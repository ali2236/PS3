<?php

require_once 'src/stree.php';

use function routing\get;
use function routing\group;
use function routing\guard;
use function routing\post;
use function routing\redirect;
use function routing\view;

echo stree(
    view: fn($ctx, $name) => "view: " . $name,
    routes: [
    get('/', view('index view')),
    get('/test', view('Test View')),
    get('/home', redirect('/')),
    get('/api/user', guard(view('Are You Authenticated?'))),
    group('/user', [
        get('[/]', view("User Root")),
        get('/name', view("User Name")),
        post('/name', view("Set Name")),
    ]),
],
);