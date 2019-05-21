<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Subcategory;
use onbuy\engine\App;

class SubcategoryRepository extends Repository {
    public function getFilledItem($id = null) {
        $tableName = $this->getTableName();
        $tableProducts = App::call()->productRepository->getTableName();
        $params = [];
        $sql = "SELECT {$tableName}.id, {$tableName}.`name`, {$tableName}.category_id, {$tableName}.image, count(products.id) as `products_count`
        FROM {$tableProducts} INNER JOIN {$tableName} ON {$tableProducts}.subcategory = {$tableName}.id
        WHERE {$tableProducts}.`active`=1";
        if (!is_null($id)) {
            $sql .= " AND {$tableName}.category_id = :id";
            $params['id'] = $id;
        }
        $sql .= " GROUP BY {$tableName}.id";
        return $this->db->queryAll($sql, $params);
    }

    public function getTableName() {
        return 'category_item';
    }
    public function getEntityClass() {
        return Subcategory::class;
    }
}
