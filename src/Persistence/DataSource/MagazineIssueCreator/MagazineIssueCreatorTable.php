<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\MagazineIssueCreator;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class MagazineIssueCreatorTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'magazine_issue_creators';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'magazine_issue_creator_id',
            'creator_id',
            'magazine_issue_id',
            'credit_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'magazine_issue_creator_id' => (object) [
                'name' => 'magazine_issue_creator_id',
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
            'magazine_issue_id' => (object) [
                'name' => 'magazine_issue_id',
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
            'magazine_issue_creator_id',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAutoinc()
    {
        return 'magazine_issue_creator_id';
    }

    /**
     * @inheritdoc
     */
    public function getColDefaults()
    {
        return [
            'magazine_issue_creator_id' => null,
            'creator_id' => null,
            'magazine_issue_id' => null,
            'credit_id' => null,
        ];
    }
}
