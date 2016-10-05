<?php
namespace PenPaper\Persistence\DataSource\MagazineArticleCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\MagazineArticle\MagazineArticleMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;
/**
 * @inheritdoc
 */
class MagazineArticleCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('magazine_article', MagazineArticleMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
