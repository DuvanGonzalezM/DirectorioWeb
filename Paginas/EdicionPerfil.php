<?php include 'Recursos/header.php'; ?>
<?php 
	if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    } 
?>
<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
</aside>
<?php if ($_SESSION['rol'] == 1): ?>
<?php
	$id = $_SESSION['usuario_id'];	
	$consulta = mysqli_query($conexion,"SELECT * from usuario where usuario_id = '$id'");							
	$datos = mysqli_fetch_array($consulta);
	$Nombre_completo = $datos['usuario_nom']." ".$datos['usuario_ape'];
	$Documento = $datos['usuario_doc'];
	$Telefono = $datos['usuario_tel1'];
	$Correo = $datos['usuario_email'];
	$UsuarioFoto = $datos['usuario_foto'];	
	$mensaje = "";			
			if ($_POST['enviar'] == "Modificar"){
				$Nombre = $_POST['nombre'];
				$Apellido = $_POST['apellido'];
				$Documento = $_POST['documento'];
				$Telefono = $_POST['telefono'];
				$Correo = $_POST['correo'];
				$actualizar = mysqli_query($conexion,"UPDATE usuario set usuario_nom='$Nombre',usuario_ape='$Apellido',usuario_doc='$Documento',usuario_email='$Correo',usuario_tel1='$Telefono' where usuario_id = '$id'");
				if ($actualizar) {
					header ('Location: Perfil.php');
				}
				else{
					$mensaje = "Los datos no fueron enviados";
				}
			}
?>	
	<section id="main">
      </section >
	<section id="section">
			<h1><dd> Edicion de perfil</dd></h1><br>
			<center><b><?=$mensaje?></b></center><br>
			<form action="#" method="post">
				<fieldset>
					<legend>
						Número de identificación:
					</legend>
					<input type="Number" name="documento" value="<?=$Documento?>" >
				</fieldset>
				<fieldset>
					<legend>
						Nombre:
					</legend>
					<input type="text" name="nombre" value="<?=$Nombre?>">				
				</fieldset>
				<fieldset>
					<legend>
						Apellido:
					</legend>
					<input type="text" name="apellido" value="<?=$Apellido?>"> 			
				</fieldset>
				<fieldset>
					<legend>
						Telefono:
					</legend>
					<input type="number" name="telefono" value="<?=$Telefono?>">
				</fieldset>
				<fieldset>
					<legend>
						Correo electronico:
					</legend>
					<input type="email" name="correo" value="<?=$Correo?>">
				</fieldset>
				<fieldset>
					<input type="submit" name="enviar" value="Modificar">
				</fieldset>
			</form>
		</center>
	</section>
		
<?php elseif ($_SESSION['rol'] == 2): ?>
	<section id="main">
      </section >
	<section id="section">
		<?php 
			$nit = $_SESSION['empresa_nit'];
			$consulta = mysqli_query($conexion,"SELECT * from empresa where empresa_nit = '$nit'");
			$datos = mysqli_fetch_array($consulta);
			$Direccion = $datos['empresa_dir']; 
			$Telefono = $datos['empresa_tel1'];
			$Correo = $datos['empresa_email'];
			$NomContacto = $datos['empresa_nom_contac'];
			$PaginaWeb = $datos['empresa_pagina'];
			$Antiguedad = $datos['empresa_antig'];
			$FacturaAnual = $datos['empresa_fact_anual'];
			$NumEmpleados = $datos['empresa_num_empl'];
			$EmpresaFoto = $datos['empresa_foto'];
			$mensaje = "";	
			if ($_POST['enviar'] == "Modificar" && !empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['correo']) && !empty($_POST['direccion'])){
				$Direccion = $_POST['direccion']; 
				$Telefono = $_POST['telefono'];
				$Correo = $_POST['correo'];
				$NomContacto = $_POST['contacto'];
				$PaginaWeb = $_POST['pagina'];
				$Antiguedad = $_POST['anti'];
				$FacturaAnual = $_POST['facanual'];
				$NumEmpleados = $_POST['numemple'];
				$Nombre = $_POST['nombre'];
				$actualizar = mysqli_query($conexion,"UPDATE empresa set empresa_nom = '$Nombre', empresa_dir='$Direccion',empresa_tel1='$Telefono', empresa_email='$Correo', empresa_nom_contac='$NomContacto', empresa_pagina='$PaginaWeb', empresa_antig='$Antiguedad', empresa_fact_anual='$FacturaAnual', empresa_num_empl='$NumEmpleados' where empresa_nit = '$nit'");
				if ($actualizar) {
					$_SESSION['empresa_nom'] = $Nombre;
					header ('Location: Perfil.php');
				}
				else{
					$mensaje = "Los datos no fueron enviados";
				}
			}
			else{
				$mensaje = "Los datos con <spam style='color: red;'>*</spam> son requeridos";
			}
		?>
			<center>
				<h1><dd> Edición de perfil</dd></h1><br>
				<center><b><?=$mensaje?></b></center><br>
				<form action="#" method="post">
					<fieldset>
						<legend>
							Razón social: <spam style='color: red;'>*</spam>
						</legend>
						<input type="text" name="nombre" value="<?=$Nombre?>" 											onkeyup="this.value=Mayuculas(this.value)">
					</fieldset>
					<fieldset>
						<legend>
							Correo: <spam style='color: red;'>*</spam>
						</legend>
						<input type="email" name="correo" value="<?=$Correo?>">
					</fieldset>
					<fieldset>
						<legend>
							Teléfono: <spam style='color: red;'>*</spam>
						</legend>
						<input type="number" name="telefono" value="<?=$Telefono?>" 										onkeyup="this.value=Numeros(this.value)">
					</fieldset>
					<fieldset>
						<legend>
							Persona de contacto: 
						</legend>
						<input type="text" name="contacto" value="<?=$NomContacto?>" 										onkeyup="this.value=NumText(this.value)">
					</fieldset>
					<fieldset>
						<legend>
							Dirección: <spam style='color: red;'>*</spam>
						</legend>
						<input type="text" name="direccion" value="<?=$Direccion?>">
					</fieldset>
					<fieldset>
						<legend>
							NumEmpleados: 
						</legend>
						<input type="number" name="numemple" value="<?=$NumEmpleados?>" 							onkeyup="this.value=Numeros(this.value)">
					</fieldset>
					<fieldset>
						<legend>
							Facturación anual:
						</legend>
						<input type="text" name="facanual" value="<?=$FacturaAnual?>">
					</fieldset>
					<fieldset>
						<legend>
							Antigüedad: (AÑOS)
						</legend>
						<input type="number" name="anti" value="<?=$Antiguedad?>" 					onkeyup="this.value=Numeros(this.value)">
					</fieldset>
					<fieldset>
						<legend>
							 Página Web: 
						</legend>
						<input type="text" name="pagina" value="<?=$PaginaWeb?>">
					</fieldset>					
					<fieldset>
						<input type="submit" name="enviar" value="Modificar">
					</fieldset>
				</form>
		    </center>
	</section>
