<?php
use PenPaper\Delivery\Config as DeliveryConfig;
use PenPaper\Persistence\Config as PersistenceConfig;
use Radar\Adr\Boot;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory as Request;

require '../vendor/autoload.php';

$boot = new Boot();
$adr = $boot->adr([
    PersistenceConfig::class,
    DeliveryConfig::class,
]);

$adr->run(Request::fromGlobals(), new Response());
