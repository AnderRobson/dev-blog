<?php

namespace Theme\Pages\Checkout;

use Source\Libary\Cart;
use Source\Libary\Freight\FreightComponent;
use Source\Libary\Paginator;
use Source\Controllers\Controller;
use Theme\Pages\Banner\BannerModel;
use Theme\Pages\Products\ProductsModel;

/**
 * Class CheckoutController
 * @package Theme\Pages\Checkout
 *
 * @property ProductsModel $products
 *
 */
class CheckoutController extends Controller
{
    /**
     *  Identificador de Banner do carrinho.
     */
    private const BANNER_TYPE_CHECKOUT = 4;

    /**
     *  Limit de Banner no carrinho.
     */
    private const BANNER_LIMIT_CHECKOUT = 2;

    /**
     *  Status ativo
     */
    private const STATUS_ACTIVE = 1;

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function index(): void
    {
        $data = filter_var_array($_GET, FILTER_SANITIZE_STRING);
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("carrinho"),
            ""
        )->render();

        echo $this->view->render("checkout/view/index", [
            "banners" => (new BannerModel())->find('type = :type', 'type=' . SELF::BANNER_TYPE_CHECKOUT)->order('id')->limit(SELF::BANNER_LIMIT_CHECKOUT)->fetch(true),
            "products" => $this->cart->getCart(null, true),
            "head" => $head
        ]);
    }

    public function pagamento(): void
    {
        if (empty($this->cart->getCart('product'))) {
            flash("danger", "O seu carrinho de compras está vazio");
            redirect('carrinho');
        }

        if (empty($this->user)) {
            flash("warning", "Por Favor Logue-se");
            redirect('login', false, 'carrinho/pagamento');
        }

        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("carrinho/pagamento"),
            ""
        )->render();

        $this->user->person->getAddress();
        $this->user->person->address->getState();
        $freight = new FreightComponent();
        if (
            ! empty($this->user->person->address->zip_code)
            &&
            empty($freight->getFreight('street'))
        ) {

            $freight->freightQuote($this->user->person->address->zip_code);
            $freight->setFreight([
                'number' => $this->user->person->address->number
            ]);
        }

        $banners = (new BannerModel())
            ->find(
            'type = :type',
            'type=' . SELF::BANNER_TYPE_CHECKOUT)
            ->order('id')
            ->limit(SELF::BANNER_LIMIT_CHECKOUT);

        echo $this->view->render("checkout/view/payment", [
            "banners" => $banners->fetch(true),
            "head" => $head
        ]);
    }

    public function freight_quote(array $data)
    {
        if (empty($data['cep'])) {
            return false;
        }

        $zipCode = filter_var($data['cep'], FILTER_SANITIZE_STRING);

        $freight = new FreightComponent();
        $response = $freight->freightQuote($zipCode);

        echo json_encode([
            'freight' => [
                'street' => $response['logradouro'],
                'number' => '',
                'district' => $response['bairro'],
                'city' => $response['localidade'],
                'state' => $response['uf'],
                'zip_code' => $response['cep'],
                'value' => formatMoney($freight->getValue())
            ],
            'cart' => [
                'total_amount' => formatMoney($this->cart->getTotal()),
                'subtotal' => formatMoney($this->cart->getSubTotal())
            ]
        ], true);
    }

    public function delete(array $data)
    {
        if (empty($data['id'])) {
            return false;
        }

        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $products = (new ProductsModel())->findById($id);

        if (! empty($products)) {
            $products->destroy();
        }

        $callback['remove'] = true;
        echo json_encode($callback);
    }

    public function do_add()
    {
        $data = filter_var_array($_GET, FILTER_SANITIZE_STRING);

        unset($data['route']);
        $this->cart->add($data);

        $callback['cart'] = $this->cart->getQuantityItems();
        echo json_encode($callback);
    }

    public function do_pagamento($data = null)
    {

        $this->cart->do_payment([
            'order' => json_encode($_SESSION)
        ]);
    }

    public function edit_address($address = null)
    {
        $freight = new FreightComponent();
        $freight->setFreight($address);

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Endereço editado com Sucesso"
        ]);

        return;
    }

    public function do_destroy()
    {
        $this->cart->destroy();

        redirect();
    }
}
