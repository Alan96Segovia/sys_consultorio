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
$query = "SELECT * FROM profesionales  order by profesional_id ";
$execute = pg_query($conexion,$query);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profesionales </title>
  <!--Adjunto mis librerias a utilizar -->
  <?php include('librerias.php') ?>
  <!--fin de archivos a utilizar -->

  <style>
    .circulo {
    width: 20px; /* Ancho del círculo */
    height: 20px; /* Altura del círculo */
    border-radius: 50%; /* Asegura que el elemento sea un círculo */
}
  </style>
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
          <h3 class="card-title">Listado de Profesionales
            <button type="button" class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal">
              Agregar Profesional <i class="fas fa-plus-circle"></i></button></h3>
        </div>

        <!-- Modal Agregar-->
        <?php include('modal_add_profesional.php'); ?>
        <!-- fin modal Agregar -->

        <!-- modal eliminar -->
        <?php include('modal_delete_profesional.php') ?>
        <!--Mensaje de Error -->
        <div class="container">
            <div id="contendorMensajesError"></div>
          </div>
          <!--Mensaje de Error -->
        <!--fin modal eliminar -->

        <!-- Modal Editar-->
        <?php include('modal_edit_profesional.php'); ?>
        <!-- fin modal Editar -->

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="h6">
                <th>Nro</th>
                <th>Nombre y Apellido</th>
                <th>Color</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              /*muestro el resultado de mi consulta */
              $i = 1;
              while ($row_profesionales = pg_fetch_array($execute)) {
              ?>
                <tr class="h6">
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $row_profesionales['profesional_nombre'].' '. $row_profesionales['profesional_apellido'] ?></td>
                  <td> <div class="circulo" style="background-color: <?php echo $row_profesionales['profesional_color']; ?>;"><?php //echo $row_profesionales['profesional_color']; ?> </div> </td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-warning btn-sm btn-editar" data-paceinte-id="<?php echo $row_profesionales['profesional_id'] ?>" data-id="<?php echo $row_profesionales['profesional_id'] ?>"  data-toggle="modal" data-target="#modalEditar"><i class="fas fa-user-edit"></i>

                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row_profesionales['profesional_id'] ?>" data-nombre="<?php echo $row_profesionales['profesional_nombre'] ?>" data-toggle="modal" data-target="#modalEliminar"><i class="fas fa-trash-alt"></i>
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
<script src="js/agregar_profesional.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

<!-- Agrego mi scrip para agregr paciente por medio de js-->
<script src="js/delete_profesional.js"></script>
  <!-- termina script de agregar paciente por medio de js -->

  <!-- Agrego mi scrip para editar paciente por medio de js-->
  <script src="js/cargar_datos_profesional_edit.js"></script>
  <!-- termina script de editar paciente por medio de js -->

  <!--scripts para datatables -->
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
            "targets": 3
          }, // Deshabilita la ordenación en la columna de opciones
          {
            "searchable": false,
            "targets": 3
          }, // Deshabilita la búsqueda en la columna de opciones
          {
            "visible": true,
            "targets": 3
          } // Muestra la columna de opciones
        ],
        "lengthMenu": [10, 25, 50, 75, 100], // Define las opciones del menú desplegable de longitud de página
            "pageLength": 10 // Establece la longitud de la página predeterminada
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