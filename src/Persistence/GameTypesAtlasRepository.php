<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\GameType\GameTypeMapper;
use PenPaper\Domain\Repository\GameTypes as GameTypesRepository;

class GameTypesAtlasRepository implements GameTypesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getGameTypeById($id)
    {
        $entity = $this->atlas->fetchRecord(
            GameTypeMapper::class,
            $id,
            [
                'other_games' => function ($game) {
                    $game->with([
                        'game_line',
                        'publisher',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['other_games'],
            [
                'string title asc',
            ]
        );

        return $entity;
    }
}
