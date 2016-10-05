<?php
namespace PenPaper\Persistence\DataSource\GameType;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\OtherGame\OtherGameMapper;
/**
 * @inheritdoc
 */
class GameTypeMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('other_games', OtherGameMapper::class);
    }
}
