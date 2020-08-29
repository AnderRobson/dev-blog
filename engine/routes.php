<?php
    use CoffeeCode\Router\Router;

    $router = new Router(URL_BASE);

    $router->group(null);

    /**
     * Setando Controllers
     */
    $router->namespace("Source\Controllers");

    $router->get("/", "Web:home");

    $router->get("{page}/{function}", "Web:pages");
    $router->get("publication/{slug_post}", "Web:slugPublication");
    $router->get("products/{slug_product}", "Web:slugProduct");
    $router->get("carrinho/{function}", "Web:checkout");
    $router->post("carrinho/{function}", "Web:checkout");
    $router->get("carrinho", "Web:checkout");
    $router->get("products", "Web:products");
    $router->get("publication", "Web:publication");
    $router->get("contact", "Web:contact");

    /**
     *  Rotas para login
     */
    $router->group(null);

    $router->get("login", "Web:login", "Web.login");
    $router->post("login", "Web:login", "Web.login");
    $router->get("register", "Web:register", "Web.register");
    $router->post("register", "Web:register", "Web.register");
    $router->get("forget", "Web:forget", "Web.forget");
    $router->post("forget", "Web:forget", "Web.forget");
    $router->get("reset/{email}/{forget}", "Web:reset", "Web.reset");
    $router->post("reset", "Web:resetPassword", "Web.resetPassword");
    $router->get("sair", "Web:logoff", "Web.logoff");
    /**
     * Redes sociais
     */

    $router->get("facebook", "Web:facebook", "Web.facebook");
    $router->get("google", "Web:google", "Web.google");

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