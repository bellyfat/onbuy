<?php
namespace onbuy\model\entities;

class Setting extends DataEntity {
    public $id;
    public $site_name;
    public $min_amount;
    public $per_page;
    public $hits_count;
    public $contact;
            
    function __construct($id = null, $site_name = null, $min_amount = null, $per_page = null, $hits_count = null, $contact = null) {
        $this->id = $id;
        $this->site_name = $site_name;
        $this->min_amount = $min_amount;
        $this->per_page = $per_page;
        $this->hits_count = $hits_count;
        $this->contact = $contact;
    }
}
