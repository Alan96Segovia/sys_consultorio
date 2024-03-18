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
$query = "SELECT * FROM view_usuarios";
$execute = pg_query($conexion,$query);

///TRAIGO LOS ESTADOS
$q_estado = "SELECT * from estados where estado_id in(5,6)";
$executeq_estado = pg_query($conexion, $q_estado);

/**traigo los grupos para el usuario */

$q_grupos = "SELECT * from grupos order by grupo_id";
$execute_grupo = pg_query($conexion,$q_grupos);
$execute_Egrupo = pg_query($conexion,$q_grupos);//para el modal de edicion

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuarios</title>
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
          <h3 class="card-title">Listado de Usuarios<button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">Agregar Usuarios <i class="fas fa-plus-circle"></i></button></h3>
        </div>

        <!-- Modal Agregar-->
        <?php include('modal_add_usuarios.php'); ?>
        <!-- fin modal Agregar -->

        <!-- modal eliminar -->
        <?php include('modal_delete_usuarios.php') ?>
        <!--Mensaje de Error -->
        <div class="container">
            <div id="contendorMensajesError"></div>
          </div>
          <!--Mensaje de Error -->
        <!--fin modal eliminar -->

        <!-- Modal Editar-->
        <?php include('modal_edit_usuarios.php'); ?>
        <!-- fin modal Editar -->

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="h6">
                <th>Nro</th>
                <th>Usuario</th>
                <th>Datos del Usuario</th>
                <th>Grupo</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              /*muestro el resultado de mi consulta */
              $i = 1;
              while ($row_usuarios = pg_fetch_array($execute)) {
              ?>
                <tr class="h6">
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row_usuarios['usuario'] ?></td>
                  <td><?php echo $row_usuarios['nombre_usuario']?></td>
                  <td><?php echo $row_usuarios['grupo_nombre']?></td>
                  <td><?php echo $row_usuarios['estado_nombre'] ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-warning btn-sm btn-editar" data-paceinte-id="<?php echo $row_usuarios['usuario_id'] ?>" data-id="<?php echo $row_usuarios['usuario_id'] ?>"  data-toggle="modal" data-target="#modalEditar"><i class="fas fa-user-edit"></i>

                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row_usuarios['usuario_id'] ?>" data-nombre="<?php echo $row_usuarios['nombre_usuario'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
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
<script src="js/agregar_usuarios.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

<!-- Agrego mi scrip para agregr paciente por medio de js-->
<script src="js/delete_usuarios.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

<!-- Agrego mi scrip para editar paciente por medio de js-->
<script src="js/cargar_datos_usuarios_edit.js"></script>
  <!-- termina script de editar paciente por medio de js -->

  <!--scripts para datatables -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "columnDefs": [{
            "orderable": false,
            "targets": 5
          }, // Deshabilita la ordenación en la columna de opciones
          {
            "searchable": false,
            "targets": 5
          }, // Deshabilita la búsqueda en la columna de opciones
          {
            "visible": true,
            "targets": 5
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