<?php

namespace Theme\Pages\User;

use Source\Controllers\Controller;
use Source\Libary\Paginator;
use Theme\Pages\Address\AddressModel;
use Theme\Pages\Order\OrderModel;

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
     * Página index perfil.
     */
    public function index($data = null): void
    {
        $head = $this->seo->optimize(
            "Bem vindo ao " . SITE["SHORT_NAME"],
            SITE["DESCRIPTION"],
            url("profile"),
            ""
        )->render();

        $this->user->person->getAddress();
        $this->user->person->address->getState();

        $order = (new OrderModel())->find(
            'id_user = :id_user',
            'id_user=' . $this->user->id
        );

        $page = isset($data["page"]) ? $data["page"] : 1;
        $limit = isset($data["limit"]) ? $data["limit"] : 20;
        $pager = new Paginator(url('user?' . (isset($data["limit"]) ? 'limit=' . $limit . '&' : '') . 'page='));
        $pager->pager($order->count(), $limit, $page, 2);
        echo $this->view->render("user/view/index", [
            'head' => $head,
            'orders' => $order->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "pager" => $pager
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
                "message" => "Erro ao editar o Endereço"
            ]);

            return;
        }

        echo $this->ajaxResponse("message", [
            "type" => "success",
            "message" => "Endereço editado com Sucesso"
        ]);

        return;
    }
}
