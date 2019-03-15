<?php
include 'Recursos/header.php'; 
if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
if (isset($_POST['Registrar'])) {
	$Nombre = $_POST['usuario_nom'];
	$Documento = $_POST['usuario_doc'];
	$Apellido= $_POST['usuario_ape'];
	$Telefono = $_POST['usuario_tel1'];
	$Correo = $_POST['usuario_email'];	
	$NombreFoto=Null;
	$TipoImagen=$_FILES['usuario_foto']['type'];
	$TamañoFoto=$_FILES['usuario_foto']['size'];
	$Mensaje = "";
	if ($_POST['usuario_contrasena'] == $_POST['usuario_confir_contrasena']){
		$Contraseña = $_POST['usuario_contrasena'];
		if ($TipoImagen == "image/jpeg"|| $TipoImagen == "image/jpg" || $TipoImagen == "image/png" || $TipoImagen == "image/webp"){
			$Formato_imagen = ".png"; 
			if ($_FILES['usuario_foto']['size'] <= 2000000){				
				$NombreFoto="Perfil".$Formato_imagen;
			}
			else{
				$Mensaje = "El tamaño maximo es de: 2 MegasBytes";
			}
		}
		else{
			$Mensaje = "Solo se aceptan estos formatos: jpeg - jpg - png - webp";
		}
		$Insertar = mysqli_query($conexion,"INSERT into usuario (usuario_id,usuario_nom,usuario_ape,usuario_doc,usuario_tel1,usuario_email,usuario_contrasena,usuario_foto,usuario_permiso) values (default,'$Nombre','$Apellido','$Documento','$Telefono','$Correo','$Contraseña','$NombreFoto',3)");			
		if ($Insertar) {
			$consulta = mysqli_query($conexion,"SELECT usuario_id from usuario where usuario_email = '$Correo'");
		$eleccion = mysqli_fetch_array($consulta);				
		$Id = $eleccion['usuario_id'];
		$CarpetaLocal='../Fotos/';
		mkdir($CarpetaLocal."/Usuario_".$Id);
		$CarpetaDestino='../Fotos/Usuario_'.$Id.'/';
		move_uploaded_file($_FILES['usuario_foto']['tmp_name'], $CarpetaDestino.$NombreFoto);
			$_SESSION['usuario_id'] = $Id;
			$_SESSION['usuario_nom'] = $Nombre." ".$Apellido;
			$_SESSION['usuario_foto']= $NombreFoto;
			$_SESSION['rol'] = 3;
			header('Location: Perfil.php');
		}
		else{
			$Mensaje = "No se pudo enviar los datos";
		}	
	}
	else{
		$Mensaje = "Las contraseñas no coinciden";
	}
}
?>


<!--Formulario CREACION USUARIO-->
	<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
	</aside>
	<section id="section">
		<span id="span_aside"><h3>Registro de Usuario</h3></span>
		<form action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<b><?=$Mensaje?></b>
			</fieldset>
			<!--DOCUMENTO USUARIO-->
			<fieldset>
				<legend>Documento:</legend>
				<input type="number" name="usuario_doc" id="nom_usu" onkeyup="this.value=Numeros			(this.value)" required>
			</fieldset>
			<!--NOMBRE USUARIO-->
			<fieldset>
				<legend>Nombre</legend>
				<input type="text" name="usuario_nom" id="nom_usu"  onkeyup="this.value=NumText				(this.value)" required>
			</fieldset>
			<!--APELLIDO USUARIO-->
			<fieldset>
				<legend>Apellidos</legend>
				<input type="text" name="usuario_ape" id="ape_usu"  onkeyup="this.value=NumText			(this.value)" required>	
			</fieldset>
			<!--TELEFONO USUARIO-->
			<fieldset>
				<legend>Teléfono</legend>
				<input type="number" name="usuario_tel1" id="tel_usu" onkeyup="this.value=Numeros			(this.value)" required>
			</fieldset>
			<!--CORREO ELECTRONICO USUARIO-->
			<fieldset>
				<legend>Correo Electrónico</legend>
				<input type="email" name="usuario_email" id="correo_usu" class="emailformulario" required>
				<div class="ayuda">
					<p>Usarás estos datos cuando entres y sí alguna vez tienes que cambiar la contraseña.
					</p>
				</div>		
			</fieldset>
			<!--CONTRASEÑA USUARIO-->
			<fieldset>
				<legend>Contraseña</legend>
					<input type="password" name="usuario_contrasena" required>
					<div class="ayuda">
						<p>Introduce una combinación de al menos seis número, letras y signos de puntuación (como ! y &).</p>
					</div>	
			</fieldset>
			<!--VERIFICAR CONTRASEÑA USUARIO-->
			<fieldset>
				<legend>Verifica tu Contraseña</legend>
					<input type="password" name="usuario_confir_contrasena" class="PassworFormulario" required>
					<div class="ayuda">
						<p>Debe coincidir con la ingresada anteriormente.</p>
					</div>	
			</fieldset>
			<!--FOTO USUARIO-->
			<fieldset>
				<legend>Adjuntar una Foto</legend>
					<input type="file" name="usuario_foto" id="myFile">
					<div class="ayuda">
						<p>Usarás esta <a href="#index">Imagen</a> para tu perfil.</p>

					</div>	
					<label class="container"><a href="Terminos y condiciones de uso">Acepto términos y condiciones de uso</a>
					<input type="checkbox">
					<span class="checkmark"></span>
					</label>
					

			</fieldset>
			<!--BOTON DE REGISTRO-->
			<input class="Btn_formulario" type="submit" value="Registrarte" name="Registrar">
		</form>
		<h2>¿Ya tienes una cuenta? <a href="Login.php">Ingresa aquí</a><h2>
	</section>

<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>

<?php include 'Recursos/footer.php'; ?>