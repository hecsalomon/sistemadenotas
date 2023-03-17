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
                    <div class="col-sm-8"><h2>Agregar <b>Nota</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
            <?php
				include ("database.php");
				$notas= new Database();
				if(isset($_POST) && !empty($_POST)){
					$nota = $notas->sanitize($_POST['nota']);
					$idalumno = $notas->sanitize($_POST['idalumno']);
					$idmateria = $notas->sanitize($_POST['idmateria']);
					

					$res = $notas->create($idalumno, $idmateria, $nota);
					if($res){
						$message= "Datos insertados con éxito";
						$class="alert alert-success";
					}else{
						$message="No se pudieron insertar los datos";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
	
			?>
			<div class="row">
				<form method="post">
				<div class="col-md-6">
					<label>Seleccionar alumno:</label>
					<!-- <input type="number" name="idalumno" id="idalumno" class='form-control' maxlength="6" required > -->
				<select name="idalumno" type="number">
                 <option value="0">Elige:</option>
 
                <?php
				 $mysqli = new mysqli('localhost', 'root', '', 'notas');
				$query="SELECT * FROM talumnos";
				$resultado = $mysqli -> query ($query);
				// while ($valores = mysqli_fetch_array($query)) {   
					while($valores = $resultado->fetch_assoc()){
						$nombres=$valores['apellidos']." ".$valores['nombres'];
					 	echo '<option value="'.$valores['idalumno'].'">'.$nombres.'</option>';
				}
                 ?>
             	</select>
			</div>

			<div class="col-md-6">
			<label>Seleccionar materia:</label>
				<select name="idmateria" " type="number">
                 <option value="0">Elige:</option>
 
                <?php
				//  $mysqli = new mysqli('localhost', 'root', '', 'notas');
				$query="SELECT * FROM tmaterias";
				$resultado = $mysqli -> query ($query);
				// while ($valores = mysqli_fetch_array($query)) {   
					while($valores = $resultado->fetch_assoc()){
						// $nombres=$valores['apellidos']." ".$valores['nombres'];
					 	echo '<option value="'.$valores['idmateria'].'">'.$valores['nombremateria'].'</option>';
				}
                 ?>
             	</select>
			</div>
			<div class="col-md-6">
					<label>Ingresar Nota:</label>
					<input type="number" step=0.1 name="nota" id="nota" class='form-control' maxlength="4" required >
			</div>
				<div class="col-md-12 pull-right">
				<hr>
					<button type="submit" class="btn btn-success">Guardar datos</button>
				</div>	
				</form>
			</div>
        </div>
    </div>     
</body>
</html>                            