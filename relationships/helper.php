<?php
function table_element($table)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', table_single($table))));
}

function table_single($table)
{
    global $elements;
    return $elements[$table]['single'];
}

function table_plural($table)
{
    global $elements;
    return $elements[$table]['plural'];
}

function table_class_prefix($table)
{
    return 'PenPaper\\Persistence\\DataSource\\' . table_element($table);
}

function table_datasource_dir()
{
    return realpath(__DIR__ . '/../src/Persistence') . '/DataSource';
}

function table_mapper_class($table, $full = true)
{
    if (true === $full) {
        return table_class_prefix($table) . '\\' . table_element($table) . 'Mapper';
    } else {
        return table_element($table) . 'Mapper';
    }
}

function table_mapper_file($table)
{
    $element = table_element($table);
    return table_datasource_dir() . '/' . $element . '/' . $element . 'Mapper.php';
}

function table_table_class($table, $full = true)
{
    if (true === $full) {
        return table_class_prefix($table) . '\\' . table_element($table) . 'Table';
    } else {
        return table_element($table) . 'Table';
    }
}

function table_table_file($table)
{
    $element = table_element($table);
    return table_datasource_dir() . '/' . $element . '/' . $element . 'Table.php';
}
