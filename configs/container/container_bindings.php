<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\DB;
use App\Pegination;
use App\Router;
use App\Twig\TwigParserExtension;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

use function DI\create;
use function DI\get;

return [
    Config::class                 => create(Config::class)->constructor(require CONFIG_PATH . '/app.php'),
    EntityManager::class          => fn (Config $config) => EntityManager::create(
        $config->get('doctrine.connection'),
        ORMSetup::createAttributeMetadataConfiguration(
            $config->get('doctrine.entity_dir'),
            $config->get('doctrine.dev_mode')
        )
    ),
    FilesystemLoader::class       => fn () => new FilesystemLoader([VIEW_PATH]),
    Twig::class                   => function (FilesystemLoader $loader) {
        $twig = new Twig($loader, ['cache' => STORAGE_PATH . '/cache/compilation_cache', 'auto_reload' => 1]);

        //Add Twwig Extension
        $twig->addExtension(new TwigParserExtension);

        return $twig;
    },
    App::class                    => function (Router $router) {

        $routes         = require CONFIG_PATH . '/routes/web.php';
        $routes($router);

        $request = ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']];

        $app = new App($router, $request);

        return $app;
    },
    DB::class                     => create(DB::class)->constructor(get(EntityManager::class)),
    Pegination::class             => create(Pegination::class)->constructor(get(DB::class)),
    HomeController::class         => create(HomeController::class)->constructor(get(Twig::class), get(DB::class), get(Pegination::class)),
];
