<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\OtherGame\OtherGameMapper;
use PenPaper\Domain\Repository\OtherGames as OtherGamesRepository;

class OtherGamesAtlasRepository implements OtherGamesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getOtherGamesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(OtherGameMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getOtherGameById($id)
    {
        $entity = $this->atlas->fetchRecord(
            OtherGameMapper::class,
            $id,
            [
                'publisher',
                'game_line',
                'game_type',
                'release_month',
                'other_game_creators' => function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['other_game_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        return $entity;
    }
}
