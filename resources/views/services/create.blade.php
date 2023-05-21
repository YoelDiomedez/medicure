<div id="newServiceModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newServiceForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="bold" for="weight">Concepto</label>
                        <input 
                            type="text" 
                            name="concept" 
                            class="form-control"
                            maxlength="255"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="bold" for="weight">Costo (S/)</label>
                        <input 
                            type="number" 
                            name="amount" 
                            class="form-control" 
                            step="0.01"
                            placeholder="########,##"
                            min="0"
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