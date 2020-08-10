<!doctype html>
<html lang="UTF-8">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title; ?></title>
        <?php
            echo css("style.min");
            echo bootstrap("dist/css/bootstrap.min.css");
            echo $v->section("css");
        ?>
    </head>
    <body>
        <?php
            $v->insert("painel/view/elements/navbar");
        ?>
        <main role="main">

            <?= $v->section("content"); ?>

            <?php
                $v->insert("painel/view/elements/footer");
            ?>
        </main>
        <?php
            echo js("jquery");
            echo plugins("feather-icons/feather.min.js");
            echo bootstrap("dist/js/bootstrap.bundle.min.js");
            echo $v->section("js");
        ?>
        <script>
            feather.replace()
        </script>
    </body>
</html>