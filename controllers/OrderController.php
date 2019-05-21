<?php
namespace onbuy\controllers;

use onbuy\engine\App;
use onbuy\model\entities\Clients;
use onbuy\model\entities\LegalClients;
use onbuy\model\entities\Orders;

class OrderController extends Controller {
    public $useAside = false;
    public $cartPreview = false;
    
    public function actionIndex() {
        if (isset(App::call()->request->getParams()['order'])) {
            $order_id = $this->sendOrder();
            if (isset($order_id)) {
                session_regenerate_id();
                $params['order_id'] = $order_id;
                $params['pay'] = App::call()->request->getParams()['pay'];
            }
        } else {
            $params['amount'] = App::call()->basketRepository->getTotalAmount(session_id());
            $params['count'] = App::call()->basketRepository->getBasketCount();
            $params['delivery'] = App::call()->deliveryRepository->getAll();
        }
        echo $this->render('order', $params);
    }
    
    private function sendOrder() {
        $post_data = App::call()->request->getParams();
        $client_id = $this->saveClient();
        $legal_client_id = $post_data['company']==1 ? $this->saveLegalClient($client_id) : null;
        $delivery_address = "{$post_data['locate']} {$post_data['number']}";
        $order = new Orders(
            null, 
            session_id(), 
            date('Y-m-d H:i:s'),
            $client_id,
            $legal_client_id,
            $post_data['delivery'],
            $delivery_address,
            $post_data['pay'],
            $post_data['comment'],
            1
        );
        App::call()->ordersRepository->save($order);
        return $order->id;
    }
    
    private function saveClient() {
        $client = new Clients(
            null,
            App::call()->request->getParams()['name'],
            App::call()->request->getParams()['phone'],
            App::call()->request->getParams()['email']
        );
        App::call()->clientsRepository->save($client);
        return $client->id;
    }
    
    private function saveLegalClient($contact) {
        $client = new LegalClients(
            null,
            App::call()->request->getParams()['company-name'],
            App::call()->request->getParams()['inn'],
            App::call()->request->getParams()['kpp'],
            App::call()->request->getParams()['company-address'],
            $contact
        );
        App::call()->legalClientsRepository->save($client);
        return $client->id;
    }
}
