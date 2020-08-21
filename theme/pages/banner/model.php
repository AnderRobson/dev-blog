<?php

namespace Theme\Pages\Banner;


use Source\Models\Model;
use Theme\Pages\Products\ProductsModel;

class BannerModel extends Model
{
    public function __construct()
    {
        $this->setTable("banners");
        parent::__construct("banners", ["title", "slug", "description"]);
    }

    public function getProducts()
    {
        $this->setTable("banners_products");

        $bannerProducts = $this->search([
            'where' => [
                'Banners_products.id_banner' => $this->id,
            ]
        ], true);

        $this->reset();
        foreach ($bannerProducts as &$bannerProduct) {
            $bannerProduct->product = (new ProductsModel())->findById($bannerProduct->id_product);
        }

        return $bannerProducts;
    }
}