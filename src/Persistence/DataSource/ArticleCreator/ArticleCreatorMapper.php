<?php
namespace PenPaper\Persistence\DataSource\ArticleCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\MagazineArticle\MagazineArticleMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;

/**
 * @inheritdoc
 */
class ArticleCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('article', MagazineArticleMapper::class);
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
