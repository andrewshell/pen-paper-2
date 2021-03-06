<?php
namespace PenPaper\Persistence;

use Atlas\Orm\Atlas;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Domain\Repository\Creators as CreatorsRepository;

class CreatorsAtlasRepository implements CreatorsRepository
{
    private $atlas;

    public function __construct(Atlas $atlas)
    {
        $this->atlas = $atlas;
    }

    public function getCreatorsStartingWith($prefix = '')
    {
        $entitys = $this->atlas
            ->select(CreatorMapper::class)
            ->where('last_name LIKE ?', $prefix . '%')
            ->orderBy([
                'last_name ASC',
                'first_name ASC',
            ])
            ->fetchRecordSet();

        return $entitys;
    }

    public function getCreatorById($id)
    {
        $entity = $this->atlas->fetchRecord(
            CreatorMapper::class,
            $id,
            [
                'urls',
                'rpg_book_creators' => function ($books) {
                    $books->with([
                        'rpg_book' => function ($book) {
                            $book->with([
                                'publisher',
                                'game_line',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'other_game_creators' => function ($othergames) {
                    $othergames->with([
                        'other_game' => function ($othergame) {
                            $othergame->with([
                                'publisher',
                                'game_line',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'magazine_issue_creators' => function ($magazines) {
                    $magazines->with([
                        'magazine_issue' => function ($magazine) {
                            $magazine->with([
                                'magazine_title'
                            ]);
                        },
                        'credit',
                    ]);
                },
                'magazine_article_creators' => function ($articles) {
                    $articles->with([
                        'magazine_article' => function ($article) {
                            $article->with([
                                'magazine_issue' => function ($magazine) {
                                    $magazine->with([
                                        'magazine_title',
                                    ]);
                                },
                            ]);
                        },
                        'credit',
                    ]);
                },
                'fiction_book_creators' => function ($fictions) {
                    $fictions->with([
                        'fiction_book' => function ($fiction) {
                            $fiction->with([
                                'publisher',
                                'game_line',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'short_story_creators' => function ($shortfictions) {
                    $shortfictions->with([
                        'short_story' => function ($shortfiction) {
                            $shortfiction->with([
                                'game_line',
                                'fiction_book',
                                'magazine_issue' => function ($magazine) {
                                    $magazine->with([
                                        'magazine_title',
                                    ]);
                                },
                                'rpg_book',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'comic_issue_creators' => function ($comics) {
                    $comics->with([
                        'comic_issue' => function ($comic) {
                            $comic->with([
                                'comic_title' => function ($title) {
                                    $title->with([
                                        'publisher',
                                    ]);
                                },
                            ]);
                        },
                        'credit',
                    ]);
                },
            ]
        )->getArrayCopy();

        $sorter = new Sorter();

        $sorter->sort(
            $entity['rpg_book_creators'],
            [
                'int rpg_book.copyright desc',
                'string rpg_book.title asc',
            ]
        );

        $sorter->sort(
            $entity['other_game_creators'],
            [
                'int other_game.copyright desc',
                'string other_game.title asc',
            ]
        );

        $sorter->sort(
            $entity['magazine_issue_creators'],
            [
                'string magazine_issue.magazine_title.title asc',
                'int magazine_issue.issue_number desc',
            ]
        );

        $sorter->sort(
            $entity['magazine_article_creators'],
            [
                'string magazine_article.title asc',
            ]
        );

        $sorter->sort(
            $entity['fiction_book_creators'],
            [
                'int fiction_book.copyright desc',
                'string fiction_book.title asc',
            ]
        );

        $sorter->sort(
            $entity['short_story_creators'],
            [
                'string short_story.title asc',
            ]
        );

        $sorter->sort(
            $entity['comic_issue_creators'],
            [
                'string comic_issue.comic_title.title asc',
                'int comic_issue.issue_number desc',
            ]
        );

        $merger = new CreditMerger();

        $merger->merge(
            $entity['rpg_book_creators'],
            'rpg_book_id'
        );

        $merger->merge(
            $entity['other_game_creators'],
            'other_game_id'
        );

        $merger->merge(
            $entity['magazine_issue_creators'],
            'magazine_issue_id'
        );

        $merger->merge(
            $entity['magazine_article_creators'],
            'magazine_article_id'
        );

        $merger->merge(
            $entity['fiction_book_creators'],
            'fiction_book_id'
        );

        $merger->merge(
            $entity['short_story_creators'],
            'short_story_id'
        );

        $merger->merge(
            $entity['comic_issue_creators'],
            'comic_issue_id'
        );

        return $entity;
    }
}
