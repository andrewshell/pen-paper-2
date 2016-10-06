<?php
namespace PenPaper\Domain;

class Publishers
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
            'publishers' => $this->repo->getPublishersStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
