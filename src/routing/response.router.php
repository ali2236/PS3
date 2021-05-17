<?php

namespace routing;

use Closure;
use STreeContext;

///
/// Responses
///

function view($name): Closure
{
    return function (STreeContext $ctx) use ($name) {
        return $ctx->view($name);
    };
}

function redirect($route, $statusCode = 303) : Closure
{
    return function ($ctx) use ($route, $statusCode) {
        header('Location: ' . $route, true, $statusCode);
        die();
    };
}

function guard(Closure $handler) : Closure
{
    return function ($ctx) use ($handler){
        return $handler->call($ctx, $ctx);
    };
}
