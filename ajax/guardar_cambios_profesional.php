<?php
include('../clases/conexion.php');


//recibo los campos a editar 
$profesional_id = $_POST['profesional_id'];
$profesional_ci = $_POST['profesional_ci'];
$profesional_nombre = $_POST['profesional_nombre'];
$profesional_apellido = $_POST['profesional_apellido'];
$profesional_color = $_POST['profesional_color'];
$estado_id = $_POST['estado_id'];


///realizo el query para hacer el update

$query_update = "UPDATE 
profesionales 
SET 
profesional_nombre = '$profesional_nombre',
profesional_apellido = '$profesional_apellido' ,
profesional_ci = $profesional_ci,
profesional_color = '$profesional_color',
estado_id = $estado_id
WHERE 
profesional_id = $profesional_id;";
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