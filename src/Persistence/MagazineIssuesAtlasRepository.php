<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\MagazineIssue\MagazineIssueMapper;
use PenPaper\Domain\Repository\MagazineIssues as MagazineIssuesRepository;

class MagazineIssuesAtlasRepository implements MagazineIssuesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getMagazineIssueById($id)
    {
        $entity = $this->atlas->fetchRecord(
            MagazineIssueMapper::class,
            $id,
            [
                'magazine_title' => function ($title) {
                    $title->with([
                        'publisher',
                    ]);
                },
                'magazine_articles' => function ($articles) {
                    $articles->with([
                        'game_line',
                    ]);
                },
                'magazine_issue_creators' => function ($creator) {
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

        return $entity;
    }
}
