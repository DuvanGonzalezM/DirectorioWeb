<?php include 'Recursos/header.php'; 
header ('Content-type: text/html; charset=utf-8');
?>
<?php 
	$codigo = $_GET['codigo'];
	$consulta=mysqli_query($conexion,"SELECT producto.empresa_nit,producto_nom,producto_tipo,producto_descrip,producto_precio,producto_stock,product_cant_min_venta,producto_envia_muestras,empresa_nom,producto_foto from producto inner join empresa on empresa.empresa_nit = producto.empresa_nit where producto_cod = '$codigo'");
	$datos=mysqli_fetch_array($consulta);
	$nit = $datos['empresa_nit']; 
	$nombre_pro = $datos['producto_nom'];
	$nombre_emp = $datos['empresa_nom'];
	$tipo = $datos['producto_tipo'];
	$descripcion = $datos['producto_descrip'];
	$precio = $datos['producto_precio'];
	$stock = $datos['producto_stock'];
	if ($stock=="si") {
		$stock="Disponible"."<img class='ico' title='Disponible' src='..//img/Enstock.png'>";
	}elseif ($stock=="no") {
		$stock="No disponible"."<img class='ico' title='No Disponible' src='..//img/Sinstock.png'>";
	}
	
	$cantidad_mini = $datos['product_cant_min_venta'];
	$muestras = $datos['producto_envia_muestras'];
	$ruta = "../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo;
	$array_cantidad=scandir($ruta);
	$cantidad_array=count($array_cantidad);
	$cantidad_definitiva=$cantidad_array-3;
			if (file_exists($ruta)) {				
				$foto1="../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo."/Producto_1.png";
				$foto2="../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo."/Producto_2.png";
				$foto3="../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo."/Producto_3.png";
				$foto4="../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo."/Producto_4.png";
				$foto5="../Fotos/Empresa_".$nit."/Productos/Producto_".$codigo."/Producto_5.png";
			}
			else{
				$foto1 = "../img/logo_de_producto.png";
			}
