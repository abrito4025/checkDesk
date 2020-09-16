<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index(){ 
		
		if (isset($this->session->userdata['_data']) && $this->session->userdata['_data']['id']==1 ) {
		
			$this->load->view('reporte-list-view');	
		}
		else{
			$this->load->view('login');
		}
	}

	function agregarReporte(){

	//	if (isset($this->session->userdata['_data']) && $this->session->userdata['_data']['id']==1 ) {
			if(isset($_POST)){
				$this->load->view('header');
				$this->load->view('menu');
				//$this->load->view('agregarreporte');	
				$this->load->view('footer');
			}else{

			}
		}
	//}

}