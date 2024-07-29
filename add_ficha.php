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
    <title>Crear Nueva Ficha</title>
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
            <!-- Aca voy a incluir mi formulario ficha paso a paso -->
            <?php include('pacientes_formulario_fichas.php') ?>
            <!-- Termino de incluir  mi formulario ficha -->

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
    
    <!--el arhivo form step configura el formulario que sea paso por paso y donde realizo el insert 
    <script src="js/form_step.js"></script>-->
    
</body>

</html>