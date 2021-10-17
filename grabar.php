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

//captura de los datos para el registro de empleados
$cod_empleado = $_POST['cod_empleado'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$DNI=$_POST['DNI'];
$cargo=$_POST['cargo'];
$clave=$_POST['clave'];
$cuenta = $nombre.$apellido;

if($cod_empleado==null){
	$sql = "INSERT INTO empleado(nombre, apellido, DNI, cargo, cuenta, contraseña) VALUES (";
	$sql .= "'$nombre','$apellido','$DNI','$cargo','$cuenta',AES_ENCRYPT('$clave','$clave'));";
}else{
	$sql = "UPDATE empleado SET nombre='$nombre',apellido='$apellido',";
	$sql .= "DNI='$DNI',cargo='$cargo',cuenta='$cuenta',contraseña=AES_ENCRYPT('$clave','$clave') WHERE cod_empleado= $cod_empleado";
}

if($cod_empleado==null){
	if(bd_ejecutar($sql)){
		header('location: empleados.php');
	}else{
		echo "ERROR";
	}	
}else{
	if(bd_ejecutar($sql)){
		$_SESSION["code"] = "";
		session_destroy();
		header('location: index.php');
	}else{
		echo "ERROR";
	}
}

