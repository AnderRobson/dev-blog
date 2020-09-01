<?php

    namespace Source\Controllers;

    use CoffeeCode\Router\Router;
    use League\Plates\Engine;
    use Theme\Pages\Checkout\CheckoutController;
    use Theme\Pages\Home\HomeController;
    use Theme\Pages\Login\LoginController;
    use Theme\Pages\Products\ProductsController;
    use Theme\Pages\Publication\PublicationController;
    use Theme\Pages\User\UserController;
    use Theme\Pages\User\UserModel;

    /**
     * Class Web
     * @package Source\Controllers
     *
     * @property Engine $controller
     * @property Router $router
     */
    class Web extends Controller
    {
        /** @var UserModel */
        protected $user;

        /** @var Engine  */
        private $controller;

        /**
         * Web constructor.
         * @param $router
         */
        public function __construct($router)
        {
            parent::__construct($router);
        }

        /**
         *  Responsavel por carregar a p�gina de home.
         */
        public function home()
        {
            $this->pages(["page" => "home"]);
        }

        /**
         *  Responsavel por carregar a listagem de publica��es.
         */
        public function publication()
        {
            $this->pages(["page" => "publication"]);
        }

        /**
         *  Responsavel por carregar a listagem de produtos.
         */
        public function products()
        {
            $this->pages(["page" => "products"]);
        }

        /**
         *  Responsavel por carregar p�gina de contato.
         */
        public function contact()
        {
            $this->pages(["page" => "contact"]);
        }

        /**
         *  Responsavel por fazer busca pelo slug de uma publica��o.
         *
         * @param $slug
         */
        public function slugPublication($slug)
        {
            $this->pages(
                [
                    "page" => "publication",
                    "function" => "slugPublication"
                ] + $slug
            );

        }

        /**
         *  Responsavel por fazer busca pelo slug de um produto.
         *
         * @param $slug
         */
        public function slugProduct($slug)
        {
            $this->pages(
                [
                    "page" => "products",
                    "function" => "slugProduct"
                ] + $slug
            );
        }

        /**
         * Responsavel por fazer a chamada das p�ginas do carrinho.
         *
         * @param array $data
         */
        public function checkout($data = [])
        {
            if (empty($data['function'])) {
                $data['function'] = 'index';
            }

            $this->pages(
                [
                    "page" => "checkout"
                ] + $data
            );
        }

        /**
         * Responsavel por fazer a chamada das p�ginas do carrinho.
         *
         * @param array $data
         */
        public function user($data = [])
        {
            if (empty($data['function'])) {
                $data['function'] = 'index';
            }

            $this->pages(
                [
                    "page" => "user"
                ] + $data
            );
        }

        /**
         *  Responsavel por fazer direcionamento para controller desejada.
         *
         * @param array $data
         */
        public function pages(array $data)
        {
            require loadController($data['page']);
            $this->setController($data['page']);
            $function = ! empty($data['function']) ? $data['function'] : "index";

            unset($data['page']);
            unset($data['function']);
            unset($data['action']);
            if (method_exists($this->controller, $function)) {
                if (!empty($data)) {
                    $this->controller->$function($data);
                } else {
                    $this->controller->$function();
                }
            } else {
                redirect('ooops/404');
            }
        }

        /**
         *  Responsavel por carregar p�gina de login.
         *
         * @param array|null $data
         */
        public function login(array $data = null): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            if (!empty($data)) {
                $this->controller->index($data);
            } else {
                $this->controller->index();
            }
        }

        /**
         *  Responsavel por deslogar usu�rio.
         */
        public function logoff(): void
        {
            unset($_SESSION["user"]);

            flash("success", "Voc� saiu com sucesso, volte logo {$this->user->first_name}!");
            unset($this->user);

            redirect("login");
        }

        /**
         *  Responsavel por realizar a solicita��o de recupera��o de senha.
         */
        public function forget(array $data = null): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            if (!empty($data)) {
                $this->controller->forget($data);
            } else {
                $this->controller->forget();
            }
        }

        /**
         *  Responsavel por resetar senhar, acessando url enviado para o e-mail.
         *
         * @param array $data
         */
        public function reset(array $data): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            $this->controller->reset($data);
        }

        /**
         *  Responsavel por salvar nova senha pos resetar a senha.
         *
         * @param array $data
         */
        public function resetPassword(array $data): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            $this->controller->resetPassword($data);
        }

        /**
         *  Responsavel por realizar o registro de um novo usu�rio.
         */
        public function register(array $data = null): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            if (! empty($data)) {
                $this->controller->register($data);
            } else {
                $this->controller->register();
            }
        }

        /**
         * Responsavel por realizar login via autentica��o Facebook.
         *
         * @param array|null $data
         */
        public function facebook(array $data = null): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            if (! empty($data)) {
                $this->controller->facebook($data);
            } else {
                $this->controller->facebook();
            }
        }

        /**
         * Responsavel por realizar login via autentica��o Google.
         *
         * @param array|null $data
         */
        public function google(array $data = null): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            if (! empty($data)) {
                $this->controller->google($data);
            } else {
                $this->controller->google();
            }
        }

        /**
         *  Responsavel por exibir p�gina de erro.
         *
         * @param $data
         */
        public function error($errcode)
        {
            $errcode = filter_var($errcode["errcode"], FILTER_VALIDATE_INT);

            $head = $this->seo->optimize(
                "Bem vindo ao " . SITE["SHORT_NAME"],
                SITE["DESCRIPTION"],
                url("home"),
                "",
                )->render();

            echo $this->view->render("error/error", [
                'errcode' => $errcode,
                'head' => $head
            ]);
        }

        /**
         * Responsavel por instanciar Controller desejada para carregar suas view ou acessar alguma fun��o expecifica via url.
         *
         * @param Engine $controller
         */
        private function setController($controllerName): void
        {
            $controller = null;
            switch ($controllerName) {
                case 'home':
                    $controller = new HomeController($this->router);
                    break;
                case 'products':
                    $controller = new ProductsController($this->router);
                    break;
                case 'publication':
                    $controller = new PublicationController($this->router);
                    break;
                case 'checkout':
                    $controller = new CheckoutController($this->router);
                    break;
                case 'user':
                    $controller = new UserController($this->router);
                    break;
            }

            if (! empty($controller)) {
                $this->controller = $controller;
            } else {
                printrx(utf8_encode("<h1 style='text-align: center'>Construtor da controller {$controllerName}, n�o implementado</h1>"));
            }
        }
    }
