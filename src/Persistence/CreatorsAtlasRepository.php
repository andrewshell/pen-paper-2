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
        $creators = $this->atlas
            ->select(CreatorMapper::class)
            ->where('lastname LIKE ?', $prefix . '%')
            ->orderBy([
                'lastname ASC',
                'firstname ASC',
            ])
            ->fetchRecordSet();

        return $creators;
    }

    public function getCreatorById($id)
    {
        $creator = $this->atlas->fetchRecord(
            CreatorMapper::class,
            $id,
            [
                'books' => function ($books) {
                    $books->with([
                        'book' => function ($book) {
                            $book->with([
                                'publisher',
                                'gameline',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'othergames' => function ($othergames) {
                    $othergames->with([
                        'othergame' => function ($othergame) {
                            $othergame->with([
                                'publisher',
                                'gameline',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'magazines' => function ($magazines) {
                    $magazines->with([
                        'magazine' => function ($magazine) {
                            $magazine->with([
                                'title'
                            ]);
                        },
                        'credit',
                    ]);
                },
                'articles' => function ($articles) {
                    $articles->with([
                        'article' => function ($article) {
                            $article->with([
                                'magazine' => function ($magazine) {
                                    $magazine->with([
                                        'title',
                                    ]);
                                },
                            ]);
                        },
                        'credit',
                    ]);
                },
                'fictions' => function ($fictions) {
                    $fictions->with([
                        'fiction' => function ($fiction) {
                            $fiction->with([
                                'publisher',
                                'gameline',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'shortfictions' => function ($shortfictions) {
                    $shortfictions->with([
                        'shortfiction' => function ($shortfiction) {
                            $shortfiction->with([
                                'gameline',
                                'fiction',
                                'magazine' => function ($magazine) {
                                    $magazine->with([
                                        'title',
                                    ]);
                                },
                                'book',
                            ]);
                        },
                        'credit',
                    ]);
                },
                'comics' => function ($comics) {
                    $comics->with([
                        'comic' => function ($comic) {
                            $comic->with([
                                'title' => function ($title) {
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

        // copyright desc, booktitle
        usort($creator['books'], function ($a, $b) {
            if ($b['book']['copyright'] === $a['book']['copyright']) {
                if ($a['book']['booktitle'] === $b['book']['booktitle']) {
                    return 0;
                }
                return strcmp($a['book']['booktitle'], $b['book']['booktitle']);
            }
            return strcmp($b['book']['copyright'], $a['book']['copyright']);
        });

        // copyright desc, gametitle
        usort($creator['othergames'], function ($a, $b) {
            if ($b['othergame']['copyright'] === $a['othergame']['copyright']) {
                if ($a['othergame']['gametitle'] === $b['othergame']['gametitle']) {
                    return 0;
                }
                return strcmp($a['othergame']['gametitle'], $b['othergame']['gametitle']);
            }
            return strcmp($b['othergame']['copyright'], $a['othergame']['copyright']);
        });

        // magtitle, issuenumber desc
        usort($creator['magazines'], function ($a, $b) {
            if ($a['magazine']['title']['magtitle'] === $b['magazine']['title']['magtitle']) {
                if ($b['magazine']['issuenumber'] === $a['magazine']['issuenumber']) {
                    return 0;
                }
                return (intval($b['magazine']['issuenumber']) < intval($a['magazine']['issuenumber'])) ? -1 : 1;
            }
            return strcmp($a['magazine']['title']['magtitle'], $b['magazine']['title']['magtitle']);
        });

        // arttitle
        usort($creator['articles'], function ($a, $b) {
            if ($a['article']['arttitle'] === $b['article']['arttitle']) {
                return 0;
            }
            return strcmp($a['article']['arttitle'], $b['article']['arttitle']);
        });

        // copyright desc, fictiontitle
        usort($creator['fictions'], function ($a, $b) {
            if ($b['fiction']['copyright'] === $a['fiction']['copyright']) {
                if ($a['fiction']['fictiontitle'] === $b['fiction']['fictiontitle']) {
                    return 0;
                }
                return strcmp($a['fiction']['fictiontitle'], $b['fiction']['fictiontitle']);
            }
            return strcmp($b['fiction']['copyright'], $a['fiction']['copyright']);
        });

        // shortfictiontitle
        usort($creator['shortfictions'], function ($a, $b) {
            if ($a['shortfiction']['shortfictiontitle'] === $b['shortfiction']['shortfictiontitle']) {
                return 0;
            }
            return strcmp($a['shortfiction']['shortfictiontitle'], $b['shortfiction']['shortfictiontitle']);
        });

        // comictitle, issuenumber desc
        usort($creator['comics'], function ($a, $b) {
            if ($a['comic']['title']['comictitle'] === $b['comic']['title']['comictitle']) {
                if ($b['comic']['issuenumber'] === $a['comic']['issuenumber']) {
                    return 0;
                }
                return (intval($b['comic']['issuenumber']) < intval($a['comic']['issuenumber'])) ? -1 : 1;
            }
            return strcmp($a['comic']['title']['comictitle'], $b['comic']['title']['comictitle']);
        });

        return $creator;
    }
}
