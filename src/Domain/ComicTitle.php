<?php
namespace PenPaper\Domain;

class ComicTitle
{
    private $repo;

    public function __construct(Repository\ComicTitles $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'comic_title' => $this->repo->getComicTitleById($params['id']),
        ];
    }
}
