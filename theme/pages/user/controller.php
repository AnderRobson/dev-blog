<?php

namespace Theme\Pages\User;

use Source\Controllers\Controller;
use Theme\pages\address\AddressModel;

/**
 * Class UserController
 * @package Theme\Pages\Exemplos
 */
class UserController extends Controller
{
    /**
     * ExemploController constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * P�gina index perfil.
     */
    public function index(): void
    {
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("profile"),
            ""
        )->render();

        $this->user->person->getAddress();
        $this->user->person->address->getState();

        echo $this->view->render("user/view/index", [
            'head' => $head
        ]);
    }

    public function edit_address($data)
    {
        $this->user->person->getAddress();
        $this->user->person->address->getState();

        $address = new AddressModel();
        if (! empty($data["id"])) {
            $address->id = (int)$data["id"];
        }

        $address->street = $data["street"];
        $address->number = (int) $data["number"];
        $address->district = $data["district"];
        $address->zip_code = $data["zip_code"];
        $address->city = $data["city"];

        if (! empty($data["state"])) {
            $address->id_state = (int) $data["state"];
        }

        if (! $address->save()) {
            echo $this->ajaxResponse("message", [
                "type" => "danger",
                "message" => "Erro ao editar o Endere�o"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Endere�o editado com Sucesso"
        ]);

        return;
    }
}
