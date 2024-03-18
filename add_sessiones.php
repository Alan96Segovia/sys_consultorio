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

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Sessiones</title>
    <!--Adjunto mis librerias a utilizar -->
    <?php include('librerias.php') ?>
    <!--fin de archivos a utilizar -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
     <!--Adjunto scripts para detalles de sesiones -->
     <script src="js/add_detalles_sesiones.js"></script>
    <!--termino de adjuntar scripts de detalles de sesiones -->
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
                        <h6 class="modal-title">Agregar Session </h6>
                        <a href="sessiones.php" class="btn btn-success">Volver lista de Sesiones</a>

                    </div>
                    <div class="modal-body">
                        <!-- Contenedor para mensajes -->
                        <div id="mensajesContainer"></div>
                        <form id="formularioCabecera" autocomplete="off">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="Paciente_cedula" class="form-label">
                                        Nro. Cedula
                                    </label>
                                    <input type="text" class="form-control" id="Paciente_cedula" placeholder="Ingresar Nro de Cedula" autofocus require>
                                    <small>Escribir numero sin puntos</small>
                                </div>
                                <div class="col">
                                    <label for="nombres" class="form-label">
                                        Datos del Pacientes
                                    </label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Escribir nombre del paciente" readonly>
                                    <input type="hidden" class="form-control" name="idp" id="idp"><!-- id del paciente -->
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="tipoPlan" class="form-label">
                                        Tipo de Plan
                                    </label>
                                    <select class="form-control" name="tipoPlan" id="tipoPlan" onchange="agregarDetallesAutomaticos()">
                                        <option value="0">Elegir un Plan</option>
                                        <?php
                                        /**Realizo el query para mostrar los planes disponibles */
                                        $q_planes = "SELECT * FROM pacientes_planes where estado_id = 5 ORDER BY plan_id";

                                        $execute_query = pg_query($conexion, $q_planes);
                                        while ($fila_plan = pg_fetch_array($execute_query)) { ?>
                                            <option value="<?php echo $fila_plan['plan_id']; ?>"><?php echo $fila_plan['plan_descrip'].' -'.number_format($fila_plan['plan_precio'],0,',','.') ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="fecha_ing" class="form-label">Fecha Adquisicion del Plan</label>
                                    <?php 
                                    date_default_timezone_set('America/Asuncion'); // Establece el huso horario a Asunción, Paraguay
                                    $fecha_actual = date('d/m/Y');
                                    ?>
                                    <input type="text" class="form-control" name="fecha_ing" id="fecha_ing" value="<?php echo $fecha_actual ; ?>">
                                    <small class="font-weight-bold">Escribir fecha en formato DD/MM/YYYY</small>
                                </div>
                                <div class="col">
                                    <label for="profesional" class="form-label">
                                        Elegir Profesional
                                    </label>
                                    <select class="form-control" name="profesional" id="profesional" >
                                        <option value="0">Seleccionar un profesional</option>
                                        <?php
                                        /**Realizo el query para mostrar el estado del plan */
                                        $q_profesional = "SELECT * FROM profesionales WHERE estado_id in(5) ORDER BY Profesional_id";

                                        $execute_profesional = pg_query($conexion, $q_profesional);
                                        while ($fila_profesional = pg_fetch_array($execute_profesional)) { ?>
                                            <option value="<?php echo $fila_profesional['profesional_id']; ?>" require><?php echo $fila_profesional['profesional_nombre'].' '. $fila_profesional['profesional_apellido']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="E_plan" class="form-label">
                                        Estado del Plan
                                    </label>
                                    <select class="form-control" name="E_plan" id="E_plan">
                                        <?php
                                        /**Realizo el query para mostrar el estado del plan */
                                        $q_estados = "SELECT * FROM estados WHERE estado_id in(1) ORDER BY estado_id  ";

                                        $execute_estado = pg_query($conexion, $q_estados);
                                        while ($fila_estado = pg_fetch_array($execute_estado)) { ?>
                                            <option value="<?php echo $fila_estado['estado_id']; ?>"><?php echo $fila_estado['estado_nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="consultorio" class="form-label">
                                        Lugar de Sesion
                                    </label>
                                    <select class="form-control" name="consultorio" id="consultorio">
                                        <option value="">Seleccionar </option>
                                        <?php
                                        /**Realizo el query para mostrar el consultorio */
                                        $q_consultorio = "SELECT * FROM pacientes_consultorios ORDER BY consultorio_id";

                                        $execute_consultorio = pg_query($conexion, $q_consultorio);
                                        while ($fila_consultorio = pg_fetch_array($execute_consultorio)) { ?>
                                            <option value="<?php echo $fila_consultorio['consultorio_id']; ?>"><?php echo $fila_consultorio['consultorio_nombre']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="tipoPago" class="form-label">
                                        Forma de Pago
                                    </label>
                                    <select class="form-control" name="tipoPago" id="tipoPago">
                                        <option value="">Seleccionar Forma de Pago </option>
                                        <?php
                                        /**Realizo el query para mostrar las formas de pago */
                                        $q_pagos = "SELECT * FROM tipos_pagos ORDER BY tipo_pago_id";

                                        $execute_pagos = pg_query($conexion, $q_pagos);
                                        while ($fila_pago = pg_fetch_array($execute_pagos)) { ?>
                                            <option value="<?php echo $fila_pago['tipo_pago_id']; ?>"><?php echo $fila_pago['tipo_pago_desc']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <!-- Campo oculto para la cantidad de detalles -->
                            <input type="hidden" id="cantidadDetalles" name="cantidadDetalles" data-cantidad="">
                            <!-- Botón para agregar detalles -->
                            <button type="button" class="btn btn-primary" onclick="mostrarFormularioDetalles()">Agregar Detalles</button>

                        </form>
                        <!-- Formulario de detalles de sesión -->
                        <form id="formularioDetalles" autocomplete="off" style="display: none;">
                            <h3>Detalles de Sesión</h3>

                            <!-- Contenedor para detalles de sesión -->
                            <div id="detallesContainer"></div>

                            <!-- Botones para agregar y quitar detalles -->
                            <button type="button" class="btn btn-primary" onclick="agregarDetalle()">Agregar Detalle</button>
                            <button type="button" class="btn btn-secondary" onclick="ocultarFormularioDetalles()">Cancelar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- Botón para enviar formulario -->
                        <button type="button" class="btn btn-success" onclick="guardarSesiones()">Guardar Sesiones</button>
                    </div>
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