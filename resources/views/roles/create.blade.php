<div id="newRoleModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newRoleForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Acceso</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bold">Rol</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-control"
                                    maxlength="255"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="bold">Permisos</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3">
                            <ul class="nav nav-tabs tabs-left">
                                <li id="newTab1" class="active">
                                    <a href="#newAccessTab1" data-toggle="tab" aria-expanded="true"> Admisión </a>
                                </li>
                                <li id="newTab2" class="">
                                    <a href="#newAccessTab2" data-toggle="tab" aria-expanded="false"> Clínica </a>
                                </li>
                                <li id="newTab3" class="">
                                    <a href="#newAccessTab3" data-toggle="tab" aria-expanded="false"> Informe </a>
                                </li>
                                <li id="newTab4" class="">
                                    <a href="#newAccessTab4" data-toggle="tab" aria-expanded="false"> Mantenimiento </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="newAccessTab1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Inicio</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="1" checked> Escritorio
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="2" checked> Listar Triajes <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="3" checked> Listar Atenciones <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Historiales</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="4"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="6"> Ver Receta <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="5"> Ver Historia <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Atenciones</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="7"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="8"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="9"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="10"> Eliminar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Pacientes</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="11"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="12"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="13"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="14"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="15"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="16"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="newAccessTab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Triajes</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="17"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="18"> Editar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Historias</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="19"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="20"> Editar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="newAccessTab3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Quirúrgicos</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="21"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="22"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="23"> Ver
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="24"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="25"> Eliminar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Laboratoriales</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="26"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="27"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="28"> Ver
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="29"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="30"> Eliminar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="newAccessTab4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Accesos</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="31"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="32"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="33"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="34"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="35"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="36"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Servicios</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="37"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="38"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="39"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="40"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="41"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="42"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Diagnósticos</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="43"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="44"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="45"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="46"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="47"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="48"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Especialistas</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="49"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="50"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="51"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="52"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="53"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" value="54"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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