@extends('layouts.main')

@section('pagetitle', 'Especialistas')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadUserDT">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Lista</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-xs-12 col-xs-offset-4 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                        @can('users store')
                        <button id="newUserBtn" class="btn blue">
                            <i class="fa fa-plus"></i> Agregar
                        </button>  
                        @endcan
                    </div>    
                </div>               
            </div>
            <div class="portlet-body">
                <table id="userDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>F. Nacimiento</th>
                            <th>Sexo</th>
                            <th>Estado Civil</th>
                            <th>Doc. de Identidad</th>
                            <th>№ de Doc.</th>

                            <th>CMP</th>
                            <th>RNE</th>
                            <th>Especialidad</th>
                            <th>Cargo</th>
                            <th>E-mail</th>
                            <th>№ Celular/Teléfono</th>
                            <th>Dirección</th>

                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('users.create')
@include('users.edit')
@include('users.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Usuarios - Read
        /**************************************************************************/
        var userDataTable = $('#userDataTable').DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Cargando...</span> ',
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: "",
            columns: [
                {data: 'id',                     name: 'id'},
                {data: 'patient.surnames',       name: 'patient.surnames'},
                {data: 'patient.names',          name: 'patient.names'},
                {data: 'patient.birthdate',      name: 'patient.birthdate'},
                {data: 'patient.gender',         name: 'patient.gender'},
                {data: 'patient.marital_status', name: 'patient.marital_status'},
                {data: 'patient.document_type',  name: 'patient.document_type'},
                {data: 'patient.document_numb',  name: 'patient.document_numb'},

                {data: 'cmp',            name: 'cmp'},
                {data: 'rne',            name: 'rne'},
                {data: 'specialty',      name: 'specialty'},
                {data: 'position',       name: 'position'},               
                {data: 'email',          name: 'email'},

                {data: 'patient.cellphone_num',  name: 'patient.cellphone_num'},
                {data: 'patient.address',        name: 'patient.address'},

                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            columnDefs: [
                {
                    targets: [6, 8, 9, 10, 11, 12, 13, 14],
                    visible: false,
                    searchable: false
                }
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Usuarios'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Usuarios'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Usuarios'
                },
                {
                    extend: "colvis",
                    className: "btn purple",
                    text: '<i class="fa fa-th-list"></i>'
                }
            ],
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
        })
        
        $.fn.dataTable.ext.errMode = 'throw'

        $('#reloadUserDT').click( function () {
            userDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Usuario - Create
        /*************************************************************************/
        $('#newUserBtn').click( function () {
            $('#newUserForm')[0].reset()
            resetNewTabs()

            $('#newRole').empty()
            getRoles('#newRole')

            $('#newUserModal').modal('show')
        })
        
        $('#newUserForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newUserForm').serialize()

            $.post('', formData, function(data) {
                // console.log(data);

                
                $('#newUserModal').modal('hide')
                $('#newUserForm')[0].reset()
                resetNewTabs()

                userDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Usuario Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Usuario - Update
        /*************************************************************************/
        $('#userDataTable tbody').on('click', '#editUserBtn', function(){
            var data = userDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#updateUserForm')[0].reset()
            resetUpdateTabs() 

            $('#updateRole').empty()
            getRoles('#updateRole')
            selectRole('#updateRole', data.roles[0].id)

            $('#id').val(data.id)
            $('#cmp').val(data.cmp)
            $('#rne').val(data.rne)
            $('#specialty').val(data.specialty)
            $('#position').val(data.position)
            $('#email').val(data.email)

            $('#surnames').val(data.patient.surnames)
            $('#names').val(data.patient.names)
            $('#birthdate').val(data.patient.birthdate)
            $('#document_numb').val(data.patient.document_numb)
            $('#cellphone_num').val(data.patient.cellphone_num)
            $('#address').val(data.patient.address)

            var gender         = data.patient.gender
            var marital_status = data.patient.marital_status
            var document_type  = data.patient.document_type
            
            if(gender == 'M'){
                $('#male').prop('checked', true)
            }else if (gender == 'F'){
                $('#female').prop('checked', true)
            }

            if(marital_status == 'S'){
                document.getElementById("marital_status").selectedIndex = "1"
            }else if(marital_status == 'C') {
                document.getElementById("marital_status").selectedIndex = "2"
            }else if(marital_status == 'V') {
                document.getElementById("marital_status").selectedIndex = "3"
            }else if(marital_status == 'D') {
                document.getElementById("marital_status").selectedIndex = "4"
            }

            if(document_type == 'DNI'){
                document.getElementById("document_type").selectedIndex = "1"
            }else if(document_type == 'RUC') {
                document.getElementById("document_type").selectedIndex = "2"
            }else if(document_type == 'P. NAC.') {
                document.getElementById("document_type").selectedIndex = "3"
            }else if(document_type == 'CARNET EXT.') {
                document.getElementById("document_type").selectedIndex = "4"
            }else if(document_type == 'PASAPORTE') {
                document.getElementById("document_type").selectedIndex = "5"
            }else if(document_type == 'OTRO') {
                document.getElementById("document_type").selectedIndex = "6"
            }

            $('#updateUserModal').modal('show')
        })

        $('#updateUserForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateUserForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'users/' + currenId,
                data: formData,
                success: function(data) {
                    // console.log(data)
                    
                    $('#updateUserModal').modal('hide')
                    $('#updateUserForm')[0].reset()
                    resetUpdateTabs()

                    var rowId = $('#userDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    userDataTable.cell(rowId, 1).data(data.patient.surnames).draw(false)
                    userDataTable.cell(rowId, 2).data(data.patient.names).draw(false)
                    userDataTable.cell(rowId, 3).data(data.patient.birthdate).draw(false)
                    userDataTable.cell(rowId, 4).data(data.patient.gender).draw(false)
                    userDataTable.cell(rowId, 5).data(data.patient.marital_status).draw(false)
                    userDataTable.cell(rowId, 6).data(data.patient.document_type).draw(false)
                    userDataTable.cell(rowId, 7).data(data.patient.document_numb).draw(false)

                    userDataTable.cell(rowId, 8).data(data.cmp).draw(false)
                    userDataTable.cell(rowId, 9).data(data.rne).draw(false)
                    userDataTable.cell(rowId, 10).data(data.specialty).draw(false)
                    userDataTable.cell(rowId, 11).data(data.position).draw(false)
                    userDataTable.cell(rowId, 12).data(data.email).draw(false)
                    userDataTable.cell(rowId, 13).data(data.patient.cellphone_num).draw(false)
                    userDataTable.cell(rowId, 14).data(data.patient.address).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Usuario Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Usuario - Delete
        /**************************************************************************/
        $('#userDataTable tbody').on('click', '#deleteUserBtn', function(){
            var data = userDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#id').val(data.id)
            $('p').text(data.patient.document_type +': '+ data.patient.document_numb +' — '+ data.patient.surnames +' '+ data.patient.names)
            $('#deleteUserModal').modal('show')
        })

        $('#deleteUserForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteUserForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'DELETE',
                url: 'users/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteUserForm')[0].reset()
                    $('#deleteUserModal').modal('hide')

                    var rowId = $('#userDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    userDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Usuario Eliminado')
                }
            })
        })
    })

    /**************************************************************************/
    /* Funciones
    /**************************************************************************/

    function resetNewTabs() {

        $('#newNavTab1').addClass('active')
        $('#newNavTab2').removeClass('active')

        $('#new_tab_1_2').addClass('active in')
        $('#new_tab_2_2').removeClass('active')
    }

    function resetUpdateTabs() {

        $('#updateNavTab1').addClass('active')
        $('#updateNavTab2').removeClass('active')
        
        $('#update_tab_1_2').addClass('active in')
        $('#update_tab_2_2').removeClass('active')
    }

    function getRoles(obj){
        $('body').on('shown.bs.modal', '.modal', function() {
            // Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened
            $(this).find('select').each(function() {
                var dropdownParent = $(document.body);
                if ($(this).parents('.modal.in:first').length !== 0)
                dropdownParent = $(this).parents('.modal.in:first')
                // Set up the Select2 control
                $(obj).select2({
                    dropdownParent: dropdownParent,
                    language: 'es',
                    placeholder: 'Seleccione un Rol',
                    allowClear: true,

                    ajax: {
                        url: "{{ url('api/roles') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                term: params.term, 
                                page: params.page
                            };
                        },
                        processResults: function (data, params) {

                            params.page = params.page || 1;

                            return {
                                results:  $.map(data.data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    }
                                }),
                                pagination: {
                                    more: (params.page * data.per_page) < data.total
                                }
                            }
                        },
                        cache: true
                    }
                })
            })
        })
    }

    function selectRole(obj, roleId){
        // Fetch the preselected item, and add to the control
        var serviceSelect = $(obj)

        $.ajax({
            type: 'GET',
            url: "{{ url('api/roles') }}" + "/" +  roleId
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.name, data.id, true, true)
            serviceSelect.append(option).trigger('change')

            // manually trigger the `select2:select` event
            serviceSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            })
        })
    }
    </script>
@endpush