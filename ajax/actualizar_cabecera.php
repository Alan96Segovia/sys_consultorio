
<?php 
include("../clases/conexion.php");

//recibo los post de la peticon ajax del formulario con id formularioCabecera

$paciente_sessionid = $_POST['paciente_sessionid'];
$paciente_id = $_POST['paciente_id'];
$fecha_ing = $_POST['fecha_ing'];
$fecha_formateada = date('d/m/Y',strtotime($fecha_ing)); 
//echo 'formateo '.$fecha_formateada; 
$estado_id = $_POST['estado_id_cab'];///es el id de la tabla cabecera pacientes_sesiones
$plan_id = $_POST['plan_id'];
$profesional = $_POST['profesional_id'];
$consultorio = $_POST['consultorio_id'];
$tipo_pago_id = $_POST['tipo_pago_id'];

//realizo el update en la tabla de cabcerea
 $query_update = "UPDATE 
pacientes_sesiones 
SET 
paciente_id = $paciente_id,
fecha_session = '$fecha_formateada',
estado_id = $estado_id,
plan_id = $plan_id,
profesional_id = $profesional,
consultorio_id = $consultorio,
tipo_pago_id = $tipo_pago_id
WHERE 
paciente_sessionid = $paciente_sessionid;";

 $execute_query = pg_query($conexion,$query_update);

// Verifica si la actualización fue exitosa
/*if ($execute_query) {
    echo 'OK'; //SE REALIZO LA EL QUERY 
} else {
    echo 'error';
}*/
if ($execute_query) {
    echo 'OK'; // Se realizó la actualización correctamente
} else {
    throw new Exception('Error en la actualización de cabecera');
}

// Cierra la conexión a la base de datos
pg_close($conexion);
?>