<?php
namespace PenPaper\Domain;

class GameSystems
{
    private $repo;

    public function __construct(Repository\GameSystems $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'game_systems' => $this->repo->getGameSystemsStartingWith($params['prefix']),
            'prefix' => $params['prefix'],
        ];
    }
}
