<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->library('grocery_CRUD');
		$this->load->database();
		$this->load->helper('url');
		/* ------------------ */

	}

	public function index()
	{
	}

	public function listar()
	{
		$this->grocery_crud->set_table('tipo_couch');
        $this->grocery_crud->set_language('spanish');
		$output = $this->grocery_crud->render();
        $output->set_subject('Tipo de Couch');
        $output->columns('nombre');
        $crud->display_as('nombre','Nombre de tipo couch');

		$this->_example_output($output);	  
	}

	function _example_output($output = null)

	{
        
		$this->load->view('tipo_view.php',$output);  
	}
}

?>