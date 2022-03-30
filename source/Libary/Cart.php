<?php


namespace Source\Libary;


use Source\Libary\Freight\FreightComponent;
use Theme\Pages\Products\ProductsModel;
use Theme\Pages\Stock\StockModel;

/**
 * Class Cart
 * @package Source\Libary
 *
 * @property FreightComponent $Freight;
 */
class Cart
{

    private $Freight;

    private $discounts;

    public function __construct()
    {
        $this->setFreight(new FreightComponent());
        $this->discounts = new Discounts();
    }

    /**
     * @return mixed
     */
    public function getCart($name = null, bool $fetch = false)
    {
        if ($fetch) {
            $stockModel = new StockModel();
            $products = [];

            if (isset($_SESSION['cart']['product'])) {
                foreach ($_SESSION['cart']['product'] as $idItem => $item) {
                    $stock = $stockModel->findById($idItem);
                    $product = (new ProductsModel())->findById($stock->id_product);
                    $product->stock = $stock;
                    $products[] = $product;
                }
            }

            return $products;
        }

        if (! empty($name)) {
            return $_SESSION['cart'][$name];
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
        $this->updateTotal();

        return $_SESSION['cart']['order']['total'];
    }

    public function updateTotal()
    {
        $total = 0;
        $cart = $this->getCart(null, true);

        foreach ($cart as $item) {
            $total += $item->stock->current_value * $_SESSION['cart']['product'][$item->stock->id]['qtd'];
        }

        $_SESSION['cart']['order']['total'] = $total + $this->Freight->getValue();
    }

    public function getSubTotal()
    {
        $this->updateSubTotal();

        return $_SESSION['cart']['order']['sub_total'];
    }

    public function updateSubTotal()
    {
        $total = 0;
        $cart = $this->getCart(null, true);

        foreach ($cart as $item) {
            $total += $item->stock->current_value * $_SESSION['cart']['product'][$item->stock->id]['qtd'];
        }

        $_SESSION['cart']['order']['sub_total'] =  $total;
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
     * @return FreightComponent
     */
    public function getFreight($name = null)
    {
        if (! empty($name)) {
            return $this->Freight->getFreight($name);
        }

        return $this->Freight;
    }

    /**
     * @param FreightComponent $Freight
     */
    public function setFreight(FreightComponent $Freight): void
    {
        $this->Freight = $Freight;
    }



    /**
     * @return Discounts
     */
    public function getDiscounts(): Discounts
    {
        return $this->discounts;
    }

    /**
     * @param Discounts $discounts
     */
    public function setDiscounts(Discounts $discounts): void
    {
        $this->discounts = $discounts;
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

    public function do_payment($date)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => url('admin/webservice/createOrder', 'http'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $date,
            CURLOPT_HTTPHEADER => [
                "Cookie: PHPSESSID=31fhkd4hs6ov3a63j075p660to"
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
//        $response = '{"order":{"id":"16","id_user":"1","status":"1","address":{"id":"1","street":"Av. Dos Prazeres","number":"1287","district":"Vila Jardim","city":"Porto Alegre","zip_code":"91320150","id_state":"1287"},"products":[{"id":"9","id_product":"1","id_stock":"1","status":"1","value":"100","old_value":"130","quantity":"1"},{"id":"10","id_product":"3","id_stock":"4","status":"1","value":"150.35","old_value":"200","quantity":"1"}]}}';

        return json_decode($response, true);
    }
}