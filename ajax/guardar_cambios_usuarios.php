<?php
include('../clases/conexion.php');


//recibo los campos a editar 
$usuario_id = $_POST['usuario_id'];
$nombres = trim($_POST['nombres']) ;
$apellidos = trim($_POST['apellidos']) ;
$usuario = trim($_POST['usuario']) ;
$pass = trim($_POST['pass']) ;
$estado_id = $_POST['estado'];
$grupo_id = $_POST['grupo'];

///realizo el query para hacer el update

 $query_update = "UPDATE usuarios 
SET 
  usuario = '$usuario',
  pass = md5('$pass'),
  usuario_nombre = '$nombres',
  usuario_apellido = '$apellidos',
  estado_id = $estado_id,
  pass_normal = '$pass',
  grupo_id = $grupo_id
WHERE 
  usuario_id = $usuario_id
;";
//echo $query_update;
//ejecuto el query
$execute_update = pg_query($conexion,$query_update);


///verifico si ocurrio la actualizacion
if(!$execute_update){
    die("Error en la consulta:".pg_last_error());
}

//cierro conexion
pg_close($conexion);

//envio la respuesta a la parte del frontend
echo "Editado Con Exito!";