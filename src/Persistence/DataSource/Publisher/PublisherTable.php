<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\Publisher;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class PublisherTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'publishers';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'publisher_id',
            'publisher',
            'url',
            'notes',
            'image',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'publisher_id' => (object) [
                'name' => 'publisher_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => true,
            ],
            'publisher' => (object) [
                'name' => 'publisher',
                'type' => 'varchar',
                'size' => 100,
                'scale' => null,
                'notnull' => true,
                'default' => '',
                'autoinc' => false,
                'primary' => false,
            ],
            'url' => (object) [
                'name' => 'url',
                'type' => 'varchar',
                'size' => 255,
                'scale' => null,
                'notnull' => true,
                'default' => '',
                'autoinc' => false,
                'primary' => false,
            ],
            'notes' => (object) [
                'name' => 'notes',
                'type' => 'text',
                'size' => null,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'image' => (object) [
                'name' => 'image',
                'type' => 'varchar',
                'size' => 255,
                'scale' => null,
                'notnull' => true,
                'default' => '',
                'autoinc' => false,
                'primary' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return [
            'publisher_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'publisher_id' => null,
            'publisher' => '',
            'url' => '',
            'notes' => null,
            'image' => '',
        ];
    }
}
