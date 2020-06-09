<!doctype html>
<html lang="UTF-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <?=
            css("style");
            $v->section("css");
        ?>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                <a class="navbar-brand" href="#">Meu primeiro Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{(Route::current()->getName() == 'site.home') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('site.home')}}">Home</a>
                        </li>
                        <li class="nav-item {{(Route::current()->getName() == 'site.courses') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('site.courses')}}">Cursos</a>
                        </li>
                        <li class="nav-item {{(Route::current()->getName() == 'site.contact') ? 'active' : ''}}">
                            <a class="nav-link" href="{{route('site.contact')}}">Contato</a>
                        </li>
                    </ul>
                    <form class="form-inline mt-2 mt-md-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </header>
        <main role="main">

            <?= $v->section("content"); ?>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

            <footer class="container">
                <p class="float-right"><a href="#">Back to top</a></p>
                <p>&copy; <?= date('Y'); ?> Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
        </main>

            <?= $v->section("js"); ?>
    
    </body>
</html>