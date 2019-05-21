<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Clients;

class ClientsRepository extends Repository {
    public function getTableName() {
        return 'clients';
    }
    public function getEntityClass() {
        return Clients::class;
    }
}
