<?php
namespace PenPaper\Domain;

class GameSystem
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
            'game_system' => $this->repo->getGameSystemById($params['id']),
        ];
    }
}
