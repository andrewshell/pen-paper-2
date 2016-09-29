<?php
namespace PenPaper\Persistence\DataSource\Creator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\BookCreator\BookCreatorMapper;
use PenPaper\Persistence\DataSource\OtherGameCreator\OtherGameCreatorMapper;
use PenPaper\Persistence\DataSource\MagazineCreator\MagazineCreatorMapper;
use PenPaper\Persistence\DataSource\ArticleCreator\ArticleCreatorMapper;
use PenPaper\Persistence\DataSource\FictionCreator\FictionCreatorMapper;
use PenPaper\Persistence\DataSource\ShortFictionCreator\ShortFictionCreatorMapper;
use PenPaper\Persistence\DataSource\ComicCreator\ComicCreatorMapper;

/**
 * @inheritdoc
 */
class CreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('books', BookCreatorMapper::class);
        $this->oneToMany('othergames', OtherGameCreatorMapper::class);
        $this->oneToMany('magazines', MagazineCreatorMapper::class);
        $this->oneToMany('articles', ArticleCreatorMapper::class);
        $this->oneToMany('fictions', FictionCreatorMapper::class);
        $this->oneToMany('shortfictions', ShortFictionCreatorMapper::class);
        $this->oneToMany('comics', ComicCreatorMapper::class);
    }
}
