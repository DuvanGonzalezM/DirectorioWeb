<?php
include 'Recursos/header.php';
	$codigo=$_GET['codigo'];
 	$consulta="SELECT producto.producto_nom 'nombre', producto.producto_foto 'foto', producto.producto_stock 'stock', producto.producto_envia_muestras 'muestras', producto.producto_descrip 'descripcion', producto.producto_precio 'precio', producto.product_cant_min_venta 'cantidad', producto.producto_tipo 'tipo', producto.producto_foto,empresa.empresa_nom 'empresa_nom', producto.empresa_nit 'nit' FROM producto INNER JOIN empresa ON empresa.empresa_nit=producto.empresa_nit WHERE empresa.empresa_nit like '".$_SESSION['empresa_nit']."' and producto.producto_cod like '".$codigo."'"; 
					$xyz=mysqli_query($conexion, $consulta);
					$res=mysqli_fetch_array($xyz);
					if (isset($_POST['Enviar'])){
  					$actualizar = mysqli_query($conexion,"UPDATE producto set producto_nom = '".$_POST['nom_pro']."', producto_stock = '".$_POST['select2']."', producto_envia_muestras = '".$_POST['selectmuestras']."', producto_descrip = '".$_POST['descripcion']."', producto_precio = '".$_POST['precio']."', product_cant_min_venta = '".$_POST['cantidad']."', producto_tipo = '".$_POST['selectformulario']."' WHERE empresa_nit like '".$_SESSION["empresa_nit"]."' and producto_cod like '".$codigo."'");
						if ($actualizar) {
							header ('Location: VistaInternaProducto.php');
						}
						else{
							$mensaje = "Los datos no fueron enviados";
						}	
					}		
if ($_SESSION['rol'] <> 2) {
      header('Location: VistaInternaProducto.php');
    }
?>
<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
</aside>
<?php if($_GET['edicion']):?>
	<?php		
		$codigo=$_GET['edicion'];
		$xyz=mysqli_query($conexion, "SELECT producto.empresa_nit 'nit' FROM producto WHERE producto.producto_cod like '".$codigo."'");
		$res=mysqli_fetch_array($xyz);
		if ($_SESSION['rol'] <> 2 || $res['nit'] <> $_SESSION['empresa_nit']) {
			header('Location: VistaInternaProducto.php');
		}
		else{
			$nit=$_SESSION['empresa_nit'];	
			$ruta = "../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo;
			if (!file_exists($ruta)) {
				mkdir($ruta);
			}
		}
	?>
	<section id="Modificar_foto"><!--Modificar_foto-->
	</section>
	<section id="section">
		<div id="cajon_fotos">
		<?php			
			$array_cantidad=scandir($ruta);
			$cantidad_array=count($array_cantidad);
			$cantidad_definitiva=$cantidad_array-2;	
			if(!empty($_POST['cerrar'])){
				function Eliminar_foto(){
					$codigo=$_GET['edicion'];
					$nit=$_SESSION['empresa_nit'];
					$ruta = '../Fotos/Empresa_'.$nit.'/Productos/Producto_'.$codigo.'/';
					$opcion=$_POST['cerrar'];			
					$foto = $ruta."Producto_".$opcion.".png";
					$eliminar = unlink($foto);	
					return header("Location: EdicionProducto.php?edicion=$codigo");
				}
				echo Eliminar_foto();
			}
			if ($cantidad_definitiva != 0) {
				for ($i=0; $i <= 5; $i++) { 
					$foto = $ruta."/Producto_".($i+1).".png";	
					if (file_exists($foto)) {
		?>	
			<div class="foto1">
				<form action="" method="post">
					<input type="submit" id="cerrar<?=$i+1?>" onclick="Eliminar_foto()" name="cerrar" value="<?=$i+1?>">					
					<label id="cerrar" title="Elimiar" for="cerrar<?=$i+1?>"></label>
				</form>
				<img src="<?=$foto?>" class="foto">
			</div>
		<?php 		}else{
						if (!is_null($_POST['guardar'])) {
							$CarpetaDestino='../Fotos/Empresa_'.$nit.'/Productos/Producto_'.$codigo.'/';
							if(move_uploaded_file($_FILES['nuevafoto']['tmp_name'],$CarpetaDestino."Producto_".($i+1).".png")){
								header("Location: EdicionProducto.php?edicion=$codigo");
							}
						}
					}
				}
			}
			else{
				if (!is_null($_POST['guardar'])) {
							$CarpetaDestino='../Fotos/Empresa_'.$nit.'/Productos/Producto_'.$codigo.'/';
							if(move_uploaded_file($_FILES['nuevafoto']['tmp_name'],$CarpetaDestino."Producto_".($i+1).".png")){
								header("Location: EdicionProducto.php?edicion=$codigo");
							}
						}
		?>
			<div class="foto1">
				<img src="../img/logo_de_producto.png" class="foto">
			</div>

		<?php
			}
			if($cantidad_definitiva<5){
		?>			
			<div class="foto2">
				<input type="button" id="modificar_foto" onclick="Cambio_foto()" style="display: none;">
				<label  for="modificar_foto" title="Cambiar foto">
				</label>
			</div>
		<?php
			}
		?>
		</div>
	</section>
