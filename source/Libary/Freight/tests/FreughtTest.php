<?php


namespace Source\Libary\Freight\tests;


use Source\Libary\Freight\FreightComponent;

class FreughtTest
{
    const SEE_CEP = 'https://viacep.com.br/ws/{$ZIP_CODE}/json';

    private $zipCode;

    private $data;

    private $response;

    public function __construct($zipCode = null)
    {
        if (! empty($zipCode)) {
            $this->setZipCode($zipCode);
        }
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param mixed $zipCode
     */
    public function setZipCode($zipCode): void
    {
        $this->zipCode = str_replace('-', '', $zipCode);

        $endPoint = str_replace('{$ZIP_CODE}', $this->zipCode, self::SEE_CEP);
        $response = file_get_contents($endPoint);
        $this->setData(
            json_decode(
                $response,
                true
            ));
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    private function setData($data)
    {
        $this->data = $data;
    }

    public function freightQuote()
    {
        $this->response = $this->responseExample();
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    private function responseExample()
    {
        $freight = [
            'PAC' => [
                'initialZip' => '90000000',
                'finalZip' => '99999999',
                'value' => '10.80'
            ]
        ];

        $zipCode = str_replace('-', '', $this->data['cep']);

        foreach ($freight as $modality => $properties) {

            if (
                $zipCode >= $properties['initialZip']
                &&
                $zipCode <= $properties['finalZip']
            ) {
                $this->data['value'] = $properties['value'];
                return $properties;
            }
        }

        return null;
    }
}
