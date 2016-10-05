<?php
namespace PenPaper\Domain;

class GameLines
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
            'game_lines' => $this->repo->getGameLinesStartingWith($params['prefix']),
        ];
    }
}
