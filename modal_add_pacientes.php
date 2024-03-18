<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Agregar Pacientes</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_pacientes" autocomplete="off">
          <!--Mensaje de insercion -->
          <div class="container">
            <div id="contendorMensajes"></div>
          </div>
          <!--Mensaje de insercion -->
          <div class="row mb-3">
            <div class="col">
              <label for="cedula" class="form-label">
                Nro. Cedula
              </label>
              <input type="text" class="form-control" id="cedula" placeholder="Ingresar Nro de Cedula">
              <small>Escribir numero sin puntos</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="nombres" class="form-label">
                Nombres
              </label>
              <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Escribir nombre del paciente">
            </div>
            <div class="col">
              <label for="apellidos" class="form-label">Apellidos</label>
              <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Escribir Apellido del paciente">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="fecha_nac" class="form-label">
                Fecha Nacimiento
              </label>
              <input type="date" class="form-control" name="fecha_nac" id="fecha_nac">
            </div>
            <div class="col">
              <label for="fecha_ing" class="form-label">Fecha Ingreso</label>
              <input type="text" class="form-control" name="fecha_ing" id="fecha_ing" value="<?php echo date('d/m/Y') ?>" >
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="correo" class="form-label">Paciente Correo</label>
              <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar Correo Electronico">
            </div>
            <div class="col">
              <label for="p_contacto" class="form-label">Paciente Telefono</label>
              <input type="text" class="form-control" name="p_contacto" id="p_contacto" placeholder="Ingresar Numero de Telefono">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="t_contacto" class="form-label">Contacto de Urgencia</label>
              <input type="text" class="form-control" name="t_contacto" id="t_contacto" placeholder="Numero de Telefono del contacto ">
            </div>
            <div class="col">
              <label for="consulta" class="form-label">Motivo Consulta</label>
              <textarea name="consulta" id="consulta" class="form-control" rows="3" placeholder="Escriba aqui.."></textarea>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-primary" value="Agregar" id="btnRegistrar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>