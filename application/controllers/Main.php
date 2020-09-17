<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Main_model');
		$this->load->helper('url');
	}

	public function index(){ 
		
		if (isset($this->session->userdata['_data']) &&  in_array($this->session->userdata['_data']['id'], array('2','3','1'))) {
		
			$this->load->view('header');
			$this->load->view('reporte-list-view');
			$this->load->view('footer');	
		}
		else{
			$this->load->view('login');
		}
	}

	function agregarReporte(){

		if (isset($this->session->userdata['_data']) && in_array($this->session->userdata['_data']['id'], array('3')) ) {
			if(!isset($_POST['asunto_mantenimiento'])){
				$this->load->view('header');
				$this->load->view('agregarreporte');
				$this->load->view('footer');	
			}else{ 
				$this->Main_model->agregarReporte($_POST);
				redirect('./');
			}
		}
	}

}