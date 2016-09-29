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

        /** Domain Use Cases */

        $di->params[Domain\Creators::class] = [
            'repo' => $di->lazyNew(Persistence\CreatorsAtlasRepository::class),
        ];

        $di->params[Domain\Creator::class] = [
            'repo' => $di->lazyNew(Persistence\CreatorsAtlasRepository::class),
        ];

        /** Repositories */

        $di->params[Persistence\CreatorsAtlasRepository::class] = [
            'atlas' => $di->lazyGet('atlas'),
        ];

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

        $adr->get('Creators', '/creators/{prefix}?/?', Domain\Creators::class)
            ->defaults(['prefix' => 'A', '_view' => 'creators.html.twig']);

        $adr->get('Creator', '/creator/{id}/', Domain\Creator::class)
            ->defaults(['_view' => 'creator.html.twig']);
    }
}
