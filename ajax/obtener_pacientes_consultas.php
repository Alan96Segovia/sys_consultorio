<?php
include('../clases/conexion.php');
error_reporting(0);
if(isset($_POST['Paciente_cedula'])){
    $ci = $_POST['Paciente_cedula'];


    ///realiza query de consulta - tabla pacientes
    $query="SELECT *   
            FROM view_pacientes WHERE cedula = '$ci' ";
    $res_query = pg_query($conexion, $query);

    $cant = pg_num_rows($res_query);

    if($cant > 0){
        $fila = pg_fetch_assoc($res_query);
        $datos=array(
            'consulta_id' => $fila['consulta_id'],
            'nombre_paciente' => $fila['nombre_paciente'],
            'edad' => $fila['edad'],
            'consulta_motivo' => $fila['consulta_motivo'],

        );
        echo json_encode($datos);
    }else{
        echo json_encode(null);
    }
    if (!$res_query) {
        echo pg_last_error($conexion);
        exit;
    }
}else{
    echo 'No se recibio el post';
}
