<?php

    class Admin_Model extends CI_Model {
        
            
        public function __construct(){
            parent::__construct();            
        }
            
        public function verificar_nombre_couch($nombre){
               $this->db->where('nombre_couch',$nombre);
               $query_result=$this->db->get('tipo_couch');
              if(!($query_result->num_rows() == 0))
                  return true;
              else
                  return false;

        }
}
?>