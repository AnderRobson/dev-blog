<?php

namespace Theme\Pages\Checkout;

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

        $products = (new ProductsModel())->find('status = :status', 'status=' . SELF::STATUS_ACTIVE)->order('id');

        echo $this->view->render("checkout/view/index", [
            "banners" => (new BannerModel())->find('type = :type', 'type=' . SELF::BANNER_TYPE_CHECKOUT)->order('id')->limit(SELF::BANNER_LIMIT_CHECKOUT)->fetch(true),
            "products" => $products->fetch(true),
            "head" => $head
        ]);
    }

    public function pagamento(): void
    {
        $data = filter_var_array($_GET, FILTER_SANITIZE_STRING);
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("carrinho/pagamento"),
            ""
        )->render();

        $this->user->person->getAddress();
        $this->user->person->address->getState();

        $products = (new ProductsModel())->find('status = :status', 'status=' . SELF::STATUS_ACTIVE)->order('id');

        echo $this->view->render("checkout/view/payment", [
            "banners" => (new BannerModel())->find('type = :type', 'type=' . SELF::BANNER_TYPE_CHECKOUT)->order('id')->limit(SELF::BANNER_LIMIT_CHECKOUT)->fetch(true),
            "products" => $products->fetch(true),
            "head" => $head
        ]);
    }

    public function create(array $data = null)
    {
        if (! empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRING);

            if (empty($data["title"]) || empty($data["description"]) || ! empty($_FILES["file"]["error"])) {
                redirect("pages/products");
                return;
            }

            $products = new ProductsModel();
            $products->title = $data['title'];
            $products->slug = str_replace(' ', '-', utf8_decode(strtolower($data['title'])));
            $products->description = $data['description'];

            if (! empty($_FILES["file"])) {
                $upload = new Upload();
                $upload->setArquivo($_FILES);
                $upload->setDestinho("products");
                $nameImage = $upload->upload();

                if (! $nameImage) {
                    redirect("pages/products");
                }

                $products->image = $nameImage;
            }

            if (! $products->save()) {
                redirect("pages/products");
            }

            redirect("pages/products");
        }

        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("pages/banner"),
            ""
        )->render();

        echo $this->view->render("products/view/create", [
            "head" => $head
        ]);
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
}
