<?php
namespace PenPaper\Persistence\DataSource\FictionBook;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\FictionBookCreator\FictionBookCreatorMapper;
use PenPaper\Persistence\DataSource\ShortStory\ShortStoryMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
/**
 * @inheritdoc
 */
class FictionBookMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('fiction_book_creators', FictionBookCreatorMapper::class);
        $this->oneToMany('short_stories', ShortStoryMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
    }
}
