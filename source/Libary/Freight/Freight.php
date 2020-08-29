<?php


namespace Source\Libary\Freight;


use Source\Libary\Freight\tests\FreughtTest;

class FreightComponent
{
    /**
     * @return mixed
     */
    public function getFreight()
    {
        return $_SESSION['cart']['freight'];
    }

    /**
     * @param mixed $freight
     */
    public function setFreight($freight): void
    {
        $_SESSION['cart']['freight'] = $freight;
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

    public function freightQuote(int $zipCode)
    {
        $freight = new FreughtTest($zipCode);
        $freight->freightQuote();
        $response = $freight->getResponse();
        $this->setValue($response['value']);

        return $freight->getData();
    }
}