<?php

namespace Theme\Pages\Home;

use Source\Controllers\Controller;
use Theme\Pages\Publication\PublicationModel;
use Theme\Pages\User\UserModel;

class HomeController extends Controller
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
            url(),
            ""
        )->render();

        echo $this->view->render("home/view/index", [
            "banners" => (new HomeModel())->find('type = 1')->order('id')->limit(3)->fetch(true),
            "publications" => (new PublicationModel())->find()->order('id')->limit(3)->fetch(true),
            "head" => $head
        ]);
    }

    public function create(array $data)
    {
        $userData = filter_var_array($data, FILTER_SANITIZE_STRING);

        if (in_array("", $userData)) {
            $callback["message"] = message("Informe o nome e o sobrenome !", "error");
            echo json_encode($callback);
            return;
        }

        $user = new UserModel();
        $user->first_name = $userData["first_name"];
        $user->last_name = $userData["last_name"];
        $user->save();

        $callback["message"] = message("Usu�rio cadastrado com sucesso !", "success");
        $callback["user"] = $this->view->render("home/view/elements/user", ["user" => $user]);

        echo json_encode($callback);
    }

    public function delete(array $data)
    {
        if (empty($data['id'])) {
            return false;
        }

        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $user = (new HomeModel())->findById($id);

        if (! empty($user)) {
            $user->destroy();
        }

        $callback['remove'] = true;
        echo json_encode($callback);
    }
}
