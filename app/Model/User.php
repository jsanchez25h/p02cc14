<?php
App::uses('AppModel', 'Model');
class User extends AppModel {

	public $displayField = 'username';

	/**
	 * Creates and return an User Object with its basic informations BY THE Username
	 * @param User.username $username
	 * @return boolean|User
	 */
	public function all_User(){
		return $this->find('all');
	}

}
