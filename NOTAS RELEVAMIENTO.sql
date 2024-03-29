/*
--Pacientes
	Contiene información personal del paciente.
	la información se almacena de manera separada para evitar redundancias.
--Consultas
	Registra las consultas con un pago fijo independientemente del plan.
    Almacenar las consultas en una tabla separada permite mantener un historial
    de todas las consultas y sus costos asociados.
    La clave externa PacienteID establece una relación con la tabla de Pacientes.
--Sesiones O plan de sesiones
	Registra las sesiones vinculadas a los diferentes planes.
    Al igual que en el caso de las consultas,
    almacenar las sesiones en una tabla separada permite un seguimiento más preciso
    de las sesiones y los planes asociados.
    La clave externa PacienteID establece una relación con la tabla de Pacientes.
---------------------------
De esta manera mejoramos la eficiencia en la gestion de los datos
Separar la información en tablas distintas facilita la actualización
y consulta de datos sin duplicar información innecesaria.
En resumen esto permite una gestion
eficiente y organizada de la información del paciente, las consultas y las sesiones
*/