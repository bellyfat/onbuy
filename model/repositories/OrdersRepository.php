<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Orders;

class OrdersRepository extends Repository {
    public function getTableName() {
        return 'orders';
    }
    public function getEntityClass() {
        return Orders::class;
    }
}
