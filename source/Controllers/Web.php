<?php

    namespace Source\Controllers;

    use League\Plates\Engine;
    use Theme\Pages\Banner\BannerController;
    use Theme\Pages\Exemplos\ExemploController;
    use Theme\Pages\Home\HomeController;
    use Theme\Pages\Publication\PublicationController;

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
                printrx(utf8_encode("<h1 style='text-align: center'>Construtor da controller {$controllerName}, n�o implementado</h1>"));
            }
        }

        public function home(array $router)
        {
            redirect("/home/index");
        }

        public function publication(array $router)
        {
            redirect("/publication/index");
        }

        public function contact(array $router)
        {
            redirect("/contact/index");
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