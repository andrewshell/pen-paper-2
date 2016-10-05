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

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
