$(document).ready(function() {
/**Esta parte es para realizar el delete */
$('.btn-delete').on('click', function() {
    //alert('hola')
    //console.log('Evento de clic en btn-delete disparado');

    var id = $(this).data('id');
    var Nombre = $(this).data('nombre');
   // alert('el nomnbre; ' + id + Nombre )
        // Pasa el id y el nombre del paciente al modal de confirmación
    $('#btnConfirmarEliminar').data('id', id);
    $('#modalEliminar .modal-body').text('¿Estás seguro de que deseas eliminar la Ficha "' + Nombre + '"?');

    // Muestra el modal de confirmación
    $('#modalEliminar').modal('show');
  });

  //al realizr el click en el boton de eliminar en el modal de confirmacion
  $('#btnConfirmarEliminar').on('click',function(){
    
    var id = $(this).data('id');
    //creo la peticion ajax
    $.ajax({
        url:'ajax/eliminar_ficha.php',
        method:'POST',
        data:{id:id},
        success:function(response){
            //manejo la respuesta
            if(response.includes("Eliminado Con Exito")){
                mostrarMensaje("success", response);
                window.location.reload();
            }else{
                mostrarMensaje("danger", response);
            }

            $('#modalEliminar').modal('hide');
        },error:function(error){
            mostrarMensaje("danger","Error en la solicitud AJAX");
            console.log("Error:" + error);
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
/**termina la parte del delete */
});
