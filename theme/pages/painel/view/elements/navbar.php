<header>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= url(); ?>" style="margin-left: 20px;"><?= SITE["SHORT_NAME"]; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto" style="margin-left: 20px;">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("products"); ?>">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("publication"); ?>">Publicação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("contact"); ?>">Contato</a>
                    </li>
                </ul>
                <ul class="navbar-nav px-3 ml-auto">
                    <a href="<?= url('carrinho')?>">
                        <button type="button" class="btn btn-primary">
                            <i data-feather="shopping-cart"></i><span class="ml-3 badge badge-light bg-light text-primary">9</span>
                            <span class="sr-only">unread messages</span>
                        </button>
                    </a>
                </ul>
                <ul class="navbar-nav px-3 ml-2">
                    <?php if (! empty($user->person)): ?>
                        <li class="nav-item dropdown">
                            <a id="navDrop" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >
                                <?= $user->person->first_name . " " . $user->person->last_name;?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" >
                                <a class="dropdown-item" href="<?= url("pages/user"); ?>"> Perfil </a>
                                <a class="dropdown-item" href="<?= url("sair"); ?>"> Sair </a>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url("login"); ?>">Login/Registrar-se</a>
                        </li>
                    <?php endif; ?>
                </ul>
<!--                <form class="form-inline">-->
<!--                    <input class="form-control form-control-dark ml-4 mr-2" type="search" placeholder="Buscar" aria-label="Search">-->
<!--                    <button class="btn btn-dark" type="submit">Ok</button>-->
<!--                </form>-->
            </div>
        </div>
    </nav>
</header>
