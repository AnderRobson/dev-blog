<?php


namespace Source\Libary;


class Freight
{
    public function getFrete()
    {
        return $_SESSION['cart']['freight'];
    }

    public function getValue()
    {
        if (! isset($_SESSION['cart']['freight']['valor'])) {
            return 0.00;
        }
        return $_SESSION['cart']['freight']['valor'];
    }

    public function setValue($value)
    {

        $_SESSION['cart']['freight']['valor'] = number_format(str_replace(',', '.', $value), 2);
    }
}