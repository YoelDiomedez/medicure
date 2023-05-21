<div id="updateUserModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="updateUserForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Especialista</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="tabbable-custom nav-justified">
                        <ul class="nav nav-tabs nav-justified">
                            <li id="updateNavTab1" class="active">
                                <a href="#update_tab_1_2" data-toggle="tab"> Datos </a>
                            </li>
                            <li id="updateNavTab2">
                                <a href="#update_tab_2_2" data-toggle="tab"> Acceso </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="update_tab_1_2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="surnames">Apellidos</label>
                                            <input 
                                                type="text" 
                                                name="surnames" 
                                                id="surnames" 
                                                class="form-control"
                                                maxlength="255" 
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="names">Nombres</label>
                                            <input 
                                                type="text" 
                                                name="names" 
                                                id="names" 
                                                class="form-control"
                                                maxlength="255" 
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="birthdate">Fecha de Nacimiento</label>
                                            <input 
                                                type="date" 
                                                name="birthdate" 
                                                id="birthdate" 
                                                class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="gender">Sexo</label>
                                            <div class="mt-radio-inline text-center" style="margin-bottom: -12px;margin-top: -8px;">
                                                <label class="mt-radio">
                                                    <input id="male" type="radio" name="gender" value="M" required> Masculino
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input id="female" type="radio" name="gender" value="F"> Femenino
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="marital_status">Estado Civil</label>
                                            <select name="marital_status" id="marital_status" class="form-control" required>
                                                <option value="" disabled selected>Seleccione un Estado Civil</option>
                                                <option value="S">Soltero(a)</option>
                                                <option value="C">Casado(a)</option>
                                                <option value="V">Viudo(a)</option>
                                                <option value="D">Divorciado(a)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label class="bold" for="document_type">Tipo de Documento</label>
                                            <select name="document_type" id="document_type" class="form-control" required>
                                                <option value="" disabled selected>Seleccione un Tipo de Documento</option>
                                                <option value="DNI">Documento Nacional de Identidad</option>
                                                <option value="RUC">Reg. Único de Contribuyentes</option>
                                                <option value="P. NAC.">Partida de Nacimiento</option>
                                                <option value="CARNET EXT.">Carnet de Extranjería </option>
                                                <option value="PASAPORTE">Pasaporte</option>
                                                <option value="OTRO">Otro</option>
                                            </select>
                                        </div>  
                                        <div class="form-group">
                                            <label class="bold" for="document_numb">№ de Documento</label>
                                            <input 
                                                type="text" 
                                                name="document_numb" 
                                                id="document_numb" 
                                                class="form-control" 
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="cellphone_num">№ Celular o Teléfono</label>
                                            <input 
                                                type="text" 
                                                name="cellphone_num" 
                                                id="cellphone_num" 
                                                class="form-control"
                                                maxlength="20"
                                                required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bold" for="address">Dirección</label>
                                            <input 
                                                type="text" 
                                                name="address" 
                                                id="address" 
                                                class="form-control"
                                                maxlength="255" 
                                                required
                                            >
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="tab-pane fade" id="update_tab_2_2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="email">E-mail</label>
                                            <input 
                                                type="email" 
                                                name="email" 
                                                id="email" 
                                                class="form-control"
                                                maxlength="255"
                                                required 
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="cmp">CMP</label>
                                            <input 
                                                type="number" 
                                                name="cmp" 
                                                id="cmp" 
                                                class="form-control"
                                                step="1"
                                                min="0"
                                                max="999999"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="position">Cargo</label>
                                            <input 
                                                type="text" 
                                                name="position" 
                                                id="position" 
                                                class="form-control"
                                                maxlength="255"
                                                required 
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bold" for="password">Contraseña</label>
                                            <input 
                                                type="password" 
                                                name="password" 
                                                id="password"
                                                class="form-control"
                                                maxlength="255"
                                                >
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="rne">RNE</label>
                                            <input 
                                                type="number" 
                                                name="rne" 
                                                id="rne" 
                                                class="form-control"
                                                step="1"
                                                min="0"
                                                max="999999"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label class="bold" for="specialty">Especialidad</label>
                                            <input 
                                                type="text" 
                                                name="specialty" 
                                                id="specialty" 
                                                class="form-control"
                                                maxlength="255" 
                                                required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bold">Rol</label>
                                            <select 
                                                id="updateRole" 
                                                name="role" 
                                                class="form-control" 
                                                style="width: auto;"
                                                required>
                                            </select>
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