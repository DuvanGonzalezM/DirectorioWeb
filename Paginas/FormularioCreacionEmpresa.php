<?php
include 'Recursos/header.php'; 
if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
if (isset($_POST['Registrar'])) {
	$Nit = $_POST['empresa_nit'];
	$Nombre = $_POST['empresa_nom'];
	$Direccion 	= $_POST['empresa_dir'];
	$Telefono = $_POST['empresa_tel1'];
	$Correo = $_POST['empresa_email'];
	$Mensaje = "";
	$NombreFoto="Perfil.png";
	$TipoImagen=$_FILES['empresa_foto']['type'];
	$TamañoFoto=$_FILES['empresa_foto']['size'];
	if (!empty($_POST['empresa_nom']) && !empty($_POST['empresa_tel1']) && !empty($_POST['empresa_email']) && !empty($_POST['empresa_dir']) && !empty($_POST['empresa_nit'])){
		if ($_POST['empresa_contrasena'] == $_POST['empresa_confir_contrasena']){
			$Contraseña = $_POST['empresa_contrasena'];
			if ($TipoImagen == "image/jpeg"|| $TipoImagen == "image/jpg" || $TipoImagen == "image/png" || $TipoImagen == "image/webp"){
				if ($_FILES['empresa_foto']['size'] <= 2000000){
					$CarpetaLocal='../Fotos/';
					mkdir($CarpetaLocal."/Empresa_".$Nit);
					$CarpetaLocal2='../Fotos/Empresa_'.$Nit;
					mkdir($CarpetaLocal2."/Productos");
					mkdir($CarpetaLocal2."/Servicios");
					$CarpetaDestino='../Fotos/Empresa_'.$Nit.'/';
					move_uploaded_file($_FILES['empresa_foto']['tmp_name'], $CarpetaDestino.$NombreFoto);
					$Insertar = mysqli_query($conexion,"INSERT into empresa (empresa_nit,empresa_nom,empresa_dir,empresa_tel1,empresa_email,empresa_contrasena,empresa_foto,empresa_permiso,empresa_fecha) values ('$Nit','$Nombre','$Direccion','$Telefono','$Correo','$Contraseña','$NombreFoto',2,now())");
					if ($Insertar) {
						$_SESSION['empresa_nit'] = $Nit;
						$_SESSION['empresa_nom'] = $Nombre;
						$_SESSION['empresa_foto']= $NombreFoto;
						$_SESSION['rol'] = 2;
						header('Location: EdicionPerfil.php');
					}
					else{
						$Mensaje = "No se pudo enviar los datos";
					}
				}
				else{
					$Mensaje = "El tamaño maximo es de: 2 MegasBytes";
				}
			}
			else{
				$Mensaje = "Solo se aceptan estos formatos: jpeg - jpg - png - webp";
			}
		}
		else{
			$Mensaje = "Las contraseñas no coinciden";
		}
	}
}
?>
<!--Formulario CREACION EMPRESA-->
	
	<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
	</aside>
	<section id="section">
		<span id="span_aside"><h3>Registro de empresa</h3></span>
		<form action="" method="post" enctype="multipart/form-data">			
			<fieldset>
				<b><?=$Mensaje?></b>
			</fieldset>
			<!--NIT DE LA EMPRESA-->
			<fieldset>
				<legend>Número NIT: </legend>
				<input type="Number" name="empresa_nit" id="num_doc"  onkeyup="this.value=Numeros			(this.value)" required>
			</fieldset>
			<!--NOMBRE EMPRESA-->
			<fieldset>
				<legend>Razón social: </legend>
				<input type="text" name="empresa_nom" id="nom_usu" onkeyup="this.value=NumText			(this.value)" required>
			</fieldset>
			<!--DIRECION EMPRESA-->
			<fieldset>
				<legend>Dirección: </legend>
				<input type="text" name="empresa_dir" id="nom_usu" required>
			</fieldset>
			<!--TELEFONO EMPRESA-->
			<fieldset>
				<legend>Teléfono: </legend>
				<input type="text" name="empresa_tel1" id="tel_usu" required>
			</fieldset>
			
			<!--CORREO ELECTRONICO EMPRESA-->
			<fieldset>
			<legend>Correo Electrónico:</legend>
				<input type="email" name="empresa_email" id="correo_usu" class="emailformulario" required>
				<div class="ayuda">
					<p>Usarás estos datos cuando entres y sí alguna vez tienes que cambiar la contraseña.
					</p>
				</div>		
			</fieldset>
			
			<!--CONTRASEÑA EMPRESA-->
			<fieldset>
				<legend>Contraseña:</legend>
					<input type="password" name="empresa_contrasena" required>
					<div class="ayuda">
						<p>Introduce una combinación de al menos seis caracteres incluyendo un número, letra y signos de puntuación válidos (como ! y &).</p>
					</div>	
			</fieldset>
			<!--VERIFICAR CONTRASEÑA EMPRESA-->
			<fieldset>
				<legend>Verifica tu Contraseña:</legend>
					<input type="password" name="empresa_confir_contrasena" class="PassworFormulario" required>
					<div class="ayuda">
						<p>Debe coincidir con la ingresada anteriormente.</p>
					</div>	
			</fieldset>
			
			
			<!--FOTO EMPRESA-->
			<fieldset>
				<legend>Adjuntar una Foto:</legend>
					<input type="file" name="empresa_foto" id="myFile">
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
		<h2>¿Ya tienes una cuenta? <a href="Login.php">Ingresa aquí</a></h2>
	</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>

	<?php include 'Recursos/footer.php'; ?>