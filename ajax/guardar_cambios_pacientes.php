<?php
include('../clases/conexion.php');


//recibo los campos a editar 
$paciente_id = $_POST['paciente_id'];
$cedula = $_POST['cedula'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$fecha_nac = date('d/m/Y', strtotime($_POST['fecha_nac']));
$fecha_ing = date('d/m/Y', strtotime($_POST['fecha_ing']));;
$correo = $_POST['correo'];
$p_contacto = $_POST['p_contacto'];
$t_contacto = $_POST['t_contacto'];
$consulta = $_POST['consulta'];
$estado = $_POST['estado'];

///realizo el query para hacer el update

$query_update = "UPDATE 
public.pacientes 
SET 
paciente_fecha = '$fecha_ing',
paciente_ci =TRIM('$cedula'),
paciente_nombre = '$nombres',
paciente_apellido = '$apellidos',
paciente_fechanac = '$fecha_nac',
paciente_celular = '$p_contacto',
paciente_correo = '$correo',
paciente_consulta = '$consulta',
contacto_familiar = '$t_contacto',
estado_id = $estado
WHERE 
paciente_id = $paciente_id
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