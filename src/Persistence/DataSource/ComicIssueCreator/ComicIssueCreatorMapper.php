<?php
namespace PenPaper\Persistence\DataSource\ComicIssueCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\ComicIssue\ComicIssueMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;
/**
 * @inheritdoc
 */
class ComicIssueCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('comic_issue', ComicIssueMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
