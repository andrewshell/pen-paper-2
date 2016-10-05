<?php
namespace PenPaper\Domain;

class GameLine
{
    private $repo;

    public function __construct(Repository\GameLines $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke($params)
    {
        return [
            'success' => true,
            'game_line' => $this->repo->getGameLineById($params['id']),
        ];
    }
}
