//$(document).ready(function() {
$(document).on("click", ".btn-editar", function () {
  var usuarioId = $(this).data("id");
  //console.log('usuarioId'+usuarioId);
  // Realiza una llamada Ajax para obtener los datos del paciente
  $.ajax({
    url: "ajax/obtener_datos_usuarios.php", // Reemplaza con la ruta correcta a tu script PHP
    method: "POST",
    data: { usuario_id: usuarioId },
    dataType: "json",
    success: function (data) {
      //console.log("muestro resultado: " + data.usuario_id);
      // Llena los campos del modal con los datos del paciente
      $("#edit_nombres").val(data.usuario_nombre);
      $("#Editapellidos").val(data.usuario_apellido);
      $("#edit_usuario").val(data.usuario);
      $("#Editpass").val(data.pass_normal);
      

      // Establece el ID del paciente en un campo oculto
      $("#editPacienteId").val(data.usuario_id);
      
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
  var usuarioId = $("#editPacienteId").val();
  //alert(pacienteId);

  ///llamada a ajax para guardar cambios
  $.ajax({
    url:'ajax/guardar_cambios_usuarios.php',
    method:'POST',
    data:{
      usuario_id :usuarioId,
      nombres:$('#edit_nombres').val(),
      apellidos:$('#Editapellidos').val(),
      usuario:$('#edit_usuario').val(),
      pass:$('#Editpass').val(),
      estado:$('#edit_estado').val(),
      grupo:$('#Editgrupo').val(),
      
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