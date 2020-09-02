<?php


namespace Theme\pages\order;


use Source\Models\Model;
use Theme\pages\address\AddressModel;
use Theme\pages\orderProduct\OrderProductModel;

class OrderModel extends Model
{
    /** @var int Status pendente */
    public const ORDER_STATUS = 1;

    const ORDER_STATUS_MAPPING = [
        '0' => [
            'class' => 'danger',
            'status' => 'Cancelado',
            'message' => 'Seu Pedido encontra-se cancelado'
        ],
        '1' => [
            'class' => 'secondary',
            'status' => 'Pendente',
            'message' => 'Seu Pedido encontra-se em pendente, aguarde até a sua aprovação'
        ],
        '2' => [
            'class' => 'primary',
            'status' => 'Aprovado',
            'message' => 'Seu Pedido encontra-se aprovado, aguarde até a sua postagem/entrega'
        ],
        '3' => [
            'class' => 'info',
            'status' => 'Transporte',
            'message' => 'Seu Pedido encontra-se em transporte, aguarde até a sua entrega'
        ],
        '4' => [
            'class' => 'success',
            'status' => 'Entregue',
            'message' => 'Seu Pedido já foi entregue'
        ]
    ];
    public function __construct()
    {
        $this->setTable("orders");

        parent::__construct("orders", ["id_user", "status", "total", "sub_total", "freight", "address"]);
    }

    public function getOrderProduct($fetch = false)
    {
        if (empty($this->orderProduct) || $fetch) {
            $this->orderProduct = (new OrderProductModel())
                ->find('id_order = :id_order', 'id_order=' . $this->id)
                ->fetch(true);
        }

        return $this->orderProduct;
    }

    public function getAddress()
    {
        if (empty($this->orderAddress)) {
            $this->orderAddress = (new AddressModel())->findById($this->address);
        }

        return $this->orderAddress;
    }

    public function getStatus($option = null)
    {
        if (! empty($option)) {
            return self::ORDER_STATUS_MAPPING[$this->status][$option];
        }

        return self::ORDER_STATUS_MAPPING[$this->status];
    }
}