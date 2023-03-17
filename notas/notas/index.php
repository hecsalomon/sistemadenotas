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
                    <div class="col-sm-8"><h2>Listado de  <b>Notas</b></h2></div>
                    <div class="col-sm-4">
                        <a href="crear_nota.php" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Nota</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>                                      
                        <th style='width: 300px;'>Alumno</th>
                        <th style='width: 300px;'>Materia</th>
                        <th style='width: 100px;'>Nota</th>
                        <th style='width: 100px;'>Acciones</th>
                    </tr>
                </thead>
				<?php 
				include ('database.php');
				$notas = new Database();
				$listado=$notas->read();
				?>
                <tbody>
				<?php 
                // var_dump($notas);
                // var_dump($listado);
					while ($row=mysqli_fetch_object($listado)){
						$id=$row->idalumno;
                        $idmateria=$row->idmateria;
						$nota=$row->nota;
                        $mysqli = new mysqli('localhost', 'root', '', 'notas');
                        $query="SELECT * FROM talumnos WHERE idalumno=$id";
				        $resultado = $mysqli -> query ($query);
                        $valores = $resultado->fetch_assoc();
                        $nombres=$valores['idalumno']." ".$valores['apellidos']." ".$valores['nombres'];

                        $query="SELECT * FROM tmaterias WHERE idmateria=$idmateria";
				        $resultado = $mysqli -> query ($query);
                        $valores = $resultado->fetch_assoc();
                        $materia=$valores['idmateria']." ".$valores['nombremateria'];

				?>
					<tr>
                        <td><?php echo $nombres;?></td>
                        <td><?php echo $materia;?></td>
                        <td><?php echo $nota;?></td>
                        <td>
						    <a href="update.php?id=<?php echo $id;?>&idmateria=<?php echo $idmateria;?>&nota=<?php echo $nota;?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="delete.php?id=<?php echo $id;?>&idmateria=<?php echo $idmateria;?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>	
				<?php
					}
				?>
                </tbody>
            </table>
        </div>
    </div>     
</body>
</html>                          