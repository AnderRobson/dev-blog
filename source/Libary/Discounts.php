<?php


namespace Source\Libary;


class Discounts
{
    public function __construct()
    {
        if (empty($_SESSION['discounts'])) {
            $_SESSION['discounts'] = [
                'valor' => 0,
                'total' => 0
            ];
        }
    }

    /**
     * @return mixed
     */
    public function getDiscounts()
    {
        return $_SESSION['discounts'];
    }

    /**
     * @param mixed $discounts
     */
    public function setDiscounts($discounts): void
    {
        $_SESSION['discounts'] = $discounts;
    }

    public function getTotal()
    {
        return $_SESSION['discounts']['total'];
    }
}