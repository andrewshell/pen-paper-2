<?php
namespace PenPaper\Module;

use Aura\Di\Container;
use Cadre\Module\Module;
use PenPaper\Delivery\DefaultResponder;
use Psr7Middlewares\Middleware\TrailingSlash;
use Radar\Adr\Handler\RoutingHandler;
use Radar\Adr\Handler\ActionHandler;
use Relay\Middleware\ExceptionHandler;
use Relay\Middleware\ResponseSender;
use Zend\Diactoros\Response;

class Core extends Module
{
    public function require()
    {
        return [
            AtlasOrm::class,
            Twig::class,
        ];
    }

    public function requireDev()
    {
        return [
            DebugBar::class,
        ];
    }

    public function define(Container $di)
    {
        /** DefaultResponder */

        $di->params[DefaultResponder::class] = [
            'twig' => $di->lazyGet('twig:environment'),
            'debugbar' => null,
        ];

        if ($this->loader()->loaded(DebugBar::class)) {
            $di->params[DefaultResponder::class]['debugbar'] = $di->lazyGet('debugbar');
        }

        /** ExceptionHandler */

        $di->params[ExceptionHandler::class] = [
            'exceptionResponse' => $di->lazyNew(Response::class),
        ];

        /** TrailingSlash */

        $di->params[TrailingSlash::class] = [
            'addSlash' => true,
        ];

        $di->setters[TrailingSlash::class] = [
            'redirect' => 301,
        ];
    }

    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->middle(ResponseSender::class);
        $adr->middle(ExceptionHandler::class);
        $adr->middle(RoutingHandler::class);
        $adr->middle(ActionHandler::class);
        $adr->middle(TrailingSlash::class);

        $adr->responder(DefaultResponder::class);
    }
}
