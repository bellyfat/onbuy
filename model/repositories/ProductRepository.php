<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Products;

class ProductRepository extends Repository {
    public function salesCounterUp($id, $quantity) {
        $product = $this->getOne($id);
        $product->sell += $quantity;
        $this->save($product);
    }
    
    public function getRecommendList($field, $value, $id, $limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT id,name,image FROM {$tableName} WHERE (`$field`=:$field) AND (`id`!=:id) AND (`active`= 1) ORDER BY sell DESC LIMIT $limit";
        return $this->db->queryAll($sql, ["$field"=>$value,"id"=>$id]);
    }
    
    public function getSalesHits($limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE (subcategory,sell)
                IN (SELECT subcategory, MAX(sell) FROM {$tableName} WHERE `active`=1 GROUP BY `subcategory`)
                ORDER BY `sell` DESC LIMIT $limit";
        return $this->db->queryAll($sql);
    }
    
    public function getSortString($str) {
        $sort_arr = [
            'price' => 'price',
            'reduct' => 'price DESC',
            'name' => 'name',
            'inverse' => 'name DESC',
        ];
        return isset($sort_arr[$str]) ? $sort_arr[$str] : $sort_arr['price'];
    }
    
    public function searchProducts($term, $start = null, $perpage = null) {
        $tableName = $this->getTableName();
        $sql = "SELECT id, name, volume, image, price FROM {$tableName} WHERE (`name` LIKE :term) AND (`active`= 1) ORDER BY `price`";
        if (!is_null($start) && !is_null($perpage)) {
            $sql .= " LIMIT {$start}, {$perpage}";
        }
        return $this->db->queryAll($sql, ["term"=>"%{$term}%"]);
    }
    
    public function getCountSearch($term) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as `count` FROM {$tableName} WHERE (`name` LIKE :term) AND (`active`= 1)";
        return $this->db->queryOne($sql, ["term"=>"%{$term}%"])['count'];
    }

    public function getTableName() {
        return 'products';
    }
    public function getEntityClass() {
        return Products::class;
    }
}
