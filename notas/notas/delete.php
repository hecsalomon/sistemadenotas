<?php 
if (isset($_GET['id'])){
	include('database.php');
	$notas = new Database();
	$id=intval($_GET['idalumno']);
	$idmateria=intval($_GET['idmateria']);
	var_dump($id);
	$res = $notas->delete($id, $idmateria);
	if($res){
		header("location:index.php");
	}else{
		echo "Error al eliminar el registro";
	}
}
?>