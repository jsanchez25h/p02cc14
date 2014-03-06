<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('CakeTime', 'Utility');

class ComlecOrdenlecturasController extends AppController {

    public $helpers = array('Html', 'Form');
    public $name = 'ComlecOrdenlectura';

    /*      public function beforeFilter(){
      $this->layout = 'internal';
      }
     */

    public function index() {
        $this->layout = 'ajax';

        $arr_suministros = $this->ComlecOrdenlectura->all_conceptos();
        var_dump($arr_suministros);
        exit;
    }

    public function form() {
        //$this->layout = 'ajax';\
    }

    public function saveForm() {
        /* La carga del archivo tendra tiempo ilimitado*/
        set_time_limit(0);

        /* Upload archivo xml al servidor*/
        $allowedExts = array("xml");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "text/xml")) && ($_FILES["file"]["size"] < 14383719) && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "ERROR: " . $_FILES["file"]["error"] . "";
            } else {
                if (file_exists("XML/" . $_FILES["file"]["name"])) {
                    echo $_FILES["file"]["name"] . " ya existe. ";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"], "files/XML/" . $_FILES["file"]["name"]);
                    echo "Guardado en: " . "XML/" . $_FILES["file"]["name"] . '<br>';
                }
            }
        } else {
            echo "ERROR. El fichero debe ser XML";
        }

        /* Lectura del archivo xml desde su ubicacion en el servidor*/
        $xml = simplexml_load_file('files/XML/' . $_FILES["file"]["name"]);
        
        /* Lectura de los conceptos que se encuentran relacionados segun la unidad del negocio */
        /* Se simulara un id del negocio (1) */
        /* El id del negocio de simulacion en el futuro sera obtenido desde la sesion */
        $idunidadnegocio=1;
        $conceptosByUnidadNegocio = $this->ComlecOrdenlectura->conceptosByUnidadNegocio($idunidadnegocio);
        
        /* Crear tabla orden de lectura en funcion a los conceptos obtenidos */
        /* Nomenclatura de la tabla lecturas comlec_ordenlecturas{id de unidad de negocio} */
        /* La nomenclatura de la tabla permitira trabajar con varias unidades del negocio al mismo tiempo */
        $creartablaordenlecturas = $this->ComlecOrdenlectura->crearTablaOrdenLecturas($conceptosByUnidadNegocio,$idunidadnegocio);
        

        if (!$creartablaordenlecturas){
            return 'Error al crear Tabla';
        }
        else
        {
            /*insertar uml en la nueva tabla creada*/
            $insertaruml = $this->ComlecOrdenlectura->insertarUml($conceptosByUnidadNegocio,$idunidadnegocio,$xml);
        }
    
        if ($insertaruml){
            echo  'archivo subido correctamente';
        }
        else
        {
             echo  'error al subir archivo';
        }
        exit();
        

      
    }

}
