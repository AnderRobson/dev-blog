<?php

    namespace Theme\Pages\Home;

    use Source\Models\Model;

    class HomeModel extends Model
    {
        public function __construct()
        {
            parent::__construct("banners", ["title", "slug", "description"]);
        }
    }