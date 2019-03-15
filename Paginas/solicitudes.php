<?php 
include 'Recursos/header.php'; 
if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
  header('Location: Login.php');
}
?>
	<aside>
		<dl id="span_aside"><h3>Panel de solicitudes</h3>
			<dd><a href="Perfil.php">Regresar a mi perfil</a></dd>
			<dt>Solicitudes realizadas:</dt>
				<dd><a href="solicitudes.php?solicitud=Productos">En productos</a></dd>
				<dd><a href="solicitudes.php?solicitud=Servicios">En servicios</a></dd>
				<dd><a href="solicitudes.php?solicitud=Empresas">A Empresas</a></dd>
		</dl>
	</aside>
	<?php
	switch($_GET['solicitud']){
		case 'Productos': 
			$consulta="SELECT
				consulta_usuario_producto.fecha 'fecha',
				consulta_usuario_producto.usuario_id 'id',
				consulta_usuario_producto.consulta 'consulta',
				consulta_usuario_producto.producto_cod 'codProducto',
				empresa.empresa_nom 'nomEmpresa',
				producto.producto_nom 'nomProducto'  
				FROM consulta_usuario_producto
				INNER JOIN empresa
				ON
				empresa.empresa_nit=consulta_usuario_producto.empresa_nit
				INNER JOIN producto
				ON producto.producto_cod=consulta_usuario_producto.producto_cod
				HAVING usuario_id LIKE '".$_SESSION['usuario_id']."' ";

			$contar="SELECT COUNT(consulta_usuario_producto.consulta) 'rows'
			FROM consulta_usuario_producto
			WHERE usuario_id LIKE '".$_SESSION['usuario_id']."' $match $obra";
			
			
			/*FIN CASO UNO*/
		break;

		case 'Servicios': 
			$consulta="SELECT
				consulta_usuario_servicio.fecha 'fecha',
				consulta_usuario_servicio.usuario_id 'id',
				consulta_usuario_servicio.consulta 'consulta',
				consulta_usuario_servicio.servicio_cod 'codservicio',
				empresa.empresa_nom 'nomEmpresa',
				servicio.servicio_nom 'nomservicio'  
				FROM consulta_usuario_servicio
				INNER JOIN empresa
				ON
				empresa.empresa_nit=consulta_usuario_servicio.empresa_nit
				INNER JOIN servicio
				ON servicio.servicio_cod=consulta_usuario_servicio.servicio_cod
				HAVING usuario_id LIKE '".$_SESSION['usuario_id']."' ";

			$contar="SELECT COUNT(consulta_usuario_servicio.consulta) 'rows'
			FROM consulta_usuario_servicio
			WHERE usuario_id LIKE '".$_SESSION['usuario_id']."' $match $obra";
			/*
			$fecha="Fecha de solicitud ".$res['fecha'];
			$consulta="Consulta: ".$res['consulta'];
			$codElemento=$res['codProducto'];
			$nomEmpresa=$res['nomEmpresa'];
			*/
		break;

		case 'Empresas':
			$consulta="SELECT
				consulta_usuario_empresa.fecha 'fecha',
				consulta_usuario_empresa.usuario_id 'id',
				consulta_usuario_empresa.consulta 'consulta',
				consulta_usuario_empresa.empresa_cod 'codempresa',
				empresa.empresa_nom 'nomEmpresa',
				empresa.empresa_nom 'nomempresa'  
				FROM consulta_usuario_empresa
				INNER JOIN empresa
				ON
				empresa.empresa_nit=consulta_usuario_empresa.empresa_nit
				INNER JOIN empresa
				ON empresa.empresa_cod=consulta_usuario_empresa.empresa_cod
				HAVING usuario_id LIKE '".$_SESSION['usuario_id']."' ";

			$contar="SELECT COUNT(consulta_usuario_empresa.consulta) 'rows'
			FROM consulta_usuario_empresa
			WHERE usuario_id LIKE '".$_SESSION['usuario_id']."' $match $obra";
			/*$fecha="Fecha de solicitud ".$res['fecha'];
			$consulta="Consulta: ".$res['consulta'];
			$codElemento=$res['codProducto'];
			$nomEmpresa=$res['nomEmpresa'];
			*/
		break;
	}
	?>
