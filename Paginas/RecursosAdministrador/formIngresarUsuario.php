<?php 
include 'headerAdministrador.php';;
include("datosbd.php"); 
include("funciones.php");

	if (!isset($_SESSION['usuario_id']) && !isset($_SESSION['empresa_nit'])) {
      header('Location: ../');
    }
?>

<?php 

//include("..//Recursos/header.php");
  

	//if(isset($_GET["codigo"]) and $_GET["codigo"]<>""){
	//	$codigo=$_GET["codigo"];

				

		if($conect=conectarbd($servidor,$usuario,$clave,$basedatos)){
			$resultado=ingresarRegistroUsuario();
					echo $resultado;
			
		}else{
			echo "<p>No hay conexion</p>";
		}
	//}else{
	//	echo "<p>No se han ingresado todos los datos</P>";
	//}

//include '..//Recursos/footer.php';
?>