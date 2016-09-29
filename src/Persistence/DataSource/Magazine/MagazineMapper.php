<?php
namespace PenPaper\Persistence\DataSource\Magazine;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\MagazineTitle\MagazineTitleMapper;

/**
 * @inheritdoc
 */
class MagazineMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('title', MagazineTitleMapper::class);
    }
}
