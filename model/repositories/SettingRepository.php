<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Setting;

class SettingRepository extends Repository {
    public function getSiteSetting() {
        return $this->getOne(1);
    }
    
    public function getTableName(){
        return 'setting';
    }
    public function getEntityClass() {
        return Setting::class;
    }
}
