<?php

namespace libs;

class Bootstrap 
{
	public static $db;
	public static $session;
	
	public function __construct() {
		$this->init();
	}
	
	public function init(){
		
		self::$db = (new Database())->init();
		
		self::$session = new Session();
		self::$session->init();
	}

	public function run(){
		$controllerName = 'controllers\\indexController';
		$actionName = 'Index';
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (!empty($routes[1])){
			$actionName = $routes[1];
		}

		$file = $controllerName . '.php';

		if(file_exists($file)) {
			require $file;
		} else {
			trigger_error('Controller  "' . $controllerName . 'Controller" not found in ');			
		}
	
		$controller = new $controllerName;
				
		$actionName = 'action' . ucfirst($actionName);

		if (method_exists($controller, $actionName)){
			$controller->$actionName();	
		}
		else{
			trigger_error('Action  "' . $actionName . '" not found in ' . $controllerName . 'Controller');
		}		
	}
}  
