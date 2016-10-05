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

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
