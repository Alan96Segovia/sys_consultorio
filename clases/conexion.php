<?php
$conexion = pg_connect("host=localhost dbname=sys_consultorio user=postgres password=123");
//verificar la conexion
    if(!$conexion){
            die("Error en la conexion:". pg_last_error());
    }
?>