<?php
include('../clases/conexion.php');
error_reporting(0);
if(isset($_POST['Paciente_cedula'])){
    $ci = $_POST['Paciente_cedula'];


    ///realiza query de consulta - tabla pacientes
    $query="SELECT paciente_id ,paciente_ci, nombres   
            FROM view_consultas WHERE paciente_ci = '$ci' ";
    $res_query = pg_query($conexion, $query);

    $cant = pg_num_rows($res_query);

    if($cant > 0){
        $fila = pg_fetch_assoc($res_query);
        $datos=array(
            'paciente_id' => $fila['paciente_id'],
            'nombres' => $fila['nombres']

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
