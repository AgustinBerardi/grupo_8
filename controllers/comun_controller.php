<?php

class Comun_Controller extends CI_Controller {
        
        public function __construct (){
            parent::__construct();
            $this->load->model('login_model');
            $this->load->model('signup_model');
            $this->load->model('comun_model');
            $this->load->helper(array('url','form','verificar_pagina'));   
            $this->load->library(array('form_validation','session'));    
            $this->load->database('default');     
        } 
        public function index(){
        }
        
        public function modificar_informacion(){
            if(verificar_comun_user($this->session->userdata('perfil'))){
                $check_user = $this->login_model->buscar_user($this->session->userdata('username'));
                if($check_user){
                            	$data = array(
                               'username'        =>      $check_user->username,
	                           'email' 	=> 		$check_user->email,
                               'password'	     	=>		$check_user->pass,
                               'apellido'	     	=>		$check_user->apellido,
                               'fecha'	     	=>		$check_user->f_nacimiento,
                               'pais'	     	=>		$check_user->nacionalidad,                               
	                           'nombre' 		=> 		$check_user->nombre);
                               
                          $this->load->view('modificar_informacion_view',$data);
                    }
              
            }
        }
        public function cambiar_informacion(){
        if(verificar_comun_user($this->session->userdata('perfil'))){
              $this->form_validation->set_rules('email','email','callback_verificar_email');
              $this->form_validation->set_rules('nombre','nombre','callback_verificar_campo');
              $this->form_validation->set_rules('apellido','apellido','callback_verificar_campo');
              if($this->form_validation->run()== FALSE)
                        $this->modificar_informacion();
              else{
                    $data= array ('email' => $this->input->post('email'),
                                  'nombre'=> $this->input->post('nombre'),
                                  'apellido' => $this->input->post('apellido'),
                                  'f_nacimiento' => $this->input->post('fecha'),
                                  'nacionalidad' => $this->input->post('paises')
                                  );
                    
                    $this->comun_model->cambiar_informacion($this->session->userdata('username'),$data);
                    if(verificar_comun_user($this->session->userdata('perfil')))
                            $this->load->view('cambio_informacion_exitoso_view');
              }
            
            }
        }
        
        public function cambiar_password(){
            if(verificar_comun_user($this->session->userdata('perfil')))
                    $this->load->view('cambiar_password_view',$this->input->post());
        }
         
        public function verificar_cambio_password (){
            if(verificar_comun_user($this->session->userdata('perfil')))  {
                $this->form_validation->set_rules('new_password','contraseña','callback_verificar_pass');
                $this->form_validation->set_rules('old_password','contraseña','callback_verificar_si_es_correcta');
                $this->form_validation->set_rules('conf_password','conf_password','callback_comparar_pass');
                if($this->form_validation->run()== FALSE)
                        $this->cambiar_password();
              else{
                    $this->login_model->cambiar_contraseña($this->session->userdata('username'),$this->input->post('new_password'));
                    if(verificar_comun_user($this->session->userdata('perfil'))){
                         $this->session->unset_userdata();
                         $this->session->sess_destroy();
                         if(verificar_public_user($this->session->userdata('perfil')))
                                $this->load->view('cambio_exitoso_view'); 
                    }
                }
            }   
        }
        
        
        public function verificar_email($email){
            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                $this->form_validation->set_message('verificar_email','Email no valido');
                return FALSE;
            }
            return TRUE;
        }
        
        
        public function verificar_campo($campo){
            if (strlen($campo)<2){
                $this->form_validation->set_message('verificar_campo','El campo debe tener por lo menos 2 letras');
                return FALSE;
            }
            $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' '"; 
               for ($i=0; $i<strlen($campo); $i++){ 
                  if (strpos($permitidos, substr($campo,$i,1))===false){ 
                     $this->form_validation->set_message('verificar_campo','El campo contiene caracteres que no son validos');
                     return false; 
                  } 
               }
            return TRUE;
        }
        
        public function comparar_pass($conf_password){
            if (!($this->input->post('new_password') == $conf_password)){
                $this->form_validation->set_message('comparar_pass',"Las contraseñas deben coincidir");
                return FALSE;
            }
            return TRUE;
        }
        public function verificar_pass($password){
             if (($this->input->post('old_password') == $password)){
                      $this->form_validation->set_message('verificar_pass','La nueva contraseña no puede ser igual a la anterior');
                      return FALSE;
                 }
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
        
        
        public function verificar_si_es_correcta ($old_password){
            $pass=$this->comun_model-> verificar_password_para_user($this->session->userdata('username'),$old_password);
            if($pass==$old_password){
                 return TRUE;
            }
            $this->form_validation->set_message('verificar_si_es_correcta',"La contraseña no es correcta");
            return FALSE;               
        }
    }   
?>