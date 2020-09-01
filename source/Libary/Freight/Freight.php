<?php


namespace Source\Libary\Freight;


use Source\Libary\Freight\tests\FreughtTest;
use Source\Models\Model;

class FreightComponent
{
    public function __construct(Model $model = null)
    {
        if (! empty($model)) {

        }
        if (empty($_SESSION['cart']['freight'])) {
            $_SESSION['cart']['freight'] = [
                'value' => 0.00,
                'street' => null,
                'number' => null,
                'district' => null,
                'city' => null,
                'state' => null
            ];
        }
    }

    /**
     * @return mixed
     */
    public function getFreight($name = null)
    {
        if (! empty($name)) {
            return $_SESSION['cart']['freight'][$name];
        }

        return $_SESSION['cart']['freight'];
    }

    /**
     * @param mixed $freight
     */
    public function setFreight($freight): void
    {
        $_SESSION['cart']['freight'] = array_merge($_SESSION['cart']['freight'], $freight);
    }

    public function getValue()
    {
        return $_SESSION['cart']['freight']['value'];
    }

    public function setValue($value)
    {
        $_SESSION['cart']['freight']['value'] = number_format(str_replace(',', '.', $value), 2);
    }

    public function freightQuote($zipCode)
    {
        $freight = new FreughtTest($zipCode);
        $freight->freightQuote();
        $this->setFreight([
            'value' => $freight->getData('value'),
            'street' => $freight->getData('logradouro'),
            'zip_code' => str_replace('-', '', $freight->getData('cep')),
            'number' => $freight->getData('complemento'),
            'district' => $freight->getData('bairro'),
            'city' => $freight->getData('localidade'),
            'state' => $freight->getData('uf')
        ]);

        return $freight->getData();
    }
}