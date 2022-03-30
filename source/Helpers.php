<?php

/**
 * Responsavel por minificar arquivos da pasta assets.
 */
//if ($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_NAME"] == "192.168.0.11") {
//    require __DIR__ . DS . "Minify.php";
//}

/**
 * Responsavel por montar url para redirecionamentos dentro da plataforma.
 *
 * @param string $path
 * @return string
 */
function url(string $path = null, string $protocol = null): string
{
    $url = URL_BLOG;
    if (! empty($protocol)) {
        $url = str_replace('http://', $protocol . '://', $url);
    }

    if ($path) {
        return $url . "/" . $path;
    }

    return $url;
}

/**
 * Responsavel por montar url para o admin .
 *
 * @param string $path
 * @return string
 */
function urlAdmin(string $path = null): string
{
    if ($path) {
        return URL_ADMIN . "/" . $path;
    }

    return URL_ADMIN;
}

/**
 * Responsavel por retorna a URL de arquivos
 *
 * @param string $path
 * @return string
 */
function urlFile(string $path, bool $theme = true): string
{
    if ($theme) {
        return URL_BLOG . "/upload/" . $path;
    }

    return URL_ADMIN . "/theme/upload/" . $path;
}


/**
 * Responsavel por carregar arquivos css da pasta css dentro de assets.
 *
 * @param string $file
 * @param bool $time
 * @return string
 */
function css(string $file, $time = true)
{
    $file = "dev-blog/theme/assets/css/" . $file . ".css";
    $fileOnDir = ROOT . DS . $file;

    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . fileatime($fileOnDir);
    }

    return "<link rel='stylesheet' href='" . URL_BASE . "/{$file}'>";
}


/**
 * Responsavel por carregar arquivos js da pasta js dentro de assets.
 *
 * @param string $file
 * @param bool $time
 * @return string
 */
function js(string $file, $time = true)
{
    $file = "dev-blog/theme/assets/js/" . $file . ".js";
    $fileOnDir = ROOT . DS . $file;

    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . fileatime($fileOnDir);
    }

    return "<script src='" . URL_BASE . "/{$file}'></script>";
}


/**
 * Responsavel por carregar plugins da pasta assets.
 *
 * @param string $file
 * @param bool $time
 * @return string|null
 */
function plugins(string $file, $time = true)
{
    $return = null;
    $type = explode('.', $file);
    $type = end($type);
    $file = "dev-blog/theme/assets/plugins/" . $file;
    $fileOnDir = ROOT . DS . $file;

    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . fileatime($fileOnDir);
    }

    switch ($type) {
        case 'js':
            $return = "<script src='" . URL_BASE . "/{$file}'></script>";
            break;
        case 'css':
            $return = "<link rel='stylesheet' href='" . URL_BASE . "/{$file}'>";
    }

    return $return;
}

/**
 * Responsavel por carregar arquivos do Bootstrap da vendor.
 *
 * @param string $file
 * @param bool $time
 * @return string|null
 */
function bootstrap(string $file, $time = true)
{
    $return = null;
    $type = explode('.', $file);
    $type = end($type);

    $file = "dev-blog/vendor/twbs/bootstrap/" . $file;
    $fileOnDir = ROOT . DS . $file;

    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . fileatime($fileOnDir);
    }

    switch ($type) {
        case 'js':
            $return = "<script src='" . URL_BASE . "/{$file}'></script>";
            break;
        case 'css':
            $return = "<link rel='stylesheet' href='" . URL_BASE . "/{$file}'>";
    }

    return $return;
}

/**
 * Redirecionamento de urls.
 *
 * @param $route
 * @param bool $external
 */
function redirect(string $route = null, bool $external = false, string $redirectBack = null)
{
    if (! empty($redirectBack)) {
        $_SESSION['redirectBack'] = $redirectBack;
    }

    if (! empty($external)) {
        header("location: " . $route);
        exit;
    }

    header("location: " . url($route));
    exit;
}

/**
 * Respons?vel por criar html de mensagens de alerta.
 *
 * @param string $message
 * @param string $type
 * @return string
 */
function message(string $message, string $type): string
{
    return utf8_encode("<div class=\"alert alert-{$type}\">{$message}</div>");
}

/**
 * Respons?vel por criar e renderizar mensagens gravadas na sess?o.
 *
 * @param string|null $type
 * @param string|null $message
 * @return string|null
 */
function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION['FLASH'] = [
            "type" => $type,
            "message" => $message
        ];

        return null;
    }

    if (! empty($_SESSION['FLASH'])) {
        $flash = $_SESSION['FLASH'];
        unset($_SESSION['FLASH']);

        return message($flash['message'], $flash['type']);
    }

    return null;
}

/**
 * Gerador de slug de url.
 *
 * @param $string
 * @return string
 */
function slugify($string): string
{
    return
        strtolower(
            trim(
                preg_replace(
                    '/[^A-Za-z0-9-]+/',
                    '-', $string
                ),
                '-'
            )
        );
}

function mountFilters(array $filters): array
{
    $return = [
        "keysFilter" => null,
        "valueToFilter" => null
    ];

    foreach ($filters as $keysFilter => $valueToFilter) {
        $return["keysFilter"][] = $keysFilter . " = :" . $keysFilter;
        $return["valueToFilter"][] =$keysFilter . "=" . $valueToFilter;
    }

    return [
        "keysFilter" => implode(" AND ", $return["keysFilter"]),
        "valueToFilter" => implode(" AND ", $return["valueToFilter"]),
    ];
}

function formatMoney(float $value, bool $full = true)
{
    $value = number_format($value, 2, ',', '.');

    return ($full ? "R$ " : '') . $value;
}
