<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\MagazineTitle\MagazineTitleMapper;
use PenPaper\Domain\Repository\MagazineTitles as MagazineTitlesRepository;

class MagazineTitlesAtlasRepository implements MagazineTitlesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getMagazineTitlesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(MagazineTitleMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getMagazineTitleById($id)
    {
        $entity = $this->atlas->fetchRecord(
            MagazineTitleMapper::class,
            $id,
            [
                'publisher',
                'magazine_issues',
            ]
        )->getArrayCopy();

        foreach (array_keys($entity['magazine_issues']) as $k) {
            $entity['magazine_issues'][$k]['magazine_title'] = [
                'title' => $entity['title'],
            ];
        }

        $sorter = new Sorter();

        $sorter->sort(
            $entity['magazine_issues'],
            [
                'int issue_number desc',
            ]
        );

        return $entity;
    }
}
