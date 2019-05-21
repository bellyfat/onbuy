<?php
namespace onbuy\engine;

use onbuy\traits\Tsingletone;

class App {
    use Tsingletone;
    
    public $config;
    /** @var  Storage */
    private $components;
    
    private $controller;
    private $action;
    private  $id;
    
    public static function call() {
        return static::getInstance();
    }
    
    public function run($config) {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }
    
    public function createComponent($name) {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
        }
        return null;
    }
    
    public function runController() {
        $this->controller = $this->request->getControllerName() ?: 'index';
        $this->action = $this->request->getActionName();
        $this->id = $this->request->getId();
        
        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";
        
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action, $this->id);
        }
    }
    
    function __get($name) {
        return $this->components->get($name);
    }
}
