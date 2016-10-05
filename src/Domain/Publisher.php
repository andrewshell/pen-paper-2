<?php
namespace PenPaper\Domain;

class Publisher
{
    private $repo;

    public function __construct(Repository\Publishers $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'publisher' => $this->repo->getPublisherById($params['id']),
        ];
    }
}
