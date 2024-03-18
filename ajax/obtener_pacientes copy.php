<?php
include('../clases/conexion.php');
error_reporting(0);
if(isset($_POST['Paciente_cedula'])){
    $ci = $_POST['Paciente_cedula'];


    ///realiza query de consulta - tabla pacientes
    $query="SELECT paciente_id ,paciente_ci, paciente_nombre ||' '|| paciente_apellido as nombres , paciente_fechanac  
            FROM pacientes WHERE paciente_ci = '$ci' ";
    $res_query = pg_query($conexion, $query);

    $cant = pg_num_rows($res_query);

    if($cant > 0){
        $fila = pg_fetch_assoc($res_query);
        $datos=array(
            'paciente_id' => $fila['paciente_id'],
            'nombres' => $fila['nombres'],
            'fecha_nac' => date('d/m/Y',strtotime($fila['paciente_fechanac'])) 

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
