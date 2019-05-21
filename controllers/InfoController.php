<?php
namespace onbuy\controllers;

use onbuy\engine\App;

class InfoController extends Controller {
    public function actionIndex() {
        echo $this->render('info',[
            'pagetitle' => 'Как это работает?',
            'company' => App::call()->companyRepository->getContact(),
        ]);
    }
    
    public function actionAbout() {
        echo $this->render('about',[
            'pagetitle' => 'О компании',
            'company' => App::call()->companyRepository->getContact(),
        ]);
    }
    
    public function actionFaq() {
        echo $this->render('faq',[
            'pagetitle' => 'Вопрос-ответ',
        ]);
    }
    
    public function actionReturns() {
        echo $this->render('returns',[
            'pagetitle' => 'Возврат и обмен',
            'company' => App::call()->companyRepository->getContact(),
        ]);
    }
    
    public function actionPayment() {
        echo $this->render('payment',[
            'pagetitle' => 'Оплата заказа',
            'company' => App::call()->companyRepository->getContact(),
            'min_amount' => App::call()->settingRepository->getSiteSetting()->min_amount,
        ]);
    }
    
    public function actionDelivery() {
        echo $this->render('delivery',[
            'pagetitle' => 'Доставка товара',
            'company' => App::call()->companyRepository->getContact(),
            'min_amount' => App::call()->settingRepository->getSiteSetting()->min_amount,
        ]);
    }
}
