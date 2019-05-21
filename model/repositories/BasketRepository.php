<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Basket;
use onbuy\engine\App;

class BasketRepository extends Repository {
    public function getBasketProducts($session) {
        $tableBasket = $this->getTableName();
        $tableProducts = App::call()->productRepository->getTableName();
        $sql = "SELECT {$tableBasket}.id, product_id, quantity, name, volume, price, image FROM {$tableBasket} 
            INNER JOIN {$tableProducts} ON {$tableBasket}.product_id = {$tableProducts}.id 
            WHERE `session_id` = :session";
        return $this->db->queryAll($sql, ["session"=>$session]);
    }
    
    public function getTotalAmount($session) {
        $tableBasket = $this->getTableName();
        $tableProducts = App::call()->productRepository->getTableName();
        $sql = "SELECT SUM(quantity * price) as summ FROM {$tableBasket}
            INNER JOIN {$tableProducts} ON {$tableBasket}.product_id = {$tableProducts}.id 
            WHERE `session_id` = :session";
        return $this->db->queryOne($sql, ["session"=>$session])['summ'];
    }
    
    public function getProduct($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE (`session_id` = :session) AND (product_id = :id)";
        return $this->db->queryObject($sql, ['session' => session_id(), 'id' => $id], $this->getEntityClass());
    }
    
    public function getBasketCount() {
        $tableName = $this->getTableName();
        $sql = "SELECT SUM(quantity) as count FROM {$tableName} WHERE `session_id` = :session";
        return $this->db->queryOne($sql, ['session' => session_id()])['count'];
    }
    
    public function getTableName() {
        return 'basket';
    }
    public function getEntityClass() {
        return Basket::class;
    }
}
