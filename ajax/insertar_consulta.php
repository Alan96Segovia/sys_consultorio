<?php
include("../clases/conexion.php");

/*capturo los datos a ser insertados */
$Paciente_cedula = $_POST['Paciente_cedula'];
$nombres = $_POST['nombres'];//nombre complero del paciente
$email = $_POST['email'];
$contacto_familiar = $_POST['contacto_familiar'];
$fecha_nac = $_POST['fecha_nac'];
//$fecha_consulta = date('d/m/y', strtotime($_POST['fecha_consulta']));
$fecha_consulta = $_POST['fecha_consulta'];
$consulta = $_POST['consulta'];
$monto = $_POST['monto'];
$obs = $_POST['obs'];
//preparo la consulta sql de insert

$query = "INSERT INTO pacientes_consultas
(fecha_consulta,
consulta_motivo,
monto_consulta,
paciente_nombres_apellidos,
paciente_cedula,
paciente_fecha_nac,
paciente_correo,
paciente_contacto_familiar,
estado_id,paciente_obs)
VALUES ('$fecha_consulta','$consulta','$monto','$nombres','$Paciente_cedula','$fecha_nac','$email','$contacto_familiar'
,5,'$obs');";

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