<div id="filtrado">
		<form action="#" method="_GET">
			<fieldset>
				<label>Cantidad:</label>
					<select id="selectformulario" name="cantidad">
						<option value="10" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "10") {echo "selected"; } ?>>10</option>
						<option value="20" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "20") {echo "selected"; } ?> >20</option>
						<option value="30" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "30") {echo "selected"; } ?> >30</option>
						<option value="40" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "40") {echo "selected"; } ?>>40</option>
						<option value="50" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "50") {echo "selected"; } ?>>50</option>
					</select>				
			</fieldset>
			<fieldset>
				<label>Ordenar:</label>
					<select id="selectformulario" name="orden">
						<option value="recientes" <?php if (isset($_GET['orden']) && $_GET['orden']== "recientes") {echo "selected"; } ?> >Recientes</option>
						<option value="AZ" <?php if (isset($_GET['orden']) && $_GET['orden']== "AZ") {echo "selected"; } ?> >A-Z</option>
						<option value="ZA" <?php if (isset($_GET['orden']) && $_GET['orden']== "ZA") {echo "selected"; } ?> >Z-A</option>
					</select>				
			</fieldset>
			<fieldset>
				<label>Buscar:</label>
					<input type="text" name="productoBus" id="nom_pro" 
					value="<?php if (isset($_GET['productoBus']) && $_GET['productoBus'] !="") {echo $_GET['productoBus']; } ?>">
			</fieldset>
			<fieldset>
			<input id="Btn_filtrado" type="submit" value="Filtrar" alt="Publica tu producto" placeholder="Producto">
			</fieldset>
		</form>
