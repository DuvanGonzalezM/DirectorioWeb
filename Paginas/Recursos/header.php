<?php

	session_start();
	require 'conexion.php';
	//$num = null;
	if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
		switch ($_SESSION['rol']) {
			case 1:			
				$Nombre=$_SESSION['usuario_nom'];
				$ruta = "../Fotos/Usuario_".$_SESSION['usuario_id'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "../img/usuario.png";
				}
				$num = 1;
				break;
			case 2:
				$Nombre=$_SESSION['empresa_nom'];
				$ruta = "../Fotos/Empresa_".$_SESSION['empresa_nit'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "../img/logo_de_fabrica.png";
				}
				$num = 1;
				break;
			case 3:
				$Nombre=$_SESSION['usuario_nom'];
				$ruta = "../Fotos/Usuario_".$_SESSION['usuario_id'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "../img/usuario.png";
				}
				$num = 1;
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<!--Aspecto y estilo slider-->
	<link rel="stylesheet" type="text/css" href="..//css/slider.css">
	<!--estilos pag de registro-->
	<link rel="stylesheet" type="text/css" href="..//css/estilof.css">
	
	<title>Directorio web</title>
	<!--Aspecto y web en general-->
	<link rel="stylesheet" href="..//css/estilo.css">
	<!---Script Fotos-->
	<script type="text/javascript" src="../js/CambioFoto.js"></script>
</head>
<body>
	<header>
	<?php
		/*Recibe el valor del campo de búsqueda*/
		/*Con isset se valida si el campo contiene algún valor*/
		$mensaje="";
		if(isset($_POST['search'])){
			$texto=$_POST['search'];
		    $mensaje="Los resultados para la busqueda de <b>".$_POST['search']."</b> son:";
		/*Si el campo no posee algún valor se le da uno por defecto*/
		}elseif(!isset($_POST['search'])){ 
		    $mensaje="No se encontraron terminos en la búsqueda";
		    $texto="";
		    $filtros="producto";
		}
		$textoLimpio = preg_replace("([ ]+)"," ",$texto); 
	?>
	<form id="fomrHeader" method="POST" action='busqueda.php?$texto'>
	<ul>
			<!--LOGOTIPO DIRECTORIO-->
		<li>
			<a href="../">
			<img alt="Página de inicio" class="logo" src="..//img/LOGO_DIRECTORIO_WEB.png" title="Página de Inicio">
			</a>
		</li>
		<li>
			<!--INICIA LISTA DESPLEGABLE OPCIONES EL PRIMER FILTRO-->
			<select class="opc_busqueda" title="Filtros" name="filtros">
				<option value="producto" <?php if (isset($_POST['filtros']) && $_POST['filtros']== "producto") {echo "selected"; } ?> >Productos</option>
				<option value="servicio" <?php if (isset($_POST['filtros']) && $_POST['filtros']== "servicio") {echo "selected"; } ?> >Servicios</option>
				<option value="empresa" <?php if (isset($_POST['filtros']) && $_POST['filtros']== "empresa") {echo "selected"; } ?> >Empresas</option>
			</select>
			<!--INICIA BARRA DE BUSQUEDA-->
				<input id="busqueda" type="text" name="search" placeholder="materias primas..." value="<?=$texto;?>" >
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
								<a href='Perfil.php'><button class='Btn_registro' type='button'>Perfil</button></a>
								<a href='Recursos/cerrarsesion.php'><button class='Btn_ingreso' type='button'>Cerrar Sesión</button></a>					 			
							</div>	
						</div>
					<?php else: ?>	
						<a href="PaginaSeleccionRegistro.php"><span class="mensaje">Regístrarse es gratis</span></a>
						<div class='ingresar'><img class='logouser' alt='logo' src='..//img/usuario.png'>Ingresar
							<div class='ingresar-contenido'>
								<span class='opcIngreso'>Ya tengo una cuenta:</span>
								<a href='Login.php'><button class='Btn_ingreso' type='button'>Ingresar</button></a>
								<span class='opcIngreso'>¿No tienes una cuenta? </span>
								<a href='PaginaSeleccionRegistro.php'><button class='Btn_registro' type='button'>Registrarme</button></a>
							</div>
						</div>
					<?php endif; ?>			
			</li>
			<!--Logo del sitio redirige al inicio Y BOTON DE AYUDA EN ESTA SECCION-->
			<li><a href="FormularioPQR.php"><img class="logoayuda" src="..//img/ayudalogo.png" alt="Ayuda/PQR" title="Ayuda/PQR" ></a></li>
		</ul>
		<span id="headerban" >Encuentra los proveedores que necesitas a un click de distancia</span>
	</header>
