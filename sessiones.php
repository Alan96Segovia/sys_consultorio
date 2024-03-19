<?php
error_reporting(0);
include('clases/conexion.php');
//inicio o reanudo la session 
session_start();

//verificar si el usuario a iniciado sesion

if(!isset($_SESSION['usuario_id'])){
      //si no ha iniciado sesion, redirigir a login.php
      header('location:index.php');
      exit();
}


/*traigo todos los pacientes con seesiones*/
$query = "SELECT *
FROM view_sessiones 
ORDER BY paciente_sessionid ";
$execute = pg_query($conexion, $query);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sessiones</title>
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
            <div class="col-sm-6">
              <h1 class="m-0">#</h1>
            </div>
          </div>
          
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <p>Listado de Sessiones</p>
            <a href="add_sessiones.php" class="btn btn-primary">Agregar Sesiones <i class="fas fa-plus-circle"></i> </a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="h6">
                <th>Nro</th>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Plan</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              /*muestro el resultado de mi consulta */
              
              $i = 1;
              while ($row_pacientes = pg_fetch_array($execute)) {
              ?>
                <tr class="h6">
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row_pacientes['nombres'] ?></td>
                  <td><?php echo $row_pacientes['profesional'] ?></td>
                  <td><?php echo $row_pacientes['plan'] ?></td>
                  <td><?php echo number_format($row_pacientes['plan_precio'],0,',','.')  ?></td>
                  <td><?php echo $row_pacientes['estado'] ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="editar_sesion.php?id=<?php echo $row_pacientes['paciente_sessionid']; ?>" title="Editar" class="btn btn-warning btn-sm btn-editar">
                        <i class="fas fa-user-edit"></i>
                      </a> 
                    </div>
                  </td>
                </tr>
              <?php
                /**cierro while de consulta */
                $acumulador = $acumulador + $row_pacientes['plan_precio'];
              }
              ?>
            </tbody>
            <tfoot class="font-weight-bold">
                <tr>
                  <td colspan="4"><?php echo 'Total: ' ?></td>
                  <td colspan="3"><?php echo number_format($acumulador,0,',','.') ?></td>
                </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  <!--Adjunto scripts jquery y js -->
  <?php include('scripts_js.php') ?>
  <!--termino de adjuntar scripts jquery y js -->

  <!--scripts para datatables -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "columnDefs": [{
            "orderable": false,
            "targets": 6
          }, // Deshabilita la ordenación en la columna de opciones
          {
            "searchable": false,
            "targets": 6
          }, // Deshabilita la búsqueda en la columna de opciones
          {
            "visible": true,
            "targets": 6
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