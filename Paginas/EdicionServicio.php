<?php

include 'Recursos/header.php';
if ($_SESSION['rol'] <> 2) {
      header('Location: ../');
    }

?>
<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
</aside>
<?php
 	$consulta="SELECT servicio.servicio_nom 'nombre', servicio.servicio_foto 'foto', servicio.servicio_mobra 'mobra', servicio.servicio_comenta 'comenta', servicio.servicio_tipo 'tipo', empresa.empresa_nom 'empresa_nom', empresa.empresa_nit 'nit' FROM servicio INNER JOIN empresa ON empresa.empresa_nit=servicio.empresa_nit WHERE empresa.empresa_nit like '".$_SESSION['empresa_nit']."' and servicio.servicio_cod like '".$_GET['codigo']."'"; 
					$xyz=mysqli_query($conexion, $consulta);
					$res=mysqli_fetch_array($xyz);
						$fotosbd = $res['foto'];
  						$porciones_fotosbd = explode("/",$fotosbd,-1);
  						$foto1="../Fotos/Empresa_".$res['nit']."/servicio_".$res['codigo']."/".$porciones_fotosbd[0];
  							if (isset($_POST['Enviar'])){
  					$actualizar = mysqli_query($conexion,"UPDATE servicio set servicio_nom = '".$_POST['nom_pro']."', servicio_comenta = '".$_POST['descripcion']."', servicio_mobra = '".$_POST['price']."', servicio_tipo = '".$_POST['selectformulario']."' WHERE empresa_nit like '".$_SESSION["empresa_nit"]."' and servicio_cod like '".$codigo."'");
						if ($actualizar) {
							header ('Location: VistaInternaProducto.php');
						}
						else{
							$mensaje = "Los datos no fueron enviados";
						}	
					}

			?>  

				<section id="section">
				<span id="span_aside"><h3>Modifica tus servicios</h3></span>
				<form action="" method="POST">
					<fieldset>
						<legend>Nombre del servicio </legend>
							<input type="text" name="nom_pro" id="servicio_nom" value="<?=$res['nombre']?>"onkeyup="this.value=NumText(this.value)">
							<div class="ayuda">
								<p>Escribe el nombre de la actividad realizada <a href=#index">Genérico</a>, no incluyas el nombre de tu empresa ya que eso limitará las visitas. ejemplo: envasado de ..., maquila de ... </p>
							</div>
					</fieldset>

					<fieldset>
						<legend>Tipo servicio</legend>
							<select id="selectformulario" name="selectformulario" >
								<option value="<?=$res['tipo']?>"><?=$res['tipo']?></option>
							<option value="maquila" 	<?php if ($res['tipo']== "maquila"  ) { echo "DEFAULT";	}?>>Maquila</option>
							<option value="empacado" 	<?php if ($res['tipo']== "empacado"  ) { echo "DEFAULT";}?>>Empacado</option>
							<option value="envasado" 	<?php if ($res['tipo']== "envasado"  ) { echo "DEFAULT";	}?>>Envasado</option>
							<option value="codificado" 	<?php if ($res['tipo']== "codificado"  ) { echo "DEFAULT";	}?>>Codificado</option>
							<option value="acondicionamiento" <?php if ($res['tipo']== "acondicionamiento" ) { echo "DEFAULT";	}?>>Acondicionamiento</option>
							<option value="transporte" 	<?php if ($res['tipo']== "transporte"  ) { echo "DEFAULT";	}?>>Transporte de Mercancías</option>
							<?php $seleccion = $_POST['selectformulario']; 
								echo $seleccion; ?>
							</select>
							<div class="ayuda">
								<p>Intenta seleccionar el mejor <a href=#index">Tipo</a> de la lista para tu servicio, dejarla en la correcta permitirá al usuario encontrarlo de manera más fácil haz que coincida con el título.</p>
							</div>						
					</fieldset>
					<fieldset>
						<legend>Descripción del Servicio</legend>
						<textarea rows="4" cols="50" maxlength="40000" name="descripcion"><?php echo htmlspecialchars($res ['comenta']) ?>
						</textarea>
						<div class="ayuda">
								<p>Inserta una breve <a href=#index">Descripción</a> de tu servicio por ejemplo mencionar la capacidad o especialización ejemplo si han envasado cosmeticos o productos de limpieza debería estar descrito también.</p>
						</div>		
					</fieldset>
					<fieldset>
						<legend>Precio del servicio</legend>
							<input type="Number" name="price" value="<?=$res['mobra']?>" 										onkeyup="this.value=Numeros(this.value)">
							<div class="ayuda">
								<p>Escríbe un precio estimado, por ejemplo el valor que cobras por llenar la camtidad de envases que en la descripcion mencionas tienes capacidad.</p>
							</div>	
					</fieldset>
					<fieldset>
						<legend>Agrega una Foto del servicio</legend>
							<input type="file" id="myFile" name="foto[]" multiple value="<?=$res['foto']?>">
							<div class="ayuda">
								<p>selecciona una <a href="#index">Imagen</a> que sirva de referencia para los clientes y puedan identificar tus servicios, recomendamos usar imagen de la maquína o área donde prestes el servicio si las dispones, de preferencia que esten relacionadas al servicio que se ofrece.</p>
							</div>	
					</fieldset>
					<input type="submit" value="Guardar" alt="Modifica tu producto" name="Modificar">
				</form>
			</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>



<?php
include 'Recursos/footer.php';
?>