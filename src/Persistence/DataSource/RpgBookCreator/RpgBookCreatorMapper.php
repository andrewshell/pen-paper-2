<?php
namespace PenPaper\Persistence\DataSource\RpgBookCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;
/**
 * @inheritdoc
 */
class RpgBookCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('rpg_book', RpgBookMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
