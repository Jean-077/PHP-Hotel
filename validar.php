<?php
$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];
session_start();

include_once 'bd/conexion.php';
$sql = "select * from empleado where cuenta ='$usuario' and contraseña=AES_ENCRYPT('$contraseña','$contraseña')";
bd_conectar();
$registro=bd_consultar($sql);


if(count($registro)==1){
	setcookie("usuario",$usuario);
	$_SESSION["code"] = "Holamundo";
	header("location: menu_principal_administrador.php");
}
else{
	session_destroy(); 
	header("location: index.php");
}