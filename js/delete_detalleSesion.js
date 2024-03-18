// Asegúrate de que este código esté después de cargar SweetAlert y jQuery
document.addEventListener("DOMContentLoaded", function () {
    // ...
  
    // Manejar el clic en el botón de eliminar
    $(".btn-delete").on("click", function () {
      var sessionDetalleId = $(this).data("id");
  
      // Mostrar SweetAlert para confirmar la eliminación
      Swal.fire({
        title: "Eliminar Sesión",
        text: "¿Estás seguro de que deseas eliminar esta sesión?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          // Confirmado, enviar solicitud AJAX para eliminar
          eliminarSesion(sessionDetalleId);
        }
      });
    });
  
    // Función para enviar la solicitud AJAX para eliminar
    function eliminarSesion(sessionDetalleId) {
      $.ajax({
        type: "POST",
        url: "ajax/DeleteDetalleSesion.php",
        data: { sessionDetalleId: sessionDetalleId },
        dataType: 'json',
        success: function (response) {
          // Manejar la respuesta del servidor
          console.log("la respuests es; "+response);
          if (response.status === "exito") {
            // Sesión eliminada con éxito
            Swal.fire({
              icon: "success",
              title: "Sesión eliminada correctamente.",
              showConfirmButton: true,
              timer: 3500,
            });
  
            // Puedes realizar acciones adicionales si es necesario, como recargar la página
            location.reload();
          } 
          
          if (response.status === "error") {
            // Error al eliminar sesión
            Swal.fire({
              icon: "error",
              title: "Error al eliminar la sesión.",
              text: "Por favor, inténtalo de nuevo. Detalles: " + response.debug,
              showConfirmButton: true,
            });
          }
        },
        error: function () {
          // Manejar errores de la solicitud AJAX
          Swal.fire({
            icon: "error",
            title: "Error de conexión.",
            text: "Por favor, inténtalo de nuevo.",
            showConfirmButton: true,
          });
        },
      });
    }
  
    // ...
  });
  