<div id="newAttentionModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newAttentionForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Atención</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="patient" class="bold">(*) Paciente</label>
                        <select 
                            id="newPatients" 
                            name="patient" 
                            class="form-control" 
                            required></select>  
                    </div>
                    <div class="form-group">
                        <label for="service" class="bold">(*) Servicio</label>
                        <select 
                            id="newServices" 
                            name="service" 
                            class="form-control" 
                            required></select>  

                    </div>
                    <div class="form-group">
                        <label for="employee" class="bold">(*) Especialista</label>
                        <select 
                            id="newEmployees" 
                            name="employee" 
                            class="form-control" 
                            required></select>  
                    </div>
                    <div class="form-group">
                        <label for="amount" class="bold">(*) Costo (S/)</label>
                        <input 
                            type="number" 
                            name="amount" 
                            class="form-control" 
                            step="0.01"
                            min="0"
                            placeholder="########,##"
                            max="99999999.99"
                            required>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>