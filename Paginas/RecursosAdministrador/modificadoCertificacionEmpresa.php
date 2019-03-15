<?php
// Incluimos los datos de conexión y las funciones:
include 'headerAdministrador.php';
include ("datosbd.php");
include ("funciones.php");


// Verificamos la presencia de los datos esperados (deberíamos validar sus valores, aunque aquí no lo hagamos para abreviar):
if ( isset($_POST["nuevacertificacion"],$_POST["codigo"]) ){

	// Nos conectamos:
	if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){

		// Evitamos problemas con codificaciones:
		@mysqli_query($conect, "SET NAMES 'utf8'");
	
		// Traspasamos a variables locales para evitar problemas con comillas:
		$certificacion = $_POST["nuevacertificacion"];
		$codigo = $_POST["codigo"];

		$consulta = "UPDATE certificacionempresa SET certificacionempresa_estado='$certificacion' WHERE empresa_nit='$codigo'";

		if ( mysqli_query($conect, $consulta) ){
	
			echo "<fieldset><legend><h3>Registro actualizado con exito.</h3></legend></fieldset>
				";

		} else {

			echo "<fieldset><legend><h3>No se pudo actualizar</h3></legend></fieldset>";
		}
		
	} else {
	
		echo "<fieldset><legend><h3>Servicio interrumpido</h3></legend></fieldset>";

	}

} else {

	echo '<fieldset><legend><h3>No se ha indicado cuál registro desea modificar.</h3></legend></fieldset>';
}

echo '<fieldset><legend><h3>Regresar al <a href="../Administrador.php">listado</a><h3></legend></fieldset>';
?>