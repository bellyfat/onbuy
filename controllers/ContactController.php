<?php
namespace onbuy\controllers;

use onbuy\engine\App;
use onbuy\model\entities\Clients;
use onbuy\model\entities\Feedback;

class ContactController extends Controller {
    public function actionIndex() {
        echo $this->render('contact',[
            'pagetitle' => 'Контакты',
            'company' =>  App::call()->companyRepository->getContact(),
        ]);
    }
    
    public function actionFeedback() {
        if (isset(App::call()->request->getParams()['name'])) {
            $client = new Clients(
                null,
                App::call()->request->getParams()['name'],
                App::call()->request->getParams()['phone'],
                App::call()->request->getParams()['email']
            );
            App::call()->clientsRepository->save($client);
            if ($this->saveMessage($client->id)) {
                echo json_encode(['client' => $client->name], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
            }
        }
    }
    
    private function saveMessage($id) {
        if (!is_null($id)) {
            $message = new Feedback(
                null,
                date('Y-m-d H:i:s'), 
                $id,
                App::call()->request->getParams()['message']
            );
            App::call()->feedbackRepository->save($message);
            return true;
        }
        return false;
    }
}
