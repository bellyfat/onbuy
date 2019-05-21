<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Category;
use onbuy\engine\App;

class CategoryRepository extends Repository {
    public function getFilledCategory() {
        $tableName = $this->getTableName();
        $tableProducts = App::call()->productRepository->getTableName();
        $tableSubcategory = App::call()->subcategoryRepository->getTableName();
        $sql = "SELECT {$tableName}.id, {$tableName}.`name`, count(products.id) as `products_count` 
                FROM {$tableProducts} INNER JOIN {$tableSubcategory} ON {$tableProducts}.subcategory = {$tableSubcategory}.id
                INNER JOIN {$tableName} ON {$tableSubcategory}.category_id = {$tableName}.id
                WHERE {$tableProducts}.`active`=1 GROUP BY {$tableName}.id";
        return $this->db->queryAll($sql);
    }

    public function getTableName() {
        return 'category';
    }
    public function getEntityClass() {
        return Category::class;
    }
}
