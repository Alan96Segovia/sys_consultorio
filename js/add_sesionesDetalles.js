document.addEventListener("DOMContentLoaded", function () {    
  // Almacena los detalles en un array
  var detallesSesiones = [];
  var contadorDetalles = 1; // Contador para generar IDs únicos

  document
    .getElementById("btnRegistrarDetalles")
    .addEventListener("click", function () {
      agregarNuevoDetalle();
    });

  //al hacer click en el boton insertar detalles llamo a la funcion insertardetalles
  document
    .getElementById("btnInsertarDetalles")
    .addEventListener("click", function () {
      insertarDetalles();
    });
// Refrescar la página al cerrar el modal
$('#exampleModal').on('hidden.bs.modal', function () {
    location.reload();
});
    function insertarDetalles() {
        // Crear un nuevo array para almacenar los detalles a enviar al archivo insertarDetalles
        var detallesEnviar = [];
    
        // Obtener todos los detalles existentes dentro del formulario
        var detalles = document
          .getElementById("contenedorSesionesDetalles")
          .getElementsByClassName("row col-md-12");
        
          // Obtener el elemento por su id
            let inputSessionDetalleId = document.getElementById('detalle_id');
            let valorSessionDetalleId = inputSessionDetalleId.value;
            //alert(valorSessionDetalleId);
        // Recorrer los detalles y agregar al array de detalles a enviar
        for (var i = 0; i < detalles.length; i++) {
            var fecha = detalles[i].querySelector('input[name^="fecha_session["]').value;
            // Obtener el valor del campo oculto 'detalle_id' que debería ser único
            var id = valorSessionDetalleId;
    
            // Agregar los datos al array
            detallesEnviar.push({
                fecha: fecha,
                id: id,
                // Puedes agregar más campos aquí según sea necesario
            });
        }
        // Mostrar la cantidad de detalles antes de enviar la solicitud
    //console.log("Cantidad de detalles a enviar:", detallesEnviar.length);
    //console.log(detallesEnviar);

    
        // Convertir el array de detalles a formato JSON
        var detallesJSON = JSON.stringify({ detalles: detallesEnviar });
    
        // Realizar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/insertarDetalles.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");
    
        // Manejar la respuesta del servidor
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Éxito: Mostrar un mensaje de éxito con SweetAlert
                Swal.fire({
                  icon: "success",
                  title: "Detalles insertados correctamente.",
                  showConfirmButton: true,
                  timer: 3500,
                });
                // Vaciar el formulario después de la inserción exitosa
                document.getElementById('formulario_detalles_sesiones').reset();

                // También puedes realizar otras acciones si es necesario
               // console.log(xhr.responseText);
              } else {
                // Error: Mostrar un mensaje de error con SweetAlert
                Swal.fire({
                  icon: "error",
                  title: "Error al insertar detalles.",
                  text: "Por favor, inténtalo de nuevo.",
                  showConfirmButton: true,
                });
                console.error("Error al enviar datos al servidor.");
              }
            };
        
            // Enviar la solicitud al servidor
            xhr.send(detallesJSON);
        }

  /////////////////////
  //////Creo una funcion para ir agregando input de fecha y hora para poder insertar nuevos de detalles
  //////////////
  /////////////
  function agregarNuevoDetalle() {
    var contenedorSesionesDetalles = document.getElementById(
      "contenedorSesionesDetalles"
    );

    // Creo el label y el input de fecha
    var labelFecha = document.createElement("label");
    labelFecha.className = "form-label";
    labelFecha.setAttribute("for", "fecha_session_" + contadorDetalles); // Asigno ID único
    labelFecha.textContent = "Fecha Para Sesión:";

    var nuevoDetalleFechaInput = document.createElement("input");
    nuevoDetalleFechaInput.type = "datetime-local";
    nuevoDetalleFechaInput.className = "form-control";
    nuevoDetalleFechaInput.id = "fecha_session_" + contadorDetalles; // Asigno ID único
    nuevoDetalleFechaInput.name = 'fecha_session[' + contadorDetalles + ']'; // Asigno nombre único
    nuevoDetalleFechaInput.required = true;

    var nuevoDetalleIdInput = document.createElement("input");
    nuevoDetalleIdInput.type = "hidden";
    nuevoDetalleIdInput.id = "detalle_id_" + contadorDetalles; // Cambiado a un ID fijo
    nuevoDetalleIdInput.name = 'detalle_id[' + contadorDetalles + ']';
    nuevoDetalleIdInput.value = document.getElementById('detalle_id');;


    // Crear un nuevo contenedor específico (div con clase "row")
    var nuevoContenedorRow = document.createElement("div");
    nuevoContenedorRow.className = "row col-md-12";

    // Crear dos nuevos contenedores específicos (divs con clase "col-md-6")
    var nuevoContenedorCol1 = document.createElement("div");
    nuevoContenedorCol1.className = "col-md-6";
    nuevoContenedorCol1.appendChild(labelFecha);
    nuevoContenedorCol1.appendChild(nuevoDetalleFechaInput);

    // Agregar los nuevos contenedores al contenedor general
    nuevoContenedorRow.appendChild(nuevoContenedorCol1);
    contenedorSesionesDetalles.appendChild(nuevoContenedorRow);
    // Incrementar el contador para el próximo detalle
    contadorDetalles++;
}
  //// Agrega el evento de cierre del modal (ejemplo con un botón de cerrar)

  document.getElementById("cerrarModal").addEventListener("click", function () {
    eliminarDetalles();
  });

  function eliminarDetalles() {
     // Reinicia el contador
     contadorDetalles = 1;

    var contenedorSesionesDetalles = document.getElementById(
      "contenedorSesionesDetalles"
    );

    // Elimina todos los hijos del contenedor
    while (contenedorSesionesDetalles.firstChild) {
      contenedorSesionesDetalles.removeChild(
        contenedorSesionesDetalles.firstChild
      );
    }

   

  }
});
