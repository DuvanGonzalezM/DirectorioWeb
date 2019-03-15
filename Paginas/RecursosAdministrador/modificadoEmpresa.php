<?php
// Incluimos los datos de conexión y las funciones:
include 'headerAdministrador.php';
include ("datosbd.php");
include ("funciones.php");


// Verificamos la presencia de los datos esperados (deberíamos validar sus valores, aunque aquí no lo hagamos para abreviar):
if ( isset($_POST["nombre"],$_POST["direccion"],$_POST["telefono"],$_POST["otrotel"],$_POST["email"],$_POST["contacto"],$_POST["pagina"],$_POST["antiguedad"],$_POST["facturacion"],$_POST["empleados"],$_POST["clave"],$_POST["foto"],$_POST["codigo"]) ){

	// Nos conectamos:
	if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){

		// Evitamos problemas con codificaciones:
		@mysqli_query($conect, "SET NAMES 'utf8'");
	
		// Traspasamos a variables locales para evitar problemas con comillas:
		$nombre = $_POST["nombre"];
		$direccion = $_POST["direccion"];
		$telefono = $_POST["telefono"];
		$otrotel = $_POST["otrotel"];
		$email = $_POST["email"];
		$contacto = $_POST["contacto"];
		$pagina = $_POST["pagina"];
		$antiguedad = $_POST["antiguedad"];
		$facturacion = $_POST["facturacion"];
		$empleados = $_POST["empleados"];
		$clave = $_POST["clave"];
		$foto = $_POST["foto"];
		$permiso = $_POST["permiso"];
		$codigo = $_POST["codigo"];

		$consulta = "UPDATE empresa SET empresa_nom='$nombre', empresa_dir='$direccion', empresa_tel1='$telefono', empresa_otros_tel='$otrotel',empresa_email='$email',empresa_nom_contac='$contacto',empresa_pagina='$pagina',empresa_antig='$antiguedad',empresa_fact_anual='$facturacion',empresa_num_empl='$empleados',empresa_contrasena='$clave',empresa_foto='$foto',empresa_permiso='$permiso' WHERE empresa_nit='$codigo'";

		if ( mysqli_query($conect, $consulta) ){
	
			echo "<fieldset><legend><h3>Registro actualizado con exito.<h3></legend></fieldset>";

		} else {

			echo "<fieldset><legend><h3>No se pudo actualizar<h3></legend></fieldset>";
		}
		
	} else {
	
		echo "<fieldset><legend><h3>Servicio interrumpido<h3></legend></fieldset>";

	}

} else {

	echo '<fieldset><legend><h3>No se ha indicado cuál registro desea modificar.<h3></legend></fieldset>';
}

echo '<fieldset><legend><h3>Regresar al <a href="../Administrador.php">listado</a><h3></legend></fieldset>';
?>