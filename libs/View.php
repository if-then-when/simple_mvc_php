<?php

namespace libs;

class View 
{
	public function __construct() 
	{
	}
   
	public function render($name, array $params = []) 
	{
        if (is_array($params)) {
            extract($params, EXTR_SKIP);
        }
		ob_start();	
		require 'views/' . $name . '.php';
        $content = ob_get_contents();
        ob_end_clean();	
		
		require_once 'views\TemplateView.php';	
	}   
}
