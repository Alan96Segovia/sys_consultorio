$(document).ready(function () {
    //capturo numero de cedula del paciente
  
    $("#Paciente_cedula").on("input", function () {
      var Paciente_cedula = $(this).val();
  
      //realizar peticion ajax
      $.ajax({
        type: "POST",
        url: "ajax/obtener_pacientes_consultas.php",
        data: { Paciente_cedula: Paciente_cedula },
        success: function (response) {
          var datos = JSON.parse(response);
          
          $("#idp").val(datos.paciente_id);
          $("#nombres").val(datos.nombres);
          $("#fecha_nac").val(datos.fecha_nac);
        },
        error: function () {
          alert("Error en la solicitud ajax");
        },
      });
    });
  });
  