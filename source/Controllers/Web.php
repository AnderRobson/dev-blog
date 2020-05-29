<?php

    namespace Source\Controllers;

    class Web
    {

        public function home($data)
        {
            var_dump($data);
        }

        public function error($data)
        {
            echo "<h1 style='text-align: center'>Web Error " . $data['errcode'] . "</h1>";
        }
    }