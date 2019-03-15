<?php 
include 'headerAdministrador.php';;
include("datosbd.php"); 
include("funciones.php");

	if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
?>

<?php 


	if(isset($_GET["codigo"]) and $_GET["codigo"]<>""){
		$codigo=$_GET["codigo"];		

		if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){

			$consulta="SELECT * FROM empresa WHERE empresa_nit="."'$codigo'";

				if($paquete=consultarbd($conect,$consulta)){

				//Aqui funcion que muestra valores					
					$resultado=editarRegistroEmpresa($paquete);
					echo $resultado;			
				}
				else{
					echo "<fieldset><legend><h3>No se encontraron datos<h3></legend></fieldset>";
				}
		}else{
			echo "<fieldset><legend><h3>No hay conexion<h3></legend></fieldset>";
		}
	}else{
		echo "<fieldset><legend><h3>No se ha indicado cual registro desea modificar<h3></legend></fieldset>";
	}
?>