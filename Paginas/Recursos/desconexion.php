<?php  
	/*Hacemos la desconexion*/
	$cerrar=mysqli_close($conexion);
	/*validamow la desconexion*/
	if (!$cerrar) {
		echo '<br>Aun esta conectado<br>';
	}
?>