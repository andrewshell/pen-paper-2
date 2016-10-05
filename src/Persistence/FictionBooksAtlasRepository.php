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
                'game_line',
                'publisher',
                'fiction_book_creators' => function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
                'short_stories' => function ($shortfiction) {
                    $shortfiction->with([
                        'game_line',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['fiction_book_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        $sorter->sort(
            $entity['short_stories'],
            [
                'string title asc',
            ]
        );

        return $entity;
    }
}
