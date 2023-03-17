<?php
	/*-------------------------
	Autor: Salomon Aquino
	Mail: salomonaquino77@gmail.com
	---------------------------*/
	class Database{
		private $con;
		private $dbhost="localhost";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="notas";
		
		function __construct(){
			$this->connect_db();
		}
		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}
		
		public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
		public function create($idalumno,$idmateria,$nota){
			$alumno=intval($idalumno);
			$materia =intval($idmateria);
			$calificacion=doubleval($nota);

			$sql = "INSERT INTO tnotas (idalumno, idmateria, nota) VALUES ($alumno, $materia, $calificacion)";

			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function read(){
			$sql = "SELECT * FROM tnotas";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		
		public function single_record($id,$idmateria){
			$alumno=intval($id);
			$materia=intval($idmateria);
			$sql="SELECT * FROM tnotas where idalumno= $alumno and idmateria=$materia";
			// var_dump($sql);
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function update($idalumno,$idmateria, $nota){
			$alumno=intval($idalumno);
			$materia =intval($idmateria);
			$calificacion=doubleval($nota);
			$sql = "UPDATE tnotas SET 
				nota = $calificacion
			WHERE idalumno = $alumno and idmateria = $materia";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id,$idmateria){
			$alumno=intval($id);
			$materia =intval($idmateria);
			$sql = "DELETE FROM tnotas WHERE idalumno=$alumno and idmateria=$materia";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
?>