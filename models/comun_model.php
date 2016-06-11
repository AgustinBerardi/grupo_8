<?php

class Comun_Model extends CI_Model {
        
            
        public function __construct(){
            parent::__construct();            
        }
        
        public function cambiar_informacion($username, $user){
             $this->db->where('username',$username);
             $this->db->update('user',$user);
        }
        
        public function verificar_password_para_user($username,$user){
            $this->db->where('username',$username);
            $query_result = $this->db->get('user');
            if ($query_result->num_rows() == 1){
                return ($query_result->row()->pass);
            }else{
                return FALSE;
            }
        }
         
        public function cambiar_premium($username){
            $tabla = array('premium' => 1);
            $this->db->where('username',$username);
            $this->db->update('user',$tabla);
        }
}
?>