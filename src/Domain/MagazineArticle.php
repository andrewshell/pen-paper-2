<?php
namespace PenPaper\Domain;

class MagazineArticle
{
    private $repo;

    public function __construct(Repository\MagazineArticles $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'magazine_article' => $this->repo->getMagazineArticleById($params['id']),
        ];
    }
}
