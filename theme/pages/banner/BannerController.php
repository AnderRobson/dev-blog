<?php

namespace Theme\Pages\Banner;

use Source\Controllers\Controller;

/**
 * Class BannerController
 * @package Theme\Pages\Banner
 *
 * @property BannerModel $banner
 */
class BannerController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function index(): void
    {
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("banner"),
            ""
        )->render();

        echo $this->view->render("banner/view/index", [
            "banners" => (new BannerModel())->find()->order('id')->fetch(true),
            "head" => $head
        ]);
    }
}
