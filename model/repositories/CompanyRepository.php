<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Company;

class CompanyRepository extends Repository {
    public function getContact() {
        return $this->getOne(1);
    }
    
    public function getTableName(){
        return 'company';
    }
    public function getEntityClass() {
        return Company::class;
    }
}
