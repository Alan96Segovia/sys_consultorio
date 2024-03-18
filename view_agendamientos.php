<?php
include('clases/conexion.php');

$query =  'SELECT * FROM "view_sesionesFechaHoras"';

//ejecuto query

$execute_query = pg_query($conexion, $query);
$cantidad_registros = pg_num_rows($execute_query);

//echo '<h2>'. $cantidad_registros .'</h2>';

$eventos = []; //creo una variable tipo arrays

while ($fila = pg_fetch_array($execute_query)) {
    //recoroo los resultado de la consulta y agrego a mi variable de tipo arrays eventos

    $eventos[] = array(
        'id_cabecera' => $fila['id_cabecera'],
        'paciente_id' => $fila['paciente_id'],
        'paciente_ci' => $fila['paciente_ci'],
        'paciente' =>  $fila['paciente'],
        'estado_cabecera' => $fila['estado_cabecera'],
        'estado_nombre_cab' => $fila['estado_nombre_cab'],
        'profesional' => $fila['profesional'],
        'color' => $fila['color'],
        'plan_id' => $fila['plan_id'],
        'plan_descrip' => $fila['plan_descrip'],
        'paciente_sessionid' => $fila['paciente_sessionid'],
        'fecha' => $fila['fecha'],
        'hora' => $fila['hora'],
        'estado_id' => $fila['estado_id'],
        'estado_nombre' => $fila['estado_nombre'],
        'consultorio_id' => $fila['consultorio_id'],
        'consultorio_nombre' => $fila['consultorio_nombre'],
        'consultorio_icono' => $fila['consultorio_icono'],
        //'title' => $fila['paciente_ci'] .' - '. $fila['paciente'], // Título del evento
        'title' => '<i class="'. $fila['consultorio_icono'].'"></i>'. $fila['paciente'] .' '. '<br> ' . $fila['consultorio_nombre'], // Título del evento
        'start' => $fila['fecha'] . ' ' . $fila['hora'], // Fecha de inicio del evento
        'backgroundColor' => $fila['color'], // Color de fondo del evento
        'borderColor' => $fila['color'], // Color del borde del evento

        // Agrega otros campos según sea necesario
    );
    /*$eventos[] = array(
                            'title' => $fila['paciente']. ' ' . $fila['estado_nombre'], // Título del evento
                            'start' => $fila['fecha']. ' ' . $fila['hora'],     // Fecha de inicio del evento
                            // Agrega otros campos según sea necesario
                        );*/
}
echo json_encode($eventos);
