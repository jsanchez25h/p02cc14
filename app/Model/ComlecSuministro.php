<?php
App::uses('AppModel', 'Model');
class ComlecSuministro extends AppModel {

	/**
	 * Creates and return an User Object with its basic informations BY THE Username
	 * @param User.username $username
	 * @return boolean|User
	 */
	public function all_suministros(){
		return $this->find('all');
	}

}