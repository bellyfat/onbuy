<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class UserController extends Controller {
    
    public function actionLogin() {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        if(App::call()->usersRepository->authUser($login, $pass)) {
            header("Location: /admin");
        } else {
            header("Location: /");
        }
    }
    
    public function actionLogout() {
        unset($_SESSION['login']);
        header("Location: /");
    }
}
