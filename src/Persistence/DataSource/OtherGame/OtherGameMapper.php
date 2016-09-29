<?php
namespace PenPaper\Persistence\DataSource\OtherGame;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\GameType\GameTypeMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;

/**
 * @inheritdoc
 */
class OtherGameMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('gameline', GameLineMapper::class);
        $this->manyToOne('gametype', GameTypeMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
    }
}
