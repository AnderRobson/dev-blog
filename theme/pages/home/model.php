<?php

    namespace Theme\Pages\Home;

    use CoffeeCode\DataLayer\DataLayer;

    class HomeModel extends DataLayer
    {
        public function __construct()
        {
            parent::__construct("banners", ["title", "slug", "description"]);
        }
    }