<?php
include("../clases/conexion.php");

//obtengo los datos del formulario - datos para la cabecera 
// Obtén los datos del formulario
try {
    // Inicia la transacción
    pg_query($conexion, "BEGIN");

    // Obtiene la cantidad de detalles del formulario
    echo 'la cantidad es =>'. $cantidad = isset($_POST['cantidadDetalles']) ? (int)$_POST['cantidadDetalles'] : 0;
    //echo ('Cantidad php '. $cantidad.'<br>');
    //id del paciente
    $paciente_id = isset($_POST['idp']) ? (int)$_POST['idp'] : 0;
    /**fecha que adquirió las sesiones */
    $fecha_ing = date('d/m/Y', strtotime(isset($_POST['fecha_ing']) ? $_POST['fecha_ing'] : ''));
    /**id del estado de la sesión */
    $E_plan = isset($_POST['E_plan']) ? (int)$_POST['E_plan'] : 0;
    /**id del plan adquirido */
    $tipoPlan = isset($_POST['tipoPlan']) ? (int)$_POST['tipoPlan'] : 0;
    

    // Inserta la cabecera
    $insert_cabecera = "INSERT INTO pacientes_sesiones
                        (paciente_id, fecha_session, estado_id, plan_id)
                        VALUES ($paciente_id, '$fecha_ing', $E_plan, $tipoPlan) RETURNING paciente_sessionid ;";

    // Ejecuta la consulta de inserción para la cabecera
    $result_cabecera = pg_query($conexion, $insert_cabecera);

    if (!$result_cabecera) {
        throw new Exception("Error al insertar la cabecera. " . pg_last_error($conexion));
    }
    //var_dump('cantidad '.$cantidad,'paciente id'. $paciente_id,'fecha ing'. $fecha_ing,'estado plan id'. $E_plan,'plan id'. $tipoPlan);

    // Obtiene el ID de la cabecera recién insertada
    $row = pg_fetch_assoc($result_cabecera);
    $id_cabecera = $row['paciente_sessionid']; /**captuo el id insertado */

    // Inserta detalles
    for ($i = 0; $i <= $cantidad; $i++) {
        echo 'poscion de i'.$i;

        //$fecha_session = date('d/m/Y', strtotime($_POST['fecha_session_'][$i - 1]));
        //$fecha_session = isset($_POST['fecha_session'][$i - 1]) ? $_POST['fecha_session'][$i - 1] : '';

        // Obtén la cadena de fecha y hora del formulario
        $fecha_session = isset($_POST['fecha_session'][$i - 1]) ? $_POST['fecha_session'][$i - 1] : '';

        // Convierte la cadena de fecha y hora a un objeto DateTime de PHP
        $fecha_session_dt = DateTime::createFromFormat('Y-m-d\TH:i', $fecha_session);
        // Verifica si la conversión fue exitosa
            if ($fecha_session_dt === false) {
                //throw new Exception("Error al convertir la fecha y hora.");
                throw new Exception("Error al convertir la fecha y hora. Formato incorrecto: '$fecha_session'");

            }
        // Formatea la fecha según tus requerimientos
        //$fecha_formateada = $fecha_session_dt->format('d/m/Y H:i:s');
        $fecha_formateada = $fecha_session_dt->format('Y-m-d H:i:s');

        $estado_id = isset($_POST['estado_id_' . $i]) ? (int)$_POST['estado_id_' . $i] : 0;

        // Inserta detalle asociado a la cabecera
         $insert_detalle = "INSERT INTO pacientes_sessiones_det (paciente_sessionid, fechahora_sesion, estado_id) 
                           VALUES ($id_cabecera, '$fecha_formateada', $estado_id);";

        // Ejecuta la consulta de inserción para el detalle
        $result_detalle = pg_query($conexion, $insert_detalle);

        if (!$result_detalle) {
            throw new Exception("Error al insertar detalles. " . pg_last_error($conexion));
        }
    }

    // Confirma la transacción
    pg_query($conexion, "COMMIT");

    // Devuelve respuesta a la aplicación cliente (puede ser un mensaje JSON)
    echo json_encode(['success' => true, 'message' => 'Agregado correctamente.']);
} catch (Exception $e) {
    // Si ocurre algún error, revertir la transacción
    pg_query($conexion, "ROLLBACK");

    // Devuelve una respuesta de error detallada
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    // Cierra la conexión
    pg_close($conexion);
}
