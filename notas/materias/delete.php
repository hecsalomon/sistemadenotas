<?php 
if (isset($_GET['id'])){
	include('database.php');
	$alumno = new Database();
	$id=intval($_GET['id']);
	var_dump($id);
	$res = $alumno->delete($id);
	if($res){
		header("location:index.php");
	}else{
		echo "Error al eliminar el registro";
	}
}
?>