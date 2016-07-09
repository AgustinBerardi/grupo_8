<?php

    class Login_Model extends CI_Model {
        
            
        public function __construct(){
            parent::__construct();            
        }
        
        public function login_user ($user){
            $this->db->where('username',$user['username']);
            $this->db->where('pass',$user['password']);
            $query_result= $this->db->get('user');
            if($query_result->num_rows() == 1 ){
                if($query_result->row()->habilitado){
                  return $query_result->row();
                }  else{
                     $data['username']=$username;
                     $data['password']=$pass; 
                     $this->session->set_flashdata('usuario',$data);
                     $this->session->set_flashdata('usuario_incorrecto','La cuenta del usuario esta dada de baja');
                     redirect(site_url().'login_controller','refresh');
                }
            }      
            else{
                 $data['username']=$user['username'];
                 $data['password']=$user['password']; 
                 $this->session->set_flashdata('usuario',$data);
                 $this->session->set_flashdata('usuario_incorrecto','El username o password no es correcto');
                 redirect(site_url().'login_controller','refresh');
            }
            
        }
        public function buscar_user($username){
               $this->db->where('username',$username);
               $query_result=$this->db->get('user');
              if($query_result->num_rows() == 1)
                  return $query_result->row();
             else
                 $this->session->set_flashdata('usuario_incorrecto','El username no es correcto');
                 redirect(site_url().'login_controller/recordar_pass','refresh');
             
        }
        public function cambiar_contraseña ($username , $contraseña ){
            $tabla = array('pass' => $contraseña);
            $this->db->where('username',$username);
            $this->db->update('user',$tabla);
        }
    }


?>