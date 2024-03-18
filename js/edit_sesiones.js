function agregarDetalle() {
    // Verifica si se puede agregar un detalle
    /*if (!puedeAgregarDetalle()) {
        // Muestra un mensaje o realiza alguna acción para informar al usuario
        alert("No se pueden agregar detalles para este tipo de plan o sesión");
        return;
    }*/

    // Obtén el contenedor de detalles
    var detallesContainer = document.getElementById('detallesContainer');

    // Crea un nuevo div para el detalle
    var nuevoDetalle = document.createElement('div');
    nuevoDetalle.className = 'detalle_1'; // Asigna la clase según sea necesario

    // Contenido del nuevo detalle (puedes adaptar esto según tus campos)
    nuevoDetalle.innerHTML = `
        <div class="col-md-6">
            <label class="form-label" for="nueva_fecha">Fecha Para Sesión:</label>
            <input type="datetime-local" class="form-control" name="fecha_session[]" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="nuevo_estado">Estado para Sesión:</label>
            <select class="form-control" name="estado_id[]" required>
                <!-- Opciones del select aquí -->
            </select>
        </div>
    `;

    // Agrega el nuevo detalle al contenedor
    detallesContainer.appendChild(nuevoDetalle);
}



function ActaulizarSesiones(){
    //obtengo los datos del formulario
    var DatosCabecera =  new FormData(document.getElementById('formularioCabecera'));

    //realizo la peticion por medio de ajax
    $.ajax({
        url:'ajax/actualizar_cabecera.php',
        type:'POST',
        data:DatosCabecera,
        contentType: false,
        processData: false,
        success:function(cabeceraResponse){
            //manejo la respuesta del servidor para el update del cabecera
            //console.log('LA RESPUESTA ES:'  + cabeceraResponse);
            /// si la actualizacion de la cabecera fue exitosa , proceder a actualizar los detalles
            if(cabeceraResponse.trim() === 'OK'){
                // Llamo a la función de actualizar los detalles dentro de la función success
                //alert('actualizarDetalles');
                actualizarDetalles();
            } else {
                // recupero el mensaje si fue un error en las acciones
                // Muestro un mensaje de error con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: cabeceraResponse,
                    showConfirmButton: true,
                });
            }
        },
        error:function(error){
            // Maneja los errores de la actualización de la cabecera aquí
            // Muestro un mensaje de error con SweetAlert
            console.log(error); 
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en la actualización de cabecera'+error ,
                showConfirmButton: true,
            });
        }
    });
}


function obtenerDetalles() {
    var detalles = [];
    var detalleContainers = document.querySelectorAll('.detalle_1');

    detalleContainers.forEach(function(container) {
        var fecha = container.querySelector('input[type="datetime-local"]').value;
        var estado = container.querySelector('select').value;
        var session_detalle_id = container.querySelector('input[name="session_detalle_id[]"]').value;
        detalles.push({ fecha: fecha, estado: estado ,session_detalle_id:session_detalle_id});
    });

    return detalles;
}


function actualizarDetalles() {
    // Obtén los datos de los detalles
    var detalles = obtenerDetalles();

    // Realiza la petición AJAX para actualizar los detalles
    $.ajax({
        url: 'ajax/actualizar_detalles.php',
        type: 'POST',
        data: { detalles: JSON.stringify(detalles) },
        success: function(detallesResponse) {
            // Maneja la respuesta del servidor para la actualización de detalles
            if (detallesResponse.trim() === 'OK') {
                // Muestra un mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Registro Actualizado Correctamente',
                    showConfirmButton: true,
                    timer: 3000
                }).then(function () {
                    // Recarga la página después de cerrar el mensaje
                    location.reload();
                });
            } else {
                // Si hay un error en la actualización de detalles, muestra un mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: detallesResponse,
                    showConfirmButton: true,
                });
            }
        },
        error: function(error) {
            // Maneja los errores de la actualización de detalles aquí
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error en la actualización de detalles',
                showConfirmButton: true,
            });
        }
    });
}

function actualizarCabeceraYDetalles() {
    // Realizar la actualización de la cabecera
    ActaulizarSesiones();

    // Realizar la actualización de los detalles
    actualizarDetalles();
}
