<?php
include('clases/conexion.php');
//inicio o reanudo la session 
session_start();
//verificar si el usuario a iniciado sesion

if(!isset($_SESSION['usuario_id'])){
    //si no ha iniciado sesion, redirigir a login.php
    header('location:index.php');
    exit();
}

///////capturo el id de la sesion de la tabla cabecera -  pacientes sesiones///////
$id = $_GET['id']; //id de la tabla pacientes_sesiones
$cabecera_id = $id;
//consutlo la vista view sesiones para mostrar los datos del paciente en la cabecera
$query_view_sesiones = "SELECT * FROM view_sessiones WHERE paciente_sessionid =$id";
$excute_view_sessiones = pg_query($conexion, $query_view_sesiones);
//variable para las alertas 
$verde ='#28a745';
$amarillo = '#ffc107';
$rojo = '#dc3545';

while ($datos_pacientes = pg_fetch_array($excute_view_sessiones)) {
    $paciente_sessionid = $datos_pacientes['paciente_sessionid'];
    $paciente_id = $datos_pacientes['paciente_id'];
    $nombre_paciente = $datos_pacientes['nombres'];
    $plan_id = $datos_pacientes['plan_id'];
    $profesional = $datos_pacientes['profesional_id'];
    $profesional_datos = $datos_pacientes['profesional'];
    $plan = $datos_pacientes['plan'];
    /**nombre del plan */
    $fecha_sesion = date('d/m/Y', strtotime($datos_pacientes['fecha_sesion']));/*fecha del plan  */
    // Convertir la fecha al formato 'YYYY-MM-DD' para mostrar en el input date
    $fecha_sesion_formato_correcto = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_sesion)));

    $estado_id = $datos_pacientes['estado_id'];
    $estado = $datos_pacientes['estado'];
    $consultorio_id=$datos_pacientes['consultorio_id'];
    $consultorio=$datos_pacientes['consultorio'];
    $tipo_pago_id=$datos_pacientes['tipo_pago_id'];
    $tipo_pago=$datos_pacientes['tipo_pago'];
}
/**controlo la cantidad de sesiones cuales son presentes , ausente, reagendado */
$control_sesiones ="SELECT
COUNT(*) AS total_sesiones,
COUNT(CASE WHEN estado_id = 3 THEN 1 END) AS total_presente,
COUNT(CASE WHEN estado_id = 4 THEN 1 END) AS total_ausente,
COUNT(CASE WHEN estado_id = 7 THEN 1 END) AS total_reagendado
FROM 
pacientes_sessiones_det
WHERE 
paciente_sessionid = $paciente_sessionid;";
$execute_control_sesiones = pg_query($conexion,$control_sesiones);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Sesiones</title>
    <!--Adjunto mis librerias a utilizar -->
    <?php include('librerias.php') ?>
    <!--fin de archivos a utilizar -->

    <!--Adjunto scripts para insertar mas detalles de sesiones -->
    <script src="js/add_sesionesDetalles.js"></script>
    <!--termino de adjuntar scripts para insertar mas detalles de sesiones -->
    <!--Adjunto scripts para insertar mas detalles de sesiones -->
    <script src="js/delete_detalleSesion.js"></script>
    <!--termino de adjuntar scripts para insertar mas detalles de sesiones -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">



    <!--Agrego script para realizar el update -->
    <script src="js/edit_sesiones.js"></script>
    <div class="wrapper">
        <!-- Preloader -->
        <?php
        /*agrego barra de navegacion*/
        include('barra_navegacion.php')
        ?>
        <?php
        include('panel_lateral.php')
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) 
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pacientes</h1>
            </div>
          </div>
          
        </div>
      </div>-->
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h6 class="modal-title">Editar las Sesiones</h6>
                        <a href="sessiones.php" class="btn btn-success">Volver lista de Sesiones</a>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Muestro la cantida de sesiones , ausentes presentes y reagendados  -->
                        <?php while($row_total_sesiones = pg_fetch_array($execute_control_sesiones)){ 
                                    $sesiones = $row_total_sesiones['total_sesiones'];
                                    $presentes = $row_total_sesiones['total_presente'];
                                    $ausentes = $row_total_sesiones['total_ausente'];
                                    $reagendado = $row_total_sesiones['total_reagendado'];
                                } ?>
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="#" class="form-label"> <h4> Total Sesiones =  <?php echo  $sesiones; ?></h4> </label>
                                        </div>
                                        <div class="col">
                                            <label for="#" class="form-label"> <h4>Presentes = <?php echo $presentes; ?></h4></label>
                                        </div>
                                        <div class="col">
                                            <label for="#" class="form-label"><h4>Ausentes = <?php echo $ausentes; ?></h4> </label>
                                        </div>
                                        <div class="col">
                                            <label for="#" class="form-label"><h4>Reagendado =<?php echo $reagendado; ?></h4> </label>
                                        </div>
                                    </div>
                        <!--Fin donde muestro el control de las sesiones  -->
                        <!-- Contenedor para mensajes -->
                        <div id="mensajesContainer"></div>
                        <form id="formularioCabecera" autocomplete="off" onsubmit="event.preventDefault(); ActaulizarSesiones();">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Paciente_cedula" class="form-label">
                                        Paciente
                                    </label>
                                    <input type="text" class="form-control" id="Paciente" value="<?php echo $nombre_paciente ?>" readonly autofocus require>
                                    <input type="hidden" id="paciente_id" name="paciente_id" value="<?php echo $paciente_id; ?>">
                                    <?php /* aqui debajo guardo el id de la tabla cabecera pacientes_sesiones*/ ?>
                                    <input type="hidden" id="paciente_sessionid" name="paciente_sessionid" value="<?php echo $paciente_sessionid; ?>">
                                </div>
                                <div class="col">
                                    <label for="tipoPlan" class="form-label">
                                        Tipo de Plan
                                    </label>
                                    <input type="hidden" class="form-control" id="plan_id" name="plan_id" value="<?php echo $plan_id ?>">
                                    <input type="text" class="form-control" id="plan" name="plan" value="<?php echo $plan ?>" readonly autofocus require>
                                </div>
                                <div class="col">
                                    <label for="fecha_ing" class="form-label">Fecha Adquisicion del Plan</label>
                                    <input type="date" readonly class="form-control" name="fecha_ing" id="fecha_ing" value="<?php echo $fecha_sesion_formato_correcto; ?>">
                                    <small class="font-weight-bold">Escribir fecha en formato DD/MM/YYYY</small>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="profesional" class="form-label">
                                        profesional
                                    </label>
                                    <input type="text" class="form-control" readonly id="profesional" name="profesional" value="<?php echo $profesional_datos; ?>">
                                    <input type="hidden" class="form-control" readonly id="profesional_id" name="profesional_id" value="<?php echo $profesional; ?>">
                                    
                                </div>
                                <div class="col">
                                    <label for="E_plan" class="form-label">
                                        Estado del Plan
                                    </label>
                                    <select class="form-control" name="estado_id_cab" id="estado_id_cab<?php echo  $i ?>" required>
                                            <?php
                                            $query_estados_cab = 'Select * from estados where estado_id in (1,2)';
                                            $excute_query_estados_cab = pg_query($conexion, $query_estados_cab);

                                            while ($row_estados_cab = pg_fetch_array($excute_query_estados_cab)) {
                                            ?>
                                                <option  value="<?php echo $row_estados_cab['estado_id'] ?>"><?php echo $row_estados_cab['estado_nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    
                                    <!-- <input type="hidden" class="form-control" name="estado_id" id="estado_id" value="<?php //echo $estado_id; ?>">
                                    <input type="text" class="form-control" name="estado" id="estado" value="<?php // echo $estado; ?>" readonly> -->
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                <label for="consultorio" class="form-label">
                                        Lugar de Sesion
                                    </label>
                                    <input type="text" class="form-control" readonly id="consultorio" name="consultorio" value="<?php echo $consultorio; ?>">
                                    <input type="hidden" class="form-control" readonly id="consultorio_id" name="consultorio_id" value="<?php echo $consultorio_id; ?>">
                                    
                                </div>
                                <div class="col">
                                <label for="tipoPago" class="form-label">
                                        Forma de Pago
                                    </label>
                                    <input type="text" class="form-control" readonly id="tipoPago" name="tipoPago" value="<?php echo $tipo_pago; ?>">
                                    <input type="hidden" class="form-control" readonly id="tipo_pago_id" name="tipo_pago_id"  value="<?php echo $tipo_pago_id; ?>">
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <a class="btn btn-block btn-warning btn-lg" href="sessiones.php" role="button">Atras</a>
                                </div>
                            </div>
                            <!-- Campo oculto para la cantidad de detalles -->
                            <input type="hidden" id="cantidadDetalles" name="cantidadDetalles" data-cantidad="">
                            <!-- Botón para agregar detalles -->
                            <!-- <button type="button" class="btn btn-primary" onclick="mostrarFormularioDetalles()">Agregar Detalles</button> -->
                            <!-- <button type="submit" class="btn btn-success">Guardar Sesiones</button> -->

                        </form>
                        
                        <!-- Formulario de detalles de sesión -->
                        <form id="formularioDetalles" autocomplete="off">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3>Detalles de Sesión
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="Agregar más detalles">
                                            <i class="fas fa-plus-circle"></i>
                                        </button>
                                    </h3>
                                </div>
                            </div>



                            <!--Aca debajo muestro todos los detalles de la sesion -->
                            <?php
                            /*realizo una consulta de la tabla de detalles - pacientes sessiones det */
                            $sql_detalles  = "SELECT * FROM pacientes_sessiones_det WHERE paciente_sessionid=$paciente_sessionid";
                            $execute_sql_detalles = pg_query($conexion, $sql_detalles);
                            $i = 1;
                            while ($row_detalles = pg_fetch_array($execute_sql_detalles)) {
                                $estado_id_detalle = $row_detalles['estado_id'];
                                $session_detalle_id = $row_detalles['session_detalle_id'];
                                $fecha_hora_session = $row_detalles['fechahora_sesion'];
                                // Convertir el formato de la fecha y hora para mostrar en el iput de fecha y hora
                                $fecha_hora_formateada = date('Y-m-d\TH:i', strtotime($fecha_hora_session));
                                $color;

                                if($estado_id_detalle == 3){
                                    $color =$verde ;
                                }
                                if($estado_id_detalle == 4){
                                    $color =$rojo ;
                                }
                                if($estado_id_detalle == 7){
                                    $color =$amarillo ;
                                }



                            ?>
                                <div class="detalle_1 row" id="detalle_<?php echo  $i ?>">
                                    <div class="col-md-4">

                                        <label class="form-label" for="fecha_session_<?php echo  $i ?>">Fecha Para Sesión <?php echo  $i ?>:</label>
                                        <input type="datetime-local" class="form-control" id="fecha_session_<?php echo  $i ?>" name="fecha_session[]" value="<?php echo $fecha_hora_formateada ?>" required>
                                        <?php /* aqui debajo guardo el id de la tabla detalle pacientes_sesiones*/ ?>
                                        <input type="hidden" id="session_detalle_id" name="session_detalle_id[]" value="<?php echo $session_detalle_id; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="estado_id_<?php echo  $i ?>">Estado para Sesión <?php echo  $i ?>:</label>
                                        <select style="color:#ffff;background-color:<?php echo $color ?> ; border-color:<?php echo $color; ?>;" class="form-control" name="estado_id[]" id="estado_id_<?php echo  $i ?>" required>
                                            <?php
                                            $query_estados = 'Select * from estados where estado_id in (3,4,7)';
                                            $excute_query_estados = pg_query($conexion, $query_estados);

                                            while ($row_estados = pg_fetch_array($excute_query_estados)) {
                                                 $row_estados['estado_id'];
                                                 $estado_id_detalle;
                                                 $selected = ($row_estados['estado_id'] == $estado_id_detalle) ? "selected" : "";
                                            

                                            ?>
                                                <!-- <option value="<?php //echo $row_estados['estado_id'] ?>"><?php // echo $row_estados['estado_nombre'] ?></option> --> 
                                                <option value="<?php echo $row_estados['estado_id'] ?>" 
                                                    <?php echo $selected ?>><?php echo $row_estados['estado_nombre'] ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="estado_id_<?php echo  $i ?>">Desea Eliminar la Sesión <?php echo  $i ?>:</label><br>
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $session_detalle_id; ?>"  data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php
                                //aca cierro el while donde muestro los detalles de la tabla - pacientes sessiones det
                                // Incrementa $i solo una vez por cada recorrido
                                $i++;
                            }
                            ?>
                            <div class="modal-footer">
                                <!-- Contenedor para detalles de sesión -->
                                <div id="detallesContainer"></div>

                                <!-- Botones para agregar y quitar detalles -->
                                <!-- <button type="button" class="btn btn-primary" onclick="agregarDetalle()">Agregar Detalle</button> -->
                                <button type="button" class="btn btn-success" onclick="ActaulizarSesiones()">Actualizar Sesiones</button>
                                <!-- <button type="button" class="btn btn-secondary" onclick="ocultarFormularioDetalles()">Cancelar</button> -->
                                <!-- <button type="button" class="btn btn-success" onclick="actualizarDetalles()">Guardar Detalles</button> -->
                            </div>
                        </form>
                        <!--Agrego modal para realizar la eliminacion de una sesion -->
                        <?php include('modal_delete_DetalleSesiones.php') ?>
                        <!-- agrego mi modal para agregar mas detalles en la sesiones -->
                        <?php include('modal_add_sesionesDetalles.php'); //se utiliza para agregar mas detalles en la tabla sesiones detalles 
                        ?>
                    </div>
                    <!-- <div class="modal-footer">
                        <!-- Botón para enviar formulario -->
                    <!-- <button type="button" class="btn btn-success" onclick="guardarSesiones()">Guardar Sesiones</button>
                    </div> -->
                </div>
            </section>
            <!-- /.content -->

        </div>
    </div>
    <!--Adjunto scripts jquery y js -->
    <?php include('scripts_js.php') ?>
    <!--termino de adjuntar scripts jquery y js -->
    <!-- Agrego mi scrip para buscar paciente por medio de js
        el archivo busca los pacientes que ya consultaron
    -->
    <script src="js/buscar_pacientes_consultas.js"></script>
    <!-- termina script buscar paciente por medio de js -->


</body>

</html>