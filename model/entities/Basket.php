<?php
namespace onbuy\model\entities;

class Basket extends DataEntity {
    public $id;
    public $session_id;
    public $product_id;
    public $quantity;

    public function __construct($id = null, $session_id = null, $product_id = null, $quantity = null) {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}
