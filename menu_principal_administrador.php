<?php
//no pueden accerder copiando el link
session_start();
if($_SESSION['code']!="Holamundo"){
	session_destroy();
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="img/jpg" href="imagenes/Logo2.jpg">
	<title>Inicio</title>
	<link rel="stylesheet" type="text/css" href="css/menu_principal.css">
	<link rel="stylesheet" type="text/css" href="css/navegacion.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
	<div class="contenedor_total">
		<nav class="contenedor_navegacion">
			<a class="nav" href="nuevo_empleado.php">Registrar Usuario</a>
			<a class="nav" href="empleados.php">Usuarios</a>
			<a class="nav" href="checkout.php">Check Out</a>
			<a class="nav" href="habitaciones.php">Habitaciones</a>
			<a class="nav" href="nueva_habitacion.php">Registrar Habitacion</a>
			<a class="nav" href="reserva.php">Nueva Reserva</a>
			<a class="nav" href="desconectar_sesion.php">Cerrar Sesión</a>
		</nav>
		<div class="contenedor_contenido">
			<h1 class="bienvenida">Bienvenido: <?= $_COOKIE['usuario'] ?></h1>
		</div>
	</div>
</body>
</html>

		