<?php
namespace PenPaper\Domain;

class FictionBooks
{
    private $repo;

    public function __construct(Repository\FictionBooks $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'fiction_books' => $this->repo->getFictionBooksStartingWith($params['prefix']),
        ];
    }
}
