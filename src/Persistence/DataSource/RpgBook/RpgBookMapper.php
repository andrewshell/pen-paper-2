<?php
namespace PenPaper\Persistence\DataSource\RpgBook;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\RpgBookCreator\RpgBookCreatorMapper;
use PenPaper\Persistence\DataSource\ShortStory\ShortStoryMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\GameSystem\GameSystemMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
use PenPaper\Persistence\DataSource\ReleaseMonth\ReleaseMonthMapper;
/**
 * @inheritdoc
 */
class RpgBookMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('rpg_book_creators', RpgBookCreatorMapper::class);
        $this->oneToMany('short_stories', ShortStoryMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
        $this->manyToOne('game_system', GameSystemMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
        $this->manyToOne('release_month', ReleaseMonthMapper::class);
    }
}
