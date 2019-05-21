<?php
namespace onbuy\model\entities;

class Feedback extends DataEntity {
    public $id;
    public $datetime;
    public $client_id;
    public $message;
    
    function __construct($id = null, $datetime = null, $client_id = null, $message = null) {
        $this->id = $id;
        $this->datetime = $datetime;
        $this->client_id = $client_id;
        $this->message = $message;
    }
}
