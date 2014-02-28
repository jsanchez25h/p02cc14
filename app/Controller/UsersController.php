<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
class UsersController extends AppController {

	public $name = 'User';
	
	public function beforeFilter(){
		$this->layout = 'internal';
	}

	public function view_user(){
		$this->layout = 'ajax';
		$this->loadModel('User');
		$arr_obj_user = $this->User->all_User();
		pr($arr_obj_user);
		//debug($data);
		//pr($data);
		//print_r($data);
		exit();
		$this->set(compact('arr_obj_user'));		
	}
}
