<?php

    namespace Source\Controllers;

    use League\Plates\Engine;
    use Theme\Pages\Banner\BannerController;
    use Theme\Pages\Exemplos\ExemploController;
    use Theme\Pages\Home\HomeController;
    use Theme\Pages\Login\LoginController;
    use Theme\Pages\Publication\PublicationController;
    use Theme\Pages\User\UserModel;

    class Web
    {

        /** @var Engine  */
        private $controller;

        /** @var Router */
        private $router;

        public function __construct($router)
        {
            $this->router = $router;
        }

        /**
         * @param Engine $controller
         */
        public function setController($controllerName): void
        {
            $controller = null;
            switch ($controllerName) {
                case 'home':
                    $controller = new HomeController($this->router);
                    break;
                case 'publication':
                    $controller = new PublicationController($this->router);
                    break;
            }

            if (! empty($controller)) {
                $this->controller = $controller;
            } else {
                printrx(utf8_encode("<h1 style='text-align: center'>Construtor da controller {$controllerName}, n?o implementado</h1>"));
            }
        }

        public function home()
        {
            $this->pages(["page" => "home"]);
        }

        public function publication()
        {
            $this->pages(["page" => "publication"]);
        }

        public function contact()
        {
            $this->pages(["page" => "contact"]);
        }

        public function pages(array $data)
        {
            require loadController($data['page']);
            $this->setController($data['page']);
            $function = ! empty($data['function']) ? $data['function'] : "index";

            unset($data['page']);
            unset($data['function']);
            unset($data['action']);

            if (!empty($data)) {
                $this->controller->$function($data);
            } else {
                $this->controller->$function();
            }
        }

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
         *
         */
        public function logoff(): void
        {
            unset($_SESSION["user"]);

            flash("success", "Você saiu com sucesso, volte logo {$this->user->first_name}!");
            unset($this->user);

            redirect("login");
        }

        /**
         *
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

        public function reset(array $data): void
        {
            if (! empty($_SESSION['user']) && $this->user = (new UserModel())->findById($_SESSION['user'])) {
                redirect();
            }

            require loadController('login');
            $this->controller = new LoginController($this->router);

            $this->controller->reset($data);
        }

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
         *
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

        public function slugPublication($slug)
        {
            require loadController('publication');
            $this->setController('publication');
            $function = 'slugPublication';

            $this->controller->$function($slug);
        }

        public function error($data)
        {
            echo "<h1 style='text-align: center'>Web Error " . $data['errcode'] . "</h1>";
        }
    }