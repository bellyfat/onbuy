<?php
namespace onbuy\model\entities;

class Delivery extends DataEntity {
    public $id;
    public $name;
    public $title;
    public $description;
    public $time;
    public $price;
    public $active;
    
    function __construct($id = null, $name = null, $title = null, $description = null, $time = null, $price = null, $active = null) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->description = $description;
        $this->time = $time;
        $this->price = $price;
        $this->active = $active;
    }
}
