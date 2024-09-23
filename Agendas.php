<?php
include('clases/conexion.php');
//inicio o reanudo la session 
session_start();

//verificar si el usuario a iniciado sesion

if (!isset($_SESSION['usuario_id'])) {
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
    <title>Agenda</title>
    <style>
        .fc-day-today {
            background: #8BDCB2 !important;
            border-style: solid;
        }
    </style>
    <!--Adjunto scripts jquery y js -->
    <?php include('scripts_js.php') ?>
    <!--Adjunto mis librerias a utilizar -->
    <?php include('librerias.php') ?>
    <!--fin de archivos a utilizar -->
    <!-- <link rel="stylesheet" href="fullcalendar/lib/main.css">
    <script src="fullcalendar/lib/main.js"></script> -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <!-- <script src='fullcalendar/dist/index.global.js'></script> -->
    <script src='fullcalendar/fullcalendar-6.1.10/dist/index.global.js'></script>
    <!--Para manejar lasfechas en js  -->
    <script src="plugins/bootstrap/js/moment.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                //initialView: 'dayGridMonth',
                initialView: 'timeGridWeek', // Cambiar la vista inicial
                locale: 'es',
                buttonText: {
                    today: 'Hoy' // Personaliza el texto del botón "Today"
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                navLinks: true, // Habilita los enlaces de navegación
                events: 'view_agendamientos.php', // Pasa la ruta a tu script PHP que obtiene eventos
                //esta función personaliza la presentación de los eventos en el calendario,
                // mostrando la hora formateada, el nombre del paciente en negrita y 
                //el icono del consultorio.
                allDaySlot: false, // Desactiva la franja horaria de "Todo el día"
                scrollTime: '05:00:00', // Comenzar a mostrar desde las 05:00
                slotDuration: '00:30:00', // Duración de cada franja horaria
                minTime: '05:00:00', // Hora mínima
                maxTime: '21:00:00', // Hora máxima
                // Personalización del formato de las etiquetas de hora
        slotLabelFormat: [
            { hour: '2-digit', minute: '2-digit', hour12: false, meridiem: false },
            'numeric'   // Esto asegura que se muestre el "hs" en cada etiqueta
        ],
                eventContent: function(info) {
                    //creo variables donde guardo 
                    //lo que viene del array de view_agendemaientos.php
                    var icono = info.event.extendedProps.consultorio_icono;
                    var hora = info.event.extendedProps.hora;
                    var paciente = info.event.extendedProps.paciente;
                    var consultorio_nombre = info.event.extendedProps.consultorio_nombre;
                    //formateo la hora por medio de la libre de momen js 
                    var HoraFormat = moment(hora, 'HH:mm').format('HH:mm');

                    // Crear un elemento HTML personalizado para mostrar el icono con la hora y nombre 
                    var customElement = document.createElement('div');
                    customElement.innerHTML = HoraFormat + '<b> ' + paciente + '</b> ' + '  <i class="' + icono + '"></i> ';

                    return { 
                        domNodes: [customElement] //Devuelve un objeto con una propiedad domNodes que 
                        //contiene un array con el elemento HTML personalizado.
                        // Este objeto se utiliza para indicar a FullCalendar cómo debe representar el contenido del evento.
                    };
                },
                // Evento viewDidMount se ejecuta después de que la vista del calendario se ha cargado completamente
                viewDidMount: function(view) {
                    // Eliminar los estilos de fc-daygrid-event-harness después de que el calendario se ha montado
                    var eventHarnessElements = document.querySelectorAll('.fc-daygrid-event-harness');
                    eventHarnessElements.forEach(function(element) {
                        element.style = null; // Elimina todos los estilos aplicados
                    });
                },
                //esta funcion se ejecuta cuadno el usuario hace click dentro de un evento en el calendario
                eventClick: function(info) {
                    //accedo a las propiedades extendendidas del evento
                    var extendedProps = info.event.extendedProps;

                    // Accede a los campos específicos
                    var idCabecera = extendedProps.id_cabecera;
                    var id_detalle = extendedProps.id_detalle;
                    var pacienteId = extendedProps.paciente_id;
                    var pacienteCi = extendedProps.paciente_ci;
                    var paciente = extendedProps.paciente;
                    var plan_descrip = extendedProps.plan_descrip;
                    var profesional = extendedProps.profesional;
                    var color = extendedProps.color;
                    var estado_cabecera = extendedProps.estado_cabecera;
                    var estado_nombre_cab = extendedProps.estado_nombre_cab;
                    var estado_nombre = extendedProps.estado_nombre;
                    var consultorio_nombre = extendedProps.consultorio_nombre;
                    var consultorio_icono = extendedProps.consultorio_icono;
                    //console.log('consultorio icono ' + consultorio_icono);
                    var bgColor = info.event.backgroundColor;
                    var brColor = info.event.borderColor;
                    // Formateo de fecha
                    var formattedStart = moment(info.event.start).format('MM/DD/YYYY HH:mm');

                    //esta parte le asigno un valor por medio del id ,
                    //los id deben tener el mismo nombre que contiene los input dentro del modal
                    $('#paciente_nombre').val(paciente);
                    //$('#title').html('<i class="' + consultorio_icono + '"></i> ' + info.event.title);
                    // $('#title').empty().append('<i class="' + consultorio_icono + '"></i> ' + info.event.title);
                    $('#title').html('<i class="' + consultorio_icono + '"></i> ' + info.event.title);

                    $('#start').val(formattedStart);
                    $('#idCabecera').val(idCabecera);
                    $('#id_detalle').val(id_detalle);
                    $('#plan_descrip').val(plan_descrip);
                    $('#profesional').val(profesional);
                    $('#estado_nombre_cab').val(estado_nombre_cab); //estado de la cabecera
                    $('#estado_nombre').val(estado_nombre); //estado de la sesion
                    $('#consultorio_nombre').val(consultorio_nombre); //consultorio nombre


                    //asigno icono 
                    $('#consultorio_icono').addClass(consultorio_icono);
                    // Abre el modal y establece valores
                    $('#myModal').modal('show');
                    // Accede a otros campos
                    // $('#otroCampo').val(extendedProps.otroCampo);

                    // Asigno icono al evento del calendario
                    info.event.setProp('title', '<i class="' + consultorio_icono + '"></i> ' + info.event.title);
                    calendar.rerenderEvents();//actualizar y mostrar visualmente los eventos en el calendario.
                    // En el contexto de la biblioteca FullCalendar,
                    // la función rerenderEvents() se utiliza para volver a procesar y mostrar los eventos en el calendario.
                },

                eventDidMount: function(info) {
                    var bgColor = info.event.backgroundColor;// color de fondo del evento en el calendario
                    var brColor = info.event.borderColor;//color de texto para el evento en el calendario

                    info.el.style.backgroundColor = bgColor;
                    info.el.style.color = '#000000'; // Puedes ajustar el color del texto si es necesario
                    // Eliminar estilos después de un breve retraso para asegurarse de que el calendario se haya cargado completamente
                    //esta funcion setimeout, selecciona todos los elementos con clase y elimina el style right
                    setTimeout(function() {
                        var eventHarnessElements = document.querySelectorAll('.fc-daygrid-event-harness');
                        eventHarnessElements.forEach(function(element) {
                            element.style.right = null; // Elimina todos los estilos aplicados
                        });
                    }, 1000); // Ajusta el tiempo de espera según sea necesario
                },
            });

            // Agrega un controlador de eventos para el clic en el botón "Vista Mensual"
            document.getElementById('vistaMensual').addEventListener('click', function() {
                calendar.changeView('dayGridMonth');
            });

            calendar.render();

        });
    </script>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!--div class="wrapper">
        <!-- Preloader -->
    <?php
    /*agrego barra de navegacion*/
    //include('barra_navegacion.php')
    ?>
    <?php
    //include('panel_lateral.php')
    ?>
    <!div class="content-wrapper">
        <!-- Main content -->
        <!-- <section class="content"> -->
        <div class="container-fluid">
            <nav class=" navbar navbar-expand navbar-white navbar-light">
                <a class="navbar-brand">Agenda</a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link btn btn-primary text-white" data-toggle="dropdown" href="#">
                            <i class="fas fa-user-circle"></i>
                            <?php echo  $_SESSION['nombre_usuario']; ?>
                            <!-- <span class="badge badge-danger navbar-badge">3</span> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="cerrar_sesion.php" class="dropdown-item dropdown-footer">
                                <i class="fas fa-sign-out-alt"></i>
                                Cerrar Session</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <button id="vistaMensual" class="btn btn-primary">Vista Mensual</button>
            <a href="menu.php" class="btn btn-secondary">Volver al Menu</a>
            <!--Aca debajo muestro mi calendario con full calendar -->
            <div id="calendar"></div>
            <!-- Agrega el siguiente código al cuerpo de tu página HTML, antes del script FullCalendar -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b>Detalles Del Plan y las Sesiones</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Aquí puedes agregar el formulario con los campos que desees -->
                            <form method="post" action="agendas.php">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="paciente_nombre">Datos del Paciente:</label>
                                        <input type="text" class="form-control" id="paciente_nombre" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_detalle">Detalle id:</label>
                                        <input type="text" class="form-control" id="id_detalle" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estado_nombre">profesionar:</label>
                                        <select class="form-control" name="idprofesional" id="idprofesional" require>
                                    <option value="">Elegir Profesional</option>
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
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="consultorio_nombre">Lugar de Sesion <i id="consultorio_icono"></i></label>
                                        <input type="text" class="form-control" id="consultorio_nombre" readonly>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="plan_descrip">Plan:</label>
                                        <input type="text" class="form-control" id="plan_descrip" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estado_nombre_cab">Estado del Plan:</label>
                                        <input type="text" class="form-control" id="estado_nombre_cab" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <h6><u><b>Detalles De la Sesion</b></u></h6>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-6">
                                        <label for="start">Fecha y Hora Sesion:</label>
                                        <input type="text" class="form-control" id="start" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estado_nombre">Estado de la Sesion:</label>
                                        <select class="form-control" name="Editestado_id" id="Editestado_id" require>
                                    <option value="">Elegir Estado</option>
                                    <?php 
                                    $q_estado = 'select * from estados where estado_id not in (5,6)';
                                    $execute_estado = pg_query($conexion,$q_estado);
                                    while ($row_estado = pg_fetch_array($execute_estado)) {
                                        $selected = ($row_estado['estado_id'] == 5) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $row_estado['estado_id']; ?>" <?php echo $selected; ?>>
                                            <?php echo $row_estado['estado_nombre']; ?>
                                        </option>
                                    <?php } ?>
                            </select>
                                    </div>
                                </div>
                        </div>
                        <!-- Agrega más campos según sea necesario -->
                       
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info" data-dismiss="modal">Editar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <!-- Puedes agregar botones adicionales aquí si es necesario -->
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        </div>
        <!-- </section> -->
        <! /div>
            <!--/div -->

</body>

</html>