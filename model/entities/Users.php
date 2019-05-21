<?php
namespace onbuy\model\entities;

class Users extends DataEntity {
    public $id;
    public $login;
    public $pass;
    
    function __construct($id = null, $login = null, $pass = null) {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;
    }
}
