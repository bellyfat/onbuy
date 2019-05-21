<?php
namespace onbuy\model\entities;

class Clients extends DataEntity {
    public $id;
    public $name;
    public $phone;
    public $email;
            
    function __construct($id = null, $name = null, $phone = null, $email = null) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
    }
}
