<?php
namespace PenPaper\Persistence\DataSource\MagazineTitle;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\MagazineIssue\MagazineIssueMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
/**
 * @inheritdoc
 */
class MagazineTitleMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('magazine_issues', MagazineIssueMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
    }
}
