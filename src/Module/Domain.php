<?php
namespace PenPaper\Module;

use Aura\Di\Container;
use Cadre\Module\Module;

class Domain extends Module
{
    public function define(Container $di)
    {
        /** Domain Use Cases and Atlas Repositories */

        $domains = [
            ['Creators', 'Creator'],
            ['RpgBooks', 'RpgBook'],
            ['OtherGames', 'OtherGame'],
            ['MagazineArticles', 'MagazineArticle'],
            ['MagazineIssues', 'MagazineIssue'],
            ['MagazineTitles', 'MagazineTitle'],
            ['FictionBooks', 'FictionBook'],
            ['ComicIssues', 'ComicIssue'],
            ['ComicTitles', 'ComicTitle'],
            ['ShortStories', 'ShortStory'],
            ['Publishers', 'Publisher'],
            ['GameLines', 'GameLine'],
            ['GameSystems', 'GameSystem'],
            ['GameTypes', 'GameType'],
        ];

        foreach ($domains as $domain) {
            list($plural, $single) = $domain;

            $di->params["PenPaper\\Persistence\\{$plural}AtlasRepository"] = [
                'atlas' => $di->lazyGet('atlas'),
            ];

            $di->params["PenPaper\\Domain\\{$plural}"] = [
                'repo' => $di->lazyNew("PenPaper\\Persistence\\{$plural}AtlasRepository"),
                'debugbar' => $di->lazyGet('debugbar'),
            ];

            $di->params["PenPaper\\Domain\\{$single}"] = [
                'repo' => $di->lazyNew("PenPaper\\Persistence\\{$plural}AtlasRepository"),
            ];
        }
    }

    public function modify(Container $di)
    {

    }
}
