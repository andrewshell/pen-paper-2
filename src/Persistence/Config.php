<?php
namespace PenPaper\Persistence;

use Atlas\Orm\AtlasContainer;
use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use PenPaper\Persistence\DataSource;

class Config extends ContainerConfig
{
    public function define(Container $di)
    {
        $di->set('atlas:container', $di->lazyNew(AtlasContainer::class));
        $di->set('atlas', $di->lazyGetCall('atlas:container', 'getAtlas'));

        $conn = include(__DIR__ . '/../../config/conn.php');

        $di->params[AtlasContainer::class] = [
            'dsn'        => $conn[0],
            'username'   => $conn[1],
            'password'   => $conn[2],
            'options'    => [],
            'attributes' => [],
        ];

        $di->setters[AtlasContainer::class]['setMappers'] = [
            DataSource\ArticleCreator\ArticleCreatorMapper::class,
            DataSource\Book\BookMapper::class,
            DataSource\BookCreator\BookCreatorMapper::class,
            DataSource\Comic\ComicMapper::class,
            DataSource\ComicCreator\ComicCreatorMapper::class,
            DataSource\ComicSpecial\ComicSpecialMapper::class,
            DataSource\ComicSpecialCreator\ComicSpecialCreatorMapper::class,
            DataSource\ComicTitle\ComicTitleMapper::class,
            DataSource\Creator\CreatorMapper::class,
            DataSource\Credit\CreditMapper::class,
            DataSource\Fiction\FictionMapper::class,
            DataSource\FictionCreator\FictionCreatorMapper::class,
            DataSource\GameLine\GameLineMapper::class,
            DataSource\GameSystem\GameSystemMapper::class,
            DataSource\GameType\GameTypeMapper::class,
            DataSource\Magazine\MagazineMapper::class,
            DataSource\MagazineArticle\MagazineArticleMapper::class,
            DataSource\MagazineCreator\MagazineCreatorMapper::class,
            DataSource\MagazineTitle\MagazineTitleMapper::class,
            DataSource\OtherGame\OtherGameMapper::class,
            DataSource\OtherGameCreator\OtherGameCreatorMapper::class,
            DataSource\Publisher\PublisherMapper::class,
            DataSource\PublisherLine\PublisherLineMapper::class,
            DataSource\ReleaseMonth\ReleaseMonthMapper::class,
            DataSource\ShortFiction\ShortFictionMapper::class,
            DataSource\ShortFictionCreator\ShortFictionCreatorMapper::class,
        ];
    }

    public function modify(Container $di)
    {

    }
}
