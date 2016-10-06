<?php
namespace PenPaper\Domain;

class OtherGames
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
            'other_games' => $this->repo->getOtherGamesStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
