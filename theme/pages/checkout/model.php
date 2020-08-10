<?php

    namespace Theme\Pages\Checkout;

    use Source\Models\Model;

    class CheckoutModel extends Model
    {
        public function __construct()
        {
            $this->setTable("products");

            parent::__construct("products", ["title", "slug", "code", "description"]);
        }
    }