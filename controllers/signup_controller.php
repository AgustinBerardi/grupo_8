<?php

    class Signup_Controller extends CI_Controller {
        
        public function __construct (){
            parent::__construct();
            $this->load->model('signup_model');
            $this->load->helper(array('url','form','verificar_pagina'));   
            $this->load->library(array('form_validation','session'));    
            $this->load->database('default');     
        } 
        public function index(){
            if(verificar_public_user($this->session->userdata('perfil')))
                 $this->load->view('signup_view');
        }
        
        
        public function add_user(){
              $this->form_validation->set_rules('username','nombre de usuario','callback_verificar_username');
              $this->form_validation->set_rules('password','contraseña','callback_verificar_pass');
              $this->form_validation->set_rules('email','email','callback_verificar_email');
              $this->form_validation->set_rules('nombre','nombre','callback_verificar_campo');
              $this->form_validation->set_rules('apellido','apellido','callback_verificar_campo');
              $this->form_validation->set_rules('conf_password','conf_password','callback_comparar_pass');
              if($this->form_validation->run()== FALSE)
                        $this->index();
              else{
                    $data= array( 'username' =>  $this->input->post('username') , 
                                  'password' =>  $this->input->post('password'),
                                  'email' => $this->input->post('email'),
                                  'nombre'=> $this->input->post('nombre'),
                                  'apellido' => $this->input->post('apellido'),
                                  'conf_password' => $this->input->post('conf_password'),
                                  'f_nacimiento' => $this->input->post('fecha'),
                                  'nacionalidad' => $this->input->post('paises')
                                  );
                    
                    $this->signup_model->add_user(serialize($data));
                    if(verificar_public_user($this->session->userdata('perfil')))
                            $this->load->view('registro_exitoso_view');
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
        public function comparar_pass($conf_password){
            if (!($this->input->post('password') == $conf_password)){
                $this->form_validation->set_message('comparar_pass','Las contraseñas deben coincidir');
                return FALSE;
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
        
    }



?>