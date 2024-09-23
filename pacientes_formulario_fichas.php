<!-- Main content -->
<section class="content " style="margin-top:4.2rem!important">
    <div class="modal-content">
        <div class="modal-header ">
            <h4 class="modal-title">Crear Ficha Paciente </h4>
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
            <div id="mensajesContainer"></div>
            <form id="formularioFicha" autocomplete="off">
                <!--Aca empieza el paso uno  
                <div id="step1"> -->
                
                    <!--Agrego campos para el paso 1 -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nroFicha" class="form-label">Ficha Nro</label>
                            <?php
                            //traigo el maximo nro de la ficha y le sumo uno para que sea el siguiente nro de ficha
                            $maxNroFicha = "select COALESCE( max(ficha_nro),0)+1 as nro_ficha FROM pacientes_fichas";
                            $execute_ficha = pg_query($conexion, $maxNroFicha);
                            $ArrayFicha = pg_fetch_array($execute_ficha);
                            ?>
                            <input type="text" class="form-control col-md-2" name="nroFicha" id="nroFicha" value="<?php echo $ArrayFicha['nro_ficha'] ?>" readonly>
                        </div>
                        <!-- <div class="col-md-4">
                            <label for="fechaFicha" class="form-label">Fecha Ficha</label>
                            <input type="date" name="fechaFicha" id="fechaFicha" class="form-control">
                        </div> -->

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Paciente_cedula" class="form-label">
                                Nro. Cedula
                            </label>
                            <input type="text" class="form-control" id="Paciente_cedula" placeholder="Ingresar Nro de Cedula" autofocus require>
                            <small>Escribir numero sin puntos</small>
                        </div>
                        <div class="col">
                            <label for="nombres" class="form-label">
                                Datos del Pacientes
                            </label>
                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Escribir nombre del paciente" readonly>
                            <input type="hidden" class="form-control" name="consulta_id" id="consulta_id"><!-- id del paciente -->
                        </div>
                        <div class="col">
                            <label for="edadpaciente" class="form-label">
                                Edad
                            </label>
                            <input type="text" class="form-control" name="edadpaciente" id="edadpaciente" readonly>
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
                            <label for="Medicotratante" class="form-label">
                                Medico Tratante
                            </label>
                            <input type="text" name="Medicotratante" id="Medicotratante" class="form-control" placeholder="Medico Tratante">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="DiagnosticoM" class="form-label">
                                Diagnostico Medico
                            </label>
                            <input type="text" name="DiagnosticoM" id="DiagnosticoM" class="form-control" placeholder="Diagnostico Medico">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="MotivoConsulta" class="form-label">
                                Motivo de Consulta
                            </label>
                            <input type="text" name="MotivoConsulta" id="MotivoConsulta" class="form-control" placeholder="Motivo de Consulta">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="AEA" class="form-label">
                                Antecedentes de la Enfermedad Actual - A.E.A
                            </label>
                            <textarea name="AEA" id="AEA" class="form-control" placeholder="Escribir..."></textarea>
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
                            <label for="app" class="form-label">
                                Antecedentes Patologico Personal - A.P.P
                            </label>
                            <textarea name="app" id="app" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="apf" class="form-label">
                                Antecedentes Patologico Familiar - A.P.F
                            </label>
                            <textarea name="apf" id="apf" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="banderas" class="form-label">
                                Banderas
                            </label>
                            <textarea name="bandera" id="bandera" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dolor" class="form-label">
                                Dolor
                            </label>
                            <textarea name="dolor" id="dolor" class="form-control" placeholder="Escribir..."></textarea>
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
                            <label for="factores_s_m" class="form-label">
                                Factores somaticos medicales:
                            </label>
                            <textarea name="factores_s_m" id="factores_s_m" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="factores_c_p" class="form-label">
                                Factores Cognitivos Percepciones:
                            </label>
                            <textarea name="factores_c_p" id="factores_c_p" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="factores_e" class="form-label">
                                Factores Emocionales:
                            </label>
                            <textarea name="factores_e" id="factores_e" class="form-control" placeholder="Escribir..."></textarea>
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
                            <label for="factores_comportamentales" class="form-label">
                                Factores Comportamentales:
                            </label>
                            <textarea name="factores_comportamentales" id="factores_comportamentales" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="factores_sociales" class="form-label">
                                Factores Sociales:
                            </label>
                            <textarea name="factores_sociales" id="factores_sociales" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="motivacion" class="form-label">
                                Motivacion
                            </label>
                            <textarea name="motivacion" id="motivacion" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="Evaluacion" class="form-label">
                                Evaluacion
                            </label>
                            <textarea name="Evaluacion" id="Evaluacion" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="diagnostico" class="form-label">
                                Diagnostico
                            </label>
                            <textarea name="diagnostico" id="diagnostico" class="form-control" placeholder="Escribir..."></textarea>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-success prev-step">Volver</button> -->
                    <!--fin donde agrego  campos para el paso 5-->
                <!-- </div> -->
                <!-- fin del paso cinco -->

        </div>
        <div class="modal-footer">
            <!-- Botón para enviar formulario -->
            <button type="submit" class="btn btn-success">Crear Ficha</button>
        </div>
        </form>
    </div>
</section>
<!-- /.content 
observacion - en el arrchivo add ficha.php ahi agrego el script para configurar el formulario paso , 
el scrip tiene el nombre de form_step.js

-->
