<div id="updateSurgeryModal" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="updateSurgeryForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Informe Quirúrgico</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="idUpdate">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="bold" for="date">Fecha</label>
                                <input 
                                    type="date" 
                                    name="date" 
                                    id="date" 
                                    class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="bold" for="start_time">Hora Inicio</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="bold" for="end_time">Hora Termino</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="bold" for="bed_num">Cama №</label>
                                <input 
                                    type="number" 
                                    name="bed_num" 
                                    id="bed_num" 
                                    class="form-control" 
                                    step="1"
                                    placeholder="###"
                                    min="0"
                                    max="999"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="amount" class="bold">Costo (S/)</label>
                                <input 
                                    type="number" 
                                    name="amount"
                                    id="amount" 
                                    class="form-control" 
                                    step="0.01"
                                    min="0"
                                    placeholder="########,##"
                                    max="99999999.99"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="patient" class="bold">Paciente</label>
                                <select 
                                    id="updatePatients" 
                                    name="patient" 
                                    class="form-control" 
                                    required></select>  
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="anesthesia_type" class="bold">Tipo de Anestesia</label>
                                <input type="text" id="anesthesia_type" name="anesthesia_type" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="oxygen_use" class="bold">Uso de Oxígeno (L)</label>
                                <input 
                                    type="number" 
                                    name="oxygen_use" 
                                    id="oxygen_use" 
                                    class="form-control" 
                                    step="0.01"
                                    min="0"
                                    placeholder="########,##"
                                    max="99999999.99"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Diagnóstico Pre-Operatorio</label>
                                <select id="updatePreDiagnoses" name="pre_diagnosis" class="form-control" required></select>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold">Diagnóstico Post-Operatorio</label>
                                <select id="updatePostDiagnoses" name="post_diagnosis" class="form-control" required></select>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="employees" class="bold">Especialistas</label>
                                <select 
                                    id="updateEmployees"
                                    class="form-control" 
                                    name="employees[]" 
                                    multiple="multiple"
                                    required>
                                </select>  
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="procedure_findings" class="bold">Procedimientos y Hallazgos</label>
                                <textarea name="procedure_findings" id="procedure_findings" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="equipment" class="bold">Equipos</label>
                                <textarea name="equipment" id="equipment" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplies" class="bold">Insumos</label>
                                <textarea name="supplies" id="supplies" rows="2" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observations" class="bold">Observaciones</label>
                                <textarea name="observations" id="observations" rows="2" class="form-control" required></textarea>
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