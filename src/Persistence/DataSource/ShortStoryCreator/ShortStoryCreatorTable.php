<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\ShortStoryCreator;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class ShortStoryCreatorTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'short_story_creators';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'short_story_creator_id',
            'short_story_id',
            'creator_id',
            'credit_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'short_story_creator_id' => (object) [
                'name' => 'short_story_creator_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => true,
                'primary' => true,
            ],
            'short_story_id' => (object) [
                'name' => 'short_story_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
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
            'short_story_creator_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'short_story_creator_id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'short_story_creator_id' => null,
            'short_story_id' => null,
            'creator_id' => null,
            'credit_id' => null,
        ];
    }
}
