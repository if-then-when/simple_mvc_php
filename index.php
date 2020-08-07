<?php
	
	ini_set('display_errors', '0');
	$log_file = 'log_errors.log'; 
	ini_set('log_errors', '1'); 
	ini_set('error_log', $log_file); 	
	
	require_once 'libs/autoload.php';
	require_once 'libs/Bootstrap.php';
	(new \libs\Bootstrap())->run();
  