</div>
<section id="section3">
	<article>
		<form>
			<?php
				switch ($_GET['cantidad']) {
					case 10:
						$limit="10";
						break;
					case 20:
						$limit="20";
						break;
					case 30:
						$limit="30";
						break;
					case 40:
						$limit="40";
						break;
					case 50:
						$limit="50";
						break;
					default:
						$limit="10";
						break;
				}
			
			if (isset($_GET['productoBus']) && $_GET['productoBus']!="" ) {
				$textoBus=$_GET['productoBus'];
				$textoBus= preg_replace("([ ]+)"," ",$textoBus);
				$match=" AND MATCH (servicio_nom, servicio_tipo, servicio_comenta) AGAINST ('$textoBus' IN NATURAL LANGUAGE MODE) ";
				
			}else{
				$match="";
			}

			if (isset($_GET['orden'])) {
				switch($_GET['orden']){
					case 'AZ':
						$productoAZ=" ORDER BY servicio.servicio_nom ASC ";
						break;
					case 'ZA':
						$productoAZ=" ORDER BY servicio.servicio_nom DESC ";
						break;
					case 'recientes':
						$productoAZ=" ORDER BY servicio.servicio_cod DESC ";
						break;
					default;
						$productoAZ=" ORDER BY servicio.servicio_nom DESC ";
						break;
				}
			}else{
				$productoAZ="";
			}

			if(isset($_POST['Resultados'])){
			  $off=$_POST['Resultados'].", ";
			}else{
			  $off="";
			}

			$queryRows=mysqli_query($conexion,$contar);
			$rows=mysqli_fetch_array($queryRows);
			$paginationSize=$rows['rows'];
					$xyz=mysqli_query($conexion, $consulta);
					while ($res=mysqli_fetch_array($xyz)) {
						 $ruta = "../Fotos/Empresa_".$res['nit']."/Producto_".$res['codigo'];
					      if (file_exists($ruta)) {
					        $foto = $ruta."/Servicio_1.png";
					      }
					      else{
					        $foto = "../img/logo_de_servicio.png";
					      } 
			?>
			</form>
			<ul id="item">
				<li><img id="imagenVistaInternaProducto" alt="Imagen Producto" target="_blank" src="<?=$foto?>"
              title="Imagen del producto"></li>
				<li>Código de servicio: <?php echo $res['codigo']?></li>
				<li> <a target="_blank" href="VistaServicio.php?codigo=<?=$res["codigo"]?>"><h3><?php echo $res['nombre']?></h3></a></li>
				<li>Tipo: <?php echo $res['tipo']?></li>
				<li>Cantidad: <?php echo $res['cantidad']?></li>
				<li>Descripción: 
					<?php 
		              if(strlen($res["descripcion"])<=30){
		                echo ($res["descripcion"]);
		              }else{
		                echo substr_replace($res["descripcion"],"...",30);}
		            ?>
                </li>
				<li>Mano de obra: <?php echo $res['obra']?></li>
				<li><a href="EdicionServicio.php?codigo=<?=$res["codigo"]?>"><input id="Btn_filtrado" type="button" value="Editar" alt="Publica tu producto"></a></li>
			</ul>
			<?php
			}
			?>
		
	</article>
	<article>
            <span>Resultados: (<b id="paginas">
              <?php if($paginationSize==0){
                echo ($paginationSize=0);
              }else{
                echo $paginationSize;
              }; ?>

             </b>) 
            </span>
            <?php
              
              $paginas = ceil($paginationSize/$limit); 

              ?>
            <form method="POST" id="pag">
              <ul id="navegacionPaginas">

                <li id="entradas">
                <?php

                if ($paginationSize >= $limit) {
                for ($i=0; $i<=($paginas-1) ; $i++) {
                    if($i==0){
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='<' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }elseif($i==($paginas-1)){
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='>' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }else{ 
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='".$i."' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }
                  }
                }
                ?>
                <script>
                    var paginas = document.getElementById("paginas");
                    var NavPaginas = document.getElementById("entradas");
                    var cantidad = paginas.textContent;
                    var inp=document.getElementById("pagina");
                    function mouseOver(x)
                    {  
                        newInp=document.createElement("input");
                        newInp.type = 'hidden';
                        newInp.name = 'Resultados';
                        newInp.value = `${(x*10)}`;
                        newInp.id = `${x}`;
                        NavPaginas.appendChild(newInp);
                    }
                    function mouseOut(x)
                    {  
                      var NavPaginas = document.getElementById("entradas");
                      newInp=document.getElementById(`${x}`);
                      NavPaginas.removeChild(newInp);
                    }
                </script>
              <input type="hidden" name=" " value="<?=$texto?>">
              <input type="hidden" name="filtros" value="<?=$_POST['filtros']?>">
              </li>

            </form>
            
          </article>
          <?php
              if ($paginationSize <= 3) {
                echo "<span id='special'></span>";
              }
            ?>
	</article>
</section>


			/*FIN CASO UNO*/
		break;

		case 'Servicios': 
			$consulta="SELECT
				consulta_usuario_servicio.fecha 'fecha',
				consulta_usuario_servicio.usuario_id 'id',
				consulta_usuario_servicio.consulta 'consulta',
				consulta_usuario_servicio.servicio_cod 'codservicio',
				empresa.empresa_nom 'nomEmpresa',
				servicio.servicio_nom 'nomservicio'  
				FROM consulta_usuario_servicio
				INNER JOIN empresa
				ON
				empresa.empresa_nit=consulta_usuario_servicio.empresa_nit
				INNER JOIN servicio
				ON servicio.servicio_cod=consulta_usuario_servicio.servicio_cod
				HAVING usuario_id LIKE '".$_SESSION['usuario_id']."' ";

			$contar="SELECT COUNT(consulta_usuario_servicio.consulta) 'rows'
			FROM consulta_usuario_servicio
			WHERE usuario_id LIKE '".$_SESSION['usuario_id']."' $match $obra";
			/*
			$fecha="Fecha de solicitud ".$res['fecha'];
			$consulta="Consulta: ".$res['consulta'];
			$codElemento=$res['codProducto'];
			$nomEmpresa=$res['nomEmpresa'];
			*/
		break;

		case 'Empresas':
			$consulta="SELECT
				consulta_usuario_empresa.fecha 'fecha',
				consulta_usuario_empresa.usuario_id 'id',
				consulta_usuario_empresa.consulta 'consulta',
				consulta_usuario_empresa.empresa_cod 'codempresa',
				empresa.empresa_nom 'nomEmpresa',
				empresa.empresa_nom 'nomempresa'  
				FROM consulta_usuario_empresa
				INNER JOIN empresa
				ON
				empresa.empresa_nit=consulta_usuario_empresa.empresa_nit
				INNER JOIN empresa
				ON empresa.empresa_cod=consulta_usuario_empresa.empresa_cod
				HAVING usuario_id LIKE '".$_SESSION['usuario_id']."' ";

			$contar="SELECT COUNT(consulta_usuario_empresa.consulta) 'rows'
			FROM consulta_usuario_empresa
			WHERE usuario_id LIKE '".$_SESSION['usuario_id']."' $match $obra";
			/*$fecha="Fecha de solicitud ".$res['fecha'];
			$consulta="Consulta: ".$res['consulta'];
			$codElemento=$res['codProducto'];
			$nomEmpresa=$res['nomEmpresa'];
			*/
		break;
	}
	?>
