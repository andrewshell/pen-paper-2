<?php
namespace PenPaper\Persistence\DataSource\ShortFictionCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ShortFiction\ShortFictionMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;

/**
 * @inheritdoc
 */
class ShortFictionCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('shortfiction', ShortFictionMapper::class);
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
