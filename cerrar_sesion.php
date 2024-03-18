<?php

session_start();

//destruyo la session
session_destroy();

//creo un mensaje para mostrar al usuario que cerro la sesion
$_SESSION['mensaje'] = '¡Has cerrado sesión exitosamente!';

//redirigo al login
header('location: index.php?mensaje=cerrado');
exit();
?>