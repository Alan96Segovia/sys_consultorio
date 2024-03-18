$(document).ready(function() {
    $('.btn-delete').on('click', function() {
      var consulta_id = $(this).data('id');
      var ConsultaNombre = $(this).data('nombre');
          // Pasa el id y el nombre del paciente al modal de confirmación
      $('#btnConfirmarEliminar').data('paciente-id', consulta_id);
      $('#modalEliminar .modal-body').text('¿Estás seguro de que deseas eliminar a "' + ConsultaNombre + '"?');
  
      // Muestra el modal de confirmación
      $('#modalEliminar').modal('show');
    });
  
    // Al hacer clic en el botón de eliminar en el modal de confirmación
    $('#btnConfirmarEliminar').on('click', function() {
      var consultaId = $(this).data('paciente-id');
  
      // Llamada Ajax para eliminar el registro
      $.ajax({
        url: 'ajax/eliminar_consultas.php', // Reemplaza con la ruta correcta a tu script PHP
        method: 'POST',
        data: { consulta_id: consultaId },
        success: function(response) {
          // Maneja la respuesta del servidor
            //muestro mensaje de exito o de error , de la eliminacion del registro
            if(response.includes("Eliminado Con Exito!")){
                mostrarMensaje("success",response);//muestro el mensaje de que el registro se elimino
            }else{
                mostrarMensaje("danger", response);
            }

          //console.log(response);
  
          // Cierra el modal de confirmación
          $('#modalEliminar').modal('hide');
  
          // Recarga la página o actualiza la tabla según sea necesario
           window.location.reload();
          // O actualiza la tabla usando DataTables API
          // $('#example1').DataTable().ajax.reload();
        },
        error: function(error) {
          //console.error(error);
           //muestro mensaje de error
           mostrarMensaje("danger", "Error en la solicitud AJAx");
           console.log("Error:" + error)
        }
      });
    });
        ///esta parte configuro para mostrar en el div con id contendorMensajesError los mensajes
         //funcion para mostrar mensajes
    function mostrarMensaje(tipo, mensaje) {
        var alerta = '<div class="alert alert-'+tipo+' alert-dismissible fade show" role="alert">' + mensaje +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>' +
            '</div>';
        //AGREGAR LA ALERTA AL CONTENEDOR DE MENSAJES
        $("#contendorMensajesError").html(alerta);
    }
    // fin del script para registrar paciente



  });
  