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
                'comic_title' => function ($title) {
                    $title->with([
                        'publisher',
                    ]);
                },
                'comic_issue_creators' => function ($creator) {
                    $creator->with([
                        'creator',
                        'credit',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['comic_issue_creators'],
            [
                'string creator.last_name asc',
                'string creator.first_name asc',
            ]
        );

        return $entity;
    }
}
