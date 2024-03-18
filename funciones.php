<?php 
///funcion para formatear el numero al nombre del mes 
function nombre_mes($mes){

    $mes_nombre='';
    switch ($mes) {
        case 1: $mes_nombre='ENERO';
                break;
        case 2: $mes_nombre='FEBRERO';
                break;
        case 3: $mes_nombre='MARZO';
                break;
        case 4: $mes_nombre='ABRIL';
                break;
        case 5: $mes_nombre='MAYO';
                break;
        case 6: $mes_nombre='JUNIO';
                break;
        case 7: $mes_nombre='JULIO';
                break;
        case 8: $mes_nombre='AGOSTO';
                break;
        case 9: $mes_nombre='SETIEMBRE';
                break;
        case 10: $mes_nombre='OCTUBRE';
                break;
        case 11: $mes_nombre='NOVIEMBRE';
                break;
        case 12: $mes_nombre='DICIEMBRE';
                break;
    }
    return ($mes_nombre);
}

?>