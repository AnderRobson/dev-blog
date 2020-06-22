<!doctype html>
<html lang="UTF-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title; ?></title>
        <?php
            echo css("style");
            echo bootstrap("dist/css/bootstrap.min.css");
            echo $v->section("css");
        ?>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="#" style="margin-left: 20px;">Meu primeiro Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto" style="margin-left: 20px;">
                        <li class="nav-item {{(Route::current()->getName() == 'site.home') ? 'active' : ''}}">
                            <a class="nav-link" href="<?= url("/"); ?>">Home</a>
                        </li>
                        <li class="nav-item {{(Route::current()->getName() == 'site.courses') ? 'active' : ''}}">
                            <a class="nav-link" href="<?= url("/publication"); ?>">Publicação</a>
                        </li>
                        <li class="nav-item {{(Route::current()->getName() == 'site.contact') ? 'active' : ''}}">
                            <a class="nav-link" href="<?= url("/contact"); ?>">Contato</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main role="main">

            <?= $v->section("content"); ?>

            <footer class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; <?= date('Y'); ?> Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
        </main>
        <?php
            echo js("jquery");
            echo bootstrap("dist/js/bootstrap.bundle.min.js");
            echo $v->section("js");
        ?>
    </body>
</html>