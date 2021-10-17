<?php
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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
	<div class="contenedor_total">
		<div class="contenedor">
			<div class="contenedor_titulo">
				<h1 class="titulo">Iniciar Sesión</h1>
			</div>
			<form class="contenedor_contenido" action="validar.php" method="POST">
				<div class="contenido_1">
					<label for="usuario">Usuario</label>
					<input type="text" id="usuario" required="" name="usuario"/>
				</div>
				<div class="contenido_2">
					<label for="contraseña">Contraseña</label>
					<input type="password" id="contraseña" required="" name="contraseña"/>
				</div>
				<button class="boton_registro" type="submit">INGRESAR</button>
			</form>
		</div>
	</div>
</body>
</html>