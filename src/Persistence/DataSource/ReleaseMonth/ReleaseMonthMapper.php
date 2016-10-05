<?php
namespace PenPaper\Persistence\DataSource\ReleaseMonth;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\OtherGame\OtherGameMapper;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
/**
 * @inheritdoc
 */
class ReleaseMonthMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('other_games', OtherGameMapper::class);
        $this->oneToMany('rpg_books', RpgBookMapper::class);
    }
}
