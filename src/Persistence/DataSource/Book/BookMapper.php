<?php
namespace PenPaper\Persistence\DataSource\Book;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\GameSystem\GameSystemMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;

/**
 * @inheritdoc
 */
class BookMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('gameline', GameLineMapper::class);
        $this->manyToOne('gamesystem', GameSystemMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
    }
}
