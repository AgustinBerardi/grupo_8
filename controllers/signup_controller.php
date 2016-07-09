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
                 $this->load->view('signup_view',$this->input->post());
        }
        
        
        public function add_user(){
              $this->form_validation->set_rules('username','nombre de usuario','callback_verificar_username');
              $this->form_validation->set_rules('password','contraseña','callback_verificar_pass');
              $this->form_validation->set_rules('email','email','callback_verificar_email');
              $this->form_validation->set_rules('nombre','nombre','callback_verificar_campo');
              $this->form_validation->set_rules('apellido','apellido','callback_verificar_campo');
              $this->form_validation->set_rules('conf_password','conf_password','callback_comparar_pass');
              $this->form_validation->set_rules('fecha','fecha','callback_verificar_edad');            
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
            
            if  (!(preg_match("/^([a-zA-Z]){1}([a-zA-Z0-9_]){3}/",$username)) || strlen($username)>20)
             { 
               $this->form_validation->set_message('verificar_username','No es un nombre de usuario valido. Debe comenzar con una letra seguido de letras y numeros. Debe tener entre 4 y 12 caracteres COMO TU MADRE'); 
               return FALSE;
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
            if (!(preg_match("/^([a-zA-Z0-9]){8}/",$password)) || strlen($password) > 16){
                $this->form_validation->set_message('verificar_pass','Contraseña no valida. Solo se permiten numeros y letras. Debe tener entre 8 y 16 caracteres');
                return FALSE;
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
            if (!(preg_match("/^([a-zA-Z]){2}/",$campo))){
                $this->form_validation->set_message('verificar_campo','El campo debe tener por lo menos 2 letras');
                return FALSE;
            }
            return TRUE;
        }
        public function verificar_edad($edad){
                trim($edad);
                $trozos = explode("-", $edad);
                if(!(sizeOf($trozos)==3)){
                    $this->form_validation->set_message('verificar_edad','La fecha ingresada es invalida');
                    return FALSE;
                }
                $dia=$trozos[2];                
                $mes=$trozos[1];               
                $año=$trozos[0];            
                if(checkdate ($mes,$dia,$año)){
                    return TRUE;
                }else{
                     $this->form_validation->set_message('verificar_edad','La fecha ingresada es invalida');
                     return FALSE;
                }
        }
        
    }



?>