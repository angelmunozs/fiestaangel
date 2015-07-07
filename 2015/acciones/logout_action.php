<?php 
 //Crear sesión
 session_start();
 //Vaciar sesión
 $_SESSION = array();
 //Destruir Sesión
 session_destroy();
 //Redireccionar a login
 echo "<script language='javascript'>
      window.location.href = '../login';
      </script>";
?>