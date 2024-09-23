<!-- muestro los datos de la tabla fichas -->
<?php 

echo $query_ficha = "SELECT * FROM view_fichas WHERE ficha_id = $ficha_id";
$execute_query = pg_query($conexion,$query_ficha);

while($datos_ficha = pg_fetch_array($execute_query)){
    $ficha_id =$datos_ficha['ficha_id'];
    $paciente_id =$datos_ficha['paciente_id'];
    $nro_ci =$datos_ficha['nro_ci'];
    $nombre =$datos_ficha['nombre'];
    $apellido =$datos_ficha['apellido'];
    $ficha_fecha =$datos_ficha['ficha_fecha'];
    $medico_tratante =$datos_ficha['medico_tratante'];
    $diagnostico_medico =$datos_ficha['diagnostico_medico'];
    $motivo_consulta =$datos_ficha['motivo_consulta'];
    $a_e_a =$datos_ficha['a_e_a']; //antecedentes_enfermedad_actual
    $a_p_p =$datos_ficha['a_p_p'];
    $a_p_f =$datos_ficha['a_p_f'];
    $banderas =$datos_ficha['banderas'];
    $dolor_persistente =$datos_ficha['dolor_persistente'];
    $ficha_evaluacion =$datos_ficha['ficha_evaluacion'];
    $ficha_diagnostico =$datos_ficha['ficha_diagnostico'];
    $ficha_nro =$datos_ficha['ficha_nro'];
    $factores_somaticos_medicales =$datos_ficha['factores_somaticos_medicales'];
    $factores_cognitivos_percepciones =$datos_ficha['factores_cognitivos_percepciones'];
    $factores_emocionales =$datos_ficha['factores_emocionales'];
    $factores_comportamentales =$datos_ficha['factores_comportamentales'];
    $factores_sociales =$datos_ficha['factores_sociales'];
    $motivacion =$datos_ficha['motivacion'];
    $estado_id =$datos_ficha['estado_id'];
    $estado_nombre =$datos_ficha['estado_nombre'];
}
?>
<!-- Main content -->
<section class="content " style="margin-top:4.2rem!important">
    <div class="modal-content">
        <div class="modal-header ">
            <h4 class="modal-title">Editar  Ficha Nro <?php echo $ficha_nro; ?> </h4>
            <a href="pacientes_fichas.php" class="btn btn-success">Volver a Lista</a>
        </div>

        <div class="modal-body">
            <!--  barra de progreso-->
            <!-- <div class="progress"> 
                <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>  -->
            <!-- fin barra de progreso -->

            <!-- Contenedor para mensajes -->
            <div id="mensajesContainerEdit"></div>
            <form id="formularioEditFicha" autocomplete="off" method="post">
                <!--Aca empieza el paso uno  -->
                <!-- <div id="step1"> -->
                    <!--Agrego campos para el paso 1 -->
                    <div class="row">
                        <div class="col-md-4">
                            <label for="EditnroFicha" class="form-label">Ficha Nro</label>
                            <input type="text" class="form-control col-md-2" name="EditnroFicha" id="EditnroFicha" value="<?php echo $ficha_nro ?>" readonly>
                            <input type="hidden"  name="Editid" id="Editid" value="<?php echo $ficha_id ?>" readonly>
                        </div>
                        <!-- <div class="col-md-4">
                            <label for="EditfechaFicha" class="form-label">Fecha Ficha</label>
                            <input type="text" name="EditfechaFicha" id="EditfechaFicha" class="form-control" value="<?php echo date('d/m/Y',strtotime($ficha_fecha));  ?>" >
                            <span style="font-size: 12px;font-weight: bold;">Formato de fecha -> dia/mes/año</span>
                        </div> -->
                        <div class="col-md-4">
                            <label for="Editestado_id" class="form-label">Estado</label>
                            <select class="form-control" name="Editestado_id" id="Editestado_id" require>
                                    <option value="">Elegir Estado</option>
                                    <?php 
                                    $q_estado = 'select * from estados where estado_id in (5,6)';
                                    $execute_estado = pg_query($conexion,$q_estado);
                                    while ($row_estado = pg_fetch_array($execute_estado)) {
                                        $selected = ($row_estado['estado_id'] == 5) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $row_estado['estado_id']; ?>" <?php echo $selected; ?>>
                                            <?php echo $row_estado['estado_nombre']; ?>
                                        </option>
                                    <?php } ?>
                            </select>
                        </div>    
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditPaciente_cedula" class="form-label">
                                Nro. Cedula
                            </label>
                            <input type="text" class="form-control" id="EditPaciente_cedula" placeholder="Ingresar Nro de Cedula" value="<?php echo $nro_ci ?>" readonly require>
                            <small>Escribir numero sin puntos</small>
                        </div>
                        <div class="col">
                            <label for="Editnombres" class="form-label">
                                Datos del Pacientes
                            </label>
                            <input type="text" class="form-control" name="Editnombres" id="Editnombres" value="<?php echo $nombre.' '.$apellido ?>" readonly>
                            <input type="hidden" class="form-control" name="Editidp" id="Editidp" value="<?php echo $paciente_id ?>"><!-- id del paciente -->
                        </div>
                    </div>

                    <!-- <button type="button" class="btn btn-primary next-step">Siguiente</button>
                    <p>
                    <span class="h6">Seguir Completando Ficha</span>
                    </p> -->
                    <!--fin donde agrego  campos para el paso 1 -->
                <!-- </div> -->
                <!-- fin del paso uno -->
                <!--Aca empieza el paso dos  -->
                <!-- <div id="step2" style="display: none;"> -->
                    <!--Agrego campos para el paso 2 -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditMedicotratante" class="form-label">
                                Medico Tratante
                            </label>
                            <input type="text" name="EditMedicotratante" id="EditMedicotratante" class="form-control" value="<?php echo $medico_tratante ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditDiagnosticoM" class="form-label">
                                Diagnostico Medico
                            </label>
                            <input type="text" name="EditDiagnosticoM" id="EditDiagnosticoM" class="form-control" value="<?php echo $diagnostico_medico ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditMotivoConsulta" class="form-label">
                                Motivo de Consulta
                            </label>
                            <input type="text" name="EditMotivoConsulta" id="EditMotivoConsulta" class="form-control" value="<?php echo $motivo_consulta ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditAEA" class="form-label">
                                Antecedentes de la Enfermedad Actual - A.E.A
                            </label>
                            <textarea name="EditAEA" id="EditAEA" class="form-control"><?php echo $a_e_a ?></textarea>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-success prev-step">Volver</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button> -->
                    <!--fin donde agrego  campos para el paso 2 -->
                <!-- </div> -->
                <!-- fin del paso dos -->
                <!--Aca empieza el paso tres  -->
                <!-- <div id="step3" style="display: none;"> -->
                    <!--Agrego campos para el paso 3 -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editapp" class="form-label">
                                Antecedentes Patologico Personal - A.P.P
                            </label>
                            <textarea name="Editapp" id="Editapp" class="form-control"><?php echo $a_p_p ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editapf" class="form-label">
                                Antecedentes Patologico Familiar - A.P.F
                            </label>
                            <textarea name="Editapf" id="Editapf" class="form-control"><?php echo $a_p_f ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editbanderas" class="form-label">
                                Banderas
                            </label>
                            <textarea name="Editbandera" id="Editbandera" class="form-control"><?php echo $banderas ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editdolor" class="form-label">
                                Dolor
                            </label>
                            <textarea name="Editdolor" id="Editdolor" class="form-control"><?php echo $dolor_persistente ?></textarea>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-success prev-step">Volver</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button> -->
                    <!--fin donde agrego  campos para el paso 3-->
                <!-- </div> -->
                <!-- fin del paso tres -->
                <!--Aca empieza el paso cuatro  -->
                <!-- <div id="step4" style="display: none;"> -->
                    <!--Agrego campos para el paso 4 -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editfactores_s_m" class="form-label">
                                Factores somaticos medicales:
                            </label>
                            <textarea name="Editfactores_s_m" id="Editfactores_s_m" class="form-control"><?php echo $factores_somaticos_medicales ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editfactores_c_p" class="form-label">
                                Factores Cognitivos Percepciones:
                            </label>
                            <textarea name="Editfactores_c_p" id="Editfactores_c_p" class="form-control"><?php echo $factores_cognitivos_percepciones ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editfactores_e" class="form-label">
                                Factores Emocionales:
                            </label>
                            <textarea name="Editfactores_e" id="Editfactores_e" class="form-control"><?php echo $factores_emocionales ?></textarea>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-success prev-step">Volver</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button> -->
                    <!--fin donde agrego  campos para el paso 4-->
                <!-- </div> -->
                <!-- fin del paso cuatro -->
                <!--Aca empieza el paso cinco  -->
                <!-- <div id="step5" style="display: none;"> -->
                    <!--Agrego campos para el paso 5 -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editfactores_comportamentales" class="form-label">
                                Factores Comportamentales:
                            </label>
                            <textarea name="Editfactores_comportamentales" id="Editfactores_comportamentales" class="form-control"><?php echo $factores_comportamentales ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editfactores_sociales" class="form-label">
                                Factores Sociales:
                            </label>
                            <textarea name="Editfactores_sociales" id="Editfactores_sociales" class="form-control"><?php echo $factores_sociales ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editmotivacion" class="form-label">
                                Motivacion
                            </label>
                            <textarea name="Editmotivacion" id="Editmotivacion" class="form-control"><?php echo $motivacion ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="EditEvaluacion" class="form-label">
                                Evaluacion
                            </label>
                            <textarea name="EditEvaluacion" id="EditEvaluacion" class="form-control" ><?php echo $ficha_evaluacion ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Editdiagnostico" class="form-label">
                                Diagnostico
                            </label>
                            <textarea name="Editdiagnostico" id="Editdiagnostico" class="form-control" placeholder="Escribir..."><?php echo $diagnostico_medico ?></textarea>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-success prev-step">Volver</button> -->
                    <!--fin donde agrego  campos para el paso 5-->
                <!-- </div> -->
                <!-- fin del paso cinco -->

        </div>
        <div class="modal-footer">
            <!-- Botón para enviar formulario -->
            <button type="submit" class="btn btn-success">Editar Ficha</button>
        </div>
        </form>
    </div>
</section>
<!-- /.content 
observacion - en el arrchivo add ficha.php ahi agrego el script para configurar el formulario paso , 
el scrip tiene el nombre de form_step.js

-->
