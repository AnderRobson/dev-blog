<?php

    namespace Theme\Pages\Products;

    use Source\Models\Model;

    class ProductsModel extends Model
    {
        public function __construct()
        {
            $this->setTable("products");

            parent::__construct("products", ["title", "slug", "code", "description"]);
        }

        public function getImages()
        {
            $idProduct = $this->id;

            $this->setTable("product_images");

            $images = $this->search([
                'where' => [
                    'Product_images.id_product' => $idProduct,
                ]
            ], true);

            $this->reset();

            if (empty($images)) {
                $images = new \stdClass();
                $images->image = 'semimage.png';
                $images = [
                    $images
                ];
            }
            return $images;
        }
    }