<div id="updateDiagnosisModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateDiagnosisForm" accept-charset="UTF-8">
                    @csrf
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Diagnóstico</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label class="bold" for="weight">Código (CIE-10)</label>
                            <input 
                                type="text" 
                                name="code" 
                                id="code" 
                                class="form-control"
                                maxlength="10"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="bold" for="weight">Enfermedad</label>
                            <input 
                                type="text" 
                                name="disease" 
                                id="disease" 
                                class="form-control" 
                                maxlength="255"
                                required>
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