<?php

    class Home_Controller extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
            $this->load->database();
            $this->load->helper(array('url','verificar_pagina'));
            $this->load->library(array('form_validation','session'));    
            $this->load->model(array('couch_model'));       
        }
        
        function index (){
            if(verificar_public_user($this->session->userdata('perfil')))
                $this->load->view('home_view');
        }
        
        public function listar_couch(){
                $data=array('couchs' => $this->couch_model->traer_couchs_listado());
                $this->load->view('listado_couch_view',$data);                                
        }
        
    }
?>