<?php
//agrego conexion a la base de datos
include('../clases/conexion.php');

//capturo el post del id
$paciente_id = $_POST['paciente_id'];

//sql para traer los datos del paciente
$query = "Select * from pacientes where paciente_id = $paciente_id";

//ejecutamos el query
$execute_query = pg_query($conexion, $query);

//verifico si la consulta me trae datos
if($execute_query){
    //obtengo los datos del paciente
    $datos_pacientes = pg_fetch_assoc($execute_query);

    //devuelvo los datos del paciente en formato JSON
    echo json_encode($datos_pacientes);
} else {
    //Manejo el erro de la consulta
    $errorMensaje = pg_last_error($conexion);//obtener el mensaje de error
    echo json_encode(array('error'=> $errorMensaje));
}

//cierro la conexion si es necesario
pg_close($conexion);