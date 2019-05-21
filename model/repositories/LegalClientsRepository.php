<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\LegalClients;

class LegalClientsRepository extends Repository {
    public function getTableName() {
        return 'legal_clients';
    }
    public function getEntityClass() {
        return LegalClients::class;
    }
}
