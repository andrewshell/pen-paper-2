<?php
namespace PenPaper\Persistence\DataSource\Creator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ComicIssueCreator\ComicIssueCreatorMapper;
use PenPaper\Persistence\DataSource\FictionBookCreator\FictionBookCreatorMapper;
use PenPaper\Persistence\DataSource\MagazineArticleCreator\MagazineArticleCreatorMapper;
use PenPaper\Persistence\DataSource\MagazineIssueCreator\MagazineIssueCreatorMapper;
use PenPaper\Persistence\DataSource\OtherGameCreator\OtherGameCreatorMapper;
use PenPaper\Persistence\DataSource\RpgBookCreator\RpgBookCreatorMapper;
use PenPaper\Persistence\DataSource\ShortStoryCreator\ShortStoryCreatorMapper;
use PenPaper\Persistence\DataSource\Url\UrlMapper;
/**
 * @inheritdoc
 */
class CreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('comic_issue_creators', ComicIssueCreatorMapper::class);
        $this->oneToMany('fiction_book_creators', FictionBookCreatorMapper::class);
        $this->oneToMany('magazine_article_creators', MagazineArticleCreatorMapper::class);
        $this->oneToMany('magazine_issue_creators', MagazineIssueCreatorMapper::class);
        $this->oneToMany('other_game_creators', OtherGameCreatorMapper::class);
        $this->oneToMany('rpg_book_creators', RpgBookCreatorMapper::class);
        $this->oneToMany('short_story_creators', ShortStoryCreatorMapper::class);
        $this->oneToMany('urls', UrlMapper::class);
    }
}
