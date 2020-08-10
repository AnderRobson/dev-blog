<?php
    $v->layout("painel/view/_theme", ["title" => $title]);

        echo $v->section("content");

    $v->start("js");
         echo$v->section("js");
    $v->end();
    $v->start("cs");
        echo $v->section("cs");
    $v->end();
