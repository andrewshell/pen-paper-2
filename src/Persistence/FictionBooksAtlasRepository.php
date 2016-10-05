<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\FictionBook\FictionBookMapper;
use PenPaper\Domain\Repository\FictionBooks as FictionBooksRepository;

class FictionBooksAtlasRepository implements FictionBooksRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getFictionBooksStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(FictionBookMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getFictionBookById($id)
    {
        $entity = $this->atlas->fetchRecord(
            FictionBookMapper::class,
            $id,
            [

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
