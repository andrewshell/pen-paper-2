<?php
namespace PenPaper\Persistence\DataSource\OtherGameCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;
use PenPaper\Persistence\DataSource\OtherGame\OtherGameMapper;

/**
 * @inheritdoc
 */
class OtherGameCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
        $this->manyToOne('othergame', OtherGameMapper::class);
    }
}
