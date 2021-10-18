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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="img/jpg" href="imagenes/Logo2.jpg">
	<title>Habitaciones</title>
	<link rel="stylesheet" type="text/css" href="css/empleados.css">
	<link rel="stylesheet" type="text/css" href="css/navegacion.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
	<div class="contenedor_total">
		<nav class="contenedor_navegacion">
			<a class="nav" href="menu_principal_administrador.php">Inicio</a>
			<a class="nav" href="empleados.php">Usuarios</a>
			<a class="nav" href="checkout.php">Check Out</a>
			<a class="nav" href="reserva.php">Nueva Reserva</a>
			<a class="nav" href="desconectar_sesion.php">Cerrar Sesión</a>
		</nav>
		<div class="contenedor_contenido">
			<table >
				<thead>
					<tr>
						<th class="encabezado">ID</th>
						<th class="encabezado">Tipo</th>
						<th class="encabezado">Precio</th>
						<th class="encabezado">Disponible</th>
					</tr>
				</thead>	
				<?php
				$registro = bd_consultar("SELECT * FROM habitacion");
				if(!$registro){
					?>
					<tr><th colspan="7">NO HAY VALORES DISPONIBLES</th></tr>
				<?php } else {
					foreach ($registro as $categoria) {
					?>
				<tr>
					<th><?=$categoria["cod_habitacion"]?></th>
					<th><?=$categoria["tipo"]?></th>
					<th><?=$categoria["precio"]?></th>
					<?php if($categoria["disponible"]==1){
						$disponible = "Disponible";
					}else{
						$disponible = "Ocupada";
					} ?>
					<th><?=$disponible?></th>
					<th><a href="nueva_habitacion.php?cod_habitacion=<?=$categoria["cod_habitacion"]?>" class="editar">Editar</a></th>
					<th><a href="eliminar_habitacion.php?cod_habitacion=<?=$categoria["cod_habitacion"]?>" 
						onclick="return confirm('¿seguro quieres eliminar?')" class="eliminar">Eliminar</a></th>
				</tr>
			<?php }
				}
			?>
			</table>
		</div>
		<a href="nueva_habitacion.php" class="agregar">Agregar</a>
	</div>
</body>
</html>