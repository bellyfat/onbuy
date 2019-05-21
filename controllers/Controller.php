<?php
namespace onbuy\controllers;

use onbuy\interfaces\IRenderer;
use onbuy\engine\App;

class Controller implements IRenderer {
    private $action;
    private $defaulAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;
    private $aside = 'aside';
    public $useAside = true;
    private $notAccessAction = 'notAccess';
    public $adminAccess = false;
    public $cartPreview = true;

    public function __construct(IRenderer $renderer) {
        $this->renderer = $renderer;
    }
    
    public function runAction($action = null, $id = null) {
        if ($this->adminAccess && !$this->isAdmin()) {
            $this->action = $this->notAccessAction;
        } else {
            $this->action = $action ?: $this->defaulAction;
        }
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method($id);
        } else {
            echo "404 Страница не найдена";
        }
    }
    private function isAdmin() {
        return App::call()->usersRepository->isAuth();
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            return $this->renderTemplate(
                "layouts/{$this->layout}",
                [
                    'content' => $this->renderContent($template, $params),
                    'title' => App::call()->settingRepository->getSiteSetting()->site_name,
                    'cart' => $this->cartPreview,
                    'count' => App::call()->basketRepository->getBasketCount(),
                    'auth' => App::call()->usersRepository->isAuth(),
                    'username' => App::call()->usersRepository->getName(),
                    'company' => App::call()->companyRepository->getContact(),
                    'menu' => App::call()->categoryRepository->getFilledCategory(),
                    'background' => App::call()->categoryRepository->getOne($params['category'])->image,
                ]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }
    
    public function renderTemplate($template, $params = []) {
        return $this->renderer->renderTemplate($template, $params);
    }
    
    public function renderContent($template, $params = []) {
        if ($this->useAside) {
            return $this->renderTemplate(
                "layouts/{$this->aside}",
                [
                    'pagetitle' => $params['pagetitle'],
                    'content' => $this->renderTemplate($template, $params),
                    'menu' => App::call()->categoryRepository->getFilledCategory(),
                    'menu_items' => App::call()->subcategoryRepository->getFilledItem(),
                    'current' => $params['category'],
                    'current_item' => $params['category_item'],
                ]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }
}
