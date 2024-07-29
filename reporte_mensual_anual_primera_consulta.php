<?php
include('clases/conexion.php');
include('funciones.php');
error_reporting(0);
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
    <title>Reportes - EPW</title>
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
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-9">
                            <!-- <h1 class="m-0">Reporte mensual y anual de la primera consulta.</h1> -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- left column -->
                    <div class="col-md-6 mt-5">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Reporte mensual y anual de la primera consulta.</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="reporte_mensual_anual_primera_consulta.php" method="post" name="Rpt_mensual_anual" autocomplete="off">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="year">Año</label>
                                        <input type="number" min="0" class="form-control" name='year' id="year" placeholder="ingresar Año ">
                                    </div>
                                    <div class="form-group">
                                        <label for="mes">Seleccionar Mes</label>
                                        <select class="form-control" name="mes" id="mes">
                                            <option value="">Seleccionar Mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Consultar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.container-fluid -->

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //pregunto si se realizo el post
                        $mes = $_POST['mes'];
                        $year = $_POST['year'];

                        $query;

                        if(empty($mes) and empty($year)){
                            $query = "SELECT * FROM view_consultas  ORDER BY mes, anho";
                        }else{
                            $query = "SELECT * FROM view_consultas WHERE mes= $mes and anho = $year   ORDER BY mes, anho";

                        }

                        $query_view_consultas = $query;
                        $execute_query = pg_query($conexion, $query_view_consultas);

                        $cant = pg_num_rows($execute_query);
                        $total;
                        if ($cant > 0) { //si hay cantidad de resultados muestro la tabla 

                    ?>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center font-weight-bold">
                                    <thead>
                                        <tr>
                                            <td colspan="7">CONSULTAS DEL MES DE <?php echo  nombre_mes($mes) ?> DEL AÑO <?php echo $year ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Nro</td>
                                            <td>Cedula</td>
                                            <td>Paciente</td>
                                            <td>Fecha Consulta</td>
                                            <td>Mes - Año</td>
                                            <td>Motivo Consulta</td>
                                            <td>Monto Consulta</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($fila = pg_fetch_array($execute_query)) { 
                                            $total = $total + $fila['monto_consulta'];
                                            ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td><?php echo $fila['paciente_ci']; ?></td>
                                                <td><?php echo $fila['nombres']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($fila['fecha_consulta'])); ?></td>
                                                <td><?php echo nombre_mes($fila['mes']) . ' ' . $fila['anho']; ?></td>
                                                <td><?php echo $fila['consulta_motivo']; ?></td>
                                                <td><?php echo $fila['monto_consulta']; ?></td>
                                            </tr>
                                        <?php } //cierro mi ciclo while 
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-right">TOTAL</td>
                                            <td><?php echo $total; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } else { //cierro if donde pregunto por la cantidad 
                            ?>
                                <h3 class="alert alert-info">No Se encontraron Resultados.. Volver a Consultar!</h3>
                            <?php } ?>
                            </div>

                        <?php } //fin donde pregunto si se realizo el post
                        ?>
                </div>
            </section>
            <!-- /.content -->
        </div>

    </div>
    <!--Adjunto scripts jquery y js -->
    <?php include('scripts_js.php') ?>

    <!--termino de adjuntar scripts jquery y js -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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