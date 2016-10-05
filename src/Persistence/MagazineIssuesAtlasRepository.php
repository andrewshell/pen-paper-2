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

            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        return $entity;
    }
}
