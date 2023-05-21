<div id="updateRoleModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateRoleForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Acceso</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="idUpdate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bold">Rol</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
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
                                <li id="updateTab1" class="active">
                                    <a href="#updateAccessTab1" data-toggle="tab" aria-expanded="true"> Admisión </a>
                                </li>
                                <li id="updateTab2" class="">
                                    <a href="#updateAccessTab2" data-toggle="tab" aria-expanded="false"> Clínica </a>
                                </li>
                                <li id="updateTab3" class="">
                                    <a href="#updateAccessTab3" data-toggle="tab" aria-expanded="false"> Informe </a>
                                </li>
                                <li id="updateTab4" class="">
                                    <a href="#updateAccessTab4" data-toggle="tab" aria-expanded="false"> Mantenimiento </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="updateAccessTab1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Inicio</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="homeIndex" value="1"> Escritorio
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="homeTriages" value="2"> Listar Triajes <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="homeAttentions" value="3"> Listar Atenciones <em>API</em>
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
                                                        <input type="checkbox" name="permissions[]" id="historiesIndex" value="4"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="historiesPrescription" value="6"> Ver Receta <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="historiesRecord" value="5"> Ver Historia <em>API</em>
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
                                                        <input type="checkbox" name="permissions[]" id="attentionsIndex" value="7"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="attentionsStore" value="8"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="attentionsUpdate" value="9"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="attentionsDestroy" value="10"> Eliminar
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
                                                        <input type="checkbox" name="permissions[]" id="patientsIndex" value="11"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="patientsStore" value="12"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="patientsUpdate" value="13"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="patientsDestroy" value="14"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="patientsGet" value="15"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="patientsShow" value="16"> Ver <em>API</em>
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="updateAccessTab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Triajes</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="triagesIndex" value="17"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="triagesUpdate" value="18"> Editar
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
                                                        <input type="checkbox" name="permissions[]" id="recordsIndex" value="19"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="recordsUpdate" value="20"> Editar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                                <div class="tab-pane fade" id="updateAccessTab3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Quirúrgicos</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="surgeriesIndex" value="21"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="surgeriesStore" value="22"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="surgeriesShow" value="23"> Ver
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="surgeriesUpdate" value="24"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="surgeriesDestroy" value="25"> Eliminar
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
                                                        <input type="checkbox" name="permissions[]" id="labsIndex" value="26"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="labsStore" value="27"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="labsShow" value="28"> Ver
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="labsUpdate" value="29"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="labsDestroy" value="30"> Eliminar
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="updateAccessTab4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bold">Accesos</label>
                                                <div class="mt-checkbox-list">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesIndex" value="31"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesStore" value="32"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesUpdate" value="33"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesDestroy" value="34"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesGet" value="35"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="rolesShow" value="36"> Ver <em>API</em>
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
                                                        <input type="checkbox" name="permissions[]" id="servicesIndex" value="37"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="servicesStore" value="38"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="servicesUpdate" value="39"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="servicesDestroy" value="40"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="servicesGet" value="41"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="servicesShow" value="42"> Ver <em>API</em>
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
                                                        <input type="checkbox" name="permissions[]" id="diagnosesIndex" value="43"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="diagnosesStore" value="44"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="diagnosesUpdate" value="45"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="diagnosesDestroy" value="46"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="diagnosesGet" value="47"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="diagnosesShow" value="48"> Ver <em>API</em>
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
                                                        <input type="checkbox" name="permissions[]" id="usersIndex" value="49"> Listar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="usersStore" value="50"> Agregar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="usersUpdate" value="51"> Editar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="usersDestroy" value="52"> Eliminar
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="usersGet" value="53"> Listar <em>API</em>
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" name="permissions[]" id="usersShow" value="54"> Ver <em>API</em>
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
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>