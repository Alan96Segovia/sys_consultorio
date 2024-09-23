/**agregar paciente */
$(document).ready(function () {

    $('#exampleModal').on('hidden.bs.modal', function (e) {
        //recargar la pagina despues de cerrar el modal
        location.reload();
    });

    /**capturo los valores de mi formulario para poder realizar el insert */
    $("#btnRegistrar").click(function () {
       // var id = $("#idp").val();
        var Paciente_cedula = $("#Paciente_cedula").val();
        var nombres = $("#nombres").val();
        var email = $("#email").val();
        var contacto_familiar = $("#contacto_familiar").val();
        var fecha_nac = $("#fecha_nac").val();
        var consulta = $("#consulta").val();
        var fecha_consulta = $("#fecha_consulta").val();
        var monto = $("#monto").val();
        var obs = $("#obs").val();
        

        $.ajax({
            type: "POST",
            url: "ajax/insertar_consulta.php",
            data: {
                Paciente_cedula: Paciente_cedula,
                nombres: nombres,
                email: email,
                contacto_familiar: contacto_familiar,
                fecha_nac: fecha_nac,
                fecha_consulta: fecha_consulta,
                consulta: consulta,
                monto: monto,
                obs: obs
            },
            success: function (response) {
                //muestro mensaje de exito o de erro
                if (response.includes("Agregado con Exito!")) {
                    mostrarMensaje("success", response);
                    //limpio los campos del formulario despues de guardar con exito
                    $("#formulario_pacientes")[0].reset();
                } else {
                    //alert(response);
                    mostrarMensaje("danger", response);
                }
            },
            error: function (error) {
                //muestro mensaje de error
                mostrarMensaje("danger", "Error en la solicitud AJAx");
                console.log("Error:" + error)
            }
        })
    });


    //funcion para mostrar mensajes
    function mostrarMensaje(tipo, mensaje) {
        var alerta = '<div class="alert alert-'+tipo+' alert-dismissible fade show" role="alert">' + mensaje +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>' +
            '</div>';
        //AGREGAR LA ALERTA AL CONTENEDOR DE MENSAJES
        $("#contendorMensajes").html(alerta);
    }
    // fin del script para registrar paciente

});