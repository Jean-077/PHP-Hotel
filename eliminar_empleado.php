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


//captura de los datos para el registro de empleados
$cod_empleado = $_GET['cod_empleado'];

$sql = "DELETE FROM empleado WHERE cod_empleado = $cod_empleado";
	

if(bd_ejecutar($sql)){
	header("location: empleados.php");
}else{
	echo "ERROR";
}
