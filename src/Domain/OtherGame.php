<?php
namespace PenPaper\Domain;

class OtherGame
{
    private $repo;

    public function __construct(Repository\OtherGames $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'other_game' => $this->repo->getOtherGameById($params['id']),
        ];
    }
}
