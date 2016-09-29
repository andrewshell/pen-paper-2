<?php
namespace PenPaper\Persistence\DataSource\ComicTitle;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;

/**
 * @inheritdoc
 */
class ComicTitleMapper extends AbstractMapper
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
