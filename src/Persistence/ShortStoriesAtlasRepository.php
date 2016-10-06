<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\ShortStory\ShortStoryMapper;
use PenPaper\Domain\Repository\ShortStories as ShortStoriesRepository;

class ShortStoriesAtlasRepository implements ShortStoriesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getShortStoriesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(ShortStoryMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getShortStoryById($id)
    {
        $entity = $this->atlas->fetchRecord(
            ShortStoryMapper::class,
            $id,
            [
                'game_line',
                'fiction_book' => function ($book) {
                    $book->with([
                        'publisher',
                    ]);
                },
                'magazine_issue' => function ($issue) {
                    $issue->with([
                        'magazine_title' => function ($title) {
                            $title->with([
                                'publisher',
                            ]);
                        },
                    ]);
                },
                'rpg_book' => function ($book) {
                    $book->with([
                        'publisher',
                    ]);
                },
                'short_story_creators'=> function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['short_story_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        $merger = new CreditMerger();

        $merger->merge(
            $entity['short_story_creators'],
            'short_story_id'
        );

        return $entity;
    }
}
