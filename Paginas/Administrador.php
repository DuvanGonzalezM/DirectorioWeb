<?php 
include 'Recursos/header.php';
include("RecursosAdministrador/datosbd.php"); 
include("RecursosAdministrador/funciones.php");
	if ($_SESSION['rol'] <> 1) {
      header('Location: ../');
    }
?>

<section id="Administrador">
	<article>
	<h3>Panel Administrador</h3>
		<form action="Administrador.php" method="post">
			<fieldset>
				<select id="span_aside" name="opcion">
					<option id="span_aside"  value="1">Modificar datos de usuarios</option>
					<option id="span_aside" value="2">Modificar datos de empresas y certificaciones</option>
					<option id="span_aside" value="3">Lista de empresas y sus certificaciones</option>	
				</select>					
			
				<input id="Btn_filtrado_form" type="submit" name="gestion" value="Gestionar">
				</fieldset>
		</form>

<?php
	$opcion=$_POST["opcion"];
//	echo $opcion;
?>	

<?php
	switch ($opcion) {
		case 1:
				?>
					<span><a href="RecursosAdministrador/formIngresarUsuario.php">Ingresar Usuario nuevo</a></span>
				<?php
			if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){
				$consulta="SELECT * FROM usuario WHERE usuario_permiso != 1";

				if($paquete=consultarbd($conect,$consulta)){
					
					$codigoTabla=tabularUsuario($paquete);
					echo $codigoTabla;
					

				}else{
					echo "<p>No se encontraron los datos</p>";
				}
			}else{
				echo "<p>Servicio interrumpido</p>";
			}
			break;

		case 2:
			?>
				<td><a href="RecursosAdministrador/formIngresarEmpresa.php">Ingresar nueva Empresa</a></td><br><br>
			<?php
			if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){
				$consulta="SELECT * FROM empresa";

				if($paquete=consultarbd($conect,$consulta)){
					
					$codigoTabla=tabularEmpresa($paquete);
					echo $codigoTabla;					

				}else{
					echo "<p>No se encontraron los datos</p>";
				}
			}else{
				echo "<p>Servicio interrumpido</p>";
			}
			break;
		case 3:
		?>
		<section id="section">
			<div><span>1=Certificada   2=En trámite   3=No certificada</span></div>
		<?php
			if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){
				$consulta="SELECT * FROM certificacionempresa ORDER BY empresa_nit";

				if($paquete=consultarbd($conect,$consulta)){
					
					$codigoTabla=tabularCertificacionEmpresa($paquete);
					echo $codigoTabla;
					
				}else{
					echo "<p>No se encontraron los datos</p>";
				}
			}else{
				echo "<p>Servicio interrumpido</p>";
			}
			break;
		?>	
		</section>
		<?php	
		case 4:
			echo $opcion."opcion4";
			break;			
		
		default:
			echo "Escoja una opción válida";
			break;
	}

?>		

	</article>
</section>
<?php
include 'Recursos/footer.php';
?>