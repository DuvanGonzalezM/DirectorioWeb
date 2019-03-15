<?php
include 'headerAdministrador.php';
include ("datosbd.php");
include ("funciones.php");

//verificamos la presencia del codigo esperado
	if(isset($_GET["codigo"]) and $_GET["codigo"]<>""){
		//Nos conectamos
		if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){
			/*Traspasamos a una variable local para no tener problemas con las comillas*/
			$codigo=$_GET["codigo"];
			//echo $codigo;	


			$consulta="DELETE FROM pqrempresa WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de pqrempresa eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM telsempresa WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de telsempresa eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM certificacionempresa WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de certificacionempresa eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM consulta_empresa_producto WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de agendaconsultas eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM consulta_empresa_servicio WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de agendaconsultas eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM valoracionproducto WHERE producto_cod IN (select producto_cod FROM producto where empresa_nit="."'$codigo')";

			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de valoracionproducto eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM valoracionservicio WHERE servicio_cod IN (select servicio_cod FROM servicio where empresa_nit="."'$codigo')";	
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de valoracionservicio eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM producto WHERE (empresa_nit="."'$codigo')";	
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de producto eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}
			$consulta="DELETE FROM servicio WHERE (empresa_nit="."'$codigo')";
			if(mysqli_query($conect,$consulta)){
			//	echo "<p>Registro de servicio eliminado correctamente</p>";
			}else{
				echo "<p>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas</p>";
			}

			$consulta="DELETE FROM empresa WHERE (empresa_nit="."'$codigo')";

			



			if(mysqli_query($conect,$consulta)){
				echo "<fieldset><legend><h3>Registro de empresa eliminado correctamente<h3></legend></fieldset>";
			}else{
				echo "<fieldset><legend><h3>No se pudo eliminar registro, es posible que el registro esté asociado a otras tablas<h3></legend></fieldset>";
			}
		}else{
			echo "<fieldset><legend><h3>Conexion interrumpida<h3></legend></fieldset>";
		}
	}else{
		echo '<fieldset><legend><h3>No se ha especificado cual registro eliminar<h3></legend></fieldset>';
	}
	echo '<fieldset><legend><h3>Regresar al <a href="../Administrador.php">listado</a><h3></legend></fieldset>';
/*
		
*/
?>
