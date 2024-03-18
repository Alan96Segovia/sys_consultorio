//$(document).ready(function() {
$(document).on("click", ".btn-editar", function () {
  var profesionalid = $(this).data("id");
  // Realiza una llamada Ajax para obtener los datos del paciente
  $.ajax({
    url: "ajax/obtener_datos_profesional.php", // Reemplaza con la ruta correcta a tu script PHP
    method: "POST",
    data: { profesional_id: profesionalid },
    dataType: "json",
    success: function (data) {
      //console.log("muestro resultado: " + data.paciente_nombre);
      // Llena los campos del modal con los datos del paciente
      $("#Editcedula").val(data.profesional_ci);
      $("#edit_nombres").val(data.profesional_nombre);
      $("#Editapellidos").val(data.profesional_apellido);
      $("#Editcolor").val(data.profesional_color);
      $("#estado").val(data.estado_id);

      // Establece el ID del paciente en un campo oculto
      $("#editProfesionalId").val(data.profesional_id);

      // Muestra el modal de edición
      $("#modalEditar").modal("show");
    }
  });
});


// Código para cerrar el modal y recargar la página
$('#modalEditar').on('hidden.bs.modal', function () {
  location.reload();
});


////capturo los datos para realizar el update del registro

$('#btnGuardarEdicion').on('click',function(){

  //var pacienteId = $(this).data('data-paceinte-id');
  var profesionalId = $("#editProfesionalId").val();
  //alert(pacienteId);

  ///llamada a ajax para guardar cambios
  $.ajax({
    url:'ajax/guardar_cambios_profesional.php',
    method:'POST',
    data:{
      profesional_id :profesionalId,
      profesional_ci:$('#Editcedula').val(),
      profesional_nombre:$('#edit_nombres').val(),
      profesional_apellido:$('#Editapellidos').val(),
      profesional_color:$('#Editcolor').val(),
      estado_id:$('#estado').val(),
    },
    success:function(response){
      //capturo mensaje de exito o de error
      if(response.includes("Editado Con Exito!")){
          mostrarMensaje("warning",response);
          //limpio el formulario al realizar la edicion
          $("#formEditar")[0].reset();
      }else{
          mostrarMensaje("danger",response);
      }
    },
    error: function(error){
        mostrarMensaje("danger","Error en la solicitud AJAX");
        console.log("Error:"+ error);
    }
  })

})

//funcion para mostrar mensajes
function mostrarMensaje(tipo, mensaje) {
  var alerta = '<div class="alert alert-'+tipo+' alert-dismissible fade show" role="alert">' + mensaje +
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>' +
      '</div>';
  //AGREGAR LA ALERTA AL CONTENEDOR DE MENSAJES
  $("#contendorMensajesEdit").html(alerta);
}
// fin del script para registrar paciente