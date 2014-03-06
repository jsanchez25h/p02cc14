<?php
App::uses('AppModel', 'Model');
class ComlecuniUnidadconcepto extends AppModel {
    /**
     * Creates and return an User Object with its basic informations BY THE Username
     * @param User.username $username
     * @return boolean|User
     */

    public $name = 'ComlecuniUnidadconcepto';
 //   var $hasAndBelongsToMany = array('GlomasUnidadnegocio'=>array('className'=>'GlomasUnidadnegocio'));
  //  var $hasAndBelongsToMany2 = array('MasOlconcepto'=>array('className'=>'MasOlconcepto'));
    public $belongsTo = array(
		'MasOlconcepto' => array(
			'className' => 'MasOlconcepto',
			'foreignKey' => 'mas_olconcepto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'GlomasUnidadnegocio' => array(
			'className' => 'GlomasUnidadnegocio',
			'foreignKey' => 'glomas_unidadnegocio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
   
}