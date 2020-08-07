<?php

namespace controllers;


use libs\bootstrap;
use libs\Controller;
use libs\View;
use libs\Session;
use libs\Database;
use models\indexModel;

class IndexController extends Controller
{
	public $model;
	
	public function __construct() 
	{		
		parent::__construct();
	}	
	
	public function actionIndex()
	{  
		$this->view->render('index');
		exit();	
	}	  
	
	public function actionLogin(){
		$this->view->render('login');
		error_log('User login');
		exit();
	}
	
	public function actionLogout() {
		Bootstrap::$session->init(true);
		Bootstrap::$session->set('auth_id', false);
		Bootstrap::$session->__unset('user_id');			
		error_log('User logout');		
		$this->view->render('logout');
		exit();
	}  	

	public function actionBalance() {		
		$result = indexModel::getBalance();	
		$this->view->render('balance', ['balance' =>  $result]);
		exit();
	}  	

	public function actionError() {
		$this->view->render('error');
		exit();
	}  	

	public function actionAuth() {
		$result = indexModel::getAuth();	
		if($result) {
			Bootstrap::$session->init(true);			
			Bootstrap::$session->set('auth_id', true);
			Bootstrap::$session->set('user_id', $result[0]['password']);			

			$result = indexModel::getBalance();				
			$this->view->render('balance', ['balance' =>  $result]);
			exit();	
		} else {
			Bootstrap::$session->init(true);			
			Bootstrap::$session->set('auth_id', false);			
			Bootstrap::$session->__unset('user_id');	
			$this->view->render('error', ['error' => 'authentication error']);
			exit();
		}			
	}

	public function actionPay() {

		$balance = indexModel::getBalance();				

		if ($_POST['value'] > 0){
			
			if ($balance < $_POST['value']){
				$this->view->render('error', ['error' => 'You want to get a larger amount that ' . $_POST['value'] . 
				                                         ' more of your balance ' . $balance]);		
				exit();													
			}			
			$balance = $balance - $_POST['value']; 
		}else{
			$this->view->render('error', ['error' => 'amount must be greater than 0']);		
			exit();																
		}			
		
		$result = indexModel::setBalance($balance);
		
		if ($result){
			$this->view->render('balance',  ['balance' =>  $balance]);
		}else{
			$this->view->render('error', ['error' => 'error updating your balance']);		
			exit();																		
		}
	}  	
}
