//$(document).ready(function() {
    $(document).on("click", ".btn-editar", function () {
        var consulta_id = $(this).data("id");
        //alert(observacion);
        // Realiza una llamada Ajax para obtener los datos del paciente
        $.ajax({
          url: "ajax/obtener_datos_consultas.php", // Reemplaza con la ruta correcta a tu script PHP
          method: "POST",
          data: { consulta_id: consulta_id },
          dataType: "json",
          success: function (data) {
            //console.log("muestro resultado: " + data);
            // Llena los campos del modal con los datos del paciente

            $("#Editcedula").val(data.cedula);
            $("#edit_nombres").val(data.nombre_paciente);
            $("#Editfecha_cons").val(data.fecha_consulta);
            $("#Editconsulta").val(data.consulta_motivo);
            $("#Editmonto").val(data.monto_consulta);
            $("#EditPaciente_id").val(data.paciente_id);
            $("#Editcorreo").val(data.correo);
            $("#EditcontactoFamiliar").val(data.contacto_familiar);
            $("#observacion").val(data.paciente_obs);
            var fechaNacimiento = data.fecha_nacimiento.replace(/-/g, '/'); // Reemplaza todos los guiones por barras

            $("#Editfecha_nac").val(fechaNacimiento);
            
      
            // Establece el ID del paciente en un campo oculto
            $("#editConsultaId").val(data.consulta_id);
      
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
        var consulta_id = $("#editConsultaId").val();
        //var observacion = $("#observacion").val();
        //alert(pacienteId);
      console.log(observacion)
        ///llamada a ajax para guardar cambios
        $.ajax({
          url:'ajax/guardar_cambios_consultas.php',
          method:'POST',
          data:{
            consulta_id :consulta_id,
            consulta_motivo:$('#Editconsulta').val(),
            monto_consulta:$('#Editmonto').val(),
            paciente_nombres_apellidos: $('#edit_nombres').val(),
            paciente_cedula:$('#Editcedula').val(),
            paciente_fecha_nac:$('#Editfecha_nac').val(),
            paciente_correo:$('#Editcorreo').val(),
            paciente_contacto_familiar:$('#EditcontactoFamiliar').val(),
            paciente_obs:$('#observacion').val()
            
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