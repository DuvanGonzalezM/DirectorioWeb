<?php include 'Recursos/header.php'; ?>
<?php
require 'Recursos/conexion.php';
?>
<?php
$texto = $_POST['search'];
if (isset($_POST['filtros'])) {
switch ($_POST['filtros']) {
case "producto":
?>
<aside>
  <h3>Flitrar Resultados</h3>
  <span>
    <a class="linkEsp" target="_blank" title="consulta especializada" href="FormularioConsulta.php">Consulta Especializada.
    </a>
  </span>
  <dl id="span_aside">
 	<form method="POST">
	    <dt>Se encontraron: <?php ;?>
	    </dt>
	    <dd>
	      <a href="#index">Animal (0)
	      </a>
	    </dd>
	    <dd>
	      <a href="#index">vegetal (0)
	      </a>
	    </dd>
	    <dd>
	      <a href="#index">Mineral (0)
	      </a>
	    </dd>
	    <dt>Mostrar solo:
	    </dt>
	    <dd>
	      <label class="container">En stock
	        <input type="checkbox" name="stock" 
            <?php 
            if(isset($_POST['stock'])){echo "checked";}
            ?>  
          />
	        <span class="checkmark">
	        </span>
	      </label>
	    </dd>
	    <dd>
	      <label class="container">Envían muestras
	        <input type="checkbox" name="muestras"
            <?php 
            if(isset($_POST['muestras'])){echo "checked";}
            ?>
          />
                  
	        <span class="checkmark">
	        </span>
	      </label>
	    </dd>
	    <dt>Cantidad para venta:
	    </dt>
	    <dd>
	      <label class="Rcontainer">Cualquiera
	        <input type="radio" name="radio" value="0" <?php 
            if(($_POST['radio'])==0){echo "checked";}
            ?>>
	        <span class="Rcheckmark">
	        </span>
	      </label>
	    </dd>
	    <dd>
	      <label class="Rcontainer">Menos de 100gr o menos de 100mL
	        <input type="radio" name="radio" value="100" <?php 
            if(($_POST['radio'])==100){echo "checked";}
            ?> >
	        <span class="Rcheckmark">
	        </span>
	      </label>
	    </dd>
	    <dd>
	      <label class="Rcontainer">Hasta 1Kg o hasta 1L
	        <input type="radio" name="radio" value="1000" <?php 
            if(($_POST['radio'])==1000){echo "checked";}
            ?>>
	        <span class="Rcheckmark">
	        </span>
	      </label>
	    </dd>
	    <dd>.
	      <label class="Rcontainer">Más de 25kg
	        <input type="radio" name="radio" value="25000" <?php 
            if(($_POST['radio'])==25000){echo "checked";}
            ?>>
	        <span class="Rcheckmark">
	        </span>
	      </label>
	    </dd>
      <input type="hidden" name="search" value="<?=$texto?>">
      <input type="hidden" name="filtros" value="<?=$_POST['filtros']?>">
	    <input id="Btn_filtrado_form" type="submit" name="filtro" value="Filtrar">
	</form>

  </dl>
</aside>
<section id="section">
  <article class="resultados">
    <span>
      <?php echo $mensaje; ?>
    </span>
  </article>
  <article>
    <?php
    if (isset($_POST['stock'])) {
    	$stock=" AND producto_stock LIKE 'si' ";
    }else{
    	$stock="";
    }
    if (isset($_POST['muestras'])) {
      $Emuestras=" AND producto_envia_muestras LIKE 'si' ";
    }else{
      $Emuestras="";
    }
    if (isset($_POST['radio'])) {
      switch ($_POST['radio']) {
        case 100:
          $cantidad= " AND product_cant_min_venta <='100' ";
          break;
        case 1000:
          $cantidad= " AND product_cant_min_venta <='1000' ";
          break;
        case 25000:
          $cantidad= " AND product_cant_min_venta >='25000' ";
          break;
        case '0':
          $cantidad= "";
          break;
      }
    }

$limite=10;
if(isset($_POST['Resultados'])){
  $off=$_POST['Resultados'].", ";
}else{
  $off="";
}
$consulta="SELECT 
PRO1.producto_cod	'codigo',
empresa.empresa_nit 'nit',
PRO1.producto_nom	'nombre',
certificacionempresa.certificacionempresa_estado 'cerificacion',
PRO1.producto_foto	'foto',
PRO1.producto_stock	'stock',
PRO1.producto_envia_muestras'muestras',
PRO1.producto_descrip 'descripcion',
PRO1.product_cant_min_venta 'cantidad',
PRO1.producto_tipo 'tipo',
empresa.empresa_nom 'empresa_nom' 
FROM producto 
as 	PRO1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=PRO1.empresa_nit 
INNER JOIN
(SELECT producto_nom,producto_stock,producto_envia_muestras,product_cant_min_venta FROM producto 
WHERE
MATCH (producto_nom,producto_descrip) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE) $stock $Emuestras $cantidad LIMIT  $off $limite) 
AS PRO2
ON PRO1.producto_nom=PRO2.producto_nom
INNER JOIN empresa ON empresa.empresa_nit=PRO1.empresa_nit
ORDER by certificacionempresa_estado asc" ;
//consulta el tamaño apra crear la paginación
$queryRows=mysqli_query($conexion,"SELECT COUNT(PRO1.producto_cod) 'rows'
FROM producto 
as  PRO1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=PRO1.empresa_nit 
INNER JOIN
(SELECT producto_nom,producto_stock,producto_envia_muestras,product_cant_min_venta FROM producto 
WHERE
MATCH (producto_nom,producto_descrip) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE) $stock $Emuestras $cantidad) 
AS PRO2
ON PRO1.producto_nom=PRO2.producto_nom
INNER JOIN empresa ON empresa.empresa_nit=PRO1.empresa_nit");
$rows=mysqli_fetch_array($queryRows);
$paginationSize=$rows['rows'];
//inicia consulta y resultados de items
$categoria=mysqli_query($conexion, $consulta);
$xyz=mysqli_query($conexion, $consulta);
//guardaremos una cantidad de registros para asi mismo 
//generar una respuesta y evitar que la pagina quede vacia
$cantidadRegistros = mysqli_num_rows($xyz);

if ($cantidadRegistros>0) {
while ($res=mysqli_fetch_array($xyz)) {
  $ruta = "../Fotos/Empresa_".$res['nit']."/Productos/Producto_".$res['codigo'];
      if (file_exists($ruta)) {
        $foto = $ruta."/Producto_1.png";
      }
      else{
        $foto = "../img/logo_de_producto.png";
      } 
//echo("<br>".$consulta."<br>");
?>
    <ul id="item">
      <li>
        <a target="_blank" href="VistaProducto.php?codigo=<?=$res["codigo"]?>">
          <img alt="Imagen Producto" src="<?=$foto?>" title="Imagen del producto">
        </a>
        <a target="_blank" href="VistaProducto.php?codigo=<?=$res["codigo"]?>">
          <img alt="Imagen Agenda" class="Agenda" src="../img/Agenda.png" title="Agendar para consulta">
        </a>
      </li>
      <li>
        <a target="_blank" href="VistaProducto.php?codigo=<?=$res["codigo"]?>" title="haz click para ver más información">
          <h3>
            <?php switch ($res['cerificacion']) {
              case 1:
                echo $res['nombre']."<img class='cert' src='..///img/certificada.png' alt='Cerificación' title='Empresa Certificada'>";
                break;
              case 2:
                echo $res['nombre']."<img class='cert' src='..///img/EnTramite.png' alt='Cerificación' title='Certificación en trámite'>";
                break;
              case 3:
                echo $res['nombre']."<img href='cerificacion.php' class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
              default:
                echo $res['nombre']."<img class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
             } 
            ?>
          </h3>
        </a>
      </li>
      <li>
        <a target="_blank" title="Haz click para ver la pagina del proveedor" href="PaginaProveedor.php">
          <?php echo "Proveedor: ".$res['empresa_nom']; ?>
        </a>
      </li>
      <li>
        <?php echo "Tipo: ".$res["tipo"]; ?>
      </li>
      <li>
        <?php echo "Cantidad: ".$res["cantidad"]; ?>
      </li>
      <li>
        <?php echo "Descripción: ".$res["descripcion"]; ?>
      </li>
      <li>
        <?php echo "Stock: ".$res["stock"]; ?>
      </li>
      <li>
        <?php echo "Muestras: ".$res["muestras"]; ?>
      </li>
      <li>
        <a target="_blank" title="haz click para ver la pagina del producto" href="VistaProducto.php?codigo=<?=$res["codigo"]?>">Ver información completa...
        </a>
      </li>
    </ul>
    <?php 
}
}else{
?>
    <ul id="item" class="special">
      <li>
        <a href="VistaProducto.php">
          <img alt="Imagen Producto" src="..//img/logo_de_producto.png ?>" title="Imagen del producto">
        </a>
      </li>
      <li>
        <a href="VistaProducto.php" title="haz click para ver más información">
          <h3>Ops... parece que no encontramos productos en tu búsqueda
          </h3>
        </a>
      </li>
      <li>Intenta reducir los términos de tu búsqueda
      </li>
      <li>o intenta usar términos más genéricos
      </li>
      <li>Ejemplo: en lugar de buscar "Acido CÍtrico U.S.P"
      </li>
      <li>Intenta buscando "acido Citrico"
      </li>
      <li>
        <a title="haz click para ver la pagina de ayuda del sitio" href="producto.php">Página de Preguntas frecuentes...
        </a>
      </li>
    </ul>
    <?php
}
break;
case "servicio":
?>
    <aside>
      <h3>Flitrar Resultados
      </h3>
      <span>
        <a class="linkEsp" target="_blank" title="consulta especializada" href="FormularioConsulta.php">Consulta Especializada.
        </a>
      </span>
      <dl id="span_aside">
        <dt>Tipo:
        </dt>
        <dd>
          <a href="#index">Envasado (0)
          </a>
        </dd>
        <dd>
          <a href="#index">transporte (0)
          </a>
        </dd>
        <dd>
          <a href="#index">acondicionamiento (0)
          </a>
        </dd>
      </dl>
    </aside>
    <section id="section">
      <article class="resultados">
        <span>
          <?php echo $cantidadRegistros ?>
        </span>
      </article>
      <article>
        <?php
$resultados=1;

$consulta="SELECT servicio_nom 'nombre',
empresa.empresa_nit 'nit',
servicio_tipo 'tipo',
servicio_cod 'codigo',
SER1.servicio_comenta 'comentario',
certificacionempresa.certificacionempresa_estado 'cerificacion',
servicio_mobra 'costo',
servicio_foto 'foto',
empresa.empresa_nom 'empresa_nom'
FROM servicio 
as 	SER1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=SER1.empresa_nit 
INNER JOIN
(SELECT servicio_comenta FROM servicio 
WHERE
MATCH (servicio.servicio_nom,servicio.servicio_tipo,servicio.servicio_comenta) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE) LIMIT 10) 
AS SER2
ON SER1.servicio_comenta=SER2.servicio_comenta
INNER JOIN empresa ON empresa.empresa_nit=SER1.empresa_nit
ORDER by certificacion_id $sortAlso";
//consulta el tamaño apra crear la paginación
$queryRows=mysqli_query($conexion,"SELECT COUNT(SER1.servicio_cod) 'rows'
FROM servicio 
as  SER1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=SER1.empresa_nit 
INNER JOIN
(SELECT servicio_nom FROM servicio 
WHERE
MATCH (servicio_nom,servicio_comenta,servicio_tipo) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE) ) 
AS SER2
ON SER1.servicio_nom=SER2.servicio_nom
INNER JOIN empresa ON empresa.empresa_nit=SER1.empresa_nit");
$rows=mysqli_fetch_array($queryRows);
$paginationSize=$rows['rows'];
$xyz=mysqli_query($conexion, $consulta);
$cantidadRegistros = mysqli_num_rows($xyz);
if ($cantidadRegistros>0) {
while ($res=mysqli_fetch_array($xyz)) {
  $ruta = "../Fotos/Empresa_".$res['nit']."/Servicios/Servicio_".$res['codigo'];
      if (file_exists($ruta)) {
        $foto = $ruta."/Servicio_1.png";
      }
      else{
        $foto = "../img/logo_de_servicio.png";
      } 
?>
        <ul id="item">
          <li>
            <a href="VistaServicio.php?codigo=<?=$res["codigo"]?>">
              <img alt="Imagen Producto" src="<?=$foto?>" title="Imagen del producto">
              <h3>
            <?php switch ($res['cerificacion']) {
              case 1:
                echo "<img class='cert' src='..///img/certificada.png' alt='Cerificación' title='Empresa Certificada'>";
                break;
              case 2:
                echo "<img class='cert' src='..///img/EnTramite.png' alt='Cerificación' title='Certificación en trámite'>";
                break;
              case 3:
                echo "<img href='cerificacion.php' class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
              default:
                echo "<img class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
             } 
            ?>
          </h3>
            </a>
            <a href="VistaServicio.php?codigo=<?=$res["codigo"]?>">
              <img alt="Imagen Agenda" class="Agenda" src="..//img/Agenda.png" title="Agendar para consulta">
            </a>
          </li>
          <li>
            <a href="VistaServicio.php?codigo=<?=$res["codigo"]?>" title="haz click para ver más información">
              <h3>
                <?php echo $res['nombre']; ?>
              </h3>
            </a>
          </li>
          <li>
            <a title="Haz click para ver la pagina del proveedor" href="PaginaProveedor.php">
              <?php echo "Empresa Proveedora: ".$res['empresa_nom']; ?>
            </a>
          </li>
          <li>
            <?php echo "Tipo: ".$res["tipo"]; ?>
          </li>
          <li>
            <?php echo "Valor Mano de obra: $".$res["costo"]; ?>
          </li>
          <li>
            <?php 
              if(strlen($res["comentario"])<=30){
                echo "Descripción: ".($res["comentario"]);
              }else{
                echo "Descripción: ".substr_replace($res["comentario"],"...",30);}
            ?>
          </li>
          <li>
            <a title="haz click para ver la pagina del producto" href="producto.php">Ver información completa...
            </a>
          </li>
        </ul>
      </article>
      <?php }
}else{
?>
      <ul id="item" class="special">
        <li>
          <a href="VistaProducto.php">
            <img alt="Imagen Producto" src="..//img/logo_de_servicio.png ?>" title="Imagen del producto">
          </a>
        </li>
        <li>
          <a href="VistaProducto.php" title="haz click para ver más información">
            <h3>Ops... parece que no encontramos Servicios relacionados en tu búsqueda
            </h3>
          </a>
        </li>
        <li>Intenta reducir los términos de tu búsqueda
        </li>
        <li>o intenta usar términos más genéricos
        </li>
        <li>Ejemplo: en lugar de buscar "empacado al vacío de cárnicos"
        </li>
        <li>Intenta buscando "empacado al vacío"
        </li>
        <li>
          <a title="haz click para ver la pagina de ayuda del sitio" href="producto.php">Página de Preguntas frecuentes...
          </a>
        </li>
      </ul>
      <?php
}
break;
case "empresa":
?>
      <aside>
        <h3>Flitrar Resultados
        </h3>
        <span>
          <a class="linkEsp" target="_blank" title="consulta especializada" href="FormularioConsulta.php">Consulta Especializada.
          </a>
        </span>
        <dl id="span_aside">
          <dt>Ordenar :
          </dt>
          <dd>
            <label class="Rcontainer">Alfabeticamente
              <input type="radio" name="radio" checked="checked">
              <span class="Rcheckmark">
              </span>
            </label>
          </dd>
          <dd>
            <label class="Rcontainer">Número de empleados
              <input type="radio" name="radio">
              <span class="Rcheckmark">
              </span>
            </label>
          </dd>
          <dd>
            <label class="Rcontainer">Facturación Anual
              <input type="radio" name="radio">
              <span class="Rcheckmark">
              </span>
            </label>
          </dd>
        </dl>
      </aside>
      <section id="section">
        <article class="resultados">
          <span>
            <?php echo $mensaje; ?>
          </span>
        </article>
        <article>
          <?php
