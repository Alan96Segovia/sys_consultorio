<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="menu.php" class="brand-link"> <span class="brand-text font-weight-light">Bievenido al Sistema</span> </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!--<div class="image"> <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> </div>-->
      <div class="info"> 
          <a href="#" class="d-block"><i class="fas fa-user-md"></i>
            <small><?php echo  $_SESSION['nombre_usuario']; ?></small>
          </a> 
      </div>
      
    </div>

    <!-- SidebarSearch Form 
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar"> <i class="fas fa-search fa-fw"></i> </button>
        </div>
      </div>
    </div>-->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">
          <p></p>
          PAGINAS
        </li>
        <li class="nav-item"> <a href="profesionales.php" class="nav-link">
            <i class="fas fa-user-md"></i>
            <p><small>Profesionales</small> </p>
          </a> </li>
        <!-- <li class="nav-item"> <a href="pacientes.php" class="nav-link">
            <i class="fas fa-restroom"></i>
            <p><small>Registros de Pacientes </small></p>
          </a> </li> -->
        <li class="nav-item"> <a href="consultas.php" class="nav-link">
            <i class="fas fa-user-md"></i>
            <p><small>Registro de Primera Consulta </small></p>
          </a> </li>
        <li class="nav-item"> <a href="sessiones.php" class="nav-link">
            <i class="fas fa-handshake"></i>
            <!-- p>Sessiones </p -->
            <p><small> Tipo de Plan de tratamiento </small> </p>
          </a> </li>
        <li class="nav-item"> <a href="Agendas.php" class="nav-link">
            <i class="far fa-calendar-alt"></i>
            <p><small>Agendamientos</small> </p>
          </a> </li>
          <li class="nav-item"> <a href="pacientes_fichas.php" class="nav-link">
            <i class="fas fa-id-badge"></i>
            <p><small>Fichas</small> </p>
          </a> </li>
      </ul>
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any othser icon font library -->
        <li class="nav-header">
          <p></p>
          CONFIGURACIONES
        </li>
        <li class="nav-item"> <a href="usuarios.php" class="nav-link">
            <i class="fas fa-user-circle"></i>
            <p><small>Usuarios</small> </p>
          </a> </li>
          <li class="nav-item"> <a href="pacientes_planes.php" class="nav-link">
          <i class="fas fa-running"></i>
            <p><small>Planes</small> </p>
          </a> </li>
          <li class="nav-item"> <a href="cerrar_sesion.php" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
            <p><small>Cerrar Session</small> </p>
          </a> </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>