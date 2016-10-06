<?php
namespace PenPaper\Domain;

class MagazineTitles
{
    private $repo;

    public function __construct(Repository\MagazineTitles $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'magazine_titles' => $this->repo->getMagazineTitlesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
