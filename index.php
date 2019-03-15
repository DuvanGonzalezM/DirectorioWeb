<?php 
	session_start();
	require 'Paginas/Recursos/conexion.php';
	$num = null;
	if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
		switch ($_SESSION['rol']) {
			case 1:
				$Nombre=$_SESSION['usuario_nom'];
				$ruta = "Fotos/Usuario_".$_SESSION['usuario_id'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "img/usuario.png";
				}
				$num = 1;
				break;
			case 2:
				$Nombre=$_SESSION['empresa_nom'];
				$ruta = "Fotos/Empresa_".$_SESSION['empresa_nit'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "img/logo_de_fabrica.png";
				}
				$num = 1;
				break;
			case 3:
				$Nombre=$_SESSION['usuario_nom'];
				$ruta = "Fotos/Usuario_".$_SESSION['usuario_id'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "img/usuario.png";
				}
				$num = 1;
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!--Aspecto y estilo slider-->
	<link rel="stylesheet" type="text/css" href="css/slider.css">
	<!--estilos pag de registro-->
	<link rel="stylesheet" type="text/css" href="css/estilof.css">
	<title>Directorio web</title>
	<!--Aspecto y web en general-->
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<header>
	<?php
		/*Recibe el valor del campo de búsqueda*/
		/*Con isset se valida si el campo contiene algún valor*/
		$mensaje="";
		$texto="";
		$filtros="";
		if(isset($_POST['search'])){
			$texto=$_POST['search'];
		    $mensaje="Los resultados para la busqueda de <b>".$_POST['search']."</b> son:";
		    
		/*Si el campo no posee algún valor se le da uno por defecto*/
		}else{ 
		    $mensaje="No se encontraron terminos en la búsqueda";
		}
		$textoLimpio = preg_replace("([ ]+)"," ",$texto);

	?>
	<form id="fomrHeader" method="POST" action="paginas/busqueda.php">
	<ul>
			<!--LOGOTIPO DIRECTORIO-->
		<li>
			<a href="">
			<img alt="Página de inicio" class="logo" src="img/LOGO_DIRECTORIO_WEB.png" title="Página de Inicio">
			</a>
		</li>
		<li>
			<!--INICIA LISTA DESPLEGABLE OPCIONES EL PRIMER FILTRO-->
			<select class="opc_busqueda" title="Filtros" name="filtros">
				<option value="producto" default>Productos</option>
				<option value="servicio" >Servicios</option>
				<option value="empresa" >Empresas</option>
			</select>
			<!--INICIA BARRA DE BUSQUEDA-->
				<input id="busqueda" type="text" name="search" placeholder="materias primas..." value="<?php echo $texto; ?>" 	onkeyup="this.value=NumText(this.value)" >
				<!--BOTON BUSQUEDA-->
				<button title="Buscar" class="Boton_busqueda" type="submit">Buscar</button>
			
		</li>
	</form>
			<!--texto seleccion registro-->
			<li>
					<?php if ($num>0): ?>
					 	<div class='ingresar'><img class='logouser' alt='logo' src='<?=$foto?>'>Mi cuenta
					 		<div class='ingresar-contenido'>
					 			<div>
					 				<div>
					 					<img alt="Imagen de perfil" title="Imagen de perfil" src="<?=$foto?>">
					 				</div>
					 				<span><?=$Nombre?></span>
					 			</div>
					 			<a href='Paginas/Perfil.php'><button class='Btn_registro' type='button'>Perfil</button></a>
					 			<a href='Paginas/Recursos/cerrarsesion.php'><button class='Btn_ingreso' type='button'>Cerrar Sesión</button></a>
					<?php else: ?>	
						<a href="Paginas/PaginaSeleccionRegistro.php"><span class="mensaje">Regístrarse es gratis</span></a>
						<div class='ingresar'><img class='logouser' alt='logo' src='img/usuario.png'>Ingresar
							<div class='ingresar-contenido'>
								<span class='opcIngreso'>Ya tengo una cuenta:</span>
								<a href='Paginas/Login.php'><button class='Btn_ingreso' type='button'>Ingresar</button></a>
								<br>
								<span class='opcIngreso'>¿No tienes una cuenta? </span>
								<a href='Paginas/PaginaSeleccionRegistro.php'><button class='Btn_registro' type='button'>Registrarme</button></a>
					 		</div>	
						</div>
							</div>
						</div>
					<?php endif; ?>
			</li>
			<!--Logo del sitio redirige al inicio Y BOTON DE AYUDA EN ESTA SECCION-->
			<li><a href="Paginas/FormularioPQR.php"><img class="logoayuda" src="img/ayudalogo.png" alt="Ayuda/PQR" title="Ayuda/PQR" ></a></li>
		</ul>
		<span id="headerban" >Encuentra los proveedores que necesitas a un click de distancia</span>
	</header>
	<aside>
		<dl id="span_aside"><h3>Encuentra tus proveedores</h3>
			<dt>Por materias primas:</dt>
			<dd><a href="#index">Animal (12)</a></dd>
			<dd><a href="#index">Vegetal (45)</a></dd>
			<dd><a href="#index">Mineral (78)</a></dd>
			<dt>Por servicios:</dt>
			<dd><a href="#index">Empacado (1)</a></dd>
			<dd><a href="#index">Maquila (2)</a></dd>
			<dd><a href="#index">Dispensado (0)</a></dd>
		</dl>
	</aside>
	<section id="section">
<!-------- Inicia Slider --------->
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
		         <img src="img/slider/slide01.jpg" alt="imgText"/>
		         <!-- Item Info -->
		         <div class="sh__meta">
		            <h4>Encuentra</h4>
		            <span>Proveedores para tu <a href="paginacreacionempresa.php">empresa</a></span>
		         </div>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="img/slider/slide02.jpg" alt="imgText"/>
		         <!-- Item Info -->
		         <div class="sh__meta">
		            <h4>Descubre</h4>
		            <span>Soluciones Innovadoras</span>
		         </div>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="img/slider/slide03.jpg" alt="imgText"/>
		         <!-- Item Info -->
		         <div class="sh__meta">
		            <h4>Comparte tus servicios</h4>
		            <span>Si tienes una máquina déjala a trabajar</span>
		         </div>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="img/slider/slide04.jpg" alt="imgText"/>
		         <!-- Item Info -->
		         <div class="sh__meta">
		            <h4>Ubica</h4>
		            <span>Proveedores de  <a href="formularioconsulta.php">maquinarias</a></span>
		         </div>
		      </div>
		      <!-- Slider Item -->
		      <div class="sh__item">
		         <img src="img/slider/slide05.jpg" alt="imgText"/>
		         <!-- Item Info -->
		         <div class="sh__meta">
		            <h4>Encuentra</h4>
		            <span>Proveedores de servicios para tu empresa</span>
		         </div>
		      </div>
		      
		   </div><!-- .sh__content -->

		   <!--botones-->
		   <div class="sh__btns">
		      <label for="s1"></label>
		      <label for="s2"></label>
		      <label for="s3"></label>
		      <label for="s4"></label>
		      <label for="s5"></label>
		   </div><!-- .sh__btns -->

		   <!--flechas-->
		   <div class="sh__arrows">
		      <label for="s1"></label>
		      <label for="s2"></label>
		      <label for="s3"></label>
		      <label for="s4"></label>
		      <label for="s5"></label>
		   </div><!-- .sh__arrows -->
		</div>
<!-------- fin Slider --------->

<div id="item1">
	<div>
	<span>Empresas que se registraron recientemente: </span>
	</div>
		<?php

	$insertar ="SELECT empresa_nom, empresa_nit,empresa_foto  FROM empresa WHERE empresa_fecha <= CURDATE() order BY empresa_fecha DESC LIMIT 5";
	$resultado=mysqli_query($conexion,$insertar);
	if ($resultado) {
		while ($verificado=mysqli_fetch_array($resultado)) {
			$ruta = "Fotos/Empresa_".$verificado['empresa_nit'];
			if (file_exists($ruta)) {
				$foto = $ruta."/Perfil.png";
			}
			else{
				$foto = "img/logo_de_fabrica.png";
			}
?>

		
		<div id="recientes">
				<a target="_blank" href="Paginas/VistaPerfilEmpresa.php?nit=<?=$verificado['empresa_nit']?>" >
				<img id="imagen_index" src="<?=$foto?>" >
				</a>
				<p><?= $verificado['empresa_nom'] ?></p>

		</div>
<?php



		
	 }
	}
	else{
		echo "error<br>";
	}

?>
</div>
			
<div id="item1">
	<div>
	<span>Productos agregados recientemente: </span>
	</div>
		<?php

	$insertar ="SELECT producto_nom, producto_cod,producto_foto,empresa_nit  FROM producto WHERE producto_fecha <= CURDATE() order BY producto_fecha DESC LIMIT 5";
	$resultado=mysqli_query($conexion,$insertar);
	if ($resultado) {
		while ($verificado=mysqli_fetch_array($resultado)) {
			$ruta = "Fotos/Empresa_".$verificado['empresa_nit']."/Productos/Producto_".$verificado['producto_cod'];
			if (file_exists($ruta)) {
				$foto = $ruta."/Producto_1.png";
			}
			else{
				$foto = "img/logo_de_producto.png";
			}			
		
?>

		
		<div id="recientes">
				<a target="_blank" href="Paginas/VistaProducto.php?codigo=<?=$verificado['producto_cod']?>" >
				<img id="imagen_index" src="<?=$foto?>" >
				</a>
				<p><?= $verificado['producto_nom'] ?></p>
		</div>
<?php



		
	 }
	}
	else{
		echo "error<br>";
	}

?>
</div>
	

<div id="item1">
	<div>
	<span>Servicios agregados recientemente: </span>
	</div>
		<?php

	$insertar ="SELECT servicio_nom, servicio_cod,servicio_foto,empresa_nit  FROM servicio WHERE servicio_fecha <= CURDATE() order BY servicio_fecha DESC LIMIT 5";
	$resultado=mysqli_query($conexion,$insertar);
	if ($resultado) {
		while ($verificado=mysqli_fetch_array($resultado)) {
			$ruta = "Fotos/Empresa_".$verificado['empresa_nit']."/Servicios/Servicio_".$verificado['servicio_cod'];
			if (file_exists($ruta)) {
				$foto = $ruta."/Servicio_1.png";
			}
			else{
				$foto = "img/logo_de_servicio.png";
			}			
		
?>

		
		<div id="recientes">
				<a target="_blank" href="Paginas/VistaServicio.php?codigo=<?=$verificado['servicio_cod']?>" >
				<img id="imagen_index" src="<?=$foto?>" >
				</a>
				<p><?= $verificado['servicio_nom'] ?></p>
		</div>
<?php



		
	 }
	}
	else{
		echo "error<br>";
	}

?>
</div>




		
	</section>
	<footer>
	<script src="js/validacion.js">  //nombre del Archivo JavaScript
	</script>

		<ul>
			<li><a href="#"><img alt="logo" title="logo Directorio" class="logo" src="img/LOGO_DIRECTORIO_WEB.png"></a>
			<li><a href="Paginas/TerminosYCondiciones.php">Términos y condiciones de uso</a>
			</li>
			<li><a href="Paginas/Contactanos.php">Contáctenos</a>
			</li>
			<li><a href="Paginas/AcercaDeNosotros.php">Acerca de nosotros</a>
			</li>
			<li><a href="Paginas/Preguntas.php">Preguntas frecuentes</a>
			</li>
			<li><a href="Paginas/FormularioPQR.php">Centro de Ayuda y PQR</a>
			</li>
		</ul>
		<script src="js/slider.js"></script>
	</footer>
</body>
</html>