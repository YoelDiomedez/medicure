<div id="restoreDiagnosisModal" class="modal fade bs-modal-sm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="restoreDiagnosisForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">¿Restaurar Diagnóstico?</h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="idRestore">
                    <p class="text-center"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Restaurar</button>
                </div>
            </form>
        </div>
    </div>
</div>