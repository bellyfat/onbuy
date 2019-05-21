<?php
namespace onbuy\model\entities;

class Company extends DataEntity {
    public $id;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $site;
    
            
    function __construct($id = null, $name = null, $phone = null, $email = null, $address = null, $site = null) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address;
        $this->site = $site;
    }
}
