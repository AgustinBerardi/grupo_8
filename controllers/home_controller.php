<?php

    class Home_Controller extends CI_Controller {
        
        public function __construct(){
            parent::__construct();
            $this->load->helper(array('url','verificar_pagina'));
            $this->load->library(array('form_validation','session'));            
        }
        
        function index (){
            if(verificar_public_user($this->session->userdata('perfil')))
                $this->load->view('home_view');
        }
        
    }
?>