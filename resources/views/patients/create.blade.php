<div id="newPatientModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="newPatientForm" accept-charset="UTF-8">
                @csrf
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Registrar Paciente</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="surnames">(*) Apellidos</label>
                                <input 
                                    type="text" 
                                    name="surnames" 
                                    class="form-control"
                                    maxlength="255"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="names">(*) Nombres</label>
                                <input 
                                    type="text" 
                                    name="names" 
                                    class="form-control"
                                    maxlength="255"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="birthdate">(*) Fecha de Nacimiento</label>
                                <input 
                                    type="date" 
                                    name="birthdate" 
                                    class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="gender">(*) Sexo</label>
                                <div class="mt-radio-inline text-center" style="margin-bottom: -12px;margin-top: -8px;">
                                    <label class="mt-radio">
                                        <input type="radio" name="gender" value="M" required> Masculino
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="gender" value="F"> Femenino
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="cellphone_num">№ Celular o Teléfono</label>
                                <input 
                                    type="text" 
                                    name="cellphone_num" 
                                    class="form-control"
                                    maxlength="20"
                                >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="address">Dirección</label>
                                <input 
                                    type="text" 
                                    name="address" 
                                    class="form-control" 
                                    maxlength="255"
                                >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="email">E-mail</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    class="form-control"
                                    maxlength="255" 
                                >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bold" for="marital_status">(*) Estado Civil</label>
                                <select name="marital_status" class="form-control" required>
                                    <option value="" disabled selected>Seleccione un Estado Civil</option>
                                    <option value="S">Soltero(a)</option>
                                    <option value="C">Casado(a)</option>
                                    <option value="V">Viudo(a)</option>
                                    <option value="D">Divorciado(a)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <label class="bold" for="document_type">(*) Tipo de Documento</label>
                                <select name="document_type" class="form-control" required>
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
                                <label class="bold" for="document_numb">(*) № de Documento</label>
                                <input 
                                    type="text" 
                                    name="document_numb" 
                                    class="form-control" 
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="vaccines">Vacunas Completas</label>
                                <div class="mt-radio-inline text-center" style="margin-bottom: -12px;margin-top: -8px;">
                                    <label class="mt-radio">
                                        <input type="radio" name="vaccines" value="1"> Sí
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="vaccines" value="0"> No
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="bold" for="allergies">Alergias</label>
                                <input 
                                    type="text" 
                                    name="allergies" 
                                    class="form-control"
                                    maxlength="255" 
                                >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="profession">Oficio</label>
                                <input 
                                    type="text" 
                                    name="profession" 
                                    class="form-control"
                                    maxlength="255" 
                                >
                            </div>
                            <div class="form-group">
                                <label class="bold" for="relative">Tutor</label>
                                <input 
                                    type="text" 
                                    name="relative" 
                                    class="form-control"
                                    maxlength="255" 
                                    placeholder="Apellidos y Nombres"
                                >
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