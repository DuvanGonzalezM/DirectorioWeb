<?php include 'Recursos/header.php';
if ($_SESSION['rol'] <> 2) {
      header('Location: ../');
    }
?>
<?php
if (isset($_POST['Publicar'])) {
	$producto_nom =$_POST['nom_pro'];
	$producto_tipo=$_POST['selectformulario'];
	$producto_descrip=$_POST['Descripción'];
	$producto_precio=$_POST['precio'];
	$muestras=$_POST['muestras'];
	$nit=$_SESSION['empresa_nit'];
	$cantidad = $_POST['cantidad'];
	$MENSAJE="";
	if ($_FILES['foto']['tmp_name'][0]!="") {		
		$insertar ="INSERT into producto  values (default,'$nit','$producto_nom','$producto_tipo','$producto_descrip',$producto_precio,default,'$cantidad','$muestras',default,NOW())";
		$resultado=mysqli_query($conexion,$insertar);
		$consulta=mysqli_query($conexion,"SELECT max(producto_cod)ultimo from producto where empresa_nit = '$nit'");
			$eleccion = mysqli_fetch_array($consulta);				
			$ultimo = $eleccion['ultimo'];
		$CarpetaLocal='../Fotos/Empresa_'.$nit.'/Productos/';
		mkdir($CarpetaLocal."/Producto_".$ultimo);
		for ($i=0; $i < count($_FILES['foto']['name']); $i++) { 
			$nom_fotos = "Producto_".($i+1).".png";
			$carp_tempo = $_FILES['foto']['tmp_name'][$i];
			$CarpetaDestino='../Fotos/Empresa_'.$nit.'/Productos/Producto_'.$ultimo.'/';
			$NombFotosBD .= $nom_fotos."/";
			move_uploaded_file($carp_tempo, $CarpetaDestino.$nom_fotos);
		}
		$subida_foto = mysqli_query($conexion,"update producto set producto_foto = '$NombFotosBD' where producto_cod = '$ultimo'");
		if ($subida_foto){		
			header ("Location: VistaProducto.php?codigo=$ultimo");
		}
		else{
			echo $insertar;
		}
	}
	else{
		$MENSAJE = "Necesitas subir por lo menos una foto del producto";
	}
}
?>
<section id="section">
				<span id="span_aside"><h3>Crea un nuevo Producto</h3></span>
				<form action="" method="Post" enctype="multipart/form-data">
					<fieldset>
					<b><?=$MENSAJE?></b>
					</fieldset>
					<fieldset>
						<legend>Nombre del producto</legend>
							<input type="text" name="nom_pro"												onkeyup="this.value=NumText(this.value)">
							<div class="ayuda">
								<p>Escribe un nombre <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas.</p>
							</div>
					</fieldset>

					<fieldset>
						<legend>Tipo producto</legend>
							<select id="selectformulario" name="selectformulario" >
								<option value="ninguno">Seleccionar...</option>
								<option value="animal">Origen Animal</option>
								<option value="vegetal">Origen Vegetal</option>
								<option value="mineral">Origen Mineral</option>
								<option value="endulzante">Endulzantes o edulcorantes</option>
								<option value="conservante">Conservantes</option>
								<option value="vitamina">Vitaminas</option>
								<option value="colorante">Colorantes</option>
								<option value="saborizante">Saborizantes</option>
								<option value="viscosante">Viscosantes</option>
								<option value="grasa">Grasas y Aceites</option>
								<option value="excipiente">Excipientes</option>
								<option value="instrumento">Instrumentos y reactivos</option>
								<option value="limpieza">Limpieza y Desinfección</option>
							</select>
							<div class="ayuda">
								<p>Intenta ubicar tu producto en la mejor <a href=#index">categoría</a>, dejarla en la correcta permitirá al usuario encontrarlo de manera más fácil.</p>
							</div>						
					</fieldset>
					<fieldset>
						<legend>Descripción del producto</legend>
						<textarea rows="4" cols="0" maxlength="40000" name="Descripción" 						onfocus="this.value=''">
						</textarea>
						<div class="ayuda">
								<p>Inserta una breve <a href=#index">Descripción</a> de tu producto por ejemplo mencionar sus aplicaciones y grados de pureza disponibles aunque también se puede dejar vacío.</p>
						</div>		
					</fieldset>
					<fieldset>
						<legend>Precio del producto</legend>
							<input type="Number" name="precio" onkeyup="this.value=NumText(this.value)">
							<div class="ayuda">
								<p>Escribe un nombre <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas.</p>
							</div>	
					</fieldset>					
					<fieldset>
						<legend>Cantidad minima</legend>
							<input type="number" name="cantidad" value="1" 							onkeyup="this.value=Numeros(this.value)">
							<div class="ayuda">
								<p>Escribe la <a href="">Cantidad minima</a> de venta, en gramos 1000 = 1kg.</p>
							</div>	
					</fieldset>
					<fieldset>
						<legend>¿Se envían muestras de este producto?</legend>
							<select id="selectformulario" name="muestras">
								<option value="si">Si</option>
								<option value="no">No</option>
							</select>
							<div class="ayuda">
								<p>Esto ayudará a tus clientes a saber si al llamar pueden solicitar una muestra del producto, antes de ir a realizar la compra.</p>
							</div>	
					</fieldset>
					<fieldset>
						<legend>Agrega una Foto del producto</legend>
							<input type="file" id="myFile" name="foto[]" multiple>
							<div class="ayuda">
								<p>Selecciona minimo una <a href="">Imagen</a> y maximo cinco <a href="">Imagenes</a> que sirvan de referencia para los clientes y puedan identificar tus productos, recomendamos usar imagenes sin logotipos de la empresa, de preferencia del tipo de producto que se vende, una(s) imagen(es) que de referencia al mismo.</p>
							</div>	
					</fieldset>
					<input class="Btn_formulario" type="submit" value="Guardar" name="Publicar" alt="Publica tu producto">
				</form>
			</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>

<?php
include 'Recursos/footer.php';
?>