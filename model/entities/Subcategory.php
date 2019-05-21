<?php
namespace onbuy\model\entities;

class Subcategory extends DataEntity {
    public $id;
    public $name;
    public $category_id;
    public $image;
            
    function __construct($id = null, $name = null, $category_id = null, $image = null) {
        $this->id = $id;
        $this->name = $name;
        $this->category_id = $category_id;
        $this->image = $image;
    }
}
