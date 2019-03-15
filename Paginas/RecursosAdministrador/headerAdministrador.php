<?php
	session_start();
	require '../Recursos/conexion.php';
	$num = null;
	if ($_SESSION['rol'] <> 1) {
      header('Location: ../../');
    }
	if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
		switch ($_SESSION['rol']) {
			case 1:
				$Nombre = $_SESSION['usuario_nom'];
				$ruta = "../../Fotos/Usuario_".$_SESSION['usuario_id'];
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "../../img/usuario.png";
				}
				$num = 1;
				break;
			case 2:
				$Nombre = $_SESSION['empresa_nom'];
				if(is_null($_SESSION['empresa_foto'])) {
					$foto =	"..//img/logo_de_fabrica.png";
				}else{
					$foto =	"../Fotos/Empresa_".$_SESSION['empresa_nit']."/Perfil.png";
				}
				$num = 1;
				break;
			case 3:
				$Nombre = $_SESSION['usuario_nom'];	
				if (is_null($_SESSION['usuario_foto'])) {
					$foto =	"..//img/usuario.png";
				}else{
					$foto =	"../Fotos/Usuario_".$_SESSION['usuario_id']."/".$_SESSION['usuario_foto'];
				}
				$num = 1;
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	
	<title>Directorio web</title>
	<!--Aspecto y web en general-->
	<link rel="stylesheet" href="../../css/estilo.css">
</head>
<body>
	<header>
	
	<form id="fomrHeader" method="POST" action='busqueda.php?$texto'>
	<ul>
			<!--LOGOTIPO DIRECTORIO-->
		<li>
			<a href="../../">
			<img alt="Página de inicio" class="logo" src="../../img/LOGO_DIRECTORIO_WEB.png" width="10%" height="10%" title="Página de Inicio">
			</a>
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
					 			<a href='../Perfil.php'><button class='Btn_registro' type='button'>Perfil</button></a>
					 			<a href='../Recursos/cerrarsesion.php'><button class='Btn_ingreso' type='button'>Cerrar Sesión</button></a>					 			
					 		</div>	
						</div>
					<?php else: ?>	
						<a href="PaginaSeleccionRegistro.php"><span class="mensaje">Regístrarse es gratis</span></a>
						<div class='ingresar'><img class='logouser' alt='logo' src='../../img/usuario.png'>Ingresar
							<div class='ingresar-contenido'>
								<span class='opcIngreso'>Ya tengo una cuenta:</span>
								<a href='../Login.php'><button class='Btn_ingreso' type='button'>Ingresar</button></a>
								<span class='opcIngreso'>¿No tienes una cuenta? </span>
								<a href='../PaginaSeleccionRegistro.php'><button class='Btn_registro' type='button'>Registrarme</button></a>
							</div>
						</div>
					<?php endif; ?>			
			</li>
			<!--Logo del sitio redirige al inicio Y BOTON DE AYUDA EN ESTA SECCION-->
			
		</ul>
		<div id="headerSepecial"></div>
		<span id="headerban" >Usted se encuentra editando datos como Administrador del sitio</span>
	</header>
	<body>
