<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Agregar Profesional</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_profesional" autocomplete="off">
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
              <input type="text" class="form-control" id="cedula" placeholder="Ingresar Nro de Cedula" autofocus>
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
            <div class="col-md-6 ">
              <label for="color" class="form-label">
                Color
              </label>
              <input type="color" class="form-control" name="color" id="color">
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