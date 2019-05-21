<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class AdminController extends Controller {
    public $useAside = false;
    public $adminAccess = true;
    
    public function actionIndex() {
        $orders = App::call()->ordersRepository->getAll();
        echo $this->render('admin', ['orders' => $orders]);
    }
    
    public function actionOrder($id) {
        $order = App::call()->ordersRepository->getOne($id);
        $basket = App::call()->basketRepository->getBasketProducts($order->session_id);
        $total = App::call()->basketRepository->getTotalAmount($order->session_id);
        echo $this->render('adminOrder', [
            'order' => $order,
            'basket' => $basket,
            'total' => $total,
        ]);
    }
    
    public function actionNotAccess() {
        header("Location: /");
    }
}
