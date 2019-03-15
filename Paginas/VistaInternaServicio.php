<?php 
include 'Recursos/header.php'; 
if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
  header('Location: Login.php');
}
?>
<aside>
	<dl id="span_aside"><h3>Panel Administrador</h3>
		<dt>Productos:</dt>
			<dd><a href="VistaInternaProducto.php">Ver mis productos</a></dd>
			<dd><a href="FormularioCreacionProducto.php">Crear un nuevo producto</a></dd>
		<dt>Servicios:</dt>
			<dd><a href="VistaInternaServicio.php">Ver mis servicios</a></dd>
			<dd><a href="FormularioCreacionServicio.php">Crear un nuevo servicio</a></dd>
		<dt>Cuenta:</dt>
			<dd><a href="Perfil.php">Volver a mi perfil</a></dd>
	</dl>
</aside>
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
			$consulta="SELECT servicio.servicio_cod 'codigo',servicio.servicio_nom 'nombre', servicio.servicio_foto 'foto', servicio.servicio_mobra 'obra', servicio.servicio_mobra 'muestras', servicio.servicio_comenta 'descripcion', servicio.servicio_mobra 'cantidad', servicio.servicio_tipo 'tipo', empresa.empresa_nom 'empresa_nom', empresa.empresa_nit 'nit' FROM servicio
				INNER JOIN empresa ON empresa.empresa_nit=servicio.empresa_nit
				HAVING empresa_nit LIKE '".$_SESSION['empresa_nit']."' $match $productoAZ LIMIT ".$off." ".$limit."  ";
				
			$contar="SELECT COUNT(servicio.servicio_cod) 'rows'
			FROM servicio
			INNER JOIN empresa 
			ON empresa.empresa_nit=servicio.empresa_nit 
			WHERE empresa.empresa_nit LIKE '".$_SESSION['empresa_nit']."' $match $obra;";
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