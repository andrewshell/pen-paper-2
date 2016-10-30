<?php
namespace PenPaper\Module;

use Aura\Di\Container;
use Cadre\Module\Module;

class Routing extends Module
{
    public function define(Container $di)
    {

    }

    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->get('SlashRedirect', '{path}', 'PenPaper\Domain\SlashRedirect')
            ->tokens(['path' => '^(.*[^/])$'])
            ->responder(SlashRedirect\Responder::class);

        $adr->get('Home', '/', 'PenPaper\Domain\Home')
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
