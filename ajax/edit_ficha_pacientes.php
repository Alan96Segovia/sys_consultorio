<?php
include('../clases/conexion.php');
//recibo los campos del formulario EDit_edpacientes_formulario_fichas.php


$ficha_id = $_POST['Editid'];
$nroFicha = $_POST['EditnroFicha'];
//$fechaFicha = $_POST['EditfechaFicha'];
$idp = $_POST['Editidp']; //id del paciente
$Medicotratante = $_POST['EditMedicotratante'];
$DiagnosticoM = $_POST['EditDiagnosticoM'];//diagnostico medico
$MotivoConsulta = $_POST['EditMotivoConsulta'];// motivo de consulta    
$AEA = $_POST['EditAEA'];//antecedentes de la enfermedad actual
$app = $_POST['Editapp'];// antecedentes patologicos personal app
$apf = $_POST['Editapf'];//antecedentes patologicos familiar apf
$banderas = $_POST['Editbandera'];//
$dolor = $_POST['Editdolor'];
$factores_s_m = $_POST['Editfactores_s_m'];//factores somaticos medicales
$factores_c_p = $_POST['Editfactores_c_p']; // factores cognitivos percepciones
$factores_e = $_POST['Editfactores_e'];//factores emocionales
$factores_comportamentales = $_POST['Editfactores_comportamentales'];//factores_comportamentales
$Evaluacion = $_POST['EditEvaluacion'];
$diagnostico = $_POST['Editdiagnostico'];
$factores_sociales = $_POST['Editfactores_sociales'];
$motivacion = $_POST['Editmotivacion'];
$Editestado_id = $_POST['Editestado_id'];

//echo 'post'.print_r($__POST);
//query para actualizar 
 $query_update = "UPDATE 
pacientes_fichas 
SET 
paciente_id =$idp,
medico_tratante = '$Medicotratante',
diagnostico_medico = '$DiagnosticoM',
motivo_consulta = '$MotivoConsulta',
antecedentes_enfermedad_actual = '$AEA',
antecedentes_potologico_personal = '$app',
antecedentes_patologicos_familiar = '$apf',
banderas = '$banderas',
dolor_persistente = '$dolor',
ficha_evaluacion = '$Evaluacion',
ficha_diagnostico = '$diagnostico',
ficha_nro = $nroFicha,
factores_somaticos_medicales = '$factores_s_m',
factores_cognitivos_percepciones = '$factores_c_p',
factores_emocionales = '$factores_e',
factores_comportamentales = '$factores_comportamentales',
factores_sociales = '$factores_sociales',
motivacion = '$motivacion',
estado_id = $Editestado_id
WHERE 
paciente_ficha_id = $ficha_id";

$update = pg_query($conexion,$query_update);

if($update){
    echo "success";
}else{
    // Si hay un error, obtener el mensaje de error de PostgreSQL
    //$error_message = $motivacion;
    //$error_message = pg_last_error($conexion);

    // muestro mi mensahe de error
    echo "error: " . $query_update;
}


?>