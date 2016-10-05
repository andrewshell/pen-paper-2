<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/helper.php';

ini_set("auto_detect_line_endings", true);

$conn = require(__DIR__ . '/../config/conn.php');
$dbh = new PDO(...$conn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$schema = new Aura\SqlSchema\MysqlSchema($dbh, new Aura\SqlSchema\ColumnFactory());
$keyTables = [];

$sth = $dbh->query("SHOW TABLES");
while ($table = $sth->fetchColumn()) {
    if ($table === 'short_stories') {
        $plural = $table;
        $single = 'short_story';
    } elseif (preg_match('!s$!', $table)) {
        $plural = $table;
        $single = substr($table, 0, -1);
    } else {
        $single = $table;
        $plural = $table . 's';
    }

    $sth2 = $dbh->query("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'");
    $key = $sth2->fetchColumn(4);
    $keyTables[$key] = $table;
    $elements[$table] = [
        'single' => $single,
        'plural' => $plural,
        'cols' => [],
        'oneToMany' => [],
        'manyToOne' => [],
    ];
}

foreach ($keyTables as $pkey => $table) {
    foreach ($schema->fetchTableCols($table) as $col) {
        $elements[$table]['cols'][$col->name] = [
            'type' => $col->type,
            'size' => $col->size,
            'scale' => $col->scale,
            'notnull' => $col->notnull,
            'default' => $col->default,
            'autoinc' => $col->autoinc,
            'primary' => $col->primary,
        ];

        if ($col->name !== $pkey && preg_match('!id$!', $col->name)) {
            if (isset($keyTables[$col->name])) {
                $foreign = $keyTables[$col->name];
                $fsingle = $elements[$foreign]['single'];
                $fplural = $elements[$foreign]['plural'];
                $elements[$table]['manyToOne'][$fsingle] = $foreign;
                $elements[$foreign]['oneToMany'][$table] = $table;
            }
        }
        echo "\n";
    }
}

$yaml = Symfony\Component\Yaml\Yaml::dump($elements, 4);
file_put_contents(__DIR__ . '/elements.yml', $yaml);

foreach (array_keys($elements) as $table) {
    $tableFile = table_table_file($table);
    if (file_exists($tableFile)) {
        unlink($tableFile);
    }

    $mapperFile = table_mapper_file($table);
    if (file_exists($mapperFile)) {
        unlink($mapperFile);
    }

    $cmd = escapeshellarg(realpath(__DIR__ . '/../vendor/bin/atlas-skeleton.php')) . ' '
         . '--conn=' . escapeshellarg(realpath(__DIR__ . '/../config/conn.php')) . ' '
         . '--dir=' . escapeshellarg(table_datasource_dir()) . ' '
         . '--table=' . escapeshellarg($table) . ' '
         . escapeshellarg(table_class_prefix($table));

    passthru($cmd);

    $mapperContents = file_get_contents($mapperFile);

    $uses = [];
    $related = [];
    foreach ($elements[$table]['oneToMany'] as $o2mTable) {
        $plural = table_plural($o2mTable);
        $mapperClass = table_mapper_class($o2mTable, false);
        $uses[] = 'use ' . table_mapper_class($o2mTable) . ';';
        $related[] = "        \$this->oneToMany('{$plural}', {$mapperClass}::class);";
    }
    foreach ($elements[$table]['manyToOne'] as $m2oTable) {
        $single = table_single($m2oTable);
        $mapperClass = table_mapper_class($m2oTable, false);
        $uses[] = 'use ' . table_mapper_class($m2oTable) . ';';
        $related[] = "        \$this->manyToOne('{$single}', {$mapperClass}::class);";
    }

    $mapperContents = str_replace(
    "use Atlas\Orm\Mapper\AbstractMapper;\n\n/**\n * @inheritdoc\n */",
    "use Atlas\Orm\Mapper\AbstractMapper;\n" . implode("\n", $uses) . "\n/**\n * @inheritdoc\n */",
    $mapperContents
    );

    $mapperContents = str_replace(
    "        // no related fields",
    implode("\n", $related),
    $mapperContents
    );

    file_put_contents($mapperFile, $mapperContents);
}
