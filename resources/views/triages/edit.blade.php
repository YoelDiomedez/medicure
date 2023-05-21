<div id="updateTriageModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateTriageForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Triaje</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="document">Doc. de Identidad</label>
                                <input 
                                    type="text" 
                                    name="document" 
                                    id="document" 
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="patient">Paciente</label>
                                <input 
                                    type="text" 
                                    name="patient" 
                                    id="patient" 
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="age">Edad</label>
                                <input 
                                    type="text" 
                                    name="age" 
                                    id="age" 
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="service">Servicio</label>
                                <input 
                                    type="text" 
                                    name="service" 
                                    id="service" 
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="employee">Especialista</label>
                                <input 
                                    type="text" 
                                    name="employee" 
                                    id="employee" 
                                    class="form-control"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="bmi">IMC</label>
                                <input 
                                    type="number" 
                                    name="bmi" 
                                    id="bmi" 
                                    class="form-control"
                                    min="0"
                                    max="99999999.99"
                                    readonly>
                            </div>
                            <div id="bmitype" class="form-group">
                                <label class="bold" for="type">Tipo de IMC</label>
                                <input 
                                    type="text" 
                                    id="type" 
                                    class="form-control"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">  
                            <div class="form-group">
                                <label class="bold" for="weight">Peso (kg)</label>
                                <input 
                                    type="number" 
                                    name="weight" 
                                    id="weight" 
                                    class="form-control" 
                                    step="0.01"
                                    placeholder="###,##"
                                    min="0"
                                    max="999.99"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="height">Talla (cm)</label>
                                <input 
                                    type="number" 
                                    name="height" 
                                    id="height" 
                                    class="form-control" 
                                    step="1"
                                    placeholder="###"
                                    max="999"
                                    min="0"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="temperature">Temperatura (°C)</label>
                                <input 
                                    type="number" 
                                    name="temperature" 
                                    id="temperature" 
                                    class="form-control" 
                                    step="0.01"
                                    placeholder="###,##"
                                    min="0"
                                    max="999.99"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="heart_rate">Frecuencia Cardíaca (x′)</label>
                                <input 
                                    type="number" 
                                    name="heart_rate" 
                                    id="heart_rate" 
                                    class="form-control" 
                                    step="1"
                                    placeholder="###"
                                    min="0"
                                    max="999"
                                    >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="respiratory_rate">Frecuencia Respiratoria (x′)</label>
                                <input 
                                    type="number" 
                                    name="respiratory_rate" 
                                    id="respiratory_rate" 
                                    class="form-control" 
                                    step="1"
                                    placeholder="##"
                                    min="0"
                                    max="99"
                                    >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="oxygen_saturation">Saturación de Oxígeno (%)</label>
                                <input 
                                    type="number" 
                                    name="oxygen_saturation" 
                                    id="oxygen_saturation" 
                                    class="form-control"
                                    step="1"
                                    placeholder="###"
                                    min="0"
                                    max="999"
                                    >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="blood_pressure">Presión Arterial (mmHg)</label>
                                <input 
                                    type="text" 
                                    name="blood_pressure" 
                                    id="blood_pressure" 
                                    class="form-control"
                                    placeholder="###/###"
                                    maxlength="7"
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>