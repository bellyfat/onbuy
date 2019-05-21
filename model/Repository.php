<?php
namespace onbuy\model;
use onbuy\engine\App;
use onbuy\model\entities\DataEntity;

abstract class Repository {
    protected $db;
    
    public function __construct() {
        $this->db = App::call()->db;
    }
    
    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll($start = null, $perpage = null) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        if (property_exists($this->getEntityClass(), 'active')) {
            $sql .= " WHERE (`active`= 1)";
        }
        if (!is_null($start) && !is_null($perpage)) {
            $sql .= " LIMIT {$start}, {$perpage}";
        }
        return $this->db->queryAll($sql);
    }
    
    public function getAllWhere($field, $value, $sort = null, $start = null, $perpage = null) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:$field";
        if (property_exists($this->getEntityClass(), 'active')) {
            $sql .= " AND (`active`= 1)";
        }
        if (!is_null($sort)) {
            $sql .= " ORDER BY $sort";
        }
        if (!is_null($start) && !is_null($perpage)) {
            $sql .= " LIMIT {$start}, {$perpage}";
        }
        return $this->db->queryAll($sql, ["$field"=>$value]);
    }
    
    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as `count` FROM {$tableName} WHERE `$field`=:$field";
        return $this->db->queryOne($sql, ["$field"=>$value])['count'];
    }
    
    public function save(DataEntity $entity) {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }
    
    public function update(DataEntity $entity) {
        $tableName = $this->getTableName();
        $params = $this->pdoUpdateSet($entity);
        $values = implode(', ', $this->getUpdateValues(array_keys($params)));
        if (!empty($values)) {
            $params['id'] = $entity->id;
            $sql = "UPDATE {$tableName} SET {$values} WHERE id = :id";
            return $this->db->execute($sql, $params);
        }
    }
    
    public function insert(DataEntity $entity) {
        $tableName = $this->getTableName();
        $params = $this->pdoSet($entity);
        $columns = implode(', ', array_keys($params));
        $values = implode(', ', $this->getInsertValues(array_keys($params)));
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        $this->db->execute($sql, $params);
        $entity->id = $this->db->lastInsertId();
    }
    
    private function pdoSet($entity) {
        return array_filter(get_object_vars($entity), function($key) {
            return $key != 'id' && $key != 'db';
        }, ARRAY_FILTER_USE_KEY);
    }
    
    private function pdoUpdateSet($entity) {
        $row = $this->getOne($entity->id);
        $cell = [];
        foreach ($row as $key => $value) {
            if (get_object_vars($entity)["{$key}"] != $value) {
                $cell["{$key}"] = $entity->$key;
            }
        }
        return $cell;
    }
    
    private function getUpdateValues($arr) {
        return array_map(function($val) {
            return "`{$val}`=:{$val}";
        }, $arr);
    }
    
    private function getInsertValues($arr) {
        return array_map(function($val) {
            return ":{$val}";
        }, $arr);
    }
    
    public function delete(DataEntity $entity) {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return $this->db->execute($sql, ['id'=>$entity->id]);
    }

    abstract public function getTableName();
    abstract public function getEntityClass();
}
