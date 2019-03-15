function Cambio_foto(){
		var modifoto = document.getElementById("Modificar_foto");

		var ventana = document.createElement("div");
			ventana.id = "ventana";
		modifoto.appendChild(ventana);	

 		var close=document.createElement("div");
 			close.id="cerrar";
 			close.onclick=function clo(){
 				modifoto.removeChild(ventana);
	    		document.getElementById("section").style.filter="none";
 			}
 		ventana.appendChild(close);

 		ventana=document.getElementById("ventana");

 		var formu=document.createElement("form");
 			formu.method = "post";
 			formu.action = "";
 			formu.name="Solicitud";
 			formu.enctype = "multipart/form-data";
 		ventana.appendChild(formu);

	    var fieldset=document.createElement("fieldset");
	    	fieldset.id="fieldsetV";
	    formu.appendChild(fieldset);

	    var legend=document.createElement("legend");  
	    	legend.id="legendV";
	    	legend.innerHTML = "CAMBIO DE FOTO";
	    fieldset.appendChild(legend);

	    var fieldset=document.createElement("fieldset");
	    	fieldset.id="fieldsetV";
	    formu.appendChild(fieldset);

	   	var label=document.createElement("label");
			label.for="nuevafoto";
			label.id="subirfoto";
			label.title="Elija una foto";
		fieldset.appendChild(label);

		var input=document.createElement("input");
			input.type="file";
			input.name="nuevafoto";	
			input.id="nuevafoto";
			input.style="display: none;";
		label.appendChild(input);

	    var inputsub=document.createElement("input");
	    	inputsub.type="submit";
	    	inputsub.id="pos";
	    	inputsub.name="guardar"
	    	inputsub.value="Guardar";
	    formu.appendChild(inputsub);

	    var span=document.createElement("span");  
	    	span.id="spanV";	    	
			span.innerHTML="+ Añadir foto";
	    label.appendChild(span);
	    document.getElementById("section").style.filter="blur(10px)";
	    document.getElementById("ventana").style.zIndex="10";

		var objet= 1;
	}