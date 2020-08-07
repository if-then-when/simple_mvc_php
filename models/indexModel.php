<?php

namespace models;

use libs\bootstrap;
use libs\Controller;
use libs\View;
use libs\Session;
use libs\Database;
use libs\Model;

class IndexModel extends Model 
{
	public function __construct() 
	{
		parent::__construct();		
	}
	
	public function getBalance(){
		$params = array(
			Bootstrap::$session->get('user_id')
		);
		$result = Database::execute('SELECT value FROM balance WHERE password = ? ', 's', $params);		
		
	return	$result[0]['value'];	
	}

	public function setBalance($balance){
		$params = array(
			$balance,
			Bootstrap::$session->get('user_id')			
		);

		$result = Database::execute('UPDATE balance SET value = ? WHERE password = ?', 'is', $params);				

		return	$result;	
	}
	
	public function getAuth(){
		$params = array(
			$_POST['login'],
			$_POST['password']
		);
		$result = Database::execute('SELECT password FROM users WHERE login = ? AND password = MD5(?)', 'ss', $params);
		
		return  $result;
	}	
}