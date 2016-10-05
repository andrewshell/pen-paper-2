<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\ComicTitle\ComicTitleMapper;
use PenPaper\Domain\Repository\ComicTitles as ComicTitlesRepository;

class ComicTitlesAtlasRepository implements ComicTitlesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getComicTitlesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(ComicTitleMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getComicTitleById($id)
    {
        $entity = $this->atlas->fetchRecord(
            ComicTitleMapper::class,
            $id,
            [

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
