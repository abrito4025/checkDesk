 <?php
   

    class Usuario_Model{
        private $db;
        private $usuario;
        public function __construct(){
            $this -> db = Conectar::conexion();
            $this -> usuario = array();

        }
        public function get_usuario(){
            $sql = "SELECT * FROM usuario";
            $resultado = $this -> db -> query($sql);
            while($row = $resultado -> fetch_assoc()){
                $this -> usuario[] = $row;
            }
            return $this -> usuario;
        }
        
            
        }
?>