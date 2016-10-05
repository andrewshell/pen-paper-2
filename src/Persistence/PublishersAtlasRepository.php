<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\Publisher\PublisherMapper;
use PenPaper\Domain\Repository\Publishers as PublishersRepository;

class PublishersAtlasRepository implements PublishersRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getPublishersStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(PublisherMapper::class)
            ->where('publisher LIKE ?', $prefix . '%')
            ->orderBy([
                'publisher ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getPublisherById($id)
    {
        $entity = $this->atlas->fetchRecord(
            PublisherMapper::class,
            $id,
            [
                'comic_titles',
                'fiction_books',
                'magazine_titles',
                'other_games' => function ($game) {
                    $game->with([
                        'game_line',
                    ]);
                },
                'publisher_lines' => function ($lines) {
                    $lines->with([
                        'game_line',
                    ]);
                },
                'rpg_books' => function ($game) {
                    $game->with([
                        'game_line',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['publisher_lines'],
            [
                'string game_line.game_line asc',
            ]
        );

        $sorter->sort(
            $entity['comic_titles'],
            [
                'string title asc',
            ]
        );

        $sorter->sort(
            $entity['magazine_titles'],
            [
                'string title asc',
            ]
        );

        $sorter->sort(
            $entity['fiction_books'],
            [
                'string title asc',
            ]
        );

        $sorter->sort(
            $entity['other_games'],
            [
                'string title asc',
            ]
        );

        $sorter->sort(
            $entity['rpg_books'],
            [
                'string title asc',
            ]
        );

        return $entity;
    }
}
