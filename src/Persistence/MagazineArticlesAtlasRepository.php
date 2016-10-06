<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\MagazineArticle\MagazineArticleMapper;
use PenPaper\Domain\Repository\MagazineArticles as MagazineArticlesRepository;

class MagazineArticlesAtlasRepository implements MagazineArticlesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getMagazineArticleById($id)
    {
        $entity = $this->atlas->fetchRecord(
            MagazineArticleMapper::class,
            $id,
            [
                'game_line',
                'magazine_issue' => function ($issue) {
                    $issue->with([
                        'magazine_title' => function ($title) {
                            $title->with([
                                'publisher',
                            ]);
                        },
                    ]);
                },
                'magazine_article_creators' => function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['magazine_article_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        $merger = new CreditMerger();

        $merger->merge(
            $entity['magazine_article_creators'],
            'magazine_article_id'
        );

        return $entity;
    }
}
