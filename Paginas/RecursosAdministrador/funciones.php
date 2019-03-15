<?php

?>
 <link rel="stylesheet" type="text/css" href="../../css/estilo.css">   <?php

	function conectarbd($servidor, $usuario, $clave, $basedatos){
			$conect=@mysqli_connect($servidor, $usuario, $clave, $basedatos);
	/*conect to database*/
		if (!$conect) {
			return false;
		}
		else{
			return $conect;
		}
	}
	function consultarbd($conect,$consulta){				
		$datos=@mysqli_query($conect,$consulta);
		if(!$datos) {
			return false;
		}
		else{
			return $datos;
		}
	}	

/*	function generaMenuSeleccion($datos,$name,$label){
		$codigo='<label>'.$label.'</label>'."\n";
		$codigo=$codigo.'<select name=>"'.$name.'">'."\n";
		while($fila=mysqli_fetch_array($datos)){
			$codigo=$codigo.'<option value="'.$fila["id"].'">'.utf8_encode($fila["pais"]).'</option>'."\n";
		}
		$codigo=$codigo."</select>\n";
		return $codigo;
	}
*/
	function tabularUsuario($datos){
		//vamos acumulando de a una fila "tr" por vuelta
		while($fila=mysqli_fetch_array($datos)){
			$codigo=$codigo.'<div id="principal"><div id="li0"><ul id="item">';
			$codigo=$codigo.'<li id="id"> Id:<b>'.utf8_encode($fila["usuario_id"])."</b></li>";
			$codigo=$codigo.'<li> Nombre:<b>'.utf8_encode($fila["usuario_nom"])."</b></li>";
			$codigo=$codigo.'<li> Apellido:<b>'.utf8_encode($fila["usuario_ape"])."</b></li>";
			$codigo=$codigo.'<li> Documento:<b>'.utf8_encode($fila["usuario_doc"])."</b></li>";
			$codigo=$codigo.'</ul></div><div id="li1"><ul id="item"><li> Telefono:<b>'.utf8_encode($fila["usuario_tel1"])."</b></li>";
			$codigo=$codigo.'<li> Otros Tels:<b>'.utf8_encode($fila["usuario_otros_tel"])."</b></li>";
			$codigo=$codigo.'<li> Email:<b>'.utf8_encode($fila["usuario_email"])."</b></li>";
			$codigo=$codigo.'<li> Permiso:<b>'.utf8_encode($fila["usuario_permiso"])."</b></li></ul></div>";
			$codigo=$codigo.'<div id="btn"><ul><li><a href="RecursosAdministrador/borrarUsuario.php?codigo='.$fila["usuario_id"].'"><input id="Btn_filtrado" type="button" value="Borrar" alt="Borra este usuario"></a></li>';
			$codigo=$codigo.'<li><a href="RecursosAdministrador/modificarUsuario.php?codigo='.$fila["usuario_id"].'"><input id="Btn_filtrado" type="button" value="modificar" alt="Modifica este usuario"></a></li><ul></div></div><br><br><br><br><br>';

			$codigo=$codigo.'';
		}
		$codigo=$codigo.'';
		return $codigo;
	}

	function tabularEmpresa($datos){
	
		while($fila=mysqli_fetch_array($datos)){
			$codigo=$codigo.'<div id="principal"><div id="li0"><ul id="item">';
			$codigo=$codigo.'<li id="id"> Nit:<b>'.utf8_encode($fila["empresa_nit"])."</b></li>";
			$codigo=$codigo.'<li id="id"> Nombre:<b>'.utf8_encode($fila["empresa_nom"])."</b></li>";
			$codigo=$codigo.'<li id="id"> Dir:<b>'.utf8_encode($fila["empresa_dir"])."</b></li>";
			$codigo=$codigo.'<li id="id"> Tel:<b>'.utf8_encode($fila["empresa_tel1"])."</b></li>";
			$codigo=$codigo.'</ul></div><div id="li1"><ul id="item"><li> Telefono:<b>'.utf8_encode($fila["empresa_otros_tel"])."</b></li>";
			$codigo=$codigo.'<li id="id"> Email:<b>'.utf8_encode($fila["empresa_email"])."</b></li>";
			$codigo=$codigo.'<li id="id"> Pagina:<b>'.utf8_encode($fila["empresa_pagina"])."</b></li></ul></div>";	

			$codigo=$codigo.'<div><div id="btn"><ul><li><a href="RecursosAdministrador/borrarEmpresa.php?codigo='.$fila["empresa_nit"].'"><input id="Btn_filtrado" type="button" value="Borrar" alt="Borra este usuario"></a></li>';
			$codigo=$codigo.'<li><a href="RecursosAdministrador/modificarEmpresa.php?codigo='.$fila["empresa_nit"].'"><input id="Btn_filtrado" type="button" value="modificar" alt="Modifica este usuario"></a></li>';
			$codigo=$codigo.'<li><a href="RecursosAdministrador/modificarCertificacionEmpresa.php?codigo='.$fila["empresa_nit"].'"><input id="Btn_filtrado" type="button" value="certificar" alt="certifica este usuario"></a></li><ul></div></div>';

			$codigo=$codigo.'';
		}
		$codigo=$codigo.'';
		return $codigo;
	}

