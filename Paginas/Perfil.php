<?php include 'Recursos/header.php'; ?>

<?php 
	if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    } 
?>
<?php if ($_SESSION['rol'] == 1): ?>
<?php //para el usuario administrador
	$id = $_SESSION['usuario_id'];	
	$consulta = mysqli_query($conexion,"SELECT * from usuario where usuario_id = '$id'");
	$datos = mysqli_fetch_array($consulta);
	$Nombre_completo = $datos['usuario_nom']." ".$datos['usuario_ape'];
	$Documento = $datos['usuario_doc'];
	$Telefono = $datos['usuario_tel1'];
	$Correo = $datos['usuario_email'];
	$UsuarioFoto = $datos['usuario_foto'];
	$ruta = "../Fotos/Usuario_".$id;
	if (file_exists($ruta)) {
		$foto = $ruta."/Perfil.png";
	}
	else{
		$foto = "../img/usuario.png";
	}
?>
		<aside id="aside">
			<dl id="span_aside"><h3>Panel Administrador</h3>
				<form action="Administrador.php" method="post">
					<dd><a href="Administrador.php"> Gestionar datos</a></dd>			
				</form>	
				
			</dl>	
		</aside>
		<section id="section">
			<dd><a href="EdicionPerfil.php">Editar perfil</a></dd> <br>
				<center>
					<div id="perfil">
						<div class="foto1">
							<img src="<?=$foto?>" class="foto">
							<input type="button" id="modificar_foto" onclick="Cambio_foto()">
							<label  class="foto2" for="modificar_foto" title="Cambiar foto"></label>
						</div>
					</div>	
				</center>
				<h1><dd> Bienvenido <?=$Nombre?></dd></h1>
									<span>Datos</span>
							<ul>
			 					<li> Nombre completo: <b><?=$Nombre_completo?></b></li>
			    				<li> Numero de identifiación: <b><?=$Documento?></b></li>
			    				<li> Teléfono: <b><?=$Telefono?></b></li>
			    				<li> Correo electrónico: <b><?=$Correo?></b></li>
			    			</ul>
		</section>
		
