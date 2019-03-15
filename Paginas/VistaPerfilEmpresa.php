<?php include 'Recursos/header.php';?>
<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
	</aside>
<section id="main">
      </section >
<section id="section">
		<?php 
			$nit = $_GET['nit'];
			$consulta = mysqli_query($conexion,"SELECT * from empresa where empresa_nit = '$nit'");
			$datos = mysqli_fetch_array($consulta);
			$Direccion = $datos['empresa_dir'];
			$Telefono = $datos['empresa_tel1'];
			$Correo = $datos['empresa_email'];
			$NomContacto = $datos['empresa_nom_contac'];
			$PaginaWeb = $datos['empresa_pagina'];
			$Antiguedad = $datos['empresa_antig'];
			$FacturaAnual = $datos['empresa_fact_anual'];
			$NumEmpleados = $datos['empresa_num_empl'];
			$EmpresaFoto = $datos['empresa_foto'];			
			$Nombre = $datos['empresa_nom'];
			$ruta = "../Fotos/Empresa_".$nit;
			if (file_exists($ruta)) {
				$foto = $ruta."/Perfil.png";
			}
			else{
				$foto = "../img/logo_de_fabrica.png";
			}
		?>
		<section id="best">
			<center><img class="perfil" id="pic" src="<?=$foto?>" ></center>
					<h1><dd> <?=$Nombre?></dd></h1>
						<div id="datos">
							<h5> Teléfono: <?=$Telefono?>  | Correo: <?=$Correo?></h5>
						</div><br>
								<span>Información</span>
						<ul id="informacionUsuario">
			 				<li>Dirección: <b><?=$Direccion?></b></li>
		    					<?php if ($NumEmpleados!=0) {
		    					?>
		    					<li>Número de Empleados: <b> 	$NumEmpleados;</b>
		    					<?php } ?>
		    				</b></li>
		    				<?php if ($NumEmpleados!=0) {
		    					?>
		    					<li>Facturación Anual: <b> 	$FacturaAnual;</b>
		    					<?php } ?>
			 				<li>Antigüedad: <b><?=$Antiguedad?> Años</b></li>
		    				<li>Pagina Web: <a target="_blank" href="http://<?=$PaginaWeb?>"><?=$PaginaWeb?></a></li>
		    			</ul>
		    			<article id="informacion">
		        <input id="Btn_filtrado_form2" type="button" value="Solicitar" alt="Buscar" onclick="Solicitar()">
		 </article>
		 <?php 
		 //antes de definir la accion al clickear en boton para el fomrulario
		 	switch ($_SESSION['rol']) {
		 		case '3':
				 	$action="";
	 				break;
	 			case '2':
				 	$action="";
	 				break;
	 			default:
	 				$action="../Paginas/PaginaSeleccionRegistro.php";
	 				break;
			}

		?>
		 <script type="text/javascript">
		 	function Solicitar(){
		 		var boton=document.getElementById("Btn_filtrado_form2");
		 		boton.style.zIndex="-1";
		 		boton.style.visibility="hidden";

		 		var enMain=document.getElementById("main");
		 		var enDiv=document.createElement("div");
		 			enDiv.id="ventana";
		 		
		 		var close=document.createElement("div");
		 			close.id="cerrar";
		 			close.onclick=function clo(){
		 				enMain.removeChild(enDiv);
		 				document.getElementById("best").style.filter="none";
		 				boton.style.zIndex="1";
		 				boton.style.visibility="visible";
		 			};

		 		enMain.appendChild(enDiv);
		 		ventana=document.getElementById("ventana");
		 		ventana.style.zIndex="10000";
		 		var form=document.createElement("form"); 
		 			form.method="post";
		 			form.action="<?php echo $action ?>";

		 		ventana.appendChild(close);
			    ventana.appendChild(form);
			    ventana.appendChild(form);

			    var fieldset=document.createElement("fieldset");
			    	fieldset.id="fieldsetV";

			    var legend=document.createElement("legend");  
			    	legend.id="legendV";
			    	legend.innerHTML = "<?php echo "Le enviaremos un mensaje a ".$nombre_emp." de tu parte."; ?>";

			    var input=document.createElement("textarea");
			    	input.name="consulta";
			    	input.id="message";
			    	input.placeholder="Introduce aquí tu solucitud";

			    var inputsub=document.createElement("input");
			    	inputsub.type="submit";
			    	inputsub.id="pos";
			    	inputsub.value="Solicitar";
			    	inputsub.name="Solicitar";

			    var span=document.createElement("span");  
			    	span.id="spanV";

			    form.appendChild(fieldset);
			    form.appendChild(legend);
			    form.appendChild(span);
			    form.appendChild(input);
			    form.appendChild(inputsub);
			    document.getElementById("best").style.filter="blur(10px)";
			    //document.getElementById("ventana").style.zIndex="10000";
		 	}
		 </script>
	<?php
		 //si se llena el formulario 
		 if (isset($_POST['Solicitar'])) {
		 		switch ($_SESSION['rol']) {
		 			case '3':
	 				$consulta=$_POST['consulta'];
			 		$usu=$_SESSION['usuario_id'];
			 		$statement="INSERT INTO consulta_usuario_producto values(default,NOW(),'$nit','$usu','$consulta','$codigo')";
			 		$insercion=mysqli_query($conexion,$statement);
				 	if($insercion) {
				 		echo "Hemos enviado tu solicitud";
				 	}
	 				break;
	 			case '2':
	 				$consulta=$_POST['consulta'];
			 		$empresaConsultante=$_SESSION['empresa_nit'];
			 		$statement="INSERT INTO consulta_empresa_producto values(default,NOW(),'$nit','$empresaConsultante','$consulta','$codigo')";
			 		$insercion=mysqli_query($conexion,$statement);
				 	if($insercion) {
				 		$ressultado="Hemos enviado tu solicitud";
				 	}
	 				break;
	 			default:
	 				echo "Ha ocurrido un error";
	 				break;
			}		 	
		}
	?>
		</section>
</section>


<?php include 'Recursos/footer.php';?>