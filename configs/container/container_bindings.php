<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Router;
use App\Twig\TwigParserExtension;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Fullpipe\TwigWebpackExtension\WebpackExtension;
use Twig\Environment as Twig;
use Twig\Loader\FilesystemLoader;

use function DI\create;

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
        $twig->addExtension(new WebpackExtension(PUBLIC_PATH . '/build/manifest.json', PUBLIC_PATH));

        return $twig;
    },
    App::class                    => function (Router $router) {

        $routes         = require CONFIG_PATH . '/routes/web.php';
        $routes($router);

        $request = ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']];

        $app = new App($router, $request);

        return $app;
    },
];