<div id="filtrado">
		<form action="#" method="_GET">
			<fieldset>
				<label>Cantidad:</label>
					<select id="selectformulario" name="cantidad">
						<option value="10" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "10") {echo "selected"; } ?>>10</option>
						<option value="20" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "20") {echo "selected"; } ?> >20</option>
						<option value="30" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "30") {echo "selected"; } ?> >30</option>
						<option value="40" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "40") {echo "selected"; } ?>>40</option>
						<option value="50" <?php if (isset($_GET['cantidad']) && $_GET['cantidad']== "50") {echo "selected"; } ?>>50</option>
					</select>				
			</fieldset>
			<fieldset>
				<label>Ordenar:</label>
					<select id="selectformulario" name="orden">
						<option value="recientes" <?php if (isset($_GET['orden']) && $_GET['orden']== "recientes") {echo "selected"; } ?> >Recientes</option>
						<option value="AZ" <?php if (isset($_GET['orden']) && $_GET['orden']== "AZ") {echo "selected"; } ?> >A-Z</option>
						<option value="ZA" <?php if (isset($_GET['orden']) && $_GET['orden']== "ZA") {echo "selected"; } ?> >Z-A</option>
					</select>				
			</fieldset>
			<fieldset>
				<label>Buscar:</label>
					<input type="text" name="productoBus" id="nom_pro" 
					value="<?php if (isset($_GET['productoBus']) && $_GET['productoBus'] !="") {echo $_GET['productoBus']; } ?>">
			</fieldset>
			<fieldset>
			<input id="Btn_filtrado" type="submit" value="Filtrar" alt="Publica tu producto" placeholder="Producto">
			</fieldset>
		</form>
