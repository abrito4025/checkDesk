<?php

class Main_model extends CI_model
{
    public function __construct(){
        $this->load->database();
    }

        public function agregarReporte($row){
		
			$asunto=$row['asunto_mantenimiento'];
			$idUsuario=$this->session->userdata['_data']['UsuarioId'];
       		$this->db->query("INSERT INTO mantenimiento(asunto,fecha,estado,idUsuario,idEquipo) values ('{$asunto}','NOW()','Pendiente','{$idUsuario}','1');");
    } 

}