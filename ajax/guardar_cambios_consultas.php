<?php
include('../clases/conexion.php');


//recibo los campos a editar 
$consulta_id = $_POST['consulta_id'];
$cedula = $_POST['cedula'];
$paciente_id = $_POST['paciente_id'];
$fecha_consulta = date('d/m/Y', strtotime($_POST['fecha_consulta']));
$consulta_motivo = $_POST['consulta_motivo'];
$monto_consulta = $_POST['monto_consulta'];
///realizo el query para hacer el update

    /*hago un select para traer el id de la tabla pacientes y poder insertar en la tabla consulta */
     $query_id_paciente = "SELECT paciente_id FROM pacientes WHERE paciente_ci ='$cedula'";
        $execute_idPaciente = pg_query($conexion,$query_id_paciente);
        $id = pg_fetch_array($execute_idPaciente);
        $pacienteId = $id['paciente_id'];
        //echo 'paciente id ;'. $pacienteId;

$query_update = " UPDATE
pacientes_consultas 
SET 
paciente_id = $pacienteId,
fecha_consulta = '$fecha_consulta',
consulta_motivo = '$consulta_motivo',
monto_consulta = $monto_consulta
WHERE 
consulta_id = $consulta_id";
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