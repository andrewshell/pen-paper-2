<?php
namespace PenPaper\Domain;

class RpgBooks
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
            'rpg_books' => $this->repo->getRpgBooksStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
