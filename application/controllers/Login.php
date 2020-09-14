<?php

class Login extends CI_controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index(){ 
		$this->form_validation->set_rules('usuario' ,'Usuario', 'required');
		$this->form_validation->set_rules('password' ,'Contraseña', 'required');

		$this->form_validation->set_message('required', 'El campo %s es requerido');

		if($this->form_validation->run() == false){
			$this->load->view('login');
		}
		else{

			$usuario = $this->input->post('usuario');
			$password = $this->input->post('password');
			$login = $this->login_model->login($usuario, $password);
			
			if ($login) {
				redirect('');
			}
			else{
				$this->load->view('login');
			}
		}
	}
	public function logout(){
     	$this->session->sess_destroy();
     	redirect('./');
   	}

}