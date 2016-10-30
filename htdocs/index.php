<?php
use Cadre\Module\ModuleLoader;
use PenPaper\Module\Core as CoreModule;
use PenPaper\Module\Domain as DomainModule;
use PenPaper\Module\Routing as RoutingModule;
use Radar\Adr\Boot;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require '../vendor/autoload.php';

$isDev = true;

$containerCache = null; // __DIR__ . '/../cache/container.php';

$boot = new Boot($containerCache);
$adr = $boot->adr([
    new ModuleLoader(
        [
            CoreModule::class,
            DomainModule::class,
            RoutingModule::class,
        ],
        $isDev
    ),
]);

$adr->run(Request::fromGlobals(), new Response());
