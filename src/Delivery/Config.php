<?php
namespace PenPaper\Delivery;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use PenPaper\Domain;
use PenPaper\Persistence;
use Radar\Adr\Handler\RoutingHandler;
use Radar\Adr\Handler\ActionHandler;
use Relay\Middleware\ExceptionHandler;
use Relay\Middleware\ResponseSender;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;
use Zend\Diactoros\Response;

class Config extends ContainerConfig
{
    public function define(Container $di)
    {
        /** Services */

        $di->set('twig:environment', $di->lazyNew(Twig_Environment::class));

        /** DefaultResponder */

        $di->params[DefaultResponder::class] = [
            'twig' => $di->lazyGet('twig:environment'),
        ];

        /** ExceptionHandler */

        $di->params[ExceptionHandler::class] = [
            'exceptionResponse' => $di->lazyNew(Response::class),
        ];

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
            ];

            $di->params["PenPaper\\Domain\\{$single}"] = [
                'repo' => $di->lazyNew("PenPaper\\Persistence\\{$plural}AtlasRepository"),
            ];
        }

        /** Twig */

        $di->params[Twig_Loader_Filesystem::class]['paths'] = [
            realpath(__DIR__ . '/../../views'),
        ];

        $di->params[Twig_Environment::class] = [
            'loader' => $di->lazyNew(Twig_Loader_Filesystem::class),
            'options' => ['debug' => true],
        ];

        $di->setters[Twig_Environment::class]['setExtensions'] = new LazyArray([
            $di->lazyNew(Twig_Extension_Debug::class),
        ]);
    }

    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->middle(ResponseSender::class);
        $adr->middle(ExceptionHandler::class);
        $adr->middle(RoutingHandler::class);
        $adr->middle(ActionHandler::class);

        $adr->responder(DefaultResponder::class);

        $adr->get('SlashRedirect', '{path}', Domain\SlashRedirect::class)
            ->tokens(['path' => '^(.*[^/])$'])
            ->responder(SlashRedirect\Responder::class);

        $adr->get('Home', '/', Domain\Home::class)
            ->defaults(['_view' => 'home.html.twig']);

        $domains = [
            ['creators', 'creator'],
            ['rpg_books', 'rpg_book'],
            ['other_games', 'other_game'],
            [false, 'magazine_article'],
            [false, 'magazine_issue'],
            ['magazine_titles', 'magazine_title'],
            ['fiction_books', 'fiction_book'],
            [false, 'comic_issue'],
            ['comic_titles', 'comic_title'],
            ['short_stories', 'short_story'],
            ['publishers', 'publisher'],
            ['game_lines', 'game_line'],
            ['game_systems', 'game_system'],
            [false, 'game_type'],
        ];

        foreach ($domains as $domain) {
            list($pluralSnake, $singleSnake) = $domain;

            if (false !== $pluralSnake) {
                $pluralKebob = str_replace('_', '-', $pluralSnake);
                $pluralCamel = str_replace(' ', '', ucwords(str_replace('_', ' ', $pluralSnake)));
                $pluralDomain = "PenPaper\\Domain\\{$pluralCamel}";

                $adr->get($pluralCamel, "/{$pluralKebob}/{prefix}?/?", $pluralDomain)
                    ->defaults(['prefix' => 'A', '_view' => "{$pluralSnake}.html.twig"]);
            }

            if (false !== $singleSnake) {
                $singleKebob = str_replace('_', '-', $singleSnake);
                $singleCamel = str_replace(' ', '', ucwords(str_replace('_', ' ', $singleSnake)));
                $singleDomain = "PenPaper\\Domain\\{$singleCamel}";

                $adr->get($singleCamel, "/{$singleKebob}/{id}/", $singleDomain)
                    ->defaults(['_view' => "{$singleSnake}.html.twig"]);
            }
        }
    }
}
