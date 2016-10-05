<?php
namespace PenPaper\Domain;

class FictionBook
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
            'fiction_book' => $this->repo->getFictionBookById($params['id']),
        ];
    }
}
