<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\GameSystem\GameSystemMapper;
use PenPaper\Domain\Repository\GameSystems as GameSystemsRepository;

class GameSystemsAtlasRepository implements GameSystemsRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getGameSystemsStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(GameSystemMapper::class)
            ->where('game_system LIKE ?', $prefix . '%')
            ->orderBy([
                'game_system ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getGameSystemById($id)
    {
        $entity = $this->atlas->fetchRecord(
            GameSystemMapper::class,
            $id,
            [
                'rpg_books' => function ($book) {
                    $book->with([
                        'game_line',
                        'publisher',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['rpg_books'],
            [
                'string title asc',
            ]
        );

        return $entity;
    }
}
