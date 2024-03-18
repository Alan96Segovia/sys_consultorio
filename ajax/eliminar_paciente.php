<?php 
include('../clases/conexion.php');


//recibo el id del registro a ser eliminado
$pacienteId=$_POST['paciente_id'];


//realizo el query para la eliminacion'
$query_delete = "DELETE FROM pacientes WHERE paciente_id =$pacienteId";

//ejecute query
$execute_delete = pg_query($conexion,$query_delete);

//verifico el resultado 

if(!$execute_delete){
    die("Error en la consulta".pg_last_error());
}
//cierro la conexion
pg_close($conexion);

//envio la respuesta a la parte del frontend
echo "Eliminado Con Exito!";
?>