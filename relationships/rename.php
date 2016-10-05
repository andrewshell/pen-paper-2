<?php
require_once __DIR__ . '/../vendor/autoload.php';

ini_set("auto_detect_line_endings", true);

$conn = require(__DIR__ . '/../config/conn.php');
$dbh = new PDO(...$conn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$schema = new Aura\SqlSchema\MysqlSchema($dbh, new Aura\SqlSchema\ColumnFactory());

if (!file_exists('rename.csv')) {
    $fp = fopen('rename.csv', 'w');

    $sth = $dbh->query("SHOW TABLES");
    while ($table = $sth->fetchColumn()) {
        if (preg_match('!s$!', $table)) {
            $plural = $table;
            $single = substr($table, 0, -1);
        } else {
            $single = $table;
            $plural = $table . 's';
        }

        $sth2 = $dbh->query("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'");
        $key = $sth2->fetchColumn(4);

        fputcsv($fp, [$table, $key, $plural, $single . '_id']);
    }

    fclose($fp);
    exit;
}

$tables = [];
$keys = [];

if (($fp = fopen("rename.csv", "r")) !== FALSE) {
    while ((list($oldTable, $oldKey, $newTable, $newKey) = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $tables[$oldTable] = $newTable;
        $keys[$oldKey] = $newKey;
    }

    fclose($fp);
}

$sth = $dbh->query("SHOW TABLES");
while ($oldTable = $sth->fetchColumn()) {
    if (isset($tables[$oldTable])) {
        $newTable = $tables[$oldTable];
    } else {
        $newTable = $oldTable;
    }

    if (0 !== strcmp($oldTable, $newTable)) {
        echo "Renaming `{$oldTable}` to `{$newTable}`\n";
        $dbh->query("RENAME TABLE `{$oldTable}` TO `{$newTable}`;");
    }

    $sth2 = $dbh->query("SHOW KEYS FROM `{$newTable}` WHERE Key_name = 'PRIMARY'");
    $oldKey = $sth2->fetchColumn(4);
    if (!preg_match('!id$!', $oldKey)) {
        $sth2 = $dbh->query("SHOW KEYS FROM `{$newTable}` WHERE Key_name = 'PRIMARY'");
        print_r($sth2->fetchAll(PDO::FETCH_NUM)); exit;
    }
    if (isset($keys[$oldKey])) {
        $newKey = $keys[$oldKey];
    } else {
        $newKey = $oldKey;
    }
    if (0 !== strcmp($oldKey, $newKey)) {
        echo "Renaming `{$newTable}`.`{$oldKey}` to `{$newKey}`\n";
        echo "ALTER TABLE `{$newTable}` CHANGE `{$oldKey}` `{$newKey}` INT( 11 ) NOT NULL AUTO_INCREMENT\n";
        $dbh->query("ALTER TABLE `{$newTable}` CHANGE `{$oldKey}` `{$newKey}` INT( 11 ) NOT NULL AUTO_INCREMENT");
    }

    $sth2 = $dbh->query("SHOW COLUMNS FROM `{$newTable}`");
    while ($col = $sth2->fetch(PDO::FETCH_ASSOC)) {
        $oldKey = $col['Field'];
        if (isset($keys[$oldKey])) {
            $newKey = $keys[$oldKey];
            echo "Renaming `{$newTable}`.`{$oldKey}` to `{$newKey}`\n";
            $dbh->query("ALTER TABLE `{$newTable}` CHANGE `{$oldKey}` `{$newKey}` INT( 11 ) NOT NULL");
        }
    }
}
