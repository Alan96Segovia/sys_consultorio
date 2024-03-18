<?php 
include("../clases/conexion.php");

//obtengo los datos del formulario - datos para la cabecera 
// Obtiene la cantidad de detalles del formulario
$cantidad = $_POST['cantidadDetalles'];



$paciente_id = $_POST['idp'];
$fecha_ing = date('d/m/y', strtotime($_POST['fecha_ing']));  /**fecha que adquirio las sessiones */
$E_plan = $_POST['E_plan'];/**id del estado de la session */
$tipoPlan = $_POST['tipoPlan'];/**id del plan adquirido */

//inserto la cabecera 
$insert_cabecera = "INSERT INTO pacientes_sesiones
(paciente_id,fecha_session,estado_id,plan_id)
VALUES ($paciente_id,$fecha_ing,$E_plan,$tipoPlan) RETURNING id ;";

//ejecuto query de insercion para la cabecera 
$excute_insert($conexion,$insert_cabecera);

/**pregunto su inserto resultado */

if($excute_insert){

}else{
    //obtengo el id de la cabecera que inserte
    $row = pg_fetch_assoc($excute_insert);
    $id_cabera = $row['id'];

    //Realizo la insercion en los detalles

}



?>