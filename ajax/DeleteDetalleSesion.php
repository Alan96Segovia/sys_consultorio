<?php

include("../clases/conexion.php");

// Recibir el ID de la sesión a eliminar desde la solicitud AJAX
if (isset($_POST['sessionDetalleId'])) {
    $sessionDetalleId = $_POST['sessionDetalleId'];

    // Realizar la eliminación en la base de datos
    $query_eliminarSesion = "DELETE FROM pacientes_sessiones_det 
    WHERE session_detalle_id = $sessionDetalleId";

    $result = pg_query($conexion, $query_eliminarSesion);

    if ($result) {
        // Éxito: Sesión eliminada correctamente
        $response = array("status" => "exito", "message" => "Sesión eliminada correctamente.");
    } else {
        // Error al eliminar sesión
        $response = array("status" => "error", "message" => "Error al eliminar sesión. Por favor, inténtalo de nuevo.", "debug" => pg_last_error($conexion));
    }
} else {
    // Error: No se recibió el ID de la sesión a eliminar
    $response = array("status" => "error", "message" => "Error: No se recibió el ID de la sesión a eliminar.");
}

// Enviar la respuesta al cliente (JavaScript)
echo json_encode($response);

?>
