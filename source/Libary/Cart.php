<?php


namespace Source\Libary;


use Theme\Pages\Products\ProductsModel;
use Theme\Pages\Stock\StockModel;

class Cart
{

    private $Freight;

    public function __construct()
    {
        $this->Freight = new Freight();
    }

    /**
     * @return mixed
     */
    public function getCart(bool $fetch = false)
    {
        if ($fetch) {
            $stockModel = new StockModel();
            $products = [];

            foreach ($_SESSION['cart']['product'] as $idItem => $item) {
                $stock = $stockModel->findById($idItem);
                $product = (new ProductsModel())->findById($stock->id_product);
                $product->stock = $stock;
                $products[] = $product;
            }

            return $products;
        }
        return $_SESSION['cart'];
    }

    public function getQuantityItems(?int $idItem = null)
    {
        if (! is_null($idItem)) {
            return $_SESSION['cart']['product'][$idItem]['qtd'];
        }

        $count = 0;
        if (! empty($_SESSION['cart']['product'])) {
            foreach ($_SESSION['cart']['product'] as $item) {
                $count += $item['qtd'];
            }
        }
        return $count;
    }

    public function getTotal()
    {
        $total = 0;
        $cart = $this->getCart(true);

        foreach ($cart as $item) {
            $total += $item->stock->current_value * $_SESSION['cart']['product'][$item->stock->id]['qtd'];
        }

        return $total + $this->Freight->getValue();
    }

    public function getSubTotal()
    {
        $total = 0;
        $cart = $this->getCart(true);

        foreach ($cart as $item) {
            $total += $item->stock->current_value * $_SESSION['cart']['product'][$item->stock->id]['qtd'];
        }

        return $total;
    }

    public function add(array $data)
    {
        foreach ($data as $option => $value) {
            switch ($option) {
                case 'stock':
                    if (isset($_SESSION['cart']['product'][$value])) {
                        $_SESSION['cart']['product'][$value]['qtd']++;
                    } else {
                        $_SESSION['cart']['product'][$value]['qtd'] = 1;
                    }
                    break;
                case 'freight':
                    $this->Freight->setValue($value);
                    break;
            }
        }
    }

    /**
     * @return Freight
     */
    public function getFreight(): Freight
    {
        return $this->Freight;
    }

    public function remove()
    {
        
    }

    public function destroy()
    {
        unset($_SESSION['cart']);
        $_SESSION['cart'] = [];
    }

    public function changeQuantity()
    {
        
    }
}