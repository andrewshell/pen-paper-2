<?php
namespace PenPaper\Persistence\DataSource\Comic;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ComicTitle\ComicTitleMapper;

/**
 * @inheritdoc
 */
class ComicMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('title', ComicTitleMapper::class);
    }
}
