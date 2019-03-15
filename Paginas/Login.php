<?php include 'Recursos/header.php'; ?>
<?php 
	if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
    $message = '';
	if (!empty($_POST['correo']) && !empty($_POST['contraseña']) && $_POST['Ingresar']){
		$correo = $_POST['correo'];
		$consulta1 = mysqli_query($conexion,"SELECT usuario_permiso from usuario where usuario_email = '$correo'");
		$eleccion1 = mysqli_fetch_array($consulta1);
		$consulta2 = mysqli_query($conexion,"SELECT empresa_permiso from empresa where empresa_email = '$correo'");
		$eleccion2 = mysqli_fetch_array($consulta2);
		if ($eleccion1['usuario_permiso'] == 3 || $eleccion1['usuario_permiso'] == 1) {
			$consulta3 =mysqli_query($conexion,"SELECT usuario_id, usuario_nom,usuario_contrasena,usuario_foto from usuario where usuario_email = '$correo'");
			$logeo = mysqli_fetch_array($consulta3);
			if ((count($logeo) > 0) && ($_POST['contraseña'] == $logeo['usuario_contrasena'])) {
				$_SESSION['usuario_id'] = $logeo['usuario_id'];
				$_SESSION['usuario_nom'] = $logeo['usuario_nom'];
				$_SESSION['usuario_foto']= $logeo['usuario_foto'];
				$_SESSION['rol'] = $eleccion1['usuario_permiso'];
				
				header('Location: ../');
			}
			else{
				$message = "La contraseña es incorrecta";
			}	
		}elseif ($eleccion2['empresa_permiso'] == 2) {
			$consulta3 =mysqli_query($conexion,"select empresa_nit, empresa_nom,empresa_contrasena,empresa_email,empresa_foto from empresa where empresa_email = '$correo'");
			$logeo = mysqli_fetch_array($consulta3);
			if ((count($logeo) > 0) && ($_POST['contraseña'] == $logeo['empresa_contrasena'])) {
				$_SESSION['empresa_nit'] = $logeo['empresa_nit'];
				$_SESSION['empresa_nom'] = $logeo['empresa_nom'];
				$_SESSION['empresa_foto']= $logeo['empresa_foto'];
				$_SESSION['rol'] = $eleccion2['empresa_permiso'];
				header('Location: ../');
			}
			else{
				$message = "La contraseña Ingresada es incorrecta";
			}
		}
		else{
			$message = "El usuario Ingresado no existe";
		}	
	}
	else{
		$message = "Algún campo está vacio";
	}
?>
<?php header("Content-type: text/html; charset=utf8"); ?>
	<section>
		<div class="insidelogin">
	<article class="login">
				<span id="span_aside"><h3>Ingresa</h3></span>
					<form class="legendlogin" action="Login.php" method="post">
						<?php if (!empty($message) && $_POST['Ingresar']): ?>
					        <p><?=  $message ?></p>
					    <?php endif; ?>
						<fieldset >
							<legend >Correo</legend>
								<input class="inputlog" type="text" name="correo" id="nom_pro" required="">
								<div class="ayuda">
									<p>Escribe tu email con el que te registraste, si no lo recuerdas ingresa a <a href="RecuperarNombreUsuario.php">Recordar mi nombre de usuario.</a> </p>
								</div>
						</fieldset>
						<fieldset >
							<legend >Contraseña</legend>
							<input class="inputlog" type="password" name="contraseña" id="nom_pro" required="">
							<div class="ayuda">
									<p>Ingresa la contraseña con la cual te registraste, si no la recuerdas ingresa a <a href="RecuperarContraseña.php">Recuperar contraseña</a></p>
							</div>		
						</fieldset>
						<input type="submit" name="Ingresar" value="Ingresar">
					</form>
			</article>
		</div>
	</section>
	<section class="loginfondo">
<!-- Inicia Slider -->
		<!--Sheet Slider-->
		<div class="sheetSlider sh-default sh-auto">
		   <input id="s1" type="radio" name="slide1" checked/> 
		   <input id="s2" type="radio" name="slide1"/> 
		   <input id="s3" type="radio" name="slide1"/> 
		   <input id="s4" type="radio" name="slide1"/> 
		   <input id="s5" type="radio" name="slide1"/> 
		   <div class="sh__content">
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="../img/slider/slide01.jpg" alt="imgText"/>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="../img/slider/slide02.jpg" alt="imgText"/>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="../img/slider/slide03.jpg" alt="imgText"/>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="../img/slider/slide04.jpg" alt="imgText"/>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="../img/slider/slide05.jpg" alt="imgText"/>
		      </div>
		   </div><!-- .sh__content -->
		</div>
	</section>
<?php include 'Recursos/footer.php'; ?>