<?php
namespace PenPaper\Persistence\DataSource\GameSystem;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
/**
 * @inheritdoc
 */
class GameSystemMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('rpg_books', RpgBookMapper::class);
    }
}
