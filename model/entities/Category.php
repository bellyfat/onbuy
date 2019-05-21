<?php
namespace onbuy\model\entities;

class Category extends DataEntity {
    public $id;
    public $name;
    public $image;
            
    function __construct($id = null, $name = null, $image = null) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }
}
