<?php
namespace onbuy\controllers;

use onbuy\model\entities\Basket;
use onbuy\engine\App;

class ProductController extends Controller {
    public function actionIndex($id) {
        $product = App::call()->productRepository->getOne($id);
        echo $this->render('product', [
            'product' => $product,
            'category' => App::call()->subcategoryRepository->getOne($product->subcategory)->category_id,
            'category_item' => $product->subcategory,
            'min_amount' => App::call()->settingRepository->getSiteSetting()->min_amount,
            'recommend' => App::call()->productRepository->getRecommendList('subcategory', $product->subcategory, $id, 6),
        ]);
    }
    
    public function actionAddBasket($id) {
        $quantity = App::call()->request->getParams()['quantity'];
        $product = App::call()->basketRepository->getProduct($id);
        App::call()->productRepository->salesCounterUp($id, $quantity);
        if($product) {
            $product->quantity += $quantity;
            App::call()->basketRepository->save($product);
        } else {
            App::call()->basketRepository->save((new Basket(null, session_id(), $id, $quantity)));
        }
        echo json_encode(['adding' => 1]);
    }
}
