<?php

require_once 'routing\controller.router.php';

use FastRoute\Dispatcher;
use function routing\registerRoutes;

class STreeContext
{
    public Closure $view;

    public function view(mixed $param)
    {
        return $this->view->call($this, $this, $param);
    }
}

function stree($view, $routes): string
{
    $ctx = new STreeContext();
    $ctx->view = $view;
    $router = registerRoutes($routes);
    $requestedUri = $_SERVER["REQUEST_URI"];
    $httpMethod = $_SERVER['REQUEST_METHOD'];

    //var_dump($router);

    $result = $router->dispatch($httpMethod, $requestedUri);

    if ($result[0] == Dispatcher::FOUND) {
        $handler = $result[1];
        return $handler->call($ctx, $ctx);
    } else {
        return var_export($result);
    }
}


