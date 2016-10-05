<?php
namespace PenPaper\Persistence\DataSource\Publisher;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\ComicTitle\ComicTitleMapper;
use PenPaper\Persistence\DataSource\FictionBook\FictionBookMapper;
use PenPaper\Persistence\DataSource\MagazineTitle\MagazineTitleMapper;
use PenPaper\Persistence\DataSource\OtherGame\OtherGameMapper;
use PenPaper\Persistence\DataSource\PublisherLine\PublisherLineMapper;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
/**
 * @inheritdoc
 */
class PublisherMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->oneToMany('comic_titles', ComicTitleMapper::class);
        $this->oneToMany('fiction_books', FictionBookMapper::class);
        $this->oneToMany('magazine_titles', MagazineTitleMapper::class);
        $this->oneToMany('other_games', OtherGameMapper::class);
        $this->oneToMany('publisher_lines', PublisherLineMapper::class);
        $this->oneToMany('rpg_books', RpgBookMapper::class);
    }
}
