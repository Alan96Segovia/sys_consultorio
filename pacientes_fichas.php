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

//consulta de la fichas 
$query_fichas = "SELECT * FROM view_fichas order by ficha_nro";
$excute_query_fichas = pg_query($conexion, $query_fichas);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pacientes Fichas</title>
    <style>
        .status-circle {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 5px;
}

.active {
    background-color: #28a745; /* Color de éxito de Bootstrap (verde) */
}

.inactive {
    background-color: #ffc107; /* Color de advertencia de Bootstrap (amarillo) */
}

    </style>

    <!--Adjunto mis librerias a utilizar -->
    <?php include('librerias.php') ?>
    <!--fin de archivos a utilizar -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <?php
        /*agrego barra de navegacion*/
        include('barra_navegacion.php')
        ?>
        <?php
        include('panel_lateral.php')
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Fichas </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="menu.php">Menu Principal</a></li>
                                <li class="breadcrumb-item active">Ficha Paciente</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <div class="form-group">
                            <div class="row">
                                <h3 class="card-title mb-0">Lista de Fichas de los Pacientes</h3>
                            </div>
                            <div class="row">
                                <a href="add_ficha.php" class="card-title" target="_blank">
                                    <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">
                                        Crear Nueva Ficha <i class="fas fa-plus-circle"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="contenedorMensajesError">
                            <p>
                                <span class="status-circle active"></span> Activo
                                <span class="status-circle inactive"></span> Inactivo
                            </p>
                            <p>
                                
                            </p>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="h6">
                                    <th>Ficha Nro</th>
                                    <th>Paciente Cedula</th>
                                    <th>Nombre y Apellido</th>
                                    <th>Motivo de Consulta</th>
                                    <th>Bandera</th>
                                    <th>Evaluacion</th>
                                    <th>Diagnostico</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*muestro el resultado de mi consulta */
                                $i = 1;
                                while ($row_fichas = pg_fetch_array($excute_query_fichas)) {
                                ?>

                                    <tr class="h6 <?php if ($row_fichas['estado_id'] == 5) {
                                                        echo 'bg-success';
                                                    } else {
                                                        echo 'bg-warning';
                                                    } ?>">
                                        <td><a target="_blank" style="text-decoration: none;color:black;" href="ficha_paciente.php?id=<?php echo $row_fichas['ficha_id'] ?>"> <?php echo $row_fichas['ficha_nro'] ?></a></td>
                                        <td><?php echo $row_fichas['nro_ci'] ?></td>
                                        <td><?php echo $row_fichas['nombre'] . ' ' . $row_fichas['apellido'] ?></td>
                                        <td><?php echo $row_fichas['motivo_consulta'] ?></td>
                                        <td><?php echo $row_fichas['banderas'] ?></td>
                                        <td><?php echo $row_fichas['ficha_evaluacion'] ?></td>
                                        <td><?php echo $row_fichas['ficha_diagnostico'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="edit_ficha.php?id=<?php echo $row_fichas['ficha_id']; ?>" title="Editar" class="btn btn-warning btn-sm btn-editar">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row_fichas['ficha_id'] ?>" data-nombre="<?php echo  $row_fichas['nombre'] . ' ' . $row_fichas['apellido'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                <?php
                                    /**cierro while de consulta */
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- modal eliminar -->
                    <?php include('modal_delete_ficha.php') ?>
                    <!--Mensaje de Error -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!--Adjunto scripts jquery y js -->
    <?php include('scripts_js.php') ?>
    <!--termino de adjuntar scripts jquery y js -->

    <!--scripts para datatables -->
    <script src="js/delete_fichas.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "language": {
                    url: 'js/datatable.es.json',
                },
                "dom": 'Bfrtip', // Indica que se utilizarán los botones (B) y el contenedor (f) para filtrar, (r) para procesar la tabla, (i) para información y (p) para la paginación
                "buttons": ["copy", "csv", "excel", "pdf", "print"],
                "columnDefs": [{
                        "orderable": false,
                        "targets": 7
                    }, // Deshabilita la ordenación en la columna de opciones
                    {
                        "searchable": false,
                        "targets": 7
                    }, // Deshabilita la búsqueda en la columna de opciones
                    {
                        "visible": true,
                        "targets": 7
                    } // Muestra la columna de opciones
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>