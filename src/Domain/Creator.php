<?php
namespace PenPaper\Domain;

class Creator
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
            'creator' => $this->repo->getCreatorById($params['id']),
        ];
    }
}
