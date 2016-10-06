<?php
namespace PenPaper\Domain;

class ComicTitles
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
            'comic_titles' => $this->repo->getComicTitlesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
