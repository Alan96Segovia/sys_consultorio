<?php
include("../clases/conexion.php");

/*capturo los datos a ser insertados */
$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha_nac = date('d/m/y', strtotime($_POST['fecha_nac']));
//$fecha_ing = date('d/m/y', strtotime($_POST['fecha_ing']));
$fecha_ing = $_POST['fecha_ing'];
$correo = $_POST['correo'];
$p_contacto = $_POST['p_contacto'];
$t_contacto = $_POST['t_contacto'];
$consulta = $_POST['consulta'];

//preparo la consulta sql de insert

 $query = "INSERT INTO pacientes
(paciente_fecha,paciente_ci,paciente_nombre,paciente_apellido,paciente_fechanac,paciente_celular,paciente_correo,paciente_consulta,
contacto_familiar,estado_id)
VALUES ('$fecha_ing','$cedula','$nombres','$apellidos','$fecha_nac','$p_contacto','$correo','$consulta','$t_contacto',5);";

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