<?php

    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => DATABASE["HOST"],
        "port" => DATABASE["PORT"],
        "dbname" => DATABASE["DBNAME"],
        "username" => DATABASE["USER"],
        "passwd" => DATABASE["PASSWORD"],
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND  => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);

    /**
     * Retorna o caminho
     *
     * @param string $path
     * @return string
     */
    function url(string $path = null): string
    {
        if ($path) {
            return URL_BASE. $path;
        }

        return URL_BASE;
    }

    /**
     * Retorna o caminho de arquivos do admin
     *
     * @param string $path
     * @return string
     */
    function urlFile(string $path): string
    {
        return URL_ADMIN . "/theme/upload/" . $path;
    }

    function css(string $file)
    {
        $file = "/Plataforma/dev-blog/theme/assets/css/" . $file . ".css";
        return "<link rel='stylesheet' href='{$file}'>";
    }

    function js(string $file)
    {
        $file = "/Plataforma/dev-blog/theme/assets/js/" . $file . ".js";
        return "<script src='{$file}'></script>";
    }

    function bootstrap(string $file)
    {
        $return = null;
        $type = explode('.', $file);
        $type = end($type);

        $file = "/Plataforma/dev-blog/vendor/twbs/bootstrap/" . $file;

        switch ($type) {
            case 'js':
                $return = "<script src='{$file}'></script>";
                break;
            case 'css':
                $return = "<link rel='stylesheet' href='{$file}'>";
        }

        return $return;
    }

    function plugins(string $file)
    {
        $return = null;
        $type = explode('.', $file);
        $type = end($type);
        $file = "/Plataforma/dev-blog/theme/assets/plugins/" . $file;

        switch ($type) {
            case 'js':
                $return = "<script src='{$file}'></script>";
                break;
            case 'css':
                $return = "<link rel='stylesheet' href='{$file}'>";
        }

        return $return;
    }

    function redirect($route, $external = false)
    {
        if ($external) {
            header("location: " . $route);
            exit;
        }
        
        header("location: " . url($route));
        exit;
    }

    function message(string $message, string $type): string
    {
        return utf8_encode("<div class='message {$type}'>{$message}</div>");
    }

    function loadController(string $controller)
    {
        $route = ROOT . DS . 'theme' . DS . 'pages' . DS . $controller . DS . 'controller.php';

        if (file_exists($route))
            return $route;
        else
            printrx(utf8_encode("<h1 style='text-align: center'>P�gina {$controller} n�o encontrada</h1>"));
    }