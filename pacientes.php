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


/*traigo todos los pacientes*/
$query = "SELECT paciente_id,
paciente_fecha,
paciente_nombre ||' '|| paciente_apellido as paciente,
paciente_consulta as consulta,
EXTRACT(YEAR from age(CURRENT_DATE,paciente_fechanac)) as edad,
paciente_fechanac as fechanac,
paciente_correo,
paciente_celular,
paciente_ci,
contacto_familiar,
pacientes.estado_id,
e.estado_nombre
FROM pacientes 
JOIN estados e ON pacientes.estado_id = e.estado_id
ORDER BY paciente_id ";
$execute = pg_query($conexion,$query);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pacientes</title>
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
    <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1> </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"></a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

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
          <h3 class="card-title">Listado de Pacientes<button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Agregar Paciente <i class="fas fa-plus-circle"></i></button></h3>
        </div>

        <!-- Modal Agregar-->
        <?php include('modal_add_pacientes.php'); ?>
        <!-- fin modal Agregar -->

        <!-- modal eliminar -->
        <?php include('modal_delete_pacientes.php') ?>
        <!--Mensaje de Error -->
        <div class="container">
            <div id="contendorMensajesError"></div>
          </div>
          <!--Mensaje de Error -->
        <!--fin modal eliminar -->

        <!-- Modal Editar-->
        <?php include('modal_edit_pacientes.php'); ?>
        <!-- fin modal Editar -->

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="h6">
                <th>Nro</th>
                <th>Fecha</th>
                <th>Nombre y Apellido</th>
                <th>Motivo de Consulta</th>
                <th>Edad</th>
                <th>Fecha de Nacimiento</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Nro de cedula o Ruc</th>
                <th>Contacto de Urgencia</th>
                <th>Estado</th>
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
                  <td><?php echo date('d/m/Y', strtotime($row_pacientes['paciente_fecha'])) ?></td>
                  <td><?php echo $row_pacientes['paciente'] ?></td>
                  <td><?php echo $row_pacientes['consulta'] ?></td>
                  <td><?php echo $row_pacientes['edad'] ?></td>
                  <td><?php echo date('d/m/Y', strtotime($row_pacientes['fechanac'])) ?></td>
                  <td><?php echo $row_pacientes['paciente_correo'] ?></td>
                  <td><?php echo $row_pacientes['paciente_celular'] ?></td>
                  <td><?php echo $row_pacientes['paciente_ci'] ?></td>
                  <td><?php echo $row_pacientes['contacto_familiar'] ?></td>
                  <td><?php echo $row_pacientes['estado_nombre'] ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-warning btn-sm btn-editar" data-paceinte-id="<?php echo $row_pacientes['paciente_id'] ?>" data-id="<?php echo $row_pacientes['paciente_id'] ?>"  data-toggle="modal" data-target="#modalEditar"><i class="fas fa-user-edit"></i>

                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row_pacientes['paciente_id'] ?>" data-nombre="<?php echo $row_pacientes['paciente'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
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
      </div>
    </div>
  </div>
  <!--Adjunto scripts jquery y js -->
  <?php include('scripts_js.php') ?>
  <!--termino de adjuntar scripts jquery y js -->
  <!-- Agrego mi scrip para agregr paciente por medio de js-->
<script src="js/agregar_pacientes.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

<!-- Agrego mi scrip para agregr paciente por medio de js-->
<script src="js/delete_pacientes.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

  <!-- Agrego mi scrip para editar paciente por medio de js-->
  <script src="js/cargar_datos_pacientes_edit.js"></script>
  <!-- termina script de editar paciente por medio de js -->

  <!--scripts para datatables -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "columnDefs": [{
            "orderable": false,
            "targets": 11
          }, // Deshabilita la ordenación en la columna de opciones
          {
            "searchable": false,
            "targets": 11
          }, // Deshabilita la búsqueda en la columna de opciones
          {
            "visible": true,
            "targets": 11
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