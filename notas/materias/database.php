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
		public function create($nombremateria){
			// $sql = "INSERT INTO 'tmaterias' (idmateria, nombremateria) VALUES ($id,'$nombremateria')";
			$sql = "INSERT INTO tmaterias (nombremateria) VALUES ('$nombremateria')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function read(){
			$sql = "SELECT * FROM tmaterias";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		
		public function single_record($id){
			$sql = 'h';
			$sql="SELECT * FROM tmaterias where idmateria='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res );
			return $return ;
		}
		public function update($idmateria,$nombremateria){
			$sql = "UPDATE tmaterias SET 
				nombremateria='$nombremateria'
			WHERE idmateria = $idmateria";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}

		public function delete($id){
			$sql = "DELETE FROM tmaterias WHERE idmateria=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
?>