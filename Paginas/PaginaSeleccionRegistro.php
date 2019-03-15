<?php

	session_start();
	require 'Recursos/conexion.php';
	//$num = null;
	if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
		switch ($_SESSION['rol']) {
			case 1:
				$Nombre = $_SESSION['usuario_nom'];
				if (is_null($_SESSION['usuario_foto'])) {
					$foto =	"..//img/usuario.png";
				}else{
					$foto =	"../Fotos/Usuario_".$_SESSION['usuario_id']."/".$_SESSION['usuario_foto'];
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
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!--Aspecto y estilo slider-->
	<link rel="stylesheet" type="text/css" href="..//css/slider.css">
	<!--estilos pag de registro-->
	<link rel="stylesheet" type="text/css" href="..//css/estilof.css">
	
	<title>Directorio web</title>
	<!--Aspecto y web en general-->
	<link rel="stylesheet" href="..//css/estilo.css">
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
		}else{ 
		    $mensaje="No se encontraron terminos en la búsqueda";
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

<?php
if (isset($_SESSION['usuario_id']) || isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
?>
<!--INFORMACION DEL DIRECTORIO-->
	<section>
		<article  class="titulo">
			<hl>Registrarse cómo:</hl>
		</article>
		<form class="contenedor">
			<!-------------------------Parte 1-------------------------->
			<a href="FormularioCreacionUsuario.php">
					<div class="uno">
					<h1>USUARIO</h1>
				<!-------------------------texto de descripcion en lista-------------------------->
				<div class="textodiv">
					<span>Podrá:</span>
					<ul>
						<li>Consultar datos de empresas Guardar.</li>
						<li>Calificar y obtener los datos más recientes de las empresas.</li>
					</ul>
				</div>
				<!-------------------------Area del boton-------------------------->
				<div class="divboton">
				
					<input class="Btn_formulario" type="submit" value="Usuario" alt="Registrar">
				</div>
				<!-------------------------cierra primer lado-------------------------->
				</div>
			</a>
		<!-------------------------Parte 2-------------------------->
			<a href="formularioCreacionEmpresa.php">
				<div class="dos">
					<h1>EMPRESA</h1>
				<!-------------------------texto de descripcion en lista-------------------------->
				<div class="textodiv">
					<span>Podrá:</span>
					<ul>
						<li>Crear y ofrecer nuevos productos.</li>
						<li>Crear y ofrecer nuevos servicios.</li>
						<li>Consultar datos de empresas Guardar.</li>
						<li>Calificar y obtener los datos más recientes de las empresas.</li>
					</ul>

				</div>
				<!-------------------------Area del boton-------------------------->
				<div class="divboton">
					
					<input class="Btn_formulario" type="submit" value="Empresa" alt="Registrar">
				</div>
				<!-------------------------cierra segundo lado-------------------------->
				</div>
			</a>
		</form>
	</section>
<?php include 'Recursos/footer.php'; ?>