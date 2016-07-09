<?php

    class Listado extends CI_Controller{
        
        public function __construct(){
                parent::__construct(); 
                $this->load->helper(array('url','form','verificar_pagina',))  ;
                $this->load->library(array('form_validation','session','grocery_CRUD')); 
                $this->load->database();      
                $this->load->model('admin_model');
        }
        
        public function listar()
    	{
 	    $crud= new grocery_CRUD();
		$crud->set_table('user');
        $crud->set_theme('datatables');
        $crud->set_language('spanish');
        $crud->set_subject('Usuario');
        $crud->columns('nombre','apellido','username','f_nacimiento');
        $crud->field_type('descripcion','text');
        $crud->display_as('apellido','Apellido del usuario');
        $crud->display_as('nombre','Nombre del usuario');
        $crud->display_as('username','Username');
        $crud->unset_delete();
        $crud->unset_list();
        $crud->unset_edit();
        $crud->unset_export();
        $crud->unset_print();
        $output = $crud->render();
		$this->_example_output($output);	  
    	}

       	function _example_output($output = null)
	   {
   		   $this->load->view('listado',$output);  
	   }
    
             
        
}
?>