?>
   <head>
      <link rel="stylesheet" type="text/css" href="..//css/estilovistap.css">
   </head>
      <!-- section darí¡ inicio al cuarpo-->
      <section id="main">
      </section >
      <section id="best">
      <section class="main" >
	      <article id="slider">
		      <?php switch ($cantidad_definitiva){ 
		         case 1:?>
		         <!--Sheet Slider-->
		      	<div class="sheetSlider sh-default sh-auto">
		         <input id="s2" type="radio" name="slide1"/> 
		         <div class="sh__content">
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto1?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		         </div>
		         <!-- .sh__content -->
		         <!-- .sh__arrows -->
		      </div>
		      <?php break;
		         case 2:?>
		      <!--Sheet Slider-->
		      <div class="sheetSlider sh-default sh-auto">
		         <input id="s1" type="radio" name="slide1" checked/> 
		         <input id="s2" type="radio" name="slide1"/> 
		         <div class="sh__content">
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto1?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto2?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		         </div>
		         <!-- .sh__content -->
		         <!--botones-->
		         <div class="sh__btns">
		            <label for="s1"></label>
		            <label for="s2"></label>
		         </div>
		         <!-- .sh__btns -->
		         <!--flechas-->
		         <div class="sh__arrows">
		            <label for="s1"></label>
		            <label for="s2"></label>
		         </div>
		         <!-- .sh__arrows -->
		      </div>
		      <?php break;
		         case 3:?>
		      <!--Sheet Slider-->
		      <div class="sheetSlider sh-default sh-auto">
		         <input id="s1" type="radio" name="slide1" checked/> 
		         <input id="s2" type="radio" name="slide1"/> 
		         <input id="s3" type="radio" name="slide1"/> 
		         <div class="sh__content">
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto1?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto2?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto3?>" alt="imgText"/>
		            </div>
		         </div>
		         <!-- .sh__content -->
		         <!--botones-->
		         <div class="sh__btns">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		         </div>
		         <!-- .sh__btns -->
		         <!--flechas-->
		         <div class="sh__arrows">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		         </div>
		         <!-- .sh__arrows -->
		      </div>
		      <?php break;
		         case 4:?>
		      <!--Sheet Slider-->
		      <div class="sheetSlider sh-default sh-auto">
		         <input id="s1" type="radio" name="slide1" checked/> 
		         <input id="s2" type="radio" name="slide1"/> 
		         <input id="s3" type="radio" name="slide1"/> 
		         <input id="s4" type="radio" name="slide1"/> 
		         <div class="sh__content">
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto1?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto2?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto3?>" alt="imgText"/>
		               <!-- Item Info -->
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto4?>" alt="imgText"/>
		               <!-- Item Info -->
		            </div>
		         </div>
		         <!-- .sh__content -->
		         <!--botones-->
		         <div class="sh__btns">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		            <label for="s4"></label>
		         </div>
		         <!-- .sh__btns -->
		         <!--flechas-->
		         <div class="sh__arrows">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		            <label for="s4"></label>			    
		         </div>
		         <!-- .sh__arrows -->
		      </div>
		      <?php break;
		         case 5:?>
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
		               <img src="<?=$foto1?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		                  <h4><?=$nombre_pro?></h4>
		                  <span><?=$tipo?></span>
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto2?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		                  <h4><?=$nombre_pro?></h4>
		                  <span><?=$tipo?></span>
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto3?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		                  <h4><?=$nombre_pro?></h4>
		                  <span><?=$tipo?></span>
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto4?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		                  <h4><?=$nombre_pro?></h4>
		                  <span><?=$tipo?></span>
		               </div>
		            </div>
		            <!-- Slider Item -->
		            <div class="sh__item">
		               <img src="<?=$foto5?>" alt="imgText"/>
		               <!-- Item Info -->
		               <div class="sh__meta">
		                  <h4><?=$nombre_pro?></h4>
		                  <span><?=$tipo?></span>
		               </div>
		            </div>
		         </div>
		         <!-- .sh__content -->
		         <!--botones-->
		         <div class="sh__btns">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		            <label for="s4"></label>
		            <label for="s5"></label>
		         </div>
		         <!-- .sh__btns -->
		         <!--flechas-->
		         <div class="sh__arrows">
		            <label for="s1"></label>
		            <label for="s2"></label>
		            <label for="s3"></label>
		            <label for="s4"></label>
		            <label for="s5"></label>
		         </div>
		         <!-- .sh__arrows -->
		      </div>
		      <?php break;
		      		default:?>
		      		<img src="<?=$foto1?>" alt="imgText"/>	
		       <?php  
		         }?>
	      </article>
		  <article id="informacion">
		  		<ul class="lista_producto">
		  		 <li class="codigo"><b>Codigo:</b> <?=$codigo?></li>
		  		 <li><h3><b>Producto:</b> <?=$nombre_pro?></h3></li>
		         <li><b>Nombre Proveedor:</b> <?=$nombre_emp?></li>
		         <li><b>Tipo Producto:</b> <?=$tipo?></li>
		         <li><b>Cantidad mí­nima para venta:</b> <?=$cantidad_mini?></li>
		         <li><b>Disponible en stock  :</b> <?=$stock?></li>
		         <li><b>El proveedor enví­a muestras?:</b> <?=$muestras?></li>
		         <li><b>Precio :</b> $<?=$precio?></li>
		        </ul>
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

		<section class="descriptivos">
		      <article id="descrip">
		         <fieldset>
		            <legend>Descripción del producto</legend>
		            <p id="desc1"><?=$descripcion?></p>
		         </fieldset>
		      </article>
		      <article id="coment">
		         <fieldset>
		            <legend>Comentarios de otro usuarios que adquirieron el producto</legend>
		            <p id="Comen1"> Comentario de usuario 1</p>
		            <p id="Comen2"> Comentario de usuario 2</p>
		         </fieldset>
		      </article>
		      <article id="envio">
		         <fieldset>
		            <legend>Productos relacionados</legend>
		            <p id="env1"> Productos que también te pueden interesar</p>
		         </fieldset>
		      </article>
	      </section>
      </section>
</section>
<?php include 'Recursos/footer.php'; ?>