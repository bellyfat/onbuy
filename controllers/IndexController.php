<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class IndexController extends Controller {
    public $useAside = false;

    public function actionIndex() {
        echo $this->render('index', [
            'hits' => App::call()->productRepository->getSalesHits(App::call()->settingRepository->getSiteSetting()->hits_count),
        ]);
    }
}
