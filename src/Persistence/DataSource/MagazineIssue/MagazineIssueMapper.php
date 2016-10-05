<?php
namespace PenPaper\Persistence\DataSource\MagazineIssue;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\MagazineArticle\MagazineArticleMapper;
use PenPaper\Persistence\DataSource\MagazineIssueCreator\MagazineIssueCreatorMapper;
use PenPaper\Persistence\DataSource\ShortStory\ShortStoryMapper;
use PenPaper\Persistence\DataSource\MagazineTitle\MagazineTitleMapper;
/**
 * @inheritdoc
 */
class MagazineIssueMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('magazine_articles', MagazineArticleMapper::class);
        $this->oneToMany('magazine_issue_creators', MagazineIssueCreatorMapper::class);
        $this->oneToMany('short_stories', ShortStoryMapper::class);
        $this->manyToOne('magazine_title', MagazineTitleMapper::class);
    }
}
