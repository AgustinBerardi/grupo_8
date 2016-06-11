<?php

    class Admin_Controller extends CI_Controller{
        
        public function __construct(){
                parent::__construct(); 
                $this->load->helper(array('url','form','verificar_pagina',))  ;
                $this->load->library(array('form_validation','session','grocery_CRUD')); 
                $this->load->database();      
                $this->load->model('admin_model');
        }
        
        public function index (){
             if(verificar_admin($this->session->userdata('perfil')))
                 $this->load->view('admin_view');
        }
        public function listar()
    	{
 	    $crud= new grocery_CRUD();
		$crud->set_table('tipo_couch');
        $crud->set_theme('datatables');
        $crud->set_language('spanish');
        $crud->set_subject('Tipo de Couch');
        $crud->columns('nombre_couch');
        $crud->display_as('nombre_couch','Nombre del tipo de couch');
        $crud->set_rules('nombre_couch','Nombre del tipo de couch','callback_verificar_nombre');
        $crud->unset_export();
        $crud->unset_print();
        $output = $crud->render();
		$this->_example_output($output);	  
    	}

       	function _example_output($output = null)
	   {
        if(verificar_admin($this->session->userdata('perfil')))
   		   $this->load->view('listado_tipo_couch_view',$output);  
	   }
    

        public function verificar_nombre($nombre){
          
               //compruebo que el tamaño del string sea válido. 
               if (strlen($nombre)<3 || strlen($nombre)>20){ 
                  $this->form_validation->set_message('verificar_nombre','No es una longitud de nombre valida');
                  return false; 
               } 
               if($this->admin_model->verificar_nombre_couch($nombre)){
                         $this->form_validation->set_message('verificar_nombre',"El nombre ya existe");
                         return false; 
               }
               return true; 
          }
             
        
}
?>