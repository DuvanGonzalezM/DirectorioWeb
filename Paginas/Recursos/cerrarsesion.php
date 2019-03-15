<?php
    // Con esto sabemos que session esta activa
    session_start();
    // Luego quitamos la sesión
    session_unset();
    //La destuimos
    session_destroy();
    // Finalmente despues de destruirla redireccionamos a nuestro usuario.
    header('Location: ../../');
?>