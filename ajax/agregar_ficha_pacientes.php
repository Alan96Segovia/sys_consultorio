<?php
include('../clases/conexion.php');
//recibo los campos del formulario pacientes_formulario_fichas.php

$nroFicha = $_POST['nroFicha'];
$fechaFicha = date("Y/m/d");
$consulta_id = $_POST['consulta_id']; //id del paciente
$Medicotratante = $_POST['Medicotratante'];
$DiagnosticoM = $_POST['DiagnosticoM'];//diagnostico medico
$MotivoConsulta = $_POST['MotivoConsulta'];// motivo de consulta    
$AEA = $_POST['AEA'];//antecedentes de la enfermedad actual
$app = $_POST['app'];// antecedentes patologicos personal app
$apf = $_POST['apf'];//antecedentes patologicos familiar apf
$banderas = $_POST['app'];//
$dolor = $_POST['dolor'];
$factores_s_m = $_POST['factores_s_m'];//factores somaticos medicales
$factores_c_p = $_POST['factores_c_p']; // factores cognitivos percepciones
$factores_e = $_POST['factores_e'];//factores emocionales
$factores_comportamentales = $_POST['factores_comportamentales'];//factores_comportamentales
$Evaluacion = $_POST['Evaluacion'];
$diagnostico = $_POST['diagnostico'];
$factores_sociales = $_POST['factores_sociales'];
$motivacion = $_POST['motivacion'];

//echo 'post'.print_r($__POST);
//query para insertar 
 $query_insert = "INSERT INTO pacientes_fichas
(paciente_id,
paciente_ficha_fecha,
medico_tratante,
diagnostico_medico,
motivo_consulta,
antecedentes_enfermedad_actual,
antecedentes_potologico_personal,
antecedentes_patologicos_familiar,
banderas,
dolor_persistente,
ficha_evaluacion,
ficha_diagnostico,
ficha_nro,
factores_somaticos_medicales,
factores_cognitivos_percepciones,
factores_emocionales,
factores_comportamentales,
factores_sociales,
motivacion,
estado_id)
VALUES ($consulta_id,
'$fechaFicha',
'$Medicotratante',
'$DiagnosticoM',
'$MotivoConsulta',
'$AEA',
'$app',
'$apf',
'$banderas',
'$dolor',
'$Evaluacion',
'$diagnostico',
$nroFicha,
'$factores_s_m',
'$factores_c_p',
'$factores_e',
'$factores_comportamentales',
'$factores_sociales',
'$motivacion',
1);";

$insert = pg_query($conexion,$query_insert);

if($insert){
    echo 'success';
}else{
    // Si hay un error, obtener el mensaje de error de PostgreSQL
    $error_message = pg_last_error($conexion);

    // muestro mi mensahe de error
    echo "error: " . $query_insert;
}


?>