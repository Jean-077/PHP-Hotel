<?php
//evitando que puedan ingresar a la página sin logearse
session_start();
if($_SESSION['code']!="Holamundo"){
	session_destroy();
	header("location: index.php");
}
//conectando a la base de datos
include_once 'bd/conexion.php';
try{
	bd_conectar();
}catch (Exception $e){
	die($e->getMessage());
}

//captura de los datos para el registro de habitaciones
$cod_habitacion = $_POST['cod_habitacion'];
$tipo=$_POST['tipo'];
$precio=$_POST['precio'];
$disponible=$_POST['disponible'];

if($cod_habitacion==null){
	$sql = "INSERT INTO habitacion(tipo, precio, disponible) VALUES (";
	$sql .= "'$tipo','$precio',$disponible);";
}else{
	$sql = "UPDATE habitacion SET tipo='$tipo',precio='$precio',";
	$sql .= "disponible=$disponible WHERE cod_habitacion= $cod_habitacion";
}

if($cod_habitacion==null){
	if(bd_ejecutar($sql)){
		header('location: habitaciones.php');
	}else{
		echo "ERROR";
	}	
}else{
	if(bd_ejecutar($sql)){
		//$_SESSION["code"] = "";
		//session_destroy();
		header('location: habitaciones.php');
	}else{
		echo "ERROR";
	}
}

