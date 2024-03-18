<?php
include("../clases/conexion.php");

// Recibir datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['detalles'])) {
    $detalles = $data['detalles'];

    foreach ($detalles as $detalle) {
        // Insertar en la tabla sesiones_detalles
        $fechas = $detalle['fecha'];
        $id = $detalle['id'];
        $estado = 1;
                // Prevenir SQL Injection usando consultas preparadas
                //error_log('Cantidad de detalles recibidos: ' . count($detalles));

       
        $fechaFormateada = DateTime::createFromFormat('Y-m-d\TH:i', $fechas)->format('Y-m-d H:i:s');
        //var_dump($fechaFormateada);
        $query_insertDetalles = "INSERT INTO pacientes_sessiones_det (paciente_sessionid, fechahora_sesion, estado_id)
        VALUES ($id, '$fechaFormateada', $estado)";
    
        $result = pg_query($conexion,$query_insertDetalles);
        //$result = pg_query_params($conexion, $query_insertDetalles, array($id, $fechas,$estado));
        if ($result) {
            // Se insertaron los registros
            $response = array("status" => "success", "message" => "Detalles insertados correctamente.");
        } else {
            // Error al insertar detalles
            $response = array("status" => "error", "message" => "Error al insertar detalles. Por favor, inténtalo de nuevo.");
        }
    }

    // Puedes enviar una respuesta al cliente si es necesario
    echo json_encode($response);
} else {
    // Enviar un código de respuesta para indicar un error si es necesario
    http_response_code(400);
    echo json_encode(array("status" => "error", "message" => "Error: No se recibieron detalles válidos."));
}

?>
