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
                'comic_titles',
                'fiction_books',
                'magazine_articles' => function ($article) {
                    $article->with([
                        'magazine_issue' => function ($magazine) {
                            $magazine->with([
                                'magazine_title',
                            ]);
                        },
                    ]);
                },
                'other_games',
                'publisher_lines' => function ($publisher) {
                    $publisher->with([
                        'publisher',
                    ]);
                },
                'rpg_books',
                'short_stories',
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['publisher_lines'],
            [
                'string publisher.publisher asc',
            ]
        );

        $sorter->sort(
            $entity['comic_titles'],
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

        $sorter->sort(
            $entity['short_stories'],
            [
                'string title asc',
            ]
        );

        return $entity;
    }
}
