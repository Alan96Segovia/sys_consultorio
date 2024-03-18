<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Agregar Plan</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formulario_planes" autocomplete="off">
          <!--Mensaje de insercion -->
          <div class="container">
            <div id="contendorMensajes"></div>
          </div>
          <!--Mensaje de insercion -->
          <div class="row mb-3">
            <div class="col">
              <label for="plan_nombre" class="form-label">
                Nombre del Plan
              </label>
              <input type="text" class="form-control" id="plan_nombre" placeholder="Escribir Nombre del Plan" require>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="precio_plan" class="form-label">
                Precio del Plan
              </label>
              <input type="number" min="0" class="form-control" name="precio_plan" id="precio_plan" placeholder="Monto del plan" require>
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