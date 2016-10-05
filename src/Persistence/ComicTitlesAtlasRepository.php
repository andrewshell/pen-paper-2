<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\ComicTitle\ComicTitleMapper;
use PenPaper\Domain\Repository\ComicTitles as ComicTitlesRepository;

class ComicTitlesAtlasRepository implements ComicTitlesRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getComicTitlesStartingWith($prefix = '')
    {
        $entities = $this->atlas
            ->select(ComicTitleMapper::class)
            ->where('title LIKE ?', $prefix . '%')
            ->orderBy([
                'title ASC',
            ])
            ->fetchRecordSet();

        return $entities;
    }

    public function getComicTitleById($id)
    {
        $entity = $this->atlas->fetchRecord(
            ComicTitleMapper::class,
            $id,
            [
                'publisher',
                'game_line',
                'comic_issues',
            ]
        )->getArrayCopy();

        foreach (array_keys($entity['comic_issues']) as $k) {
            $entity['comic_issues'][$k]['comic_title'] = [
                'title' => $entity['title'],
            ];
        }

        $sorter = new Sorter();

        $sorter->sort(
            $entity['comic_issues'],
            [
                'int issue_number desc',
            ]
        );

        return $entity;
    }
}
