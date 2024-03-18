<?php
include("../clases/conexion.php");

/*capturo los datos a ser insertados */
$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$color = $_POST['color'];

//preparo la consulta sql de insert

$query = "INSERT INTO profesionales
(
  profesional_nombre,
  profesional_apellido,
  profesional_ci,
  profesional_color,
  estado_id
)
VALUES (
  '$nombres',
  '$apellidos',
  '$cedula',
  '$color',
  5
);";

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