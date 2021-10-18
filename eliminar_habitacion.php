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


//captura de los datos para el registro de habitaciones
$cod_habitacion = $_GET['cod_habitacion'];

$sql = "DELETE FROM habitacion WHERE cod_habitacion = $cod_habitacion";
	

if(bd_ejecutar($sql)){
	header("location: habitaciones.php");
}else{
	echo "ERROR";
}
