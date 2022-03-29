<?php

namespace Theme\Pages\Products;

use Source\Models\Model;
use Theme\Pages\Stock\StockModel;

class ProductsModel extends Model
{
    public function __construct()
    {
        $this->setTable("products");

        parent::__construct("products", ["title", "slug", "code", "description"]);
    }

    public function getImages($limit = null)
    {
        $idProduct = $this->id;

        $this->setTable("product_images");

        $options['where'] = [
            'Product_images.id_product' => $idProduct,
        ];

        if (! is_null($limit)) {
            $options['limit'] = $limit;
        }

        $images = $this->search($options, true);

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

    public function getStock()
    {
        $this->stock = (new StockModel())->find('id_product = :id_product', 'id_product=' . $this->id)->fetch();
        return $this->stock;
    }
}
