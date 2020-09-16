<?php

class Main_model extends CI_model
{
    public function __construct(){
        $this->load->database();
    }

        public function agregarReporte($username,$clave){

       		$this->db->query("INSERT INTO datos_rnc(rnc,NombreEmpresa,FechaCrea,estatus) values ('{$rnc}','{$empresa}',NOW(),'ACTIVO');");
    } 

}