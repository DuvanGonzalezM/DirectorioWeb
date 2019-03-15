<?php include 'Recursos/header.php';
if ($_SESSION['rol'] <> 2) {
      header('Location: ../');
    }
?>
<?php
if (isset($_POST['Publicar'])) {
	$servicio_nom =$_POST['nom_pro'];
	$servicio_tipo=$_POST['tipo_servicio'];
	$servicio_descrip=$_POST['Descripción'];
	$servicio_precio=$_POST['precio'];
	$nit=$_SESSION['empresa_nit'];
	$MENSAJE="";
	if ($_FILES['foto']['tmp_name'][0] != "") {		
		$insertar ="INSERT into servicio  values (default,'$nit','$servicio_nom','$servicio_tipo',$servicio_precio,'$servicio_descrip',default,NOW())";
		$resultado=mysqli_query($conexion,$insertar);
		$consulta=mysqli_query($conexion,"SELECT max(servicio_cod)ultimo from servicio where empresa_nit = '$nit'");
			$eleccion = mysqli_fetch_array($consulta);				
			$ultimo = $eleccion['ultimo'];
		$CarpetaLocal='../Fotos/Empresa_'.$nit.'/Servicios/';
		mkdir($CarpetaLocal."/Servicio_".$ultimo);
		for ($i=0; $i < count($_FILES['foto']['name']); $i++) { 
			$nom_fotos = "Servicio_".($i+1).".png";
			$carp_tempo = $_FILES['foto']['tmp_name'][$i];
			$CarpetaDestino='../Fotos/Empresa_'.$nit.'/Servicios/Servicio_'.$ultimo.'/';
			$NombFotosBD .= $nom_fotos."/";
			move_uploaded_file($carp_tempo, $CarpetaDestino.$nom_fotos);
		}
		$subida_foto = mysqli_query($conexion,"update servicio set servicio_foto = '$NombFotosBD' where servicio_cod = '$ultimo'");
		if ($subida_foto){		
			header ("Location: VistaServicio.php?codigo=$ultimo");
		}
		else{
			echo $insertar;
		}
	}
	else{
		$MENSAJE = "Necesitas subir por lo menos una foto del servicio";
	}
}
?>
<section id="section">
				<span id="span_aside"><h3>Crea un nuevo servicio</h3></span>
				<form action="" method="POST" enctype="multipart/form-data">
					<fieldset><?=$MENSAJE?></fieldset>
					<fieldset>
						<legend>Nombre del servicio</legend>
							<input type="text" name="nom_pro" id="nom_servicio" 							onkeyup="this.value=NumText(this.value)"
>
							<div class="ayuda">
								<p>Escribe el nombre de la actividad realizada <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas. ejemplo: envasado de ..., maquila de ... </p>
							</div>
					</fieldset>

					<fieldset>
						<legend>Tipo servicio</legend>
							<select id="selectformulario" name="tipo_servicio" >
								<option value="Ninguno">Seleccionar...</option>
								<option value="Maquila">Maquila</option>
								<option value="Empacado">Empacado</option>
								<option value="Envasado">Envasado</option>
								<option value="Codificado">Codificado</option>
								<option value="Acondicionamiento">Acondicionamiento</option>
								<option value="Transporte">Transporte de Mercancías</option>
							</select>
							<div class="ayuda">
								<p>Intenta seleccionar el mejor <a href=#index">Tipo</a> de la lista para tu servicio, dejarla en la correcta permitirá al usuario encontrarlo de manera más fácil haz que coincida con el título.</p>
							</div>						
					</fieldset>
					<fieldset>
						<legend>Descripción del Servicio</legend>
						<textarea rows="4" cols="50" maxlength="40000" name="Descripción" 						onfocus="this.value=''">
						</textarea>
						<div class="ayuda">
								<p>Inserta una breve <a href=#index">Descripción</a> de tu servicio por ejemplo mencionar la capacidad o especialización ejemplname="foto[]" multipleo si han envasado cosmeticos o productos de limpieza debería estar descrito también.</p>
						</div>		
					</fieldset>
					<fieldset>
						<legend>Precio del servicio</legend>
							<input type="Number" name="precio"  onkeyup="this.value=Numeros(this.value)">
							<div class="ayuda">
								<p>Escríbe un precio estimado, por ejemplo el valor que cobras por llenar la camtidad de envases que en la descripcion mencionas tienes capacidad.</p>
							</div>	
					</fieldset>
					<fieldset>
						<legend>Agrega una Foto del servicio</legend>
							<input type="file" id="myFile" name="foto[]" multiple>
							<div class="ayuda">
								<p>selecciona una <a href="#index">Imagen</a> que sirva de referencia para los clientes y puedan identificar tus servicios, recomendamos usar imagen de la maquína o área donde prestes el servicio si las dispones, de preferencia que esten relacionadas al servicio que se ofrece.</p>
							</div>	
					</fieldset>
					<input type="submit" value="Guardar" alt="Publica tu producto" name="Publicar">
				</form>
			</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>

<?php
include 'Recursos/footer.php';
?>