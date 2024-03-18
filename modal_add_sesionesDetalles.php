<!-- en este modal agregarenos mas detalles a la tabla sesiones detalles -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title font-weight-bold" id="exampleModalLabel">Desea Agregar mas Detalles a la Session </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario_detalles_sesiones" autocomplete="off">
                    <!--Mensaje de insercion -->
                    <div class="container">
                        <div id="contendorMensajes"></div>
                    </div>
                    <!--Mensaje de insercion -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="fecha_session_0">Click en Agregar Detalle:</label>
                            <!-- <input type="datetime-local" class="form-control" id="fecha_session_0" name="fecha_session[0]" required> -->
                            <input type="hidden" id="detalle_id" value="<?php echo $cabecera_id; ?>" name="detalle_id">
                        </div>
                    </div>
                    <div class="row" id="contenedorSesionesDetalles"></div>


                </form>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-primary" value="Agregar Detalle" id="btnRegistrarDetalles">
                <input type="button" class="btn btn-success" value="Insertar detalles" id="btnInsertarDetalles">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrarModal">Cerrar</button>
            </div>
        </div>
    </div>
</div>