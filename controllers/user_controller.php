<?php

    class User_Controller extends CI_Controller{
        
        public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->model('comun_model');
                $this->load->model('user_model'); 
                $this->load->helper(array('url','form','verificar_pagina'))  ;
                $this->load->library(array('form_validation','session'));       
        }
        
        public function index (){
             if(verificar_user($this->session->userdata('perfil')))
                 $this->load->view('user_view');
        }
        
        public function ingresar_tarjeta_premium(){
            if($this->session->userdata('premium')){
                redirect(site_url().'home_controller');
            }
            if((verificar_user($this->session->userdata('perfil')))){
                $this->load->view('ingresar_numero_tarjeta_view');
            }
        }
        public function cambiar_premium(){
            if($this->session->userdata('premium')){
                redirect(site_url().'home_controller');
            }
            $this->form_validation->set_rules('codigo','Codigo','callback_verificar_codigo');
            $this->form_validation->set_rules('seguridad','seguridad','callback_verificar_seguridad');
            if($this->form_validation->run()==FALSE)
                $this->ingresar_tarjeta_premium();
            else
            {
                $this->comun_model->cambiar_premium($this->session->userdata('username'));
                $this->session->set_userdata('premium',1);
                redirect(site_url().'home_controller');
            }
        }
        public function verificar_codigo($campo){
            if (!(preg_match("/^([0-9]){16}/",$campo)) & strlen($campo) <=16 ){
                $this->form_validation->set_message('verificar_codigo','El campo debe tener 16 digitos');
                return FALSE;
            }
            return TRUE;
        }
        public function verificar_seguridad($campo){
            if (!(preg_match("/^([0-9]){3}/",$campo))& strlen($campo) <=3){
                $this->form_validation->set_message('verificar_seguridad','El campo debe tener 3 digitos');
                return FALSE;
            }
            return TRUE;
        }
        
        public function eliminar_cuenta(){
            if((verificar_user($this->session->userdata('perfil')))){
                $this->user_model->eliminar_cuenta($this->session->userdata('username'));
                $this->session->unset_userdata();
                $this->session->sess_destroy();
                $this->load->view('eliminacion_exitosa_view');
                }
        }
        public function eliminar_cuenta_opciones(){
            if((verificar_user($this->session->userdata('perfil')))){
                 $this->load->view('eliminar_cuenta_opciones_view');
            }            
        }
} 

?>