/*	function tabularEmpresa($datos){
		$codigo='<table border="1" cellpadding="3">
		<tr><td><legend>NIT</legend></td><td><legend>NOMBRE</legend></td><td><legend>DIRECCION</legend></td><td><legend>TELEFONO</legend></td><td><legend>OT_TEL</legend></td><td><legend>EMAIL</legend></td><td><legend>NOMBRE_CONTACTO</legend></td><td><legend>PAGINA WEB</legend></td><td><legend>ANTIG</legend></td><td><legend>FACTURACION</legend></td><td><legend>EMPLEADOS</legend></td><td><legend>CLAVE</legend></td><td><legend>FOTO</legend></td><td><legend>PERMISO</legend></td><td></td><td></td><td></td></tr></tr>';
		//vamos acumulando de a una fila "tr" por vuelta
		while($fila=mysqli_fetch_array($datos)){
			$codigo=$codigo.'<tr>';
			/*vamos acumulando tantos td como sea necesario*//*
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_nit"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_nom"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_dir"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_tel1"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_otros_tel"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_email"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_nom_contac"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_pagina"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_antig"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_fact_anual"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_num_empl"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_contrasena"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_foto"])."</legend></td>";
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_permiso"])."</legend></td>";
			$codigo=$codigo.'<td><legend><a href="RecursosAdministrador/borrarEmpresa.php?codigo='.$fila["empresa_nit"].'">BORRAR</a></legend></td>';
			$codigo=$codigo.'<td><legend><a href="RecursosAdministrador/modificarEmpresa.php?codigo='.$fila["empresa_nit"].'">MODIFICAR</a></td>';
			$codigo=$codigo.'<td><legend><a href="RecursosAdministrador/modificarCertificacionEmpresa.php?codigo='.$fila["empresa_nit"].'">CERTIFICAR</a></legend></td>';

			$codigo=$codigo.'</tr>';
		}
		$codigo=$codigo.'</table>';
		return $codigo;
	}*/
	function editarRegistroUsuario($datos){
		
		//Extraemos a $fila el registro
		if($fila=mysqli_fetch_array($datos)){
			$nombreActual=utf8_encode($fila["usuario_nom"]);
			$apellidoActual=utf8_encode($fila["usuario_ape"]);
			$documentoActual=utf8_encode($fila["usuario_doc"]);
			$telefonoActual=utf8_encode($fila["usuario_tel1"]);
			$otrotelActual=utf8_encode($fila["usuario_otros_tel"]);
			$emailActual=utf8_encode($fila["usuario_email"]);
			$claveActual=utf8_encode($fila["usuario_contrasena"]);
			$fotoActual=utf8_encode($fila["usuario_foto"]);
			$permisoActual=utf8_encode($fila["usuario_permiso"]);
			$codigoActual=($fila["usuario_id"]);
			$codigo='<section id="section">
				<form id="span_aside" action="modificadoUsuario.php" method="post">
				<fieldset><span>Puede modificar los datos de este registro:</span></fieldset>
				<fieldset>
					<legend>Nombre:</legend><input id="span_aside" type="text" name="nombre" value="'.$nombreActual.'">
					<legend>Apellido:</legend><input id="span_aside" type="text" name="apellido" value="'.$apellidoActual.'">
					<legend>Documento:</legend><input id="span_aside" type="text" name="documento" value="'.$documentoActual.'">
					<legend>Telefono:</legend><input id="span_aside" type="text" name="telefono" value="'.$telefonoActual.'">
					<legend>Otro telefono:</legend><input id="span_aside" type="text" name="otrotel" value="'.$otrotelActual.'">
					<legend>Email:</legend><input id="span_aside" type="text" name="email" value="'.$emailActual.'">
					<legend>Permiso:</legend><input id="span_aside" type="text" name="permiso" value="'.$permisoActual.'">

					<input type="hidden" name="codigo" value="'.$codigoActual.'">
					<input type="submit" name="Submit" value="Guardar">
				</fieldset>
			</form>
			Regresar al panel <a href="../Administrador.php">administrador</a>
			</section>';
		}else{
			$codigo=false;
		}
		return $codigo;
	}

	function ingresarRegistroUsuario(){	
		
	
		$codigo='<section id="section">
				<form action="ingresarUsuario.php" method="post">
				<fieldset><span>Puede modificar los datos de este registro de usuario:</span>
				</fieldset>
				<fieldset>
					<legend>Nombre:</legend><input type="text" name="nombre">
					<legend>Apellido:</legend><input type="text" name="apellido">
					<legend>Documento:</legend><input type="text" name="documento">
					<legend>Telefono:</legend><input type="text" name="telefono">
					<legend>Otro telefono:</legend><input type="text" name="otrotel">
					<legend>Email:</legend><input type="text" name="email">
					<legend>Clave:</legend><input type="text" name="clave">
					<legend>Foto:</legend><input type="file" name="foto">
					<legend>Permiso:</legend><input type="text" name="permiso">

					<input type="hidden" name="codigo">
					<input type="submit" name="Submit" value="Guardar">
				</fieldset>
			</form>
			Regresar al panel <a href="../Administrador.php">administrador</a>
			</section>';		
		return $codigo;
	}

	

	function ingresarRegistroEmpresa(){		
		$codigo='<section id="section">
				<form action="ingresarEmpresa.php" method="post">
				<fieldset><spam>Puede ingresar una nueva empresa:</spam></fieldset>
				<fieldset>
					<legend>Nit:</legend><input type="text" name="nit">
					<legend>Nombre:</legend><input type="text" name="nombre">
					<legend>Direccion:</legend><input type="text" name="direccion">
					<legend>Telefono:</legend><input type="text" name="telefono">
					<legend>Otro telefono:</legend><input type="text" name="otrotel">
					<legend>Email:</legend><input type="text" name="email">
					<legend>Contacto:</legend><input type="text" name="contacto">
					<legend>Pagina Web:</legend><input type="text" name="pagina">
					<legend>Antiguedad:</legend><input type="text" name="antiguedad">
					<legend>Facturacion anual:</legend><input type="text" name="facturacion">
					<legend>Numero de empleados:</legend><input type="text" name="empleados">
					<legend>Contraseña:</legend><input type="text" name="clave">
					<legend>Foto de perfil:</legend><input type="file" name="foto">
					<legend>Permiso:</legend><input type="text" name="permiso">
				</fieldset>
				<fieldset>	
					<input type="hidden" name="codigo">
					<input type="submit" name="Submit" value="Guardar">
				</fieldset>
			</form>
			Regresar al panel <a href="../Administrador.php">administrador</a>
			</section>';		
		return $codigo;
	}

	function editarRegistroEmpresa($datos){
		
		//Extraemos a $fila el registro
		if($fila=mysqli_fetch_array($datos)){
			$nombreActual=utf8_encode($fila["empresa_nom"]);
			$direccionActual=utf8_encode($fila["empresa_dir"]);
			$telefonoActual=utf8_encode($fila["empresa_tel1"]);
			$otrotelActual=utf8_encode($fila["empresa_otros_tel"]);
			$emailActual=utf8_encode($fila["empresa_email"]);
			$contactActual=utf8_encode($fila["empresa_nom_contac"]);
			$paginaActual=utf8_encode($fila["empresa_pagina"]);
			$antiguedadActual=utf8_encode($fila["empresa_antig"]);
			$facturacionActual=utf8_encode($fila["empresa_fact_anual"]);
			$empleadosActual=utf8_encode($fila["empresa_num_empl"]);
			$claveActual=utf8_encode($fila["empresa_contrasena"]);
			$fotoActual=utf8_encode($fila["empresa_foto"]);
			$permisoActual=utf8_encode($fila["empresa_permiso"]);
			$codigoActual=($fila["empresa_nit"]);
			$codigo='<section id="section">
				<form action="modificadoEmpresa.php" method="post">
				<fieldset><span>Puede modificar los datos de este registro de Empresa:</span></fieldset>
				<fieldset>
					<legend>Nombre:</legend><input type="text" name="nombre" value="'.$nombreActual.'">
					<legend>Apellido:</legend><input type="text" name="direccion" value="'.$direccionActual.'">
					<legend>Telefono:</legend><input type="text" name="telefono" value="'.$telefonoActual.'">
					<legend>Otro telefono:</legend><input type="text" name="otrotel" value="'.$otrotelActual.'">
					<legend>Email:</legend><input type="text" name="email" value="'.$emailActual.'">
					<legend>Contacto:</legend><input type="text" name="contacto" value="'.$contactActual.'">
					<legend>Pagina web:</legend><input type="text" name="pagina" value="'.$paginaActual.'">
					<legend>Antiguedad:</legend><input type="text" name="antiguedad" value="'.$antiguedadActual.'">
					<legend>Facturacion anual:</legend><input type="text" name="facturacion" value="'.$facturacionActual.'">
					<legend>Numero de empleados:</legend><input type="text" name="empleados" value="'.$empleadosActual.'">

					<input type="hidden" name="codigo" value="'.$codigoActual.'">
					<input type="submit" name="Submit" value="Guardar">
				</fieldset>
				</form>
				Regresar al panel <a href="../Administrador.php">administrador</a>
			</section>';
		}else{
			$codigo=false;
		}
		return $codigo;
	}

	function tabularCertificacionEmpresa($datos){
		$codigo='<table border="1" cellpadding="3">
		<tr><td><legend>NIT</legend></td><td><legend>ESTADO CERTIFICACION</legend><td></td><tr><td>-</td></tr></tr>';
		//vamos acumulando de a una fila "tr" por vuelta
		while($fila=mysqli_fetch_array($datos)){
			$codigo=$codigo.'<tr>';
			/*vamos acumulando tantos td como sea necesario*/
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["empresa_nit"])."</legend></td>";			
			$codigo=$codigo.'<td><legend>'.utf8_encode($fila["certificacionempresa_estado"])."</legend></td>";
			$codigo=$codigo.'<td><legend><a href="RecursosAdministrador/modificarCertificacionEmpresa.php?codigo='.$fila["empresa_nit"].'">MODIFICAR</a></legend></td>';

			$codigo=$codigo.'</tr>';
		}
		$codigo=$codigo.'</table>';
		return $codigo;
	}

	function editarCertificacionEmpresa($datos){
		
		//Extraemos a $fila el registro
		if($fila=@mysqli_fetch_array($datos)){
			$nitActual=utf8_encode($fila["empresa_nit"]);
			$certificacionActual=utf8_encode($fila["certificacionempresa_estado"]);
			switch ($certificacionActual) {
				case 1:
					$certificacionActual="Certificada";
					break;
				case 2:
					$certificacionActual="En trámite";
					break;
				case 3:
					$certificacionActual="No certificada";
					break;		
				
				default:
					echo "Error al cargar certificación";
					break;
			}
			
			$codigoActual=($fila["empresa_nit"]);
			$codigo='<section id="section">
				<form action="modificadoCertificacionEmpresa.php" method="post">
				<fieldset><span>Puede modificar el estado de certificacion de esta Empresa:</span></fieldset><br><br>
				<fieldset>
					<legend>Nit: '.$nitActual.'</legend><br>
					<legend>Certificacion Actual: '.$certificacionActual.'</legend><br>
						
					<legend>Nueva Certificacion:</legend>
						<select id="span_aside" name="nuevacertificacion">
							<option id="span_aside" value="1">Certificada</option>
							<option id="span_aside" value="2">En tramite</option>
							<option id="span_aside" value="3">No Certificada</option>
							
						</select>					
					
					<input type="hidden" name="codigo" value="'.$codigoActual.'">
					<input type="submit" name="Submit" value="Guardar">
				</fieldset>
				</form>
				Regresar al panel <a href="../Administrador.php">administrador</a>
			</section>';
		}else{
			$codigo=false;
		}
		return $codigo;
	}


?>