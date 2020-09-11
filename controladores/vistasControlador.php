<?php
    require_once "./modelo/vistasModelo.php";
    class vistasControlador extends vistaModelo{
        /* Controlador para la plantilla*/
        public function obtener_plantilla_controlador(){
            return require_once "./vistas/Plantilla.php";
        }
        public function obtener_vistas_contralador(){
            if(isset($_GET['views'])){
                 $ruta=explode("/",$_GET['views']);
                 $respuesta = vistaModelo::obtener_vistas_modelo($ruta[0]);
            }else{
                $respuesta="login";
            }
            return $respuesta;  
        }
    }