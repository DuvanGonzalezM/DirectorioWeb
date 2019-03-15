<?php
include 'headerAdministrador.php'; 
include("datosbd.php"); 
include("funciones.php");

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
		
		$consulta="INSERT INTO usuario VALUES ('','$nombre','$apellido','$documento','$telefono','$otrotel','$email','$clave','$foto',$permiso)";

				if($paquete=consultarbd($conect,$consulta)){

					echo "<fieldset><legend><h3>Datos correctamente insertados<h3></legend></fieldset>";					
								
				}
				else{
					echo "<fieldset><legend><h3>No se encontraron datos<h3></legend></fieldset>";
				}



		}else{
			echo "<fieldset><legend><h3>No hay conexion<h3></legend></fieldset>";
		}
	//}else{
	//	echo "<fieldset><legend><h3>No se han ingresado todos los datos<h3></legend></fieldset>";
	//}
echo '<fieldset><legend><h3>Regresar al panel <a href="../Administrador.php">administrador</a><h3></legend></fieldset>';


?>