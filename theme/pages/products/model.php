<?php

    namespace Theme\Pages\Products;

    use Source\Models\Model;

    class ProductsModel extends Model
    {
        public function __construct()
        {
            parent::__construct("products", ["title", "slug", "code", "description"]);
        }
    }