<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Agregar Consultas</h6>
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
              <label for="Paciente_cedula" class="form-label">
                Nro. Cedula
              </label>
              <input type="text" class="form-control" id="Paciente_cedula" placeholder="Ingresar Nro de Cedula" autofocus require >
              <small>Escribir numero sin puntos</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="nombres" class="form-label">
                Datos del Pacientes
              </label>
              <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Escribir nombre del paciente" readonly>
              <input type="hidden" class="form-control" name="id" id="idp">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="fecha_nac" class="form-label">
                Fecha Nacimiento
              </label>
              <input type="text" class="form-control" name="fecha_nac" id="fecha_nac" readonly>
            </div>
            <div class="col">
              <label for="consulta" class="form-label">Motivo Consulta</label>
              <textarea name="consulta" id="consulta" class="form-control" rows="3" placeholder="Escriba aqui.." ></textarea>
            </div>
          </div>
          <div class="row mb-3">
          <div class="col">
              <label for="fecha_consulta" class="form-label">
                Fecha Consulta
              </label>
              <input type="text" class="form-control" name="fecha_consulta" id="fecha_consulta" value="<?php echo date('d/m/Y') ?>" readonly require>
            </div>
            <div class="col">
              <label for="monto" class="form-label">Monto Consulta</label>
              <input type="number" min='0' class="form-control" name="monto" id="monto" placeholder="Monto de Consulta" value="150000">
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