<?php
namespace onbuy\model\entities;

class Orders extends DataEntity {
    public $id;
    public $session_id;
    public $datetime;
    public $client_id;
    public $legal_client_id;
    public $delivery_id;
    public $delivery_address;
    public $payment;
    public $comment;
    public $status;
            
    function __construct($id = null, $session_id = null, $datetime = null, $client_id = null, $legal_client_id = null, $delivery_id = null, $delivery_address = null, $payment = null, $comment = null, $status = null) {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->datetime = $datetime;
        $this->client_id = $client_id;
        $this->legal_client_id = $legal_client_id;
        $this->delivery_id = $delivery_id;
        $this->delivery_address = $delivery_address;
        $this->payment = $payment;
        $this->comment = $comment;
        $this->status = $status;
    }
}
