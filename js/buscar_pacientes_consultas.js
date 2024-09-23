$(document).ready(function () {
    //capturo numero de cedula del paciente
  
    $("#Paciente_cedula").on("input", function () {
      var Paciente_cedula = $(this).val();
      //console.log(Paciente_cedula);
      //realizar peticion ajax
      $.ajax({
        type: "POST",
        url: "ajax/obtener_pacientes_consultas.php",
        data: { Paciente_cedula: Paciente_cedula },
        success: function (response) {
          var datos = JSON.parse(response);
          //console.log(datos)
          $("#consulta_id").val(datos.consulta_id);
          $("#nombres").val(datos.nombre_paciente);
          $("#MotivoConsulta").val(datos.consulta_motivo);
          $("#edadpaciente").val(datos.edad);
          $("#fecha_nac").val(datos.fecha_nac);
        },
        error: function () {
          alert("Error en la solicitud ajax");
        },
      });
    });
  });
  