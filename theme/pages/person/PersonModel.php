<?php


namespace Theme\Pages\Person;

use Source\Models\Model;
use Theme\Pages\Address\AddressModel;

class PersonModel extends Model
{
    public function __construct()
    {
        parent::__construct("persons", ["first_name", "last_name", "date_birth"]);
    }

    public function getAddress(): PersonModel
    {
        $this->address = (new AddressModel())->findByIdPerson($this->id);

        return $this;
    }
}
