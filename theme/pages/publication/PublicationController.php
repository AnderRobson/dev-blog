<?php

namespace Theme\Pages\Publication;

use Source\Libary\Paginator;
use Source\Controllers\Controller;
use Theme\Pages\Banner\BannerModel;

/**
 * Class PublicationController
 * @package Theme\Pages\Publication
 *
 * @property PublicationModel $publication
 *
 */
class PublicationController extends Controller
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
            url("pages/publication"),
            ""
        )->render();

        $publications = (new PublicationModel())->find()->order('id');
        $banners = (new BannerModel())->find('type = 2')->order('id')->limit(3);

        $page = isset($data["page"]) ? $data["page"] : 1;
        $limit = isset($data["limit"]) ? $data["limit"] : 20;
        $pager = new Paginator(url('publication?' . (isset($data["limit"]) ? 'limit=' . $limit . '&' : '') . 'page='));
        $pager->pager($publications->count(), $limit, $page, 2);

        echo $this->view->render("publication/view/index", [
            "banners" => $banners->fetch(true),
            "publications" => $publications->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "pager" => $pager,
            "head" => $head
        ]);
    }

    public function slugPublication($slug): void
    {
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("pages/publication"),
            ""
        )->render();

        echo $this->view->render("publication/view/publication", [
            "banners" => (new BannerModel())->find('type = 2')->order('id')->limit(3)->fetch(true),
            "publications" => (new PublicationModel())->find('slug = "' . $slug['slug_post']. '"')->limit(1)->fetch(true),
            "head" => $head
        ]);
    }

    public function create(array $data = null)
    {
        if (! empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRING);

            if (empty($data["title"]) || empty($data["description"]) || ! empty($_FILES["file"]["error"])) {
                redirect("pages/publication");
                return;
            }

            $publication = new PublicationModel();
            $publication->title = $data['title'];
            $publication->slug = str_replace(' ', '-', utf8_decode(strtolower($data['title'])));
            $publication->description = $data['description'];

            if (! empty($_FILES["file"])) {
                $upload = new Upload();
                $upload->setArquivo($_FILES);
                $upload->setDestinho("publication");
                $nameImage = $upload->upload();

                if (! $nameImage) {
                    redirect("pages/publication");
                }

                $publication->image = $nameImage;
            }

            if (! $publication->save()) {
                redirect("pages/publication");
            }

            redirect("pages/publication");
        }

        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("pages/publication"),
            ""
        )->render();

        echo $this->view->render("publication/view/create", [
            "head" => $head
        ]);
    }

    public function delete(array $data)
    {
        if (empty($data['id'])) {
            return false;
        }

        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $publication = (new PublicationModel())->findById($id);

        if (! empty($publication)) {
            $publication->destroy();
        }

        $callback['remove'] = true;
        echo json_encode($callback);
    }
}
