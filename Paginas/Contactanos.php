<?php
include 'Recursos/header.php';
?>

<section>
 <div id="contacto">
      <article class="contacto">
 <center><div>
 	<br><br><br>
    <h3>CONTACTENOS</h3>
    <legend>TEL: 312 4667121 directorioweb@gmail.com</legend>
    <br>
    <form method="POST" action="#" accept-charset="UTF-8" class="" id="contactForm"><input name="_token" type="hidden" value="">
      <div class="row">

      	<fieldset>
        <input id="nombre" class="small-6 medium-6 large-4 columns" required maxlength="255" placeholder="NOMBRE" autocomplete="name" name="nombre" type="text" value="">
        </fieldset>
        <fieldset>
        <input id="email" class="small-6 medium-6 large-4 columns end" required maxlength="150" placeholder="EMAIL" autocomplete="email" name="email" type="text" value="">
       </div>
   </fieldset>
   <fieldset>
      <div class="row">
        <textarea id="coment" class="small-12 medium-12 large-8 columns" required placeholder="MENSAJE" name="comment" cols="50" rows="10"></textarea>
        <input class="small-5 medium-12 large-4 columns end" type="submit" value="Enviar">
      </center></div>
      </fieldset>
    </form>
  </div>
</article>
</section>

<?php
include 'Recursos/footer.php';
?>