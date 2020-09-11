<?php
    const SERVER = "localhost/db_checkdesk";
    const DB ="db_checkdesk";
    const USER = "root";
    const PASS = "";
    const SGBD = "mysql:host=".SERVER.";dbname=".DB;
    const METHOD = "AES-256-CBC";
    const SECRET_KEY='checkdesk2020';
    const SECRET_IV='037970';



    //////// para conectar la DB tomado de otro video
    
    class Conectar{
        public static function conexion(){
            $conexion = new mysqli("localhost", USER, PASS, DB);
            return $conexion;
        }
    }



    ?>