<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class CategoryController extends Controller {
    public function actionIndex($id) {
        echo $this->render('category',[
            'pagetitle' => App::call()->categoryRepository->getOne($id)->name,
            'category' => $id,
            'category_items' => App::call()->subcategoryRepository->getFilledItem($id),
        ]);
    }
}
