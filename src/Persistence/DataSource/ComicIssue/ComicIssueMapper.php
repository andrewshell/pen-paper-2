<?php
namespace PenPaper\Persistence\DataSource\ComicIssue;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ComicIssueCreator\ComicIssueCreatorMapper;
use PenPaper\Persistence\DataSource\ComicTitle\ComicTitleMapper;
/**
 * @inheritdoc
 */
class ComicIssueMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('comic_issue_creators', ComicIssueCreatorMapper::class);
        $this->manyToOne('comic_title', ComicTitleMapper::class);
    }
}
