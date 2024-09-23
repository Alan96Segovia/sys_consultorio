//espero que el documento html se cargue completamente para poder ejecutar el codigo
$(document).ready(function () {
  var paso_actual = 1; // se crea una variable para utilizar el seguimiento del formulario paso a paso
  var totalPasos = 5; // Cambia esto al número total de pasos en tu formulario

  $(".next-step").click(function () {
    // agrego el evento click a  la clase next step
    $("#step" + paso_actual).hide(); // oculta el paso actual e incremento mi variabel paso actual y muestra el siguiente
    paso_actual++;
    $("#step" + paso_actual).show();
    updateProgressBar(); // llamo a la funcion para actualizar la barra de progreso
  });

  $(".prev-step").click(function () {
    // a la clase prev step tambien le agrego el evento click
    $("#step" + paso_actual).hide(); // oculto paso actual
    paso_actual--; //decremenenta el paso actual
    $("#step" + paso_actual).show(); // y muestro el anterior
    updateProgressBar(); // vuelvo a actualizar mi barra de progreso
  });

  /* $("#formularioFicha").submit(function (e) { //agrego el evento submit al formulario 
        e.preventDefault(); //Evita el comportamiento predeterminado del formulario (recargar la página) utilizando e.preventDefault().
        alert("Form submitted!"); // envio el formulario
    });*/

  /**esta parte agrego el codigo para realizar un insert en la tabla de pacientes fichas */
  $("#formularioFicha").submit(function (e) {
    e.preventDefault(); //evitar recargar la pagina
    //alert("Form submitted!"); // envio el formulario
    //realizar la solicitud  ajax para enviar  los datos
    //console.log($('#formularioFicha').serialize());
    $.ajax({
      type: "POST",
      url: "ajax/agregar_ficha_pacientes.php", //ruta donde voy a procesar el insert
      data: $("#formularioFicha").serialize(), //envio todos los datos del formulario por medio de la funcion serialize
      success: function (response) {
        //manejo la respuesta del servidor
        var mensajesContainer = $("#mensajesContainer");

        if (response === "success") {
          //muestro alerta de exito
          //mensajesContainer.removeClass().addClass('alert alert-info').text('Ficha creada con éxito.');
          // Muestra alerta de éxito con SweetAlert2
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: "Ficha creada con éxito.",
          }).then((result) => {
            // Si el usuario hace clic en "OK", puedes realizar alguna acción adicional
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        } else {
          //muesto alerta de error
          //mensajesContainer.removeClass().addClass('alert alert-danger').text('Error al crear la ficha. Inténtalo de nuevo.' + response);
          // Muestra alerta de error con SweetAlert2
          Swal.fire({
            icon: "error",
            title: "¡Error!",
            text: "Error al crear la ficha. Inténtalo de nuevo.\n" + response,
          });
        }
      },
      error: function () {
        //alerta en caso de que falla la solicitud de ajax
        $("#mensajesContainer")
          .removeClass()
          .addClass("alert alert-danger")
          .text("Error en la solicitud de AJAX. Por favor, intenta de nuevo.");
      },
    });
  });
  /**termina insert en la tabla de pacientes fichas */

  /**esta parte se realiza el update del formulario de fichas */
  $("#formularioEditFicha").submit(function (e) {
    e.preventDefault(); //evita recargar la pagina
    //console.log($('#formularioEditFicha').serialize());
    //alert('hola')
    $.ajax({
      type: "POST",
      url: "ajax/edit_ficha_pacientes.php",
      data: $("#formularioEditFicha").serialize(),
      success: function (response) {
        //manejo la respues del servidor
        var mensajesContainerEdit = $("#mensajesContainerEdit");

        if (response === "success") {
          /*console.log(response)
          mensajesContainerEdit
            .removeClass()
            .addClass("alert alert-info")
            .text("Se Actualizo La Ficha Con Exito" );
          /*setTimeout(function () {
            location.reload();
          }, 2000);*/
          Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: "Ficha Actaulizada con éxito.",
          }).then((result) => {
            // Si el usuario hace clic en "OK", puedes realizar alguna acción adicional
            if (result.isConfirmed) {
              window.location.reload();
            }
          });
        } else { /*
          mensajesContainerEdit
            .removeClass()
            .addClass("alert alert-warning")
            .text("Erro al Actualizar. Intentar de nuevo" + response);*/
            Swal.fire({
              icon: "error",
              title: "¡Error!",
              text: "Error al crear la ficha. Inténtalo de nuevo.\n" + response,
            });
        }
      },
      error: function () {
        //alerta en caso de que falle la solicitud ajax
        $("#mensajesContainer")
          .removeClass()
          .addClass("alert alert-danger")
          .text("Error en la solicitud de AJAX. Por favor, intenta de nuevo.");
      },
    });
  });

  /**Fin de formulario de update  */

  function updateProgressBar() {
    //Actualiza la barra de progreso según el paso actual.
    var progress = ((paso_actual - 1) / (totalPasos - 1)) * 100; // Calcula el progreso como un porcentaje de acuerdo a  los 5 pasos
    $(".progress-bar")
      .width(progress + "%")
      .attr("aria-valuenow", progress); //Actualiza el ancho de la barra de progreso y el atributo aria-valuenow del elemento con la clase progress-bar.
  }
});
