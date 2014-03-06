<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');
class ComlecSuministrosController extends AppController {
    public $helpers = array('Html', 'Form');
	public $name = 'ComlecSuministro';
	


	/*public function beforeFilter(){
		$this->layout = 'internal';
	}
*/
	public function index(){
		$this->layout = 'ajax';
		//$this->loadModel('ComlecSuministro');
		//$arr_suministros = $this->ComlecSuministro->all_suministros();
		//pr($arr_suministros);
		//debug($data);
		//pr($data);
		//print_r($data);
		//exit();
            //    $this->set(compact('arr_suministros'));		
                
               // $this->set('arr_suministros', $arr_suministros);
                
            
            $arr_suministros = $this->ComlecSuministro->find('all');
       //   var_dump($arr_suministros);exit;
//$this->set('ComlecSuministro', $this->ComlecSuministro->find('all'));
 $this->set(compact('arr_suministros'));
                
                
	}
        
   public function form(){
		//$this->layout = 'ajax';\

	}
   

             
               // $this->set('arr_suministros', $arr_suministros);
                
                
                
	
        
    public function saveForm(){
        
        set_time_limit(0);
//var_dump($_FILES["file"]["size"]);exit;
    	$allowedExts = array("xml");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "text/xml"))
&& ($_FILES["file"]["size"] < 14383719)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "ERROR: " . $_FILES["file"]["error"] . "";
    }
  else
    {
    if (file_exists("XML/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " ya existe. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "files/XML/" . $_FILES["file"]["name"]);
      echo "Guardado en: " . "XML/" . $_FILES["file"]["name"].'<br>';
      }
    }
  }
else
  {
  echo "ERROR. El fichero debe ser XML";
  }

//var_dump($_FILES["file"]["name"]);exit;
	$xml = simplexml_load_file('files/XML/'.$_FILES["file"]["name"]);
//	echo $xml;


 // $xml = simplexml_load_file("productos.xml");
 
foreach($xml->children() as $child)
  {
 // 	var_dump('s');
 // echo $child->Suministro."<br>US$ <b>".$child->Concepto_D. "</b><br/><br>";
//var_dump($this->data);exit;
	//$this->request->data['ComlecSuministro']['numsuministro']= $child->Suministro;
   //$this->data['ComlecSuministro']['numsuministro']= $child->Suministro;
  	$array['ComlecSuministro']['numsuministro']= $child->Suministro;

//$varComponent = $this->data['MachineComponent']; 
	 $this->ComlecSuministro->save($array);

	    $this->ComlecSuministro->id = false;

  }




exit();
    	 //  	var_dump($_FILES["filexml"]["name"]);exit;
      // pr($this->request->data);
     //  exit();
//        $this->layout = 'ajax';
//         if ($this->request->is('post')) {
//          // var_dump($this->request->data);exit;
//             	$this->loadModel('ComlecSuministro');
//          $this->ComlecSuministro->create();
//         // var_dump($this->ComlecSuministro);exit;
//            if ($this->ComlecSuministro->save($this->request->data)) {
//                  var_dump('paosrrrrr');exit;
//                echo "grabado";
//                 exit();
//            }
//        }
//        if ($this->ComlecSuministro->validates()) {
//        //	var_dump($this->data);
//            // paso la lógica de validación
//            	$this->loadModel('ComlecSuministro');
//                        var_dump('paso');
//                        $this->ComlecSuministro->save($this->data);
//                        var_dump('paso2');
//        } else {
//            // no paso la lógica de validadición
//            var_dump('no paso');
//        }
        //$this->ComlecSuministro->save($this->data);


    //var_dump($this->data);exit;

   //  $this->ComlecSuministro->save($this->data);
        // Podemos guardar los datos de Usuario
        // deberían estar en: $this->data['Usuario']

    	 //	var_dump($this->data);exit;
   	 	//echo $this->ComlecSuministro->error_reporting();
//
//  if ($this->ComlecSuministro->save($this->data)) {
//       var_dump('todo bien');exit;
//    }

      //  $this->ComlecSuministro->save($this->data);

	//	var_dump($this->ComlecSuministro->id);exit;
        // El ID del nuevo Usuario está ahora en $this->User->id, así que lo
        // añadimos a los datos a grabar y grabamos el Perfil
       // $this->data['Perfil']['usuario_id'] = $this->Usuario->id;

        // Como nuestro "Usuario hasOne Perfil", podemos acceder
        // al modelo Perfil a través del modelo Usuario
     //   $this->Usuario->Perfil->save($this->data);
   		
     }
}
