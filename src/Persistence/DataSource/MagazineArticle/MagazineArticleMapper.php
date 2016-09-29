<?php
namespace PenPaper\Persistence\DataSource\MagazineArticle;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Persistence\DataSource\Magazine\MagazineMapper;

/**
 * @inheritdoc
 */
class MagazineArticleMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('gameline', GameLineMapper::class);
        $this->manyToOne('magazine', MagazineMapper::class);
    }
}
