<?php

    class Login_Controller extends CI_Controller{
        
        public function __construct(){
            parent::__construct();  
            $this->load->helper(array('url','form','verificar_pagina'));
            $this->load->library(array('form_validation','session'));  
            $this->load->model('login_model');    
            $this->load->database('default');      
        }
        
        public function index (){
           if(verificar_public_user($this->session->userdata('perfil')))
                 $this->load->view('login_view');
       
        }
        
        public function login_user (){
            
              $this->form_validation->set_rules('username','nombre de usuario','callback_verificar_username');
              $this->form_validation->set_rules('password','contraseña','callback_verificar_pass');           
              if($this->form_validation->run()== FALSE)
                        $this->index();
              else{
                    $data= array( 'username' =>  $this->input->post('username') , 
                                  'password' =>  $this->input->post('password'));
                    
                    $check_user = $this->login_model->login_user($data);
                    if($check_user){
                            	$data = array(
                               'premium'        =>      $check_user->premium,
	                           'id_usuario' 	=> 		$check_user->id,
                               'perfil'	     	=>		$check_user->perfil,
	                           'username' 		=> 		$check_user->username);
                            $this->session->set_userdata($check_user);
                            $this->index();
                    }
                    
            }
        }
            

            
           public function verificar_username($username){   
            if  (!(preg_match("/^([a-zA-Z]){1}/",$username))) { 
               $this->form_validation->set_message('verificar_username','No es un nombre de usuario valido. Debe comenzar con una letra'); 
               return FALSE;
             }
            if(strlen($username)<4 || strlen($username)>20)
            {
               $this->form_validation->set_message('verificar_username','No es un nombre de usuario valido. El nombre debe comprender entre 4 y 20 caracteres'); 
               return FALSE;   
            }     
             $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' '_1234567890"; 
               for ($i=0; $i<strlen($username); $i++){ 
                  if (strpos($permitidos, substr($username,$i,1))===false){ 
                     $this->form_validation->set_message('verificar_username','El username contiene caracteres que no son validos');
                     return false; 
                  } 
               }
             return TRUE;
            }
            public function verificar_pass($password){
            if (strlen($password)<8 || strlen($password) > 16){
                $this->form_validation->set_message('verificar_pass','Contraseña no valida.Debe tener entre 8 y 16 caracteres');
                return FALSE;
            }
            $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' '_1234567890"; 
               for ($i=0; $i<strlen($password); $i++){ 
                  if (strpos($permitidos, substr($password,$i,1))===false){ 
                     $this->form_validation->set_message('verificar_pass','El password debe contener letras numeros y "_"');
                     return false; 
                  } 
               }
            return TRUE;
        }
            
        public function logout (){
            $this->session->unset_userdata();
            $this->session->sess_destroy();
            redirect(site_url().'home_controller');            
        }
        
        public function recordar_pass(){
               if(verificar_public_user($this->session->userdata('perfil')))
                 $this->load->view('recordar_pass_view');
                   
        }
        
        public function cambiar_pass(){
            $user =$this->login_model->buscar_user($this->input->post('username'));
            if($user){
                $this->login_model->cambiar_contraseña($this->input->post('username'),'12345678');
                if(verificar_public_user($this->session->userdata('perfil')))
                    $this->load->view('cambio_exitoso_view');
            }       
        }
    }

?>