<?php
// Incluimos los datos de conexión y las funciones:
include 'headerAdministrador.php';
include ("datosbd.php");
include ("funciones.php");


// Verificamos la presencia de los datos esperados (deberíamos validar sus valores, aunque aquí no lo hagamos para abreviar):
if ( isset($_POST["nombre"],$_POST["apellido"],$_POST["documento"],$_POST["telefono"],$_POST["otrotel"],$_POST["email"],$_POST["clave"],$_POST["foto"],$_POST["codigo"]) ){

	// Nos conectamos:
	if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){

		// Evitamos problemas con codificaciones:
		@mysqli_query($conect, "SET NAMES 'utf8'");
	
		// Traspasamos a variables locales para evitar problemas con comillas:
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$documento = $_POST["documento"];
		$telefono = $_POST["telefono"];
		$otrotel = $_POST["otrotel"];
		$email = $_POST["email"];
		$clave = $_POST["clave"];
		$foto = $_POST["foto"];
		$permiso = $_POST["permiso"];
		$codigo = $_POST["codigo"];

		$consulta = "UPDATE usuario SET usuario_nom='$nombre', usuario_ape='$apellido', usuario_doc='$documento', usuario_tel1='$telefono', usuario_otros_tel='$otrotel',usuario_email='$email',usuario_contrasena='$clave',usuario_foto='$foto',usuario_permiso='$permiso' WHERE usuario_id='$codigo'";

		if ( mysqli_query($conect, $consulta) ){
	
			echo "<fieldset><legend><h3>Registro actualizado.<h3></legend></fieldset>";

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
