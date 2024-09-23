<?php
//phpinfo(); 

include('clases/conexion.php');
//inicio o reanudo la session 
session_start();

//verificar si el usuario a iniciado sesion

if (!isset($_SESSION['usuario_id'])) {
    //si no ha iniciado sesion, redirigir a login.php
    header('location:index.php');
    exit();
}


 ob_start(); 

$id = $_GET['id'];
//consulta de la fichas 
$query_fichas = "SELECT * FROM view_fichas where ficha_id = $id order by ficha_nro";
$excute_query_fichas = pg_query($conexion, $query_fichas);

while ($row_fichas = pg_fetch_array($excute_query_fichas)) {
    $nombre = $row_fichas['nombre'];
    $nro_ci = $row_fichas['nro_ci'];
    $apellido = $row_fichas['apellido'];
    $medico_tratante = $row_fichas['medico_tratante'];
    $motivo_consulta = $row_fichas['motivo_consulta'];
    $diagnostico_medico = $row_fichas['diagnostico_medico'];
    $a_e_a = $row_fichas['a_e_a'];
    $a_p_p = $row_fichas['a_p_p'];
    $a_p_f = $row_fichas['a_p_f'];
    $banderas = $row_fichas['banderas'];
    $dolor_persistente = $row_fichas['dolor_persistente'];
    $ficha_evaluacion = $row_fichas['ficha_evaluacion'];
    $ficha_diagnostico = $row_fichas['ficha_diagnostico'];
    $factores_somaticos_medicales = $row_fichas['factores_somaticos_medicales'];
    $factores_cognitivos_percepciones = $row_fichas['factores_cognitivos_percepciones'];
    $factores_emocionales = $row_fichas['factores_emocionales'];
    $factores_comportamentales = $row_fichas['factores_comportamentales'];
    $factores_sociales = $row_fichas['factores_sociales'];
    $motivacion = $row_fichas['motivacion'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Ficha Paciente- <?php echo $nombre.'_'.$apellido?> </title>
    <style>
        table,tr,td{
            border: 1px solid !important;
            font-weight: bold;
        }
    </style>
</head>

<body style="font-size: 13px;">
    <table class="table table-bordered">
        <tr class="bg-info text-center" >
            <td>
                <p class="font-weight-bold text-white">FICHA MEDICA</p>
            </td>
        </tr>
    </table>
    <table class="table" width:"80%" height:"80%">
        <tr>
            <td>Cedula</td>
            <td><?php echo $nro_ci ?></td>
            <td>Nombres</td>
            <td><?php echo $nombre ?></td>
            <td>Apellidos</td>
            <td><?php echo $apellido ?></td>
        </tr>
        <tr>
            <td>Medico Tratante</td>
            <td colspan="5"><?php echo $medico_tratante ?></td>
        </tr>
        <tr>
            <td>Motivo de Consutla</td>
            <td colspan="5"><?php echo $motivo_consulta ?></td>
        </tr>
        <tr>
            <td>Diagnostico Medico</td>
            <td colspan="5"><?php echo $diagnostico_medico ?></td>
        </tr>
        <tr>
            <td>Antecedentes de la Enfermedad A.E.A</td>
            <td colspan="5"><?php echo $a_e_a ?></td>
        </tr>
        <tr>
            <td>Antecedentes Patologico Personal A.P.P</td>
            <td colspan="5"><?php echo $a_p_p ?></td>
        </tr>
        <tr>
            <td>Antecedentes Patologico familiar A.P.F</td>
            <td colspan="5"><?php echo $a_p_p ?></td>
        </tr>
        <tr>
            <td>banderas</td>
            <td colspan="2"><?php echo $banderas ?></td>
            <td>Dolor Persistente</td>
            <td colspan="3"><?php echo $dolor_persistente ?></td>
        </tr>
        <tr>
            <td>Evaluacion</td>
            <td colspan="5"><?php echo $ficha_evaluacion ?></td>
        </tr>
        <tr>
            <td>Diagnostico</td>
            <td colspan="5"><?php echo $ficha_diagnostico ?></td>
        </tr>
        <tr>
            <td>Factores Somaricos y Medicales</td>
            <td colspan="5"><?php echo $factores_somaticos_medicales ?></td>
        </tr>
        <tr>
            <td>Factores Cognitivos y Percepciones</td>
            <td colspan="5"><?php echo $factores_cognitivos_percepciones ?></td>
        </tr>
        <tr>
            <td>Factores Emocionales</td>
            <td colspan="5"><?php echo $factores_emocionales ?></td>
        </tr>
        <tr>
            <td>Factores Comportamentales</td>
            <td colspan="5"><?php echo $factores_comportamentales ?></td>
        </tr>
        <tr>
            <td>Factores Sociales</td>
            <td colspan="5"><?php echo $factores_sociales ?></td>
        </tr>
        <tr>
            <td>Motivacion</td>
            <td colspan="5"><?php echo $motivacion ?></td>
        </tr>
    </table>
</body>
</html>
<?php 
$html = ob_get_clean();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$option = $dompdf->getOptions();
$option->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($option);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();

//$dompdf->stream("ficha_.pdf", array("Attachment" => false));
$dompdf->stream("ficha_'$nombre'_'$apellido'.pdf", array("Attachment" => false));
?>