<?php
App::uses('AppModel', 'Model');
class MasOlconcepto extends AppModel {
    /**
     * Creates and return an User Object with its basic informations BY THE Username
     * @param User.username $username
     * @return boolean|User
     */

    public $name = 'MasOlconcepto';
    public $hasMany = array(
                    'ComlecuniUnidadconcepto' => array(
                            'className' => 'ComlecuniUnidadconcepto',
                            'foreignKey' => 'mas_olconcepto_id',
                            'dependent' => false
                    )
            );
   
}