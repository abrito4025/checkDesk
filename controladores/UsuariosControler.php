<?php
class UsuarioControler{
    public function index(){
        require_once "modelo/UsuarioModel.php";
        $usuario = new Usuario_Model();
        $data["titulo"] = "Usuarios";
        $data ["usuario"] = $usuario -> get_usuario();
        require_once "vistas/user-list.php";
    }
}
?>