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
		//var_dump($this->session->server_name);exit();
		if (isset($this->session) && $this->session->Permitir == "TRUE" /*&& $this->session->server_name == 'orbi.net.do'*/) {
			$inscripcion = new Inscripcion_model();
			$data['titulo'] = 'Solicitud de materias';
			$archivo = "archives/".$this->session->Matricula.".json";

			// escritura de archivo
			if (file_exists($archivo)) {
				// el tiempo esta en escala de 100 pos minuto
				if (time() - filemtime($archivo) > 0) {
					unlink($archivo);
					file_put_contents($archivo,json_encode($inscripcion->seleccionar($this->session->IDNaturaleza, $this->session->IDrecinto, $this->session->IDplan_Estudio, $this->session->IDperiodo, $this->session->Matricula, $this->session->CantidadBloqueMuestra)));
				}
			}
			else{//var_dump($archivo);exit();
				file_put_contents($archivo,json_encode($inscripcion->seleccionar($this->session->IDNaturaleza, $this->session->IDrecinto, $this->session->IDplan_Estudio, $this->session->IDperiodo, $this->session->Matricula, $this->session->CantidadBloqueMuestra)));
			}

			$data['datos'] = json_decode(file_get_contents($archivo), true);
			$this->load->view('templates/header', $data);
			$this->load->view('inscripcion');
			$this->load->view('templates/footer');
		}
		else{
			$this->load->view('login');
		}
	}

// 	public function inscripcion(){
// 		if (isset($this->session) && $this->session->Permitir == "TRUE" /*&& $this->session->server_name == 'orbi.net.do'*/) {
// 			$inscripcion = new Inscripcion_model();
// 			$IDgrupo = desencriptarID($this->input->post('IDgrupo'));
// 			$IDgrupo = (int)$IDgrupo;
// 			$data['data'] = $inscripcion->inscripcion($this->session->IDusuario, $IDgrupo, $this->session->IDperiodo, $this->session->IDusuario, $this->session->IDplan_Estudio);


// // if (isset($_GET['edit'])) {
// // 	$key = array_search('33616', array_column($data['datos'], 'IDgrupo'));
// // 				// $key = array_search('100', array_column($userdb, 'uid'));
// // 	print_r($data['datos'][$key]);

// // 				// var_dump($key);
// // 	exit;
// // }

// // var_dump($data['data']);
// // var_dump($data['data'][0]['Insertado']);
// // exit;

// 			echo(json_encode($data['data']));
// 		}
// 		else{
// 			$data['data'] = array(array('Insertado' => 'FALSE', 'Mensaje' => 'Es obligatorio iniciar sesión', 'CantidadInscritos' => 0));
// 			echo(json_encode($data['data']));
// 			$this->session->set_flashdata('note', $data);
// 			redirect(base_url('logout'),'refresh');
// 		}
// 	}

// 	public function resumen(){
// 		if (isset($this->session) && $this->session->Permitir == "TRUE" /*&& $this->session->server_name == 'orbi.net.do'*/) {
// 			$inscripcion = new Inscripcion_model();

// 			$data['titulo'] = 'Resumen de Inscripción';
// 			$data['datos'] = $inscripcion->resumen($this->session->IDusuario, $this->session->IDNaturaleza, $this->session->IDperiodo);

