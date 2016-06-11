<?php

class User_Model extends CI_Model {
        
            
        public function __construct(){
            parent::__construct();            
        }
         
        public function eliminar_cuenta($username){
            $tabla = array('habilitado' => 0);
            $this->db->where('username',$username);
            $this->db->update('user',$tabla);
        }
}
?>