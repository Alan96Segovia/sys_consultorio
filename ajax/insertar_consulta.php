<?php
include("../clases/conexion.php");

/*capturo los datos a ser insertados */
$id = $_POST['id'];
//$fecha_consulta = date('d/m/y', strtotime($_POST['fecha_consulta']));
$fecha_consulta = $_POST['fecha_consulta'];
$consulta = $_POST['consulta'];
$monto = $_POST['monto'];
//preparo la consulta sql de insert

$query = "INSERT INTO pacientes_consultas
(paciente_id,fecha_consulta,consulta_motivo,monto_consulta)
VALUES ($id,'$fecha_consulta','$consulta','$monto');";

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