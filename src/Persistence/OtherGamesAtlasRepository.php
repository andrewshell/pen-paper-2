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

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
