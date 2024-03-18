//$(document).ready(function() {
$(document).on("click", ".btn-editar", function () {
  var plan_id = $(this).data("id");
  //alert(plan_id);
  // Realiza una llamada Ajax para obtener los datos del paciente
  $.ajax({
    url: "ajax/obtener_datos_plan.php", // Reemplaza con la ruta correcta a tu script PHP
    method: "POST",
    data: { plan_id: plan_id },
    dataType: "json",
    success: function (data) {
      console.log("muestro resultado: " + data);
      // Llena los campos del modal con los datos del paciente
      $("#Editplan_nombre").val(data.plan_descrip);
      $("#editprecio_plan").val(data.plan_precio);
      
      // Establece el ID del paciente en un campo oculto
      $("#editPlanId").val(data.plan_id);

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
  var editPlanId = $("#editPlanId").val();
  //alert(pacienteId);

  ///llamada a ajax para guardar cambios
  $.ajax({
    url:'ajax/guardar_cambios_planes.php',
    method:'POST',
    data:{
      plan_id :editPlanId,
      plan:$('#Editplan_nombre').val(),
      precio:$('#editprecio_plan').val(),
      estado:$('#EditEstado').val()
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