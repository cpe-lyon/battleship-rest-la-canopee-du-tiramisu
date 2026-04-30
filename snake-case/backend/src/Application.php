<?php

namespace App;

use Watamelo\Framework\AbstractApplication;
use Watamelo\Framework\Http\Router\Router;

class Application extends AbstractApplication
{
    public function init(Router $router)
    {
        // example routes
        $router->mapDefault($this, 'error404');
        $router->get('/', $this, 'index');

        // instead of an instance (here we use $this as a minimalistic example), you can mention any class:
        // $router->get('/', MyController::class, 'index');
    }

    public function execute(Router $router)
    {
        // find and execute matching route
        $router->dispatch();
    }

    /**
     * The following methods could be moved into separate
     * classes such as controllers or services.
     */

    public function error404(): void
    {
        http_response_code(404);
        echo '404 Not Found';
    }

    public function index(): void
    {
        echo 'Hello, World!';
    }
}
