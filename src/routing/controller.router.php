<?php

namespace routing;

require 'vendor/autoload.php';
require 'request.router.php';
require 'response.router.php';

use FastRoute;
use FastRoute\RouteCollector;


function registerRoutes(array $routes): FastRoute\Dispatcher
{
    return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) use ($routes) {
        _registerRoutes($routes, $router);
    });
}

function _registerRoutes(array $routes, FastRoute\RouteCollector $router)
{
    foreach ($routes as $info) {
        if ($info instanceof RouteGroupInfo) {
            $router->addGroup($info->prefix, function (RouteCollector $router) use ($info) {
                _registerRoutes($info->routes, $router);
            }
            );
        } else {
            /* @var RouteInfo $info */
            $router->addRoute($info->method, $info->prefix, $info->handler);
        }
    }
}
