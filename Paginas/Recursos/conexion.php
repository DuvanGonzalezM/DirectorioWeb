<?php 
	$Servidor="localhost";
	$Usuario="root";
	$Contraseña="";	
	$Basedatos="bddirectorioweb";
	/*Hacemos la conexion*/
	$conexion=mysqli_connect($Servidor,$Usuario,$Contraseña,$Basedatos);
	/*Validamos la conexion*/
	if ($conexion) {
	}
	else{
		echo "No conecto<br>";
	}
	mysqli_set_charset($conexion,"utf8");
	error_reporting(!"Notice"); 
?>