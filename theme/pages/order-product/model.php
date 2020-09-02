<?php


namespace Theme\pages\orderProduct;


use Source\Models\Model;
use Theme\Pages\Products\ProductsModel;

class OrderProductModel extends Model
{

    public function __construct()
    {
        $this->setTable("orders_products");

        parent::__construct("orders_products", ["id_order", "id_product", "id_stock", "status", "value", "old_value", "quantity"]);
    }

    public function reset()
    {
        return new OrderProductModel();
    }

    public function getProduct()
    {
        $this->product = (new ProductsModel())->findById($this->id_product);

        return $this;
    }
}