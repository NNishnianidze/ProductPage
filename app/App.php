<?php

declare(strict_types=1);

namespace App;

class App
{
    public function __construct(
        protected ?Router $router = null,
        protected array $request = [],
    ) {
    }

    public function run()
    {
        session_start();
        echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
    }
}
