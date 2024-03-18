
// agregar el input hidden
const cantidadDetallesInput = document.createElement("input");
cantidadDetallesInput.type = "hidden";
cantidadDetallesInput.id = "cantidadDetalles";
cantidadDetallesInput.name = "cantidadDetalles";
cantidadDetallesInput.dataset.cantidad = "0";
document.body.appendChild(cantidadDetallesInput);

// Función para mostrar el formulario de detalles y ocultar el de cabecera
function mostrarFormularioDetalles() {
  document.getElementById('formularioCabecera').style.display = 'none';
  document.getElementById('formularioDetalles').style.display = 'block';
}
// Función para ocultar el formulario de detalles y mostrar el de cabecera
function ocultarFormularioDetalles() {
  // Limpiar valores de los campos en el formulario de detalles
    const detallesForm = document.getElementById("formularioDetalles");
    detallesForm.reset();
    // Mostrar el formulario de cabecera
  document.getElementById('formularioCabecera').style.display = 'block';
  // Ocultar el formulario de detalles
  document.getElementById('formularioDetalles').style.display = 'none';
  // Restablecer la variable detalleCounter a 1
  detalleCounter = 1;
}

// Variables para contar detalles
let detalleCounter = 1;

let totalDetalles = 0; // Variable para rastrear la cantidad total de detalles
// Función para agregar automáticamente la cantidad de detalles seleccionada
function agregarDetallesAutomaticos() {
  // Obtiene la cantidad seleccionada desde el select
  const cantidadDetallesSelect = document.getElementById("tipoPlan");
  const cantidadSeleccionada = cantidadDetallesSelect.value;
  let cantidadAdicional = 0; // Variable para la cantidad adicional de detalles

  // Asigna la cantidad adicional según la selección
  if (cantidadSeleccionada === "1") {
    cantidadAdicional = 1;
  } else if (cantidadSeleccionada === "2") {
    cantidadAdicional = 5;
  } else if (cantidadSeleccionada === "3") {
    cantidadAdicional = 10;
  } else if (cantidadSeleccionada === "4") {
    cantidadAdicional = 1;
  } else if (cantidadSeleccionada === "5") {
    cantidadAdicional = 1;
  } else if (cantidadSeleccionada === "6") {
    cantidadAdicional = 1;
  } else if (cantidadSeleccionada === "7") {
    cantidadAdicional = 1;
  } else if (cantidadSeleccionada === "0") {
    cantidadAdicional = 0;
  }

 // Inicializa el valor del campo oculto
 document.getElementById("cantidadDetalles").value = cantidadAdicional;

 // Limpia detalles existentes antes de agregar nuevos
 const detallesContainer = document.getElementById("detallesContainer");
 while (detallesContainer.firstChild) {
   detallesContainer.removeChild(detallesContainer.firstChild);
 }

 // Agrega la cantidad de detalles correspondientes
 for (let i = 0; i < cantidadAdicional; i++) {
   agregarDetalle();
 }
}
// Función para agregar detalles dinámicamente
function agregarDetalle() {
  const detallesContainer = document.getElementById("detallesContainer");

  // Campos para el detalle
  const detalleHtml = `
      <div class="detalle_1 row" id="detalle_${detalleCounter}">
          <div class="col-md-6">
              <label class="form-label" for="fecha_session_${detalleCounter}">Fecha Para Sesión ${detalleCounter}:</label>
              <input type="datetime-local" class="form-control" id="fecha_session_${detalleCounter}" name="fecha_session[]" required>
          </div>
          <div class="col-md-6">
              <label class="form-label" for="estado_id_${detalleCounter}">Estado para Sesión ${detalleCounter}:</label>
              <select class="form-control" name="estado_id[]" id="estado_id_${detalleCounter}" required>
                  <option value="4" selected>Ausente</option>
              </select>
              <button class="btn btn-danger" type="button" onclick="eliminarDetalle(${detalleCounter})">Eliminar Detalle</button>
          </div>
      </div>
  `;

  // Agregar detalles al contenedor
  const div = document.createElement("div");
  div.innerHTML = detalleHtml;
  detallesContainer.appendChild(div);

  // Incrementar el contador y la cantidad total de detalles
  detalleCounter++;
  totalDetalles++;
}
// Función para eliminar un conjunto de campos de detalle
function eliminarDetalle(detalleCounter) {
  const detalle = document.getElementById(`detalle_${detalleCounter}`);
  // Verificar si el elemento existe antes de intentar eliminarlo
  if (detalle) {
      detalle.parentNode.removeChild(detalle);
      // Reducir el contador y la cantidad total de detalles
      detalleCounter--;
      totalDetalles--; // Asegúrate de que la variable totalDetalles esté declarada y sea accesible en este ámbito
  }
}


