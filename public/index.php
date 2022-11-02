<?php

declare(strict_types=1);

use App\App;

$container = require __DIR__ . '/../bootstrap.php';
$container->get(App::class)->run();
