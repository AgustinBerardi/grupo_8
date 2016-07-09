<?php

  class Couch_Controller extends CI_Controller{
        
        public function __construct(){
                parent::__construct();
                $this->load->database();
                $this->load->model('couch_model');
                $this->load->model('comun_model');
                $this->load->model('user_model');
                $this->load->model('login_model'); 
                $this->load->helper(array('url','form','verificar_pagina'))  ;
                $this->load->library(array('form_validation','session'));       
        }
        
        public function ver_couch($id = 0){
            
            $couch = $this->couch_model->traer_couch($id);
            if(($couch)&&($couch['alta'])){
                $this->load->view('ver_couch_view',$couch);
            }
            else
                $this->load->view('error_404_view');
            
        }
        
        public function buscar_couch(){
            $this->load->view('buscar_couch_view',$this->input->post());
        }
        
  }
        


?>