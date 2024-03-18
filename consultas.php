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


/*traigo todos los pacientes*/
$query = "SELECT * 
FROM view_consultas
ORDER BY paciente_id ";
$execute = pg_query($conexion,$query);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultas</title>
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
          <h3 class="card-title">Listado de Consultas<button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Agregar Consulta <i class="fas fa-plus-circle"></i></button></h3>
        </div>

        <!-- Modal Agregar-->
        <?php include('modal_add_consultas.php'); ?>
        <!-- fin modal Agregar -->

        <!-- modal eliminar -->
        <?php include('modal_delete_consultas.php') ?>
        <!--Mensaje de Error -->
        <div class="container">
            <div id="contendorMensajesError"></div>
          </div>
          <!--Mensaje de Error -->
        <!--fin modal eliminar -->

        <!-- Modal Editar-->
        <?php include('modal_edit_consultas.php'); ?>
        <!-- fin modal Editar -->

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="h6">
                <th>Nro</th>
                <th>C.I</th>
                <th>Datos Personales</th>
                <th>Fecha Consulta</th>
                <th>Motivo de Consulta</th>
                <th>Monto</th>
                <th>Opciones</th>
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
                  <td><?php echo $row_pacientes['paciente_ci'] ?></td>
                  <td><?php echo $row_pacientes['nombres'] ?></td>
                  <td><?php echo date('d/m/Y', strtotime($row_pacientes['fecha_consulta'])) ?></td>
                  <td><?php echo $row_pacientes['consulta_motivo'] ?></td>
                  <td><?php echo number_format( $row_pacientes['monto_consulta'],0,',','.') ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-warning btn-sm btn-editar" data-paceinte-id="<?php echo $row_pacientes['consulta_id'] ?>" data-id="<?php echo $row_pacientes['consulta_id'] ?>"  data-toggle="modal" data-target="#modalEditar"><i class="fas fa-user-edit"></i>

                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row_pacientes['consulta_id'] ?>" data-nombre="<?php echo $row_pacientes['nombres'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
                        </button>

                    </div>
                    
                  </td>
                </tr>
              <?php
                /**cierro while de consulta */
                $acumulador = $acumulador + $row_pacientes['monto_consulta'];
              }
              ?>
            </tbody>
            <tfoot class="font-weight-bold">
                <tr>
                  <td colspan="5"><?php echo 'Total Consulta: ' ?></td>
                  <td colspan="2"><?php echo number_format($acumulador,0,',','.') ?></td>
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

<!-- Agrego mi scrip para buscar paciente por medio de js-->
<script src="js/buscar_pacientes.js"></script>
  <!-- termina script buscar paciente por medio de js -->

  <!-- Agrego mi scrip para agregr consulta por medio de js-->
<script src="js/agregar_consultas.js"></script>
  <!-- termina script de agregar consulta por medio de js -->

<!-- Agrego mi scrip para agregr paciente por medio de js-->
<script src="js/delete_consultas.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

  <!-- Agrego mi scrip para editar paciente por medio de js-->
  <script src="js/cargar_datos_consultas_edit.js"></script>
  <!-- termina script de editar paciente por medio de js -->

  <!--scripts para datatables -->
  <script>
   $('#exampleModal').on('shown.bs.modal', function () {
  // Establecer el foco en el campo de cédula cuando se muestra el modal
  $('#Paciente_cedula').focus();
});
  $(function() {
  $("#example1").DataTable({
    "dom": 'Bfrtip',
    "buttons": [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "columnDefs": [{
      "orderable": false,
      "targets": 6
    }, {
      "searchable": false,
      "targets": 6
    }, {
      "visible": true,
      "targets": 6
    }]
  });
});

  </script>
</body>

</html>