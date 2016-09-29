<?php
namespace PenPaper\Persistence\DataSource\ShortFiction;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\Fiction\FictionMapper;
use PenPaper\Persistence\DataSource\Magazine\MagazineMapper;
use PenPaper\Persistence\DataSource\Book\BookMapper;

/**
 * @inheritdoc
 */
class ShortFictionMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('gameline', GameLineMapper::class);
        $this->manyToOne('fiction', FictionMapper::class);
        $this->manyToOne('magazine', MagazineMapper::class);
        $this->manyToOne('book', BookMapper::class);
    }
}
