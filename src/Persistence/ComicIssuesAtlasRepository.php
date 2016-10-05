<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\ComicIssue\ComicIssueMapper;
use PenPaper\Domain\Repository\ComicIssues as ComicIssuesRepository;

class ComicIssuesAtlasRepository implements ComicIssuesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getComicIssueById($id)
    {
        $entity = $this->atlas->fetchRecord(
            ComicIssueMapper::class,
            $id,
            [

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
