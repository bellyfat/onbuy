<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class BasketController extends Controller {
    public $cartPreview = false;
    
    public function actionIndex() {
        echo $this->render('basket', [
            'pagetitle' => 'Товары в корзине',
            'min_amount' => App::call()->settingRepository->getSiteSetting()->min_amount,
        ]);
    }
    
    public function actionApiBasket() {
        $basket = App::call()->basketRepository->getBasketProducts(session_id());
        header('Content-Type: application/json');
        echo json_encode([
            'basket' => $basket,
        ], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
    
    public function actionDelete($id) {
        $item = App::call()->basketRepository->getOne($id);
        if ($item->session_id == session_id()) {
            App::call()->basketRepository->delete($item);
            echo json_encode(['remote' => 1], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
        }
    }
    
    public function actionCount() {
        $count = App::call()->basketRepository->getBasketCount();
        header('Content-Type: application/json');
        echo json_encode(['count' => $count], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
    
    public function actionAmount() {
        $amount = App::call()->basketRepository->getTotalAmount(session_id());
        header('Content-Type: application/json');
        echo json_encode([
            'amount' => $amount, 
            'min' => App::call()->settingRepository->getSiteSetting()->min_amount,
        ], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
    }
    
    public function actionRecount($id) {
        $quantity = App::call()->request->getParams()['quantity'];
        if(isset($quantity)) {
            $product = App::call()->basketRepository->getProduct($id);
            $product->quantity = $quantity;
            App::call()->basketRepository->save($product);
            echo json_encode(['recount' => true]);
        }
    }
}
