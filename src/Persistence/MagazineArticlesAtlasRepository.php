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

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
