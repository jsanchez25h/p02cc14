<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
class ComlecSuministrosController extends AppController {

	public $name = 'ComlecSuministro';
	
	public function beforeFilter(){
		$this->layout = 'internal';
	}

	public function index(){
		$this->layout = 'ajax';
		$this->loadModel('ComlecSuministro');
		$arr_suministros = $this->ComlecSuministro->all_suministros();
		//pr($arr_suministros);
		//debug($data);
		//pr($data);
		//print_r($data);
		//exit();
                $this->set(compact('arr_suministros'));		
                
               // $this->set('arr_suministros', $arr_suministros);
                
                
                
	}
        
        public function form(){
		$this->layout = 'ajax';
		$this->loadModel('ComlecSuministro');
		$arr_suministros = $this->ComlecSuministro->all_suministros();
		//pr($arr_suministros);
		//debug($data);
		//pr($data);
		//print_r($data);
		//exit();
                $this->set(compact('arr_suministros'));		
                
               // $this->set('arr_suministros', $arr_suministros);
                
                
                
	}
        
    public function saveForm(){
       pr($this->request->data);
       exit();
        $this->layout = 'ajax';
         if ($this->request->is('post')) {
            if ($this->ComlecSuministro->save($this->request->data)) {
                echo "grabado";
                 exit();
            }
        }
        exit();
     }
}
