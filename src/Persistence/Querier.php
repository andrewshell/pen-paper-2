<?php
namespace PenPaper\Persistence;

use PDO;

class Querier
{
    private $dbh;
    private $selects = array();
    private $tables = array();
    private $subset = array();
    private $source = array();
    private $collected = array();

    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function select($id, array $fields, $table, array $wheres = null)
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }

        if (is_null($wheres)) {
            $wheres = [];
        } elseif (!is_array($wheres)) {
            $wheres = [$wheres];
        }

        if (isset($this->tables[$table])) {
            $selectId = $this->tables[$table];
        } else {
            $selectId = count($this->selects);
            $this->tables[$table] = $selectId;
        }

        $this->selects[$selectId] = [
            'id' => $id,
            'fields' => $fields,
            'table' => $table,
            'wheres' => $wheres,
        ];
    }

    public function subset($table, $field, $sourceTable, $sourceField)
    {
        $this->subset[$table] = [
            'field' => $field,
            'sourceTable' => $sourceTable,
            'sourceField' => $sourceField
        ];

        $this->source[$sourceTable][$sourceField] = $sourceField;
    }

    public function execute(array $params = null)
    {
        $tables = array();

        $this->collected = array();

        foreach ($this->selects as $select) {
            extract($select);
            $tables[$table] = array();
            $sql = $this->buildQuery($select);
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $tables[$table][$row[$id]] = $row;
                if (isset($this->source[$table])) {
                    foreach ($this->source[$table] as $k) {
                        $value = $row[$k];
                        if (!isset($this->collected[$table][$k])) {
                            $this->collected[$table][$k] = array();
                        }
                        $this->collected[$table][$k][$value] = $this->dbh->quote($value);
                    }
                }
            }
        }

        return $tables;
    }

    private function buildQuery(array $select)
    {
        extract($select);

        if (isset($this->subset[$table])) {
            extract($this->subset[$table]);
            $wheres[] = $table . '.' . $field . ' IN (' .
                implode(', ', array_values($this->collected[$sourceTable][$sourceField])) . ')';
        }

        $sql = 'SELECT ' . implode(', ', $fields) . "\n";
        $sql .= "FROM {$table}\n";
        $sql .= 'WHERE ' . implode(' AND ', $wheres) . ";\n";

        echo $sql;
        return $sql;
    }
}
