<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Registro Consulta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí van los campos de edición (input, select, etc.) -->
        <form id="formEditar" autocomplete="off">
          <!--Mensaje de insercion -->
          <div class="container">
            <div id="contendorMensajesEdit"></div>
          </div>
          <!--Mensaje de insercion -->
          <div class="row mb-3">
            <div class="col">
              <label for="Editcedula" class="form-label">
                Nro. Cedula
              </label>
              <input type="text" class="form-control" id="Editcedula" placeholder="Ingresar Nro de Cedula">
              <input type="hidden" class="form-control" name="EditPaciente_id" id="EditPaciente_id" readonly>
              <small>Escribir numero sin puntos</small>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="edit_nombres" class="form-label">
                Datos del Paciente
              </label>
              <input type="text" class="form-control" name="edit_nombres" id="edit_nombres" placeholder="Escribir nombre del paciente">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="Editcorreo" class="form-label">
                Correo Electronico
              </label>
              <input type="email" class="form-control" name="Editcorreo" id="Editcorreo">
            </div>
            <div class="col">
              <label for="EditcontactoFamiliar" class="form-label">Contacto Familiar</label>
              <input type="text" class="form-control" name="EditcontactoFamiliar" id="EditcontactoFamiliar">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="Editfecha_nac" class="form-label">
                Fecha Nacimiento
              </label>
              <input type="text" class="form-control" name="Editfecha_nac" id="Editfecha_nac">
              <span>Formato de fecha es año mes dia</span>
            </div>
            <div class="col">
              <label for="Editconsulta" class="form-label">Motivo Consulta</label>
              <textarea name="Editconsulta" id="Editconsulta" class="form-control" rows="3" placeholder="Escriba aqui.."></textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="Editfecha_cons" class="form-label">
                Fecha Consulta
              </label>
              <input type="text" class="form-control" name="Editfecha_cons" id="Editfecha_cons" readonly >
            </div>
            <div class="col">
              <label for="Editmonto" class="form-label">Monto</label>
              <input type="number" min='0' name="Editmonto" id="Editmonto" class="form-control" placeholder="Escriba aqui..">
              <!-- Agrega un campo oculto para almacenar el ID del paciente -->
              <input type="hidden" id="editConsultaId" name="editConsultaId">
            </div>
          </div>
          <div class="row mb-3">
              <div class="col">
              <label for="observacion" class="form-label">Observacion</label>
              <input type="text" name="observacion" id="observacion" class="form-control" placeholder="Escriba aqui..">

              </div>
          </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="btnGuardarEdicion">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
</div>