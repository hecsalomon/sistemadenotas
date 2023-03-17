<?php
	if (isset($_GET['id'])){
		$id=intval($_GET['id']);
	} else {
		header("location:index.php");
	}
	if (isset($_GET['idmateria'])){
		$idmateria=intval($_GET['idmateria']);
	} else {
		header("location:index.php");
	}
	if (isset($_GET['nota'])){
		$nota=doubleval($_GET['nota']);
	} else {
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD con PHP usando Programación Orientada a Objetos</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Editar <b>Notas</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
				
				include ("database.php");
				$notas= new Database();
				
				if(isset($_POST) && !empty($_POST)){

					$idalumno = $notas->sanitize($_POST['idalumno']);
					// $idmateria= $notas->sanitize($_POST["idmateria"]);
					$idmateria=intval($_POST['idmateria']);
					$nota=doubleval($_POST['nota']);
					// var_dump($idalumno);
					// var_dump($idmateria);
					// var_dump($nota);
					$res = $notas->update($idalumno,$idmateria, $nota);
					if($res){
						$message= "Datos actualizados con éxito";
						$class="alert alert-success";
						
					}else{
						$message="No se pudieron actualizar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
				$datos_nota=$notas->single_record($id, $idmateria);
				// var_dump($datos_nota);
				$alumno = $datos_nota->idalumno;
				$materia = $datos_nota->idmateria;

				$mysqli = new mysqli('localhost', 'root', '', 'notas');
                        $query="SELECT * FROM talumnos WHERE idalumno=$alumno";
				        $resultado = $mysqli -> query ($query);
                        $valores = $resultado->fetch_assoc();
                        $nombres=$valores['idalumno']." ".$valores['apellidos']." ".$valores['nombres'];

						$query="SELECT * FROM tmaterias WHERE idmateria=$materia";
				        $resultado = $mysqli -> query ($query);
                        $valores = $resultado->fetch_assoc();
                        $materia=$valores['idmateria']." ".$valores['nombremateria'];
			?>
			<div class="row">
				<form method="post">
				<div class="col-md-6">
					<label>Id Alumno:</label>
					<input type="text" readonly name="idalumno" id="idalumno" class='form-control' maxlength="6"   value="<?php echo $nombres;?>">
				</div>
				<div class="col-md-6">
					<label>Id Materia:</label>
					<input type="text" readonly name="idmateria" id="idmateria" class='form-control' maxlength="6"   value="<?php echo $materia;?>">
				</div>
				<div class="col-md-6">
					<label>Nota:</label>
					<input type="number" step=0.1 name="nota" id="nota" class='form-control' maxlength="20" required value="<?php echo $datos_nota->nota;?>">
				</div>						
				<div class="col-md-12 pull-right">
					<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
				</form>
			</div>
        </div>
    </div>     
</body>
</html>                            