<?php
include("../clases/conexion.php");

/*capturo los datos a ser insertados */
$nombres = trim($_POST['nombres']) ;
$apellidos = trim($_POST['apellidos']) ;
$usuario = trim($_POST['usuario']) ;
$pass = trim($_POST['pass'])  ;
$grupo = $_POST['grupo'];
//preparo la consulta sql de insert

$query = "INSERT INTO usuarios(usuario,pass,usuario_nombre,usuario_apellido,estado_id,pass_normal,grupo_id)
VALUES ('$usuario',md5('$pass'),'$nombres','$apellidos',5,'$pass',$grupo);";

//ejecuto la consulta
$execute_insert = pg_query($conexion, $query);

//verifico el resultado
if(!$execute_insert){
        die("Error en la consulta".pg_last_error());
}
//cierro conexion
pg_close($conexion);

//envio la respuesta a la parte del frontend
echo "Agregado con Exito!";