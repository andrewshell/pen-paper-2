<?php
namespace PenPaper\Domain;

class GameType
{
    private $repo;

    public function __construct(Repository\GameTypes $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'game_type' => $this->repo->getGameTypeById($params['id']),
        ];
    }
}
