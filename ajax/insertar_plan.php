<?php
include("../clases/conexion.php");
error_reporting(0);
/*capturo los datos a ser insertados */
$plan_nombre = $_POST['plan_nombre'];
$precio_plan = $_POST['precio_plan'];
$plan_estado = $_POST['plan_estado'];



//preparo la consulta sql de insert

 $query = "INSERT INTO pacientes_planes
(plan_id,plan_descrip,plan_precio,estado_id)
VALUES ((SELECT COALESCE(max(plan_id),0) + 1 as plan_id from pacientes_planes),'$plan_nombre',$precio_plan,5);";

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