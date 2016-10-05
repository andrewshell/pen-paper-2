<?php
namespace PenPaper\Persistence\DataSource\OtherGame;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\OtherGameCreator\OtherGameCreatorMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\GameType\GameTypeMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
use PenPaper\Persistence\DataSource\ReleaseMonth\ReleaseMonthMapper;
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
        $this->oneToMany('other_game_creators', OtherGameCreatorMapper::class);
        $this->manyToOne('game_line', GameLineMapper::class);
        $this->manyToOne('game_type', GameTypeMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
        $this->manyToOne('release_month', ReleaseMonthMapper::class);
    }
}
