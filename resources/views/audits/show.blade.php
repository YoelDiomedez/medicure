<div id="viewAuditModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalles de Auditoria</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <h3 class="form-section">Información General</h3>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label col-md-3">
                                        <i class="fa fa-clock-o"></i>
                                    </label>
                                    <div class="col-md-9">
                                        <p class="form-control-static" id="datetime"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="control-label col-md-3 ">
                                        <i class="fa fa-user"></i>
                                    </label>
                                    <div class="col-md-9">
                                        <p class="form-control-static" id="user"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 bold">
                                        Evento:
                                    </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static" id="event"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 bold">
                                        Modelo:
                                    </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static" id="model"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 bold">
                                        IP:
                                    </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static" id="ip"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 bold">
                                        URL:
                                    </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static" id="url"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-2 bold">
                                        Agente:
                                    </label>
                                    <div class="col-md-10">
                                        <p class="form-control-static" id="agent"></p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <h3 class="form-section">Cambios Realizados</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 bold">Valores Nuevos:</label>
                                    <div class="col-md-12">
                                        <pre id="newValues">
                                        </pre>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-12 bold">Valores Antiguos:</label>
                                    <div class="col-md-12">
                                        <pre id="OldValues">
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>