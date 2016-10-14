<?php
namespace PenPaper\Persistence;

use Cadre\AtlasOrmDebugBarBridge\AtlasContainer;
use Cadre\AtlasOrmDebugBarBridge\AtlasOrmCollector;
use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use DebugBar\DataCollector\PDO\PDOCollector;

class Config extends ContainerConfig
{
    public function define(Container $di)
    {
        $di->set('atlas:container', $di->lazyNew(AtlasContainer::class));
        $di->set('atlas', $di->lazyGetCall('atlas:container', 'getAtlas'));

        $conn = include(__DIR__ . '/../../config/conn.php');

        $di->params[AtlasContainer::class] = [
            'dsn'        => $conn[0],
            'username'   => $conn[1],
            'password'   => $conn[2],
            'options'    => [],
            'attributes' => [],
        ];

        $pattern = __DIR__ . '/DataSource/*/*Mapper.php';
        $mappers = glob($pattern);
        foreach ($mappers as $i => $file) {
            $mappers[$i] = 'PenPaper\\Persistence\\' . str_replace('/', '\\', substr($file, strpos($file, 'DataSource/'), -4));
        }

        $di->setters[AtlasContainer::class]['setMappers'] = $mappers;

        $di->params[AtlasOrmCollector::class] = [
            'atlasContainer' => $di->lazyGet('atlas:container'),
            'timeCollector' => $di->lazyGet('debugbar:tdc'),
        ];
    }

    public function modify(Container $di)
    {

    }
}
