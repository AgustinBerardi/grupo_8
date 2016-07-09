<?php

    class Signup_Model extends CI_Model {
        
        public function __construct(){
            parent::__construct();            
        }
        
        public function add_user ($user){ 
                $user = unserialize($user);
                $nombre = $user['nombre'];
                $email = $user['email'];  
                $apellido = $user['apellido'];
                $username = $user['username'];
                $f_nacimiento = $user['f_nacimiento'];
                $pass = $user['password'];
                $nacionalidad = $user['nacionalidad'];         
                $query = "SELECT nombre
                          FROM user u
                          WHERE username='$username'";
                $query_result= $this->db->query($query);
                if(!($query_result->num_rows() == 0)){
                    $this->session->set_flashdata('usuario',$user);
                    $this->session->set_flashdata('usuario_existente',utf8_encode('Ese nombre de usuario no está disponible'));
                    redirect(site_url().'signup_controller','refresh');
                    }
                else
                    {
                        $query = "SELECT nombre
                          FROM user u
                          WHERE email='$email'";
                        $query_result= $this->db->query($query);
                        if(!($query_result->num_rows() == 0)){
                            $this->session->set_flashdata('usuario',$user);
                            $this->session->set_flashdata('email_existente',utf8_encode('Ese email no está disponible'));
                            redirect(site_url().'signup_controller','refresh');
                        } 
                         else{
                            $query = "INSERT INTO user(perfil, premium, username, email, f_nacimiento, nombre, apellido, pass,nacionalidad)
                                      VALUES              ('usuario',0,'$username','$email','$f_nacimiento','$nombre','$apellido','$pass','$nacionalidad')";
                            
                            $this->db->query($query);
                         }
                    }       
        }
        
        public function traer_paises (){
            $query = "SELECT nombre 
                      FROM pais";
            $query_result= $this->db->query($query);
            return $query_result->result();            
        }
       
    }



?>