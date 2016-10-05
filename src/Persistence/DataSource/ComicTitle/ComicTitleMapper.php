<?php
namespace PenPaper\Persistence\DataSource\ComicTitle;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ComicIssue\ComicIssueMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
/**
 * @inheritdoc
 */
class ComicTitleMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('comic_issues', ComicIssueMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
    }
}
