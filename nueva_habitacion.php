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
if(isset($_GET["cod_habitacion"])){
	$cod_habitacion = $_GET["cod_habitacion"];
	$boton = "Actualizar";
	$query = "SELECT * FROM habitacion WHERE cod_habitacion = $cod_habitacion";
	$datos = bd_consultar($query);
	@$categoria = $datos[0];
	//
	$tipoBd= $categoria["tipo"];
	$queryTipo = "SELECT DISTINCT tipo FROM habitacion WHERE tipo NOT IN ( SELECT tipo FROM habitacion WHERE tipo='$tipoBd')";
	$queryTipoTamaño = "SELECT COUNT(DISTINCT tipo) FROM habitacion WHERE tipo NOT IN ( SELECT tipo FROM habitacion WHERE tipo='$tipoBd')";
	$dataQuery= bd_consultar($queryTipo);
	$dataTamaño=bd_consultar($queryTipoTamaño);
	$dataTamañoTipo=$dataTamaño[0]["COUNT(DISTINCT tipo)"];
	//$dataQuery[0]["tipo"];
	//$tamaño= count($dataQuery);
}
$queryTipoN="SELECT DISTINCT tipo FROM habitacion";
$queryTamañoN = "SELECT COUNT(DISTINCT tipo) FROM habitacion";
$dataTipoN=bd_consultar($queryTipoN);
$dataTamañoN=bd_consultar($queryTamañoN);
$numeroTipoN=$dataTamañoN[0]["COUNT(DISTINCT tipo)"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="img/jpg" href="imagenes/Logo2.jpg">
	<title>Registro de habitación</title>
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>
<body>
	<div class="contenedor_total">
		<form class="contenedor_contenido" action="grabar_habitacion.php" method="POST">
			<!--Código de habitación-->
			<table>
				<thead>
					<h1 class="titulo"><span>Registrar Habitación</span></h1>
				</thead>
				<input type="hidden" id="cod_habitacion" required="" name="cod_habitacion" value="<?=$categoria["cod_habitacion"]?>"/>
				<!--Tipo-->
				<tr>
					<th>
						<label for="tipo">Tipo de habitación</label>
					</th>
					<th>
						<select name="tipo" id="tipo" dir="rt2">
						<?php if($tipoBd == ""){
							for( $j=0; $j< $numeroTipoN; $j++){ 
								$nombreTipo=$dataTipoN[$j]["tipo"]?>
							<option value="<?=$nombreTipo;?>">Hab. <?=$nombreTipo?>
							<?php }
						 ?>
							
						<?php }else{
							//$hola="hola".$tipoBd;
							//$hola=$tipoBd;
							?>
							<option value="<?=$tipoBd;?>">Hab. <?=$tipoBd;?> </option>
							<?php
							for( $i=0; $i< $dataTamañoTipo; $i++){ 
								$nombreTipo=$dataQuery[$i]["tipo"]?>
							<option value="<?=$nombreTipo;?>">Hab. <?=$nombreTipo?>
							<?php }
						} ?>
						</select>
					</th>
				</tr>	
				<!--Precio-->
				<tr>
					<th>
						<label for="precio">Precio</label>
					</th>
					<th>
						<input type="number" style="text-align:center;" id="precio" required="" name="precio" value="<?=$categoria["precio"]?>"/>
					</th>
				</tr>
				<!--Disponibilidad-->
				<tr>
					<th>
						<label for="disponible">Disponibilidad</label>
					</th>
					<th>
						<select name="disponible" id="disponible">
						<?php if($categoria["disponible"] ==1 || $categoria["disponible"] ==""){?>
							<option value="1">Disponible</option>
							<option value="0">No disponible</option>
						<?php }else{?>
							<option value="0">No disponible</option>
							<option value="1">Disponible</option>
						<?php } ?>
						</select>
					</th>
				</tr>			
			</table>
			<button class="agregar" type="submit"><?=$boton?></button>
			<a href="menu_principal_administrador.php" class="volver">Volver</a>
			<a href="habitaciones.php" class="registro">Lista de registros</a>
		</form>

	</div>
</body>
</html>