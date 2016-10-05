<?php
namespace PenPaper\Domain;

class MagazineTitle
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
            'magazine_title' => $this->repo->getMagazineTitleById($params['id']),
        ];
    }
}