$resultados=1;
$consulta="SELECT EMP1.empresa_nit 'nit',
EMP1.empresa_nom 'nombre',
empresa_pagina 'website',
empresa_tel1 'tel',
certificacionempresa.certificacionempresa_estado 'cerificacion',
empresa_foto 'foto',
empresa_email 'mail'
FROM empresa
as 	EMP1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=EMP1.empresa_nit 
INNER JOIN
(SELECT empresa_nom,empresa_nit FROM empresa 
WHERE
MATCH (empresa_nom) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE) LIMIT 10) 
AS EMP2
ON EMP1.empresa_nit=EMP2.empresa_nit
ORDER by certificacion_id $sortAlso";

//consulta el tamaño apra crear la paginación
$queryRows=mysqli_query($conexion,"SELECT COUNT(EMP1.empresa_nit) 'rows'
FROM empresa 
as  EMP1
LEFT JOIN certificacionempresa ON certificacionempresa.empresa_nit=EMP1.empresa_nit 
INNER JOIN
(SELECT empresa_nom FROM empresa 
WHERE
MATCH (empresa_nom) AGAINST ('$textoLimpio' IN NATURAL LANGUAGE MODE)) 
AS EMP2
ON EMP1.empresa_nom=EMP2.empresa_nom");
$rows=mysqli_fetch_array($queryRows);
$paginationSize=$rows['rows'];
$xyz=mysqli_query($conexion, $consulta);
$cantidadRegistros = mysqli_num_rows($xyz);
if ($cantidadRegistros>0) { 
while ($res=mysqli_fetch_array($xyz)) {
  $ruta = "../Fotos/Empresa_".$res['nit'];
      if (file_exists($ruta)) {
        $foto = $ruta."/Perfil.png";
      }
      else{
        $foto = "../img/logo_de_fabrica.png";
      } 
?>
          <ul id="item">
            <li>
              <a href="VistaPerfilEmpresa.php?nit=<?=$res['nit']?>">
                <img alt="Logotipo de la empresa" 
                     src="<?=$foto?>" title="Logotipo de la empresa">
                <h3>
            <?php switch ($res['cerificacion']) {
              case 1:
                echo "<img class='cert' src='..///img/certificada.png' alt='Cerificación' title='Empresa Certificada'>";
                break;
              case 2:
                echo "<img class='cert' src='..///img/EnTramite.png' alt='Cerificación' title='Certificación en trámite'>";
                break;
              case 3:
                echo "<img href='cerificacion.php' class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
              default:
                echo "<img class='cert' src='..///img/sinVerificar.png' alt='Cerificación' title='Sin verificar'>";
                break;
             } 
            ?>
          </h3>
              </a>
              <a href="VistaPerfilEmpresa.php?nit=<?=$res['nit']?>">
                <img alt="Imagen Agenda" class="Agenda" src="..//img/Agenda.png" title="Agendar para consultar">
              </a>
            </li>
            <li>
              <a href="VistaPerfilEmpresa.php?nit=<?=$res['nit']?>" title="haz click para ver más información">
                <h3>
                  <?php echo $res['nombre']; ?>
                </h3>
              </a>
            </li>
            <li>
              <a title="Haz click para ver la página del proveedor" href="PerfilEmpresa.php">
                <?php echo "Web: ".$res['website']; ?>
              </a>
            </li>
            <li>
              <?php echo "Teléfono: ".$res['tel']; ?>
            </li>
            <li>
              <?php echo "Correo: ".$res['mail']; ?>
            </li>
            <li>
              <a title="haz click para ver la página de la empresa" href="VistaPerfilEmpresa.php?nit=<?=$res['nit']?>">Ver información completa...
              </a>
            </li>
          </ul>
        </article>
        <?php 
}
}else{
?>
        <ul id="item" >
          <li>
            <a href="VistaProducto.php">
              <img alt="Imagen Producto" src="..//img/logo_de_fabrica.png ?>" title="Imagen del producto">
            </a>
          </li>
          <li>
            <a href="VistaProducto.php" title="haz click para ver más información">
              <h3>Ops... parece que no encontramos la empresa que buscabas
                ;
              </h3>
            </a>
          </li>
          <li>Intenta reducir los términos de tu búsqueda
          </li>
          <li>o intenta usar términos más genéricos
          </li>
          <li>Ejemplo: en lugar de buscar "Consumer pharmaceutical S.A.S. "
          </li>
          <li>Intenta buscando "Consumer pharmaceutical"
          </li>
          <li>También recuerda elegir los términos apropiados para la búsqueda.	
          </li>
          <li>
            <a title="haz click para ver la pagina de ayuda del sitio" href="producto.php">Página de Preguntas frecuentes...
            </a>
          </li>
        </ul>

        <?php
}
break;
}
}else{
?>
        <aside>
          <h3>Flitrar Resultados
          </h3>
          <span>
            <a title="consulta especializada" href="FormularioConsulta.php">Consulta Especializada.
            </a>
          </span>
          <dl id="span_aside">
            <dt>Tipo:
            </dt>
            <dd>
              <a href="#index">Animal (0)
              </a>
            </dd>
            <dd>
              <a href="#index">vegetal (0)
              </a>
            </dd>
            <dd>
              <a href="#index">Mineral (0)
              </a>
            </dd>
            <dt>Mostrar solo:
            </dt>
            <dd>
              <label class="container">En stock
                <input type="checkbox">
                <span class="checkmark">
                </span>
              </label>
            </dd>
            <dd>
              <label class="container">Bajo Pedido
                <input type="checkbox">
                <span class="checkmark">
                </span>
              </label>
            </dd>
            <dd>
              <label class="container">Envían muestras
                <input type="checkbox">
                <span class="checkmark">
                </span>
              </label>
            </dd>
            <dt>Cantidad para venta:
            </dt>
            <dd>
              <label class="Rcontainer">Cualquiera
                <input type="radio" name="radio" checked="checked">
                <span class="Rcheckmark">
                </span>
              </label>
            </dd>
            <dd>
              <label class="Rcontainer">Menos de 100gr o menos de 100mL
                <input type="radio" name="radio">
                <span class="Rcheckmark">
                </span>
              </label>
            </dd>
            <dd>
              <label class="Rcontainer">Hasta 1Kg o hasta 1L
                <input type="radio" name="radio">
                <span class="Rcheckmark">
                </span>
              </label>
            </dd>
            <dd>
              <label class="Rcontainer">Menos 25kg o menos de 25L
                <input type="radio" name="radio">
                <span class="Rcheckmark">
                </span>
              </label>
            </dd>
            <dd>.
              <label class="Rcontainer">Más de 25kg
                <input type="radio" name="radio">
                <span class="Rcheckmark">
                </span>
              </label>
            </dd>
          </dl>
          <?php 
} 
          ?>			
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
              $limite=10;
              $paginas = ceil($paginationSize/$limite); 

              ?>
            <form method="POST" id="pag">
              <ul id="navegacionPaginas">

                <li id="entradas">
                <?php

                if ($paginationSize >= $limite) {
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
              <input type="hidden" name="search" value="<?=$texto?>">
              <input type="hidden" name="filtros" value="<?=$_POST['filtros']?>">
              </li>

            </form>
            
          </article>
          <?php
              if ($paginationSize <= 3) {
                echo "<span id='special'></span>";
              }
            ?>
          </section>
        <?php include 'Recursos/footer.php'; ?>