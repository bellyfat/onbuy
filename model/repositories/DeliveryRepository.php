<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Delivery;

class DeliveryRepository extends Repository {
    public function getTableName() {
        return 'delivery';
    }
    public function getEntityClass() {
        return Delivery::class;
    }
}
