<?php
namespace PenPaper\Persistence\DataSource\Fiction;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;

/**
 * @inheritdoc
 */
class FictionMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('gameline', GameLineMapper::class);
        $this->manyToOne('publisher', PublisherMapper::class);
    }
}
