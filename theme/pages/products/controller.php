<?php

namespace Theme\Pages\Products;

use Source\Libary\Paginator;
use Source\Controllers\Controller;
use Theme\Pages\Home\HomeModel;

/**
 * Class ProductsController
 * @package Theme\Pages\Products
 *
 * @property ProductsModel $products
 *
 */
class ProductsController extends Controller
{

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
            url("pages/products"),
            ""
        )->render();

        $products = (new ProductsModel())->find('status = 1')->order('id');
        $banners = (new HomeModel())->find('type = 2')->order('id')->limit(3);

        $page = isset($data["page"]) ? $data["page"] : 1;
        $limit = isset($data["limit"]) ? $data["limit"] : 20;
        $pager = new Paginator(url('products?' . (isset($data["limit"]) ? 'limit=' . $limit . '&' : '') . 'page='));
        $pager->pager($products->count(), $limit, $page, 2);

        echo $this->view->render("products/view/index", [
            "banners" => $banners->fetch(true),
            "products" => $products->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "pager" => $pager,
            "head" => $head
        ]);
    }

    public function slugProduct($slug): void
    {
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("pages/products"),
            ""
        )->render();

        echo $this->view->render("products/view/product", [
            "banners" => (new HomeModel())->find('type = 2')->order('id')->limit(3)->fetch(true),
            "product" => (new ProductsModel())->find('slug = "' . $slug['slug_post']. '"')->limit(1)->fetch(true),
            "head" => $head
        ]);
    }

    public function create(array $data = null)
    {
        if (! empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRING);

            if (empty($data["title"]) || empty($data["description"]) || ! empty($_FILES["file"]["error"])) {
                redirect("/pages/products?type=error");
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
                    redirect("/pages/products?type=error");
                }

                $products->image = $nameImage;
            }

            if (! $products->save()) {
                redirect("/pages/products?type=error");
            }

            redirect("/pages/products?type=success");
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
