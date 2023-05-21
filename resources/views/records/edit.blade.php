<div id="updateRecordModal" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="updateRecordForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Historia</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li id="navTab1" class="active">
                                <a href="#tab_1_3" data-toggle="tab"> Sección 1/3 </a>
                            </li>
                            <li id="navTab2">
                                <a href="#tab_2_3" data-toggle="tab"> Sección 2/3 </a>
                            </li>
                            <li id="navTab3">
                                <a href="#tab_3_3" data-toggle="tab"> Sección 3/3 </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_1_3">
                                <h3 class="form-section">1. Filiación</h3><hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="document">Doc. de Identidad</label>
                                            <input 
                                                type="text" 
                                                name="document" 
                                                id="document" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="patient">Paciente</label>
                                            <input 
                                                type="text" 
                                                name="patient" 
                                                id="patient" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="age">Edad</label>
                                            <input 
                                                type="text" 
                                                name="age" 
                                                id="age" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="service">Servicio</label>
                                            <input 
                                                type="text" 
                                                name="service" 
                                                id="service" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="employee">Especialista</label>
                                            <input 
                                                type="text" 
                                                name="employee" 
                                                id="employee" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">2. Anamnesis</h3><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="symptom" class="bold">Síntomas Principales</label>
                                            <textarea name="symptom" id="symptom" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="history" class="bold">Historia de la Enfermedad</label>
                                            <textarea name="history" id="history" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="physiological_background" class="bold">Antecedentes Fisiológicos</label>
                                            <textarea name="physiological_background" id="physiological_background" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pathological_background" class="bold">Antecedentes Patológicos</label>
                                            <textarea name="pathological_background" id="pathological_background" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_2_3">
                                <h3 class="form-section">3. Exámen Físico</h3><hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="temperature">Temperatura (°C)</label>
                                            <input 
                                                type="number" 
                                                name="temperature" 
                                                id="temperature" 
                                                class="form-control" 
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="oxygen_saturation">Saturación de Oxígeno (%)</label>
                                            <input 
                                                type="number" 
                                                name="oxygen_saturation" 
                                                id="oxygen_saturation" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="weight">Peso (kg)</label>
                                            <input 
                                                type="number" 
                                                name="weight" 
                                                id="weight" 
                                                class="form-control" 
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="heart_rate">F. Cardíaca (x′)</label>
                                            <input 
                                                type="number" 
                                                name="heart_rate" 
                                                id="heart_rate" 
                                                class="form-control" 
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="height">Talla (cm)</label>
                                            <input 
                                                type="number" 
                                                name="height" 
                                                id="height" 
                                                class="form-control" 
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="respiratory_rate">F. Respiratoria (x′)</label>
                                            <input 
                                                type="number" 
                                                name="respiratory_rate" 
                                                id="respiratory_rate" 
                                                class="form-control" 
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bold" for="bmi">IMC</label>
                                            <input 
                                                type="text" 
                                                name="bmi" 
                                                id="bmi" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="blood_pressure">Presión Arterial (mmHg)</label>
                                            <input 
                                                type="text" 
                                                name="blood_pressure" 
                                                id="blood_pressure" 
                                                class="form-control"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="physical_exam" class="bold">Exámen Físico</label>
                                            <textarea name="physical_exam" id="physical_exam" rows="1" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="form-section">4. Impresión Dignóstica</h3><hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="auxiliary_exams" class="bold">Exámenes Auxiliares</label>
                                            <textarea name="auxiliary_exams" id="auxiliary_exams" rows="1" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select id="diagnoses" class="form-control" style="width: auto;"></select>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-scrollable">
                                            <table id="diagnosesTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Quitar</th>
                                                        <th>Tipo</th>
                                                        <th>Enfermedad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_3_3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instruction" class="bold">Indicaciones</label>
                                            <textarea name="instruction" id="instruction" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="treatment" class="bold">Tratamiento</label>
                                            <textarea name="treatment" id="treatment" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-sm-12 text-center">
                                        <div class="form-group">
                                            <button id="addPrescriptionBtn" onclick="addPrescription()" class="btn btn-success" type="button"> 
                                                <i class="fa fa-plus"></i> Agregar Receta
                                            </button>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-scrollable">
                                            <table id="prescriptionTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Quitar</th>
                                                        <th>Medicamento</th>
                                                        <th>Cantidad</th>
                                                        <th>Presentación</th>
                                                        <th>Dosis</th>
                                                        <th>Vía</th>
                                                        <th>Frecuencia</th>
                                                        <th>Duración</th>
                                                        <th>Observación</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning" id="updateRecordsBtn">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>