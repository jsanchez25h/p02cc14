<?php
App::uses('AppModel', 'Model');
class ComlecOrdenlectura extends AppModel {
    public $name = 'ComlecOrdenlectura';
    
    public function conceptosByUnidadNegocio($idunidadnegocio){
        $db = $this->getDataSource();
        $sql="select c.id,c.descripcion from  lecturas.comlecuni_unidadconceptos cuc
                inner join lecturas.glomas_unidadnegocios un
                on cuc.glomas_unidadnegocios_id=un.id and un.eliminado=false
                inner join lecturas.mas_olconceptos c
                on cuc.mas_olconceptos_id=c.id and c.eliminado=false
                where un.id=".$idunidadnegocio." and cuc.eliminado=false;";
        return  $db->query($sql);
    }
    
    
    public function crearTablaOrdenLecturas($conceptosByUnidadNegocio,$idunidadnegocio){
        $db = $this->getDataSource();
        $esquema='lecturas';
        $nombretabla='comlec_ordenlecturas'.$idunidadnegocio;
        
        /* verificar si la tabla existe antes de eliminarla*/
        $sql_verificarexistenciatabla="select * from pg_tables where tablename='".$nombretabla."'
        and schemaname='".$esquema."'";
        $return_sql_verificarexistenciatabla= $db->query($sql_verificarexistenciatabla);
        if ($return_sql_verificarexistenciatabla){
            /*Eliminar tabla antes de volver a crearla */
            $sql_eliminartabla="drop table ".$esquema.".".$nombretabla;
            $return_sql_eliminartabla= $db->query($sql_eliminartabla);
            if (!$return_sql_eliminartabla){
                return false;
            }
        }
        
        $campostabla='';
        foreach ($conceptosByUnidadNegocio as $clave => $valor) {
             $campostabla.=$valor[0]['descripcion'].' character varying(100),';
        }
      
        $sql="CREATE TABLE ".$esquema.".".$nombretabla."
             (
               id bigserial,
              ".$campostabla."
               eliminado boolean,
               created timestamp without time zone,
               modified timestamp without time zone
            )WITH (
           OIDS=FALSE
           );";
        
        $estadoCreado=$db->query($sql);
        
        if (!$return_sql_verificarexistenciatabla){
        $sql_crearsecuencia="CREATE SEQUENCE ".$esquema.".".$nombretabla."_id_seq
            INCREMENT 1
            MINVALUE 1
            MAXVALUE 9223372036854775807
            START 1
            CACHE 1;
            ";
        
        $db->query($sql_crearsecuencia);
        
        $sql_crearsecuencia1="ALTER TABLE ".$esquema.".".$nombretabla."_id_seq
                                 OWNER TO postgres;";
        
        $db->query($sql_crearsecuencia1);
        
        
        $sql_crearsecuencia2="alter table ".$esquema.".".$nombretabla;
        
        $db->query($sql_crearsecuencia2);
        
        $sql_crearsecuencia3="alter column id set default nextval('".$esquema.".".$nombretabla."_id_seq');";
        
        $db->query($sql_crearsecuencia3);
        }
        return  $estadoCreado;
    }
    
    
    public function insertarUml($conceptosByUnidadNegocio,$idunidadnegocio,$xml){
        $db = $this->getDataSource();
       
        $esquema='lecturas';
        $nombretabla='comlec_ordenlecturas'.$idunidadnegocio;
        $campostabla='';
        $campostabla2='';
        foreach ($conceptosByUnidadNegocio as $clave => $valor) {
             $campostabla.=$valor[0]['descripcion'].',';
        }
        
       $db->begin();
        
        foreach ($xml->children() as $child) {
            $campostabla2='';
            foreach ($conceptosByUnidadNegocio as $clave => $valor) {
                  $campostabla2.="'".$child->$valor[0]['descripcion']."'".',';
            }
            $sql="INSERT INTO ".$esquema.".".$nombretabla." ( ".$campostabla." eliminado) VALUES (".$campostabla2." false);";
            $db->query($sql);
        }
       return $db->commit();

    }
    
    
    public function all_conceptos(){
           // include('database.class.php');

//$db = new Database();
           $db = $this->getDataSource();
           
		//return  $db->query("SELECT descripcion from lecturas.mas_olconceptos;");
           
           
           $sql="CREATE TABLE lecturas.basura3
                        (
                          id integer,
                          descripcion character varying(100),
                          eliminado boolean
                        );";
           return  $db->query($sql);
	}
   
}