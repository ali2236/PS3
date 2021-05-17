# PHP Server Tree

The goal is to create a hieratical php web server that is easy to write & read for programmers

PSTree Is not trying to be fast, or a full-fledged framework.

Example:
```PHP
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
```