<?php
namespace onbuy\model\entities;

class Products extends DataEntity {
    public $id;
    public $name;
    public $volume;
    public $description;
    public $composition;
    public $image;
    public $price;
    public $subcategory;
    public $active;
    public $sell;
            
    function __construct($id = null, $name = null, $volume = null, $description = null, $composition = null, $image = null, $price = null, $subcategory = null, $active = null, $sell = null) {
        $this->id = $id;
        $this->name = $name;
        $this->volume = $volume;
        $this->description = $description;
        $this->composition = $composition;
        $this->image = $image;
        $this->price = $price;
        $this->subcategory = $subcategory;
        $this->active = $active;
        $this->sell = $sell;
    }
}
