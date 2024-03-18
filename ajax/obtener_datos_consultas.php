<?php
//agrego conexion a la base de datos
include('../clases/conexion.php');

//capturo el post del id
$consulta_id = $_POST['consulta_id'];
//echo 'consultaid'. $consulta_id;
//sql para traer los datos del paciente
$query = "Select * from view_consultas where consulta_id = $consulta_id";
//echo $query;
//ejecutamos el query
$execute_query = pg_query($conexion, $query);

//verifico si la consulta me trae datos
if($execute_query){
    //obtengo los datos del paciente
    $datos_consultas = pg_fetch_assoc($execute_query);

    //devuelvo los datos del paciente en formato JSON
    echo json_encode($datos_consultas);
} else {
    //Manejo el erro de la consulta
    $errorMensaje = pg_last_error($conexion);//obtener el mensaje de error
    echo json_encode(array('error'=> $errorMensaje));
}

//cierro la conexion si es necesario
pg_close($conexion);