<?php else: ?>
	<section id="section">
		<?php  
			$id = $_SESSION['usuario_id'];
			$consulta = mysqli_query($conexion,"SELECT * from usuario where usuario_id = '$id'");
			$datos = mysqli_fetch_array($consulta);
			$Nombre = $datos['usuario_nom'];
			$Apellido = $datos['usuario_ape'];
			$Documento = $datos['usuario_doc'];
			$Telefono = $datos['usuario_tel1'];
			$Correo = $datos['usuario_email'];
			$UsuarioFoto = $datos['usuario_foto'];
			$mensaje = "";
			if ($_POST['enviar'] == "Modificar" && !empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['apellido']) && !empty($_POST['telefono']) && !empty($_POST['documento'])){
				$Nombre = $_POST['nombre'];
				$Apellido = $_POST['apellido'];
				$Documento = $_POST['documento'];
				$Telefono = $_POST['telefono'];
				$Correo = $_POST['correo'];
				$actualizar = mysqli_query($conexion,"UPDATE usuario set usuario_nom='$Nombre',usuario_ape='$Apellido',usuario_doc='$Documento',usuario_email='$Correo',usuario_tel1='$Telefono' where usuario_id = '$id'");
				if ($actualizar) {
					$_SESSION['usuario_nom'] = $Nombre;
					header ('Location: Perfil.php');
				}
				else{
					$mensaje = "Los datos no fueron enviados";
				}
			}
			else{
				$mensaje = "Todos los datos son requeridos";
			}
		?>
			<h1><dd> Edición de perfil</dd></h1><br>
			<center><b><?=$mensaje?></b></center><br>
			<form action="#" method="post">
				<fieldset>
					<legend>
						Número de identificación: 
					</legend>
					<input type="Number" name="documento" value="<?=$Documento?>" 								 onkeyup="this.value=Numeros(this.value)">
				</fieldset>
				<fieldset>
					<legend>
						Nombre:
					</legend>
					<input type="text" name="nombre" value="<?=$Nombre?>" onkeyup="this.value=NumText					(this.value)">
				</fieldset>
				<fieldset>
					<legend>
						Apellido:
					</legend>
					<input type="text" name="apellido" value="<?=$Apellido?>" 					onkeyup="this.value=NumText(this.value)">
				</fieldset>
				<fieldset>
					<legend>
						Teléfono:
					</legend>
					<input type="number" name="telefono" value="<?=$Telefono?>" 				onkeyup="this.value=Numeros(this.value)">
				</fieldset>
				<fieldset>
					<legend>
						Correo electrónico:
					</legend>
					<input type="email" name="correo" value="<?=$Correo?>">
				</fieldset>
				<fieldset>
					<input type="submit" name="enviar" value="Modificar">
				</fieldset>
			</form>
		</center>
	</section>
<?php endif; ?>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>
<?php include 'Recursos/footer.php'; ?>