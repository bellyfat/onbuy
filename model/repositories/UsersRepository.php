<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Users;

class UsersRepository extends Repository {
    public function authUser($login, $pass) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `login` = :login";
        $hash_pass = $this->db->queryOne($sql, ['login' => $login])['pass'];
        if (password_verify($pass, $hash_pass)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }
    
    public function isAuth() {
        return isset($_SESSION['login']);
    }

    public function getName() {
        return $this->isAuth() ? $_SESSION['login'] : false;
    }
    
    public function getTableName(){
        return 'users';
    }
    public function getEntityClass() {
        return Users::class;
    }
}
