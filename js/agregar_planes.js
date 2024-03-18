/**agregar paciente */
$(document).ready(function () {

    $('#exampleModal').on('hidden.bs.modal', function (e) {
        //recargar la pagina despues de cerrar el modal
        location.reload();
    });

    /**capturo los valores de mi formulario para poder realizar el insert */
    $("#btnRegistrar").click(function () {
        var plan_nombre = $("#plan_nombre").val();
        var precio_plan = $("#precio_plan").val();
        var plan_estado = $("#plan_estado").val();
       


        $.ajax({
            type: "POST",
            url: "ajax/insertar_plan.php",
            data: {
                plan_nombre: plan_nombre,
                precio_plan: precio_plan,
                plan_estado: plan_estado
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