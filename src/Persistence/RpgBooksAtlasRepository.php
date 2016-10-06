<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\RpgBook\RpgBookMapper;
use PenPaper\Domain\Repository\RpgBooks as RpgBooksRepository;

class RpgBooksAtlasRepository implements RpgBooksRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getRpgBooksStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(RpgBookMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getRpgBookById($id)
    {
        $entity = $this->atlas->fetchRecord(
            RpgBookMapper::class,
            $id,
            [
                'publisher',
                'game_line',
                'game_system',
                'rpg_book_creators' => function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
                'short_stories' => function ($shortfictions) {
                    $shortfictions->with([
                        'game_line',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        // lastname
        $sorter->sort(
            $entity['rpg_book_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        // shortfictiontitle
        $sorter->sort(
            $entity['short_stories'],
            [
                'string short_stories.title asc',
            ]
        );

        $merger = new CreditMerger();

        $merger->merge(
            $entity['rpg_book_creators'],
            'rpg_book_id'
        );

        return $entity;
    }
}
