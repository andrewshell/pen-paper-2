<?php
namespace PenPaper\Persistence\DataSource\MagazineArticle;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\MagazineArticleCreator\MagazineArticleCreatorMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\MagazineIssue\MagazineIssueMapper;
/**
 * @inheritdoc
 */
class MagazineArticleMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('magazine_article_creators', MagazineArticleCreatorMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
        $this->manyToOne('magazine_issue', MagazineIssueMapper::class);
    }
}
