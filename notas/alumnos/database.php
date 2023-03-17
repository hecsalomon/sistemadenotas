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
		public function create($apellidos,$nombres){
			// $sql = "INSERT INTO 'talumnos' (idalumno, apellidos, nombres) VALUES ($id, '$apellidos', '$nombres')";
			$sql = "INSERT INTO talumnos (apellidos, nombres) VALUES ('$apellidos', '$nombres')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function read(){
			$sql = "SELECT * FROM talumnos";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		
		public function single_record($id){
			$sql = 'h';
			$sql="SELECT * FROM talumnos where idalumno='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function update($idalumno,$apellidos, $nombres){
			$sql = "UPDATE talumnos SET 
				apellidos ='$apellidos',
				nombres='$nombres'
			WHERE idalumno = $idalumno";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM talumnos WHERE idalumno=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
?>