<?php
namespace onbuy\model\entities;

class LegalClients extends DataEntity {
    public $id;
    public $name;
    public $inn;
    public $kpp;
    public $address;
    public $contact_person;
    
    function __construct($id = null, $name = null, $inn = null, $kpp = null, $address = null, $contact_person = null) {
        $this->id = $id;
        $this->name = $name;
        $this->inn = $inn;
        $this->kpp = $kpp;
        $this->address = $address;
        $this->contact_person = $contact_person;
    }
}