<?php elseif ($_SESSION['rol'] == 2): //para las empresas ?>
	<aside>
		<dl id="span_aside"><h3>Panel Administrador</h3>
			<dt>Productos:</dt>
				<dd><a href="VistaInternaProducto.php">Ver mis productos</a></dd>
				<dd><a href="FormularioCreacionProducto.php">Crear un nuevo producto</a></dd>
			<dt>Servicios:</dt>
				<dd><a href="VistaInternaServicio.php">Ver mis servicios</a></dd>
				<dd><a href="FormularioCreacionServicio.php">Crear un nuevo servicio</a></dd>
		</dl>
	</aside>	
	<section id="Modificar_foto"><!--Modificar_foto-->
	</section>
	<section id="section">
		<?php 
			$nit = $_SESSION['empresa_nit'];
			$consulta = mysqli_query($conexion,"SELECT * from empresa where empresa_nit = '$nit'");
			$datos = mysqli_fetch_array($consulta);
			if ($_POST['guardar']) {
				$CarpetaDestino='../Fotos/Empresa_'.$nit.'/Perfil.png';
				if(move_uploaded_file($_FILES['nuevafoto']['tmp_name'],$CarpetaDestino)){
					header('Location: Perfil.php');
				}
			}
			$Direccion = $datos['empresa_dir'];
			$Telefono = $datos['empresa_tel1'];
			$Correo = $datos['empresa_email'];
			$NomContacto = $datos['empresa_nom_contac'];
			$PaginaWeb = $datos['empresa_pagina'];
			$Antiguedad = $datos['empresa_antig'];
			$FacturaAnual = $datos['empresa_fact_anual'];
			$NumEmpleados = $datos['empresa_num_empl'];
			$EmpresaFoto = $datos['empresa_foto'];
			$ruta = "../Fotos/Empresa_".$nit;
			if (file_exists($ruta)) {
				$foto = $ruta."/Perfil.png";
			}
			else{
				$foto = "../img/logo_de_fabrica.png";
			}
		?>
		<dd><a href="EdicionPerfil.php">Editar perfil</a></dd> <br>
					<center>
						<div id="perfil">
							<div class="foto1">
								<img src="<?=$foto?>" class="foto">
								<input type="button" id="modificar_foto" onclick="Cambio_foto()">
								<label  class="foto2" for="modificar_foto" title="Cambiar foto"></label>
							</div>
						</div>	
					</center>
					<center><h1><dd> Bienvenido a tu perfil, <?=$datos['empresa_nom']?></dd></h1>
						<div id="datos">
							<center><h5> <?=$Telefono?>  | <?=$Correo?></h5></center>
						</div><br>
								<span>Datos</span>
						<ul id="informacionUsuario">
			 				<li> Dirección: <b><?=$Direccion?></b></li>
			 				<li> Persona de contacto: <b><?=$NomContacto?></b></li>
		    				<li> NumEmpleados: <b><?=$NumEmpleados?></b></li>
		    				<li> Facturacion anual: <b><?=$FacturaAnual?></b></li>
			 				<li> Antigüedad: <b><?=$Antiguedad?> Años</b></li>
		    				<li> Pagina Web: <a target="_blank" href="http://<?=$PaginaWeb?>"><?=$PaginaWeb?></a></li>
		    			</ul>
			</section>
	<?php else: ?>
		<aside>
		<dl id="span_aside"><h3>Panel de solicitudes</h3>
			<dt>Solicitudes realizadas:</dt>
					<dd><a href="solicitudes.php?solicitud=Productos">En productos</a></dd>
					<dd><a href="solicitudes.php?solicitud=Servicios">En servicios</a></dd>
					<dd><a href="solicitudes.php?solicitud=Empresas">A Empresas</a></dd>
			</dl>
		</aside>
		<section id="Modificar_foto"><!--Modificar_foto-->
		</section>
		<section id="section">
			<?php  
				$id = $_SESSION['usuario_id'];
				if ($_POST['guardar']) {
				$CarpetaDestino='../Fotos/Usuario_'.$id.'/Perfil.png';
					if(move_uploaded_file($_FILES['nuevafoto']['tmp_name'],$CarpetaDestino)){
					header('Location: Perfil.php');
					}
				}
				$consulta = mysqli_query($conexion,"SELECT * from usuario where usuario_id = '$id'");
				$datos = mysqli_fetch_array($consulta);
				$Nombre_completo = $datos['usuario_nom']." ".$datos['usuario_ape'];
				$Documento = $datos['usuario_doc'];
				$Telefono = $datos['usuario_tel1'];
				$Correo = $datos['usuario_email'];
				$UsuarioFoto = $datos['usuario_foto'];
				$ruta = "../Fotos/Usuario_".$id;
				if (file_exists($ruta)) {
					$foto = $ruta."/Perfil.png";
				}
				else{
					$foto = "../img/usuario.png";
				}
			?>

			<dd><a href="EdicionPerfil.php">Editar perfil</a></dd> <br>
				<center>
						<div id="perfil">
							<div class="foto1">
								<img src="<?=$foto?>" class="foto">
								<input type="button" id="modificar_foto" onclick="Cambio_foto()">
								<label  class="foto2" for="modificar_foto" title="Cambiar foto"></label>
							</div>
						</div>	
					</center>
				<h1><dd> Hola, <?=$datos['usuario_nom']?></dd></h1>
									<span><h3>Esta información la podrán ver las empresas con las cuales te quieras contactar</h3></span></center>
							<ul id="informacionUsuario">
			 					<li> Nombre completo: <b><?=$Nombre_completo?></b></li>
			    				<li> Numero de identifiación: <b><?=$Documento?></b></li>
			    				<li> Teléfono: <b><?=$Telefono?></b></li>
			    				<li> Correo electrónico: <b><?=$Correo?></b></li>
			    			</ul>
		</section>

</section>
	<?php endif; ?>
<?php
include 'Recursos/footer.php';
?>