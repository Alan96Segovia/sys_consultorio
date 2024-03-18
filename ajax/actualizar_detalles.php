<?php
include("../clases/conexion.php");

//recibir los datos de los detalles del formulario formularioDetalles
$detalles = json_decode($_POST['detalles'], true);
// Mostrar los valores para depuración
//echo '<pre>';
//var_dump($detalles); // Utiliza var_dump para una salida más detallada
//echo '</pre><br>';
try {
    //realiza  la actualizacion  en la base de datos 
    foreach ($detalles as $detalle) {

        $fechaSession = $detalle['fecha'];
        $estadoId = $detalle['estado'];
        $session_detalle_id = $detalle['session_detalle_id'];

        $query_detalle = "UPDATE pacientes_sessiones_det 
                      SET 
                        fechahora_sesion = '$fechaSession',
                        estado_id = $estadoId
                    WHERE 
                    session_detalle_id = $session_detalle_id;";
        $result_detalle = pg_query($conexion, $query_detalle);
        // Verifica si la actualización fue exitosa
        if (!$result_detalle) {
            //echo 'error';
            throw new Exception('Error en la actualización de cabecera');
            // Puedes agregar lógica adicional si necesitas manejar errores específicos
        }
    }

    echo 'success'; // notifica que todo fue exitoso
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
// Cierra la conexión a la base de datos
pg_close($conexion);
