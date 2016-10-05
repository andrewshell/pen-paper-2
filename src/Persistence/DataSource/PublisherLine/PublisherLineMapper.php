<?php
namespace PenPaper\Persistence\DataSource\PublisherLine;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
/**
 * @inheritdoc
 */
class PublisherLineMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('publisher', PublisherMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
    }
}
