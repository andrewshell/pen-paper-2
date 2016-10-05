<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\GameLine\GameLineMapper;
use PenPaper\Domain\Repository\GameLines as GameLinesRepository;

class GameLinesAtlasRepository implements GameLinesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getGameLinesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(GameLineMapper::class)
            ->where('game_line LIKE ?', $prefix . '%')
            ->orderBy([
                'game_line ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getGameLineById($id)
    {
        $entity = $this->atlas->fetchRecord(
            GameLineMapper::class,
            $id,
            [

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