</div>
<section id="section3">
	<article>
		<form>
			<?php
				switch ($_GET['cantidad']) {
					case 10:
						$limit="10";
						break;
					case 20:
						$limit="20";
						break;
					case 30:
						$limit="30";
						break;
					case 40:
						$limit="40";
						break;
					case 50:
						$limit="50";
						break;
					default:
						$limit="10";
						break;
				}
			
			if (isset($_GET['productoBus']) && $_GET['productoBus']!="" ) {
				$textoBus=$_GET['productoBus'];
				$textoBus= preg_replace("([ ]+)"," ",$textoBus);
				$match=" AND MATCH (servicio_nom, servicio_tipo, servicio_comenta) AGAINST ('$textoBus' IN NATURAL LANGUAGE MODE) ";
				
			}else{
				$match="";
			}

			if (isset($_GET['orden'])) {
				switch($_GET['orden']){
					case 'AZ':
						$productoAZ=" ORDER BY servicio.servicio_nom ASC ";
						break;
					case 'ZA':
						$productoAZ=" ORDER BY servicio.servicio_nom DESC ";
						break;
					case 'recientes':
						$productoAZ=" ORDER BY servicio.servicio_cod DESC ";
						break;
					default;
						$productoAZ=" ORDER BY servicio.servicio_nom DESC ";
						break;
				}
			}else{
				$productoAZ="";
			}

			if(isset($_POST['Resultados'])){
			  $off=$_POST['Resultados'].", ";
			}else{
			  $off="";
			}

			$queryRows=mysqli_query($conexion,$contar);
			$rows=mysqli_fetch_array($queryRows);
			$paginationSize=$rows['rows'];
					$xyz=mysqli_query($conexion, $consulta);
					while ($res=mysqli_fetch_array($xyz)) {
						 $ruta = "../Fotos/Empresa_".$res['nit']."/Producto_".$res['codigo'];
					      if (file_exists($ruta)) {
					        $foto = $ruta."/Servicio_1.png";
					      }
					      else{
					        $foto = "../img/logo_de_servicio.png";
					      } 
			?>
			</form>
			<ul id="item">
				<li><img id="imagenVistaInternaProducto" alt="Imagen Producto" target="_blank" src="<?=$foto?>"
              title="Imagen del producto"></li>
				<li>Código de servicio: <?php echo $res['codigo']?></li>
				<li> <a target="_blank" href="VistaServicio.php?codigo=<?=$res["codigo"]?>"><h3><?php echo $res['nombre']?></h3></a></li>
				<li>Tipo: <?php echo $res['tipo']?></li>
				<li>Cantidad: <?php echo $res['cantidad']?></li>
				<li>Descripción: 
					<?php 
		              if(strlen($res["descripcion"])<=30){
		                echo ($res["descripcion"]);
		              }else{
		                echo substr_replace($res["descripcion"],"...",30);}
		            ?>
                </li>
				<li>Mano de obra: <?php echo $res['obra']?></li>
				<li><a href="EdicionServicio.php?codigo=<?=$res["codigo"]?>"><input id="Btn_filtrado" type="button" value="Editar" alt="Publica tu producto"></a></li>
			</ul>
			<?php
			}
			?>
		
	</article>
	<article>
            <span>Resultados: (<b id="paginas">
              <?php if($paginationSize==0){
                echo ($paginationSize=0);
              }else{
                echo $paginationSize;
              }; ?>

             </b>) 
            </span>
            <?php
              
              $paginas = ceil($paginationSize/$limit); 

              ?>
            <form method="POST" id="pag">
              <ul id="navegacionPaginas">

                <li id="entradas">
                <?php

                if ($paginationSize >= $limit) {
                for ($i=0; $i<=($paginas-1) ; $i++) {
                    if($i==0){
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='<' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }elseif($i==($paginas-1)){
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='>' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }else{ 
                    echo "<input  id='p".$i."' type='submit' name='R".$i."' value='".$i."' onmouseover='mouseOver(".$i.")' onmouseout='mouseOut(".$i.")'>"; 
                    }
                  }
                }
                ?>
                <script>
                    var paginas = document.getElementById("paginas");
                    var NavPaginas = document.getElementById("entradas");
                    var cantidad = paginas.textContent;
                    var inp=document.getElementById("pagina");
                    function mouseOver(x)
                    {  
                        newInp=document.createElement("input");
                        newInp.type = 'hidden';
                        newInp.name = 'Resultados';
                        newInp.value = `${(x*10)}`;
                        newInp.id = `${x}`;
                        NavPaginas.appendChild(newInp);
                    }
                    function mouseOut(x)
                    {  
                      var NavPaginas = document.getElementById("entradas");
                      newInp=document.getElementById(`${x}`);
                      NavPaginas.removeChild(newInp);
                    }
                </script>
              <input type="hidden" name=" " value="<?=$texto?>">
              <input type="hidden" name="filtros" value="<?=$_POST['filtros']?>">
              </li>

            </form>
            
          </article>
          <?php
              if ($paginationSize <= 3) {
                echo "<span id='special'></span>";
              }
            ?>
	</article>
</section>

<?php include 'Recursos/footer.php'; ?>