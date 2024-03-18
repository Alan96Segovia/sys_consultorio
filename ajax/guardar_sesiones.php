<?php
include("../clases/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cedula = $_POST["cedula"];
    $tipoPlan = $_POST["tipoPlan"];
    $fechaIngreso = $_POST["fechaIngreso"];
    $profesional = $_POST["profesional"];
    $estadoPlan = $_POST["estadoPlan"];
    $consultorio = $_POST["consultorio"];
    $tipoPago = $_POST["tipoPago"];
    $detalles = json_decode($_POST["detalles"], true);

    // Aquí debes realizar la inserción en la base de datos con los datos obtenidos
    // Usa las variables $cedula, $tipoPlan, $fechaIngreso, $estadoPlan y $detalles

    // inserción de cabecera
   $sqlCabecera = "INSERT INTO pacientes_sesiones (paciente_id,fecha_session,estado_id,plan_id,profesional_id,consultorio_id,
   tipo_pago_id) VALUES ('$cedula', '$fechaIngreso', '$estadoPlan', '$tipoPlan',$profesional,$consultorio,$tipoPago) RETURNING paciente_sessionid";
    //pg_query($conexion, $sqlCabecera);
    // Ejecuta la consulta de inserción para la cabecera
    $result_cabecera = pg_query($conexion, $sqlCabecera);

    // Obtener el ID de la cabecera insertada (si es necesario)
    //$idCabecera = pg_last_oid($conexion);
    // Obtiene el ID de la cabecera recién insertada
    $row = pg_fetch_assoc($result_cabecera);
    $id_cabecera = $row['paciente_sessionid']; /**captuo el id insertado */
    //inserción de detalles
     foreach ($detalles as $detalle) {
         $fechaSession = $detalle["fechaSession"];
         $estadoId = $detalle["estadoId"];

         $sqlDetalle = "INSERT INTO pacientes_sessiones_det (paciente_sessionid,fechahora_sesion,estado_id) VALUES ('$id_cabecera', '$fechaSession', '$estadoId')";
         pg_query($conexion, $sqlDetalle);
     }

    // Aquí puedes devolver alguna respuesta al cliente
    echo "Sesiones guardadas correctamente";
} else {
    // Si no es una solicitud POST, puedes devolver algún mensaje de error
    echo "Error en la solicitud";
}
?>