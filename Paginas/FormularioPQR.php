<?php include 'Recursos/header.php'; ?>
	<aside>
		 <img class="banner" src="../img/banner.jpg" alt="imgText"/>
	</aside>
<section id="section">
		<!--Formulario Modificacion datos de Empresa-->
		<span><h3>Para petición, sugerencia, queja o reclamo por favor digite la siguiente información</h3></span>
		
		<form action="#" method="post">
		
			<fieldset>		
				<legend>Nombre:</legend>
				<input type="text" name="Nombre" onkeyup="this.value=NumText(this.value)">
			</fieldset>
			<fieldset>
				<legend>Apellidos:</legend>
				<input type="text" name="apellido" onkeyup="this.value=NumText(this.value)">
			</fieldset>
			<fieldset>
				<legend>Correo:</legend>
				<input type="text" name="Correo">
			</fieldset>
			<fieldset>
				<legend>Teléfono:</legend>
				<input type="text" name="Teléfono">
			</fieldset>
			<fieldset>
			<!------------------REVISAR ESTOS DATOS PARA QUE SEAN COHERENTES----------------------------->
			<legend>Reporte</legend>
				<select class="selectformulario" name="país">
				<option value="ninguno">Seleccionar...</option>
				<option value="sugerencia">Sugerencia</option>
				<option value="queja">Queja</option>
				<option value="reclamo">Reclamo</option>
				<option value="consulta">Consulta</option>
			</select>
			</fieldset>
			<fieldset>
				<legend>Agrega una Descripción</legend>
				<textarea id="message" name"message" rows="8" cols="86"> </textarea>
				<div class="ayuda">
					<p>Agrega una descripcion breve de tu petición, queja, reclamo o recurso.</p>
				</div>	
			</fieldset>	
			<input id="boton1" type="submit" value="Enviar">
			<input type="reset">

		</form>
	</section>
	<script src="..//js/validacion.js">  //nombre del Archivo JavaScript
	</script>

	<?php include 'Recursos/footer.php'; ?>
