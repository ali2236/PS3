<?php

namespace routing;

use Closure;


class RouteInfo {
    public ?string $method;
    public string $prefix;
    public Closure $handler;

    /**
     * RouteInfo constructor.
     * @param string|null $method
     * @param string $prefix
     */
    public function __construct(string $prefix, string $method, Closure $handler)
    {
        $this->method = $method;
        $this->prefix = $prefix;
        $this->handler = $handler;
    }

    public function executeHandler($ctx){
        if (is_callable($this->handler)){
            $this->handler->call($ctx);

        }
    }
}

class RouteGroupInfo {
    public string $prefix;
    public array $routes;

    /**
     * RouteGroupInfo constructor.
     * @param string $prefix
     * @param array $routes
     */
    public function __construct(string $prefix, array $routes)
    {
        $this->prefix = $prefix;
        $this->routes = $routes;
    }


}

///
/// Accepted Requests
///

function group($prefix, array $routes) : RouteGroupInfo{
    $info = new RouteGroupInfo($prefix, $routes);
    return $info;
}

function get($prefix, Closure $handler) : RouteInfo{
    $info = new RouteInfo($prefix, "GET", $handler);
    return $info;
}

function post($prefix, Closure $handler) : RouteInfo{
    $info = new RouteInfo($prefix, "POST", $handler);
    return $info;
}