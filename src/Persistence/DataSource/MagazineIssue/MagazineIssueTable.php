<?php
/**
 * This table class was generated by Atlas. Changes will be overwritten.
 */
namespace PenPaper\Persistence\DataSource\MagazineIssue;

use Atlas\Orm\Table\AbstractTable;

/**
 * @inheritdoc
 */
class MagazineIssueTable extends AbstractTable
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'magazine_issues';
    }

    /**
     * @inheritdoc
     */
    public function getColNames()
    {
        return [
            'magazine_issue_id',
            'magazine_title_id',
            'issue_number',
            'cover_date',
            'page_count',
            'notes',
            'cover',
            'url',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCols()
    {
        return [
            'magazine_issue_id' => (object) [
                'name' => 'magazine_issue_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => true,
            ],
            'magazine_title_id' => (object) [
                'name' => 'magazine_title_id',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => null,
                'autoinc' => false,
                'primary' => false,
            ],
            'issue_number' => (object) [
                'name' => 'issue_number',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => '0',
                'autoinc' => false,
                'primary' => false,
            ],
            'cover_date' => (object) [
                'name' => 'cover_date',
                'type' => 'varchar',
                'size' => 100,
                'scale' => null,
                'notnull' => true,
                'default' => '',
                'autoinc' => false,
                'primary' => false,
            ],
            'page_count' => (object) [
                'name' => 'page_count',
                'type' => 'int',
                'size' => 11,
                'scale' => null,
                'notnull' => true,
                'default' => '0',
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
            'cover' => (object) [
                'name' => 'cover',
                'type' => 'varchar',
                'size' => 50,
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
            'magazine_issue_id',
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
            'magazine_issue_id' => null,
            'magazine_title_id' => null,
            'issue_number' => '0',
            'cover_date' => '',
            'page_count' => '0',
            'notes' => null,
            'cover' => '',
            'url' => '',
        ];
    }
}
