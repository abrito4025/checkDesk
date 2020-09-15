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
		
		if ($this->session->userdata['_data']['id']==1 ) {


			$data['datos'] = "1111";
			
			$this->load->view('reporte-list-view');
			
		}
		else{
			$this->load->view('login');
		}
	}

}