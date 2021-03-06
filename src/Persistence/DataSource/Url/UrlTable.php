<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\Url;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class UrlTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'urls';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'url_id',
            'creator_id',
            'title',
            'url',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'url_id' => (object) [
                'name' => 'url_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => true,
            ],
            'creator_id' => (object) [
                'name' => 'creator_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'title' => (object) [
                'name' => 'title',
                'type' => 'varchar',
                'size' => 255,
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryKey()
    {
        return [
            'url_id',
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
            'url_id' => null,
            'creator_id' => null,
            'title' => '',
            'url' => '',
        ];
    }
}
