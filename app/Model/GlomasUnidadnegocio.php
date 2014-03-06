<?php
App::uses('AppModel', 'Model');
class GlomasUnidadnegocio extends AppModel {
    /**
     * Creates and return an User Object with its basic informations BY THE Username
     * @param User.username $username
     * @return boolean|User
     */

    public $name = 'GlomasUnidadnegocio';
    public $hasMany = array(
                    'ComlecuniUnidadconcepto' => array(
                            'className' => 'ComlecuniUnidadconcepto',
                            'foreignKey' => 'glomas_unidadnegocio_id',
                            'dependent' => false
                    )
            );
   
}