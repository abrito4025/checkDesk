<?php

class Login_model extends CI_model
{
    public function __construct(){
        $this->load->database();
    }

        public function login($username,$clave){

        $query = "CALL getAcceso (?, ?)";
        $data = array('_correoUsuario' => $username, '_Clave' => $clave);
        $result = $this->db->query($query, $data);

        // $query=$this->db->query("call getAcceso('{$username}','{$clave}')");
       //  return $result->row();

        if($result->num_rows() == 1){
            $row = $result->row();

            if (isset($row->_status)) {
                $data = array("_status" => $row->_status, "_msj" => $row->_msj, "_data" => array(), "_action" => $row->_action);
                $this->session->set_userdata($data);
                return false;
            }
            else{
                $data = array("_status" => 1, "_msj" => "", "_data" => 
                array(
                    'UsuarioId' => $row->idUsuario, 
                    'usuario' => $row->email, 
                    'nombre' => $row->nombre,
                    'id' => $row->idRol, 
                    'estatus' => $row->estado
                ), "_action" => NULL);

                $this->session->set_userdata($data);
                return true;
            }
        }
        // $this->session->unset_userdata('user_data');

        return false;
    } 

    // public function login($usuario, $password){

    //     $query = "EXEC SpPermite_Seleccion_En_Superior ?, ?";
    //     $data = array('usuario' => $usuario, 'password' => md5($password));
    //     $result = $this->db->query($query, $data);
        
    //     if($result->num_rows() == 1){
    //         $row = $result->row();
    //         $data = array(
    //             'Mensaje' => $row->Mensaje,
    //             'Permitir' => $row->Permitir,
    //             'IDinscripcion' => $row->IDinscripcion,
    //             'CantidadBloqueMuestra' => $row->CantidadBloqueMuestra,
    //             'IDNaturaleza' => $row->IDNaturaleza,
    //             'IDrecinto' => $row->IDrecinto,
    //             'IDplan_Estudio' => $row->IDplan_Estudio,
    //             'Periodo' => $row->Periodo,
    //             'Matricula'=> $row->Matricula,
    //             'IDusuario'=> $row->IDusuario,
    //             'NombreEstudiante' => $row->NombreEstudiante,
    //             'NombreCarrera' => $row->NombreCarrera,
    //             'IndiceAcumulado' => $row->IndiceAcumulado,
    //             'IDperiodo' => $row->IDperiodo,
    //             'IDestudiante' => @$row->IDestudiante,
    //             'server_name' => $_SERVER['SERVER_NAME']
    //         );

    //         if ($row->Permitir == 'TRUE') {
    //             $this->session->set_userdata($data);
    //             return true;
    //         }
    //         else{
    //             $this->session->set_userdata($data);
    //             return false;
    //         }
    //     }
    //     $this->session->unset_userdata('user_data');
    //     return false;
    // }
}