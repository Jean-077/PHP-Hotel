<?php
//no pueden accerder copiando el link
session_start();
if($_SESSION['code']!="Holamundo"){
	session_destroy();
	header("location: index.php");
}
//conexión a la base de datos
include_once 'bd/conexion.php';
try{
	bd_conectar();
}catch (Exception $e){
	die($e->getMessage());
}

//condicional para la actualización de datos
$boton = "Agregar";
$categoria = null;
if(isset($_GET["cod_empleado"])){
	$cod_empleado = $_GET["cod_empleado"];
	$boton = "Actualizar";
	$query = "SELECT * FROM empleado WHERE cod_empleado = $cod_empleado";
	$datos = bd_consultar($query);
	$categoria = $datos[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="img/jpg" href="imagenes/Logo2.jpg">
	<title>Registro de empleado</title>
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>
<body>
	<div class="contenedor_total">
		<form class="contenedor_contenido" action="grabar.php" method="POST">
			<!--Código de empleado-->
			<table>
				<thead>
					<h1 class="titulo"><span>Registrar Usuario</span></h1>
				</thead>
				<input type="hidden" id="nombre" required="" name="cod_empleado" value="<?=$categoria["cod_empleado"]?>"/>
				<!--Nombre-->
				<tr>
					<th>
						<label for="nombre">Nombre</label>
					</th>
					<th>
						<input type="text" id="nombre" required="" name="nombre" value="<?=$categoria["nombre"]?>"/>
					</th>
				</tr>
				<!--Apellido-->
				<tr>
					<th>
						<label for="apellido">Apellido</label>
					</th>
					<th>
						<input type="text" id="apellido" required="" name="apellido" value="<?=$categoria["apellido"]?>"/>
					</th>
				</tr>
				<!--DNI-->
				<tr>
					<th>
						<label for="DNI">DNI</label>
					</th>
					<th>
						<input type="text" id="DNI" required="" name="DNI" value="<?=$categoria["DNI"]?>"/>
					</th>
				</tr>
				<!--Cargo-->
				<tr>
					<th>
						<label for="cargo">Cargo</label>
					</th>
					<th>
						<select name="cargo" id="cargo">
							<option value="administrador">administrador</option>
							<option value="recepcionista">recepcionista</option>
						</select>
					</th>
				</tr>
				<!--Contraseña-->
				<tr>
					<th>
						<label for="clave">Contraseña</label>
					</th>
					<th>
						<input type="text" id="clave" required="" name="clave" />
					</th>
				</tr>				
			</table>
			<button class="agregar" type="submit"><?=$boton?></button>
			<a href="menu_principal_administrador.php" class="volver">Volver</a>
			<a href="empleados.php" class="registro">Registro</a>
		</form>

	</div>
</body>
</html>