// Función para guardar sesiones en la base de datos
function guardarSesiones() {
// Validar que la cédula no esté vacía
const cedula = document.getElementById("idp").value;
if (cedula.trim() === "") {
  // Mostrar un mensaje de error con SweetAlert
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Por favor, ingrese la cédula del paciente.',
  });
  return; // Salir de la función si hay un error
}
// Validar que el tipo de plan sea seleccionado
const tipoPlan = document.getElementById("tipoPlan").value;
if (tipoPlan === "0") {
  // Mostrar un mensaje de error con SweetAlert
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Por favor, seleccione un tipo de plan.',
  });
  return; // Salir de la función si hay un error
}

// Validar que al menos un detalle haya sido agregado
if (totalDetalles === 0) {
  // Mostrar un mensaje de error con SweetAlert
  Swal.fire({
    icon: 'error',
    title: 'Error',
    text: 'Por favor, agregue al menos un detalle de sesión.',
  });
  return; // Salir de la función si hay un error
}
// Validar que todos los campos de detalle sean llenados
  for (let i = 1; i <= totalDetalles; i++) {
    const fechaSession = document.getElementById(`fecha_session_${i}`).value;
    if (fechaSession.trim() === "") {
      // Mostrar un mensaje de error con SweetAlert
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: `Por favor, complete la Fecha Para Sesión #${i}.`,
      });
      return; // Salir de la función si hay un error
    }
  }


  // Obtener valores del formulario de cabecera
  //const cedula = document.getElementById("Paciente_cedula").value;
 // const cedula = document.getElementById("idp").value; /**envio el id del paciente */
  //const tipoPlan = document.getElementById("tipoPlan").value;
  const fechaIngreso = document.getElementById("fecha_ing").value; /*fecha de adquisicion del plna */
  const profesional = document.getElementById("profesional").value;/**id del profesional */
  const estadoPlan = document.getElementById("E_plan").value;/*estado del plan */
  const consultorio = document.getElementById("consultorio").value;/*lugar de la sesion */
  const tipoPago = document.getElementById("tipoPago").value;/*forma de pago */

  // Obtener valores del formulario de detalles
  const detalles = [];
  for (let i = 1; i <= totalDetalles; i++) {
      const fechaSession = document.getElementById(`fecha_session_${i}`).value;
      const estadoId = document.getElementById(`estado_id_${i}`).value;

      detalles.push({ fechaSession, estadoId });
  }

  // Enviar datos al servidor mediante AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/guardar_sesiones.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Manejar la respuesta del servidor
  xhr.onload = function () {
      if (xhr.status === 200) {
          // Éxito, hacer algo si es necesario
          //console.log(xhr.responseText);
          // Éxito, mostrar mensaje de éxito con SweetAlert
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Las sesiones se guardaron correctamente.',
            showConfirmButton: true,
            timer: 1500
          });
          
          // Puedes redirigir o hacer otras acciones después de un tiempo
          setTimeout(function() {
            window.location.href = 'add_sessiones.php';
          }, 3500);
      } else {
          // Manejar errores aquí
          // Error, mostrar mensaje de error con SweetAlert
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar las sesiones.',
            showConfirmButton: true
          });
          
          console.error("Error al guardar sesiones");
      }
  };

  // Construir la cadena de datos para enviar
  const data = `cedula=${cedula}&tipoPlan=${tipoPlan}&fechaIngreso=${fechaIngreso}&profesional=${profesional}&estadoPlan=${estadoPlan}&consultorio=${consultorio}&tipoPago=${tipoPago}&detalles=${JSON.stringify(detalles)}`;

  // Enviar la solicitud
  xhr.send(data);
}


