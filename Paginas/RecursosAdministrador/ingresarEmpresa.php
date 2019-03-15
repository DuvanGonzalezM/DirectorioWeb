<?php 
include("datosbd.php"); 
include("funciones.php");

if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){

		// Evitamos problemas con codificaciones:
		@mysqli_query($conect, "SET NAMES 'utf8'");
	
		// Traspasamos a variables locales para evitar problemas con comillas:
		$nit = $_POST["nit"];
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
		
		$consulta="INSERT INTO empresa VALUES ('$nit','$nombre','$direccion','$telefono','$otrotel','$email','$contacto','$pagina','$antiguedad','$facturacion','$empleados','$clave','$foto',$permiso)";

				if($paquete=consultarbd($conect,$consulta)){

					echo "<p>Datos correctamente insertados</p>";					
								
				}
				else{
					echo "<p>No se encontraron datos</p>";
				}



		}else{
			echo "<p>No hay conexion</p>";
		}
	//}else{
	//	echo "<p>No se han ingresado todos los datos</P>";
	//}
echo '<p>Regresar al panel <a href="../Administrador.php">administrador</a></p>';


?>