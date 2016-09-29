<?php
namespace PenPaper\Persistence\DataSource\ComicCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Comic\ComicMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;

/**
 * @inheritdoc
 */
class ComicCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('comic', ComicMapper::class);
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
