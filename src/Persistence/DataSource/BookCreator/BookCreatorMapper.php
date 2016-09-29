<?php
namespace PenPaper\Persistence\DataSource\BookCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Book\BookMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;

/**
 * @inheritdoc
 */
class BookCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('book', BookMapper::class);
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
