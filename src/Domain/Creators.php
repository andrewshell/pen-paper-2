<?php
namespace PenPaper\Domain;

class Creators
{
    private $repo;

    public function __construct(Repository\Creators $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'creators' => $this->repo->getCreatorsStartingWith($params['prefix']),
        ];
    }
}
