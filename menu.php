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

//consulta de cantidad de pacientes
 $query_cantidad= "SELECT
 (
       SELECT  count(*) as Pacientes FROM pacientes
     ) as Pacientes ,
     (
       SELECT  count(*) as consultas FROM pacientes_consultas
     ) as Consultas";
$excute_query_pacientes = pg_query($conexion,$query_cantidad);
while ($row_pacientes = pg_fetch_array($excute_query_pacientes)){
    $cant_Pacientes = $row_pacientes['pacientes'];
    $cant_Consultas = $row_pacientes['consultas'];
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Menu Principal</title>
<!--Adjunto mis librerias a utilizar -->
<?php include('librerias.php') ?>
<!--fin de archivos a utilizar -->
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> 
  <!-- Preloader -->
  <?php
  /*agrego barra de navegacion*/
  include( 'barra_navegacion.php' )
  ?>
  <?php
  include( 'panel_lateral.php' )
  ?>
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Menu Principal</h1>
          </div>
          <!-- /.col 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
          <!-- /.col --> 
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.container-fluid --> 
    </div>
    <!-- /.content-header --> 
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6"> 
            <!-- small box CAJA DE PACIENTES-->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cant_Pacientes ?></h3>
                <p>Cant. Pacientes</p>
              </div>
              <div class="icon"> <i class="fas fa-restroom"></i></div>
              <a href="pacientes.php" class="small-box-footer">Ver Pacientes <i class="fas fa-arrow-circle-right"></i></a> </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6"> 
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo  $cant_Consultas; ?></h3>
                <p>Cant. Consultas</p>
              </div>
              <div class="icon"> <i class="far fa-heart"></i> </div>
              <a href="consultas.php" class="small-box-footer">Ver Consultas <i class="fas fa-arrow-circle-right"></i></a> </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6">  -->
            <!-- small box -->
            <!-- <div class="small-box bg-warning">
              <div class="inner">
                <h3>0</h3>
                <p>Reporte mensual y anual</p>
                <p>de la primera consulta.</p>
              </div>
              <div class="icon"> <i class="ion ion-person-add"></i> </div>
              <a href="#" class="small-box-footer">Ir a Reporte <i class="fas fa-arrow-circle-right"></i></a> </div>
          </div> -->
          <!-- ./col -->
          <div class="col-lg-3 col-6"> 
            <!-- small box -->
            <!--div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Agendamientos</p>
              </div>
              <div class="icon"> <i class="ion ion-pie-graph"></i> </div>
              <a href="#" class="small-box-footer">ver Agendamiento <i class="fas fa-arrow-circle-right"></i></a> </div>
          </div>
          <!-- ./col --> 
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.container-fluid --> 
    </section>
    <!-- /.content --> 
  </div>
</div>
<!--Adjunto scripts jquery y js -->
<?php include('scripts_js.php') ?>
<!--termino de adjuntar scripts jquery y js -->
</body>
</html>