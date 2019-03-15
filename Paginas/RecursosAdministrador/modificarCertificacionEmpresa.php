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

			$consulta="SELECT * FROM certificacionempresa WHERE empresa_nit="."'$codigo'";

				if($paquete=consultarbd($conect,$consulta)){

				//Aqui funcion que muestra valores					
					$resultado=editarCertificacionEmpresa($paquete);
					if($resultado==false){ /*si no hay datos en certificacion empresa los crea*/
							
						$consulta="INSERT INTO certificacionempresa VALUES (default,'$codigo','1','no certificada')";
						if($paquete=consultarbd($conect,$consulta)){

							$resultado=editarCertificacionEmpresa($paquete);
							
							echo $resultado;
							echo "No encontramos estado de certificacion para el nit ".$codigo.", hemos creado el estado (no certificado), ingrese nuevamente para cambiarlo";?>
							<br><br>
							Regresar al panel <a href="../Administrador.php">administrador</a>
						<?php	
						}		
						else{
						echo "No se encontraron datos";
						}
					}
					else 
					echo $resultado;			
				}
				else{
					echo "<p>No se encontraron datos</p>";
				}
		}else{
			echo "<p>No hay conexion</p>";
		}
	}else{
		echo "<p>No se ha indicado cual registro desea modificar</P>";
	}
?>