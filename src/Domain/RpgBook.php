<?php
namespace PenPaper\Domain;

class RpgBook
{
    private $repo;

    public function __construct(Repository\RpgBooks $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'rpg_book' => $this->repo->getRpgBookById($params['id']),
        ];
    }
}
