<?php
    use CoffeeCode\Router\Router;

    $router = new Router(URL_BASE);

    $router->group(null);

    /**
     * Setando Controllers
     */
    $router->namespace("Source\Controllers");

    $router->get("/", "Web:home");

    $router->get("{slug_post}", "Web:slugPost");
    $router->get("pages/{page}", "Web:pages");
    $router->get("pages/{page}/{function}", "Web:pages");
    $router->post("pages/{page}/{function}", "Web:pages");

    /**
     * Group Error
     * This monitors all Router errors. Are they: 400 Bad Request, 404 Not Found, 405 Method Not Allowed and 501 Not Implemented
     */
    $router->get("ooops/{errcode}", "Web:error");

    /**
     * This method executes the routes
     */
    $router->dispatch();

    /*
     * Redirect all errors
     */
    if ($router->error()) {
        $router->redirect("/ooops/{$router->error()}");
    }