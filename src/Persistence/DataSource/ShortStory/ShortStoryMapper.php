<?php
namespace PenPaper\Persistence\DataSource\ShortStory;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ShortStoryCreator\ShortStoryCreatorMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\FictionBook\FictionBookMapper;
use PenPaper\Persistence\DataSource\MagazineIssue\MagazineIssueMapper;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
/**
 * @inheritdoc
 */
class ShortStoryMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('short_story_creators', ShortStoryCreatorMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
        $this->manyToOne('fiction_book', FictionBookMapper::class);
        $this->manyToOne('magazine_issue', MagazineIssueMapper::class);
        $this->manyToOne('rpg_book', RpgBookMapper::class);
    }
}
