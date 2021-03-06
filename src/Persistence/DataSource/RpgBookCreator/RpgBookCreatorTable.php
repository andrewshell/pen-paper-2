<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\RpgBookCreator;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class RpgBookCreatorTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'rpg_book_creators';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'rpg_book_creator_id',
            'creator_id',
            'rpg_book_id',
            'credit_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'rpg_book_creator_id' => (object) [
                'name' => 'rpg_book_creator_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => true,
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
            'rpg_book_id' => (object) [
                'name' => 'rpg_book_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'credit_id' => (object) [
                'name' => 'credit_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
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
            'rpg_book_creator_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'rpg_book_creator_id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'rpg_book_creator_id' => null,
            'creator_id' => null,
            'rpg_book_id' => null,
            'credit_id' => null,
        ];
    }
}
