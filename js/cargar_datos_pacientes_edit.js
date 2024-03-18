//$(document).ready(function() {
$(document).on("click", ".btn-editar", function () {
  var pacienteId = $(this).data("id");
  // Realiza una llamada Ajax para obtener los datos del paciente
  $.ajax({
    url: "ajax/obtener_datos_paciente.php", // Reemplaza con la ruta correcta a tu script PHP
    method: "POST",
    data: { paciente_id: pacienteId },
    dataType: "json",
    success: function (data) {
      //console.log("muestro resultado: " + data.paciente_nombre);
      // Llena los campos del modal con los datos del paciente
      $("#Editcedula").val(data.paciente_ci);
      $("#edit_nombres").val(data.paciente_nombre);
      $("#Editapellidos").val(data.paciente_apellido);
      $("#Editfecha_nac").val(data.paciente_fechanac);
      $("#Editfecha_ing").val(data.paciente_fecha);
      $("#Editcorreo").val(data.paciente_correo);
      $("#Editp_contacto").val(data.paciente_celular);
      $("#editt_contacto").val(data.contacto_familiar);
      $("#Editconsulta").val(data.paciente_consulta);

      // Establece el ID del paciente en un campo oculto
      $("#editPacienteId").val(data.paciente_id);

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
  var pacienteId = $("#editPacienteId").val();
  //alert(pacienteId);

  ///llamada a ajax para guardar cambios
  $.ajax({
    url:'ajax/guardar_cambios_pacientes.php',
    method:'POST',
    data:{
      paciente_id :pacienteId,
      cedula:$('#Editcedula').val(),
      nombre:$('#edit_nombres').val(),
      apellidos:$('#Editapellidos').val(),
      fecha_nac:$('#Editfecha_nac').val(),
      fecha_ing:$('#Editfecha_ing').val(),
      correo:$('#Editcorreo').val(),
      p_contacto:$('#Editp_contacto').val(),
      t_contacto:$('#editt_contacto').val(),
      consulta:$('#Editconsulta').val(),
      estado:$('#Editestado').val(),
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