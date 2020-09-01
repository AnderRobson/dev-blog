<?php
$v->layout("painel/view/_theme"); ?>

    <?= $v->section("content"); ?>

<?php
    $v->start("js");
        echo $v->section("js");
    $v->end();
