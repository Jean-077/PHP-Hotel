<?php
include_once 'config.php';
$cnx = "";

//para conectar a la base de datos
function bd_conectar(){
	global $cnx;
	$cnx = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
	mysqli_query($cnx, "set names utf8");
	
}

//para desconectar con la base de datos
function bd_desconectar(){
	global $cnx;
	mysqli_close($cnx);
}

//para consultar los datos de una tabla
function bd_consultar($sql){
	global $cnx;
	$bolsa = mysqli_query($cnx, $sql);
	$salida = array();
	if($bolsa != null){
		while($row = mysqli_fetch_assoc($bolsa)){
			$salida[]=$row;
		}
		mysqli_free_result($bolsa);
	}else{
		$salida = false; 
	}
	unset($row);
	return $salida;
}


//para guardar datos
function bd_ejecutar($sql){
	global $cnx;
	$exito = mysqli_query($cnx, $sql);
	if(exito){
		return true;
	}else{
		return false;
	}
}