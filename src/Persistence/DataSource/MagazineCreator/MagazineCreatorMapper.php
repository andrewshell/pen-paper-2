<?php
namespace PenPaper\Persistence\DataSource\MagazineCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Magazine\MagazineMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;

/**
 * @inheritdoc
 */
class MagazineCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('magazine', MagazineMapper::class);
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