<?php else:?>
			<section id="section">
				<dd><a href="?edicion=<?=$codigo?>">Editar fotos</a></dd>
				<span id="span_aside"><h3>Edita tus productos</h3></span>
				<form action="" method="Post">
					<fieldset>
						<legend>Nombre del producto</legend>
							<input type="text" name="nom_pro" value="<?=$res['nombre']?>" 									onkeyup="this.value=NumText(this.value)">
							<div class="ayuda">
								<p>Escribe un nombre <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas.</p>
							</div>
					</fieldset>

					<fieldset>
						<legend>Tipo producto</legend>
							<select id="selectformulario" name="selectformulario" >
								<option value="<?=$res['tipo']?>"><?=$res['tipo']?></option>
								<option value="Animal">Origen Animal</option>								
								<option value="Vegetal">Origen Vegetal</option>
								<option value="Mineral">Origen Mineral</option>
								<option value="Endulzante">Endulzantes o edulcorantes</option>
								<option value="Conservante">Conservantes</option>
								<option value="Vitaminas">Vitaminas</option>
								<option value="Colorante">Colorantes</option>
								<option value="Saborizante">Saborizantes</option>
								<option value="Viscosante">Viscosantes</option>
								<option value="Grasa">Grasas y Aceites</option>
								<option value="Excipiente">Excipientes</option>
								<option value="Instrumento">Instrumentos y reactivos</option>
								<option value="Limpieza">Limpieza y Desinfección</option>
							</select>
							<div class="ayuda">
								<p>Intenta ubicar tu producto en la mejor <a href=#index">categoría</a>, dejarla en la correcta permitirá al usuario encontrarlo de manera más fácil.</p>
							</div>						
					</fieldset>
					<fieldset>
						<legend>Descripción del producto</legend>
						<textarea rows="4" cols="50" maxlength="40000" name="descripcion"><?php echo htmlspecialchars($res ['descripcion']) ?>
						</textarea>
						<div class="ayuda">
								<p>Inserta una breve <a href=#index">Descripción</a> de tu producto por ejemplo mencionar sus aplicaciones y grados de pureza disponibles aunque también se puede dejar vacío.</p>
						</div>		
					</fieldset>
					<fieldset>
						<legend>Precio del producto</legend>
							<input type="Number" name="precio" value="<?=$res['precio']?>" 							onkeyup="this.value=Numeros(this.value)">
							<div class="ayuda">
								<p>Escribe un nombre <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas.</p>
							</div>	
					</fieldset>
					<fieldset>
						<legend>Cantidad mínima</legend>
							<input type="number" name="cantidad" value="<?=$res['cantidad']?>" 							onkeyup="this.value=Numeros(this.value)">
							<div class="ayuda">
								<p>Escribe la <a href="">Cantidad minima</a> en la cual tiene este producto, no incluyas el nombre de tu empresa ya que eso limitará las visitas.</p>
							</div>	
					</fieldset>
						<fieldset>
						<legend>Stock del producto</legend>
							<select id="selectformulario" name="select2" >
								<option value="<?=$res['stock']?>"><?=$res['stock']?></option>
								<option value="Disponible">Disponible</option>
								<option value="NoDispobible">No disponible</option>
							</select>
							<div class="ayuda">
								<p>Cantidad de stock disponible</p>
							</div>	
					</fieldset>
					
					<fieldset>
						<legend>¿Se envían muestras de este producto?</legend>
							<select id="selectformulario" name="selectmuestras" >
								<option value="<?=$res['muestras']?>"><?=$res['muestras']?></option>
								<option value="Si" 	<?php if ($res['muestras']) ?>>Si</option>
								<option value="No" <?php if ($res['muestras'])?>>No</option>
								<option value="SoloEmpresas" <?php if ($res['muestras'])?>>Sólo Empresas</option>
								<?php $seleccion = $_POST['selectmuestras']; 
								echo $seleccion; ?>
							</select>
							<div class="ayuda">
								<p>Esto ayudará a tus clientes a saber si al llamar pueden solicitar una muestra del producto, antes de ir a realizar la compra.</p>
							</div>	
					</fieldset>

					<fieldset>
						<legend>Modificar Foto del producto</legend>
							<input type="file" id="myFile" name="foto[]" multiple value="<?=$res['foto']?>">
							<div class="ayuda">
								<p>selecciona minimo una <a href="">Imagen</a> y maximo cinco <a href="">Imagenes</a> que sirvan de referencia para los clientes y puedan identificar tus productos, recomendamos usar imagenes sin logotipos de la empresa, de preferencia del tipo de producto que se vende, una(s) imagen(es) que de referencia al mismo.</p>
							</div>	
					</fieldset>
					<input class="Btn_formulario" type="submit" value="Modificar" name="Enviar" alt="Modifica tus productos">
				</form>
			</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>
<?php endif;?>				
<?php
include 'Recursos/footer.php';
?>