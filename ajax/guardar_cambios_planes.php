<?php
include('../clases/conexion.php');


//recibo los campos a editar 
$plan_id = $_POST['plan_id'];
$plan = $_POST['plan'];
$precio = $_POST['precio'];
$estado = $_POST['estado'];

///realizo el query para hacer el update

$query_update = "UPDATE 
public.pacientes_planes 
SET 
plan_descrip = '$plan',
plan_precio = $precio,
estado_id = $estado
WHERE 
plan_id = $plan_id
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