// 			$this->load->view('templates/header', $data);
// 			$this->load->view('resumen');
// 			$this->load->view('templates/footer');
// 		}
// 		else{
// 			redirect('login');
// 		}
// 	}

	// function seleccionarCorrequisito(){
	// 	if (isset($this->session) && $this->session->Permitir == "TRUE" && $this->session->server_name == 'orbi.net.do') {
	// 		$inscripcion = new Inscripcion_model();

	// 		$idMateria = desencriptarID($this->input->post('idMateria'));
	// 		$idMateria = (int)$idMateria;

	// 		$data = $inscripcion->seleccionar($this->session->IDNaturaleza, $this->session->IDrecinto, $this->session->IDplan_Estudio, $this->session->IDperiodo, $this->session->Matricula, $this->session->CantidadBloqueMuestra, $idMateria);
	// 		$contenedor = "";
	// 		if ($data) {
	// 			$lunes = "";
	// 			$martes = "";
	// 			$miercoles = "";
	// 			$jueves = "";
	// 			$viernes = "";
	// 			$sabado = "";
	// 			$domingo = "";
	// 			$checked = "";

	// 			foreach($data as $key){
	// 				$IDgrupo = encriptarID($key['IDgrupo']);
	// 				$checked = ($key['Estatus'] && $key['Estatus'] != 'B' ) ? 'checked': '';
	// 				$domingo = ($key['Domingo']) ? "<b>Domingo</b><br>".$key['Domingo']: "";
	// 				$lunes = ($key['Lunes']) ? "<b>Lunes</b><br>".$key['Lunes']: "";
	// 				$martes = ($key['Martes']) ? "<b>Martes</b><br>".$key['Martes']: "";
	// 				$miercoles = ($key['Miercoles']) ? "<b>Miércoles</b><br>".$key['Miercoles']: "";
	// 				$jueves = ($key['Jueves']) ? "<b>Jueves</b><br>".$key['Jueves']: "";;
	// 				$viernes = ($key['Viernes']) ? "<b>Viernes</b><br>".$key['Viernes']: "";
	// 				$sabado = ($key['Sabado']) ? "<b>Sábado</b><br>".$key['Sabado']: "";
	// 				$cupo = ($key['Inscritos'] >= $key['Cupo']) ? "class='class-full'": ""; 
	// 				$contenedor.= "
	// 				<tr ".$cupo.">
	// 				<th scope='row'>
	// 				<input 
	// 				type='checkbox' 
	// 				name='MateriaCo[]' 
	// 				id='co".$IDgrupo."' 
	// 				nombre='co".$key['CodMat']."' 
	// 				value='".$IDgrupo."' 
	// 				".$checked."
	// 				/>
	// 				</th>
	// 				<td scope='row'>".$key['Credito']."</td>
	// 				<td scope='row'><label for='co".$IDgrupo."' class='label'>".$key['Materia']." - (".$key['Grupo'].")</label></td>
	// 				<td scope='row'>".$key['Modalidad']."</td>
	// 				<td scope='row'><span class='inscritos' id='ins".$IDgrupo."'>".$key['Inscritos']."</span>/".$key['Cupo']."</td>
	// 				<td scope='row'>$domingo</td>
	// 				<td scope='row'>$lunes</td>
	// 				<td scope='row'>$martes</td>
	// 				<td scope='row'>$miercoles</td>
	// 				<td scope='row'>$jueves</td>
	// 				<td scope='row'>$viernes</td>
	// 				<td scope='row'>$sabado</td>
	// 				</tr>
	// 				";
	// 			} 

	// 		}
	// 		else{
	// 			$contenedor = "<tr><th scope='row' colspan='12'>Materia no disponible para usted</td></tr>";
	// 		}
	// 		echo json_encode($contenedor);
	// 	}	
	// }

	// public function inscripcionCorrequisito(){

	// 	if (isset($this->session) && $this->session->Permitir == "TRUE" /*&& $this->session->server_name == 'orbi.net.do'*/) {
	// 		$inscripcion = new Inscripcion_model();

	// 		if (isset($_POST['MateriaCo'])) {
	// 			$data['idCorrequisitos'] = $_POST['MateriaCo'];
	// 			$v_correquisito = $this->validarCorrequisito($_POST['MateriaCo']); 

	// 			if( isset($v_correquisito) && $v_correquisito['data'][0]['Insertado']=='FALSE'){
	// 				echo (json_encode($v_correquisito)); 
	// 				exit;
	// 			}
	// 		}
	// 		else{
	// 			$IDgrupo = desencriptarID($this->input->post('IDgrupo'));
	// 			$data['idCorrequisitos'] = (int)$IDgrupo;
	// 		}

	// 		$data['data'] = $inscripcion->inscripcionCorrequisito($this->session->IDusuario, $data['idCorrequisitos'], $this->session->IDperiodo, $this->session->IDusuario, $this->session->IDplan_Estudio);

	// 		echo (json_encode($data));
	// 	}
	// 	else{
	// 		$data['data'] = array(array('Insertado' => 'FALSE', 'Mensaje' => 'Es obligatorio iniciar sesión', 'CantidadInscritos' => 0));
	// 		echo(json_encode($data['data']));
	// 		$this->session->set_flashdata('note', $data);
	// 		redirect(base_url('logout'),'refresh');
	// 	}
	// }

	// function validarCorrequisito($idGrupos){ 

	// 	$inscripcion = new Inscripcion_model();
	// 	foreach ($idGrupos as $idGrupo) {

	// 		$idGrupo = (int)desencriptarID($idGrupo);

	// 		$data['data'] = $inscripcion->validarCorrequisito($this->session->IDusuario, $idGrupo, count($idGrupos), $this->session->IDperiodo, $this->session->IDplan_Estudio);
	// 	}
	// 	return $data;	
	// }
}