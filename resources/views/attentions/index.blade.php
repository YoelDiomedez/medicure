@extends('layouts.main')

@section('pagetitle', 'Atenciones')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadAttentionDT">@yield('pagetitle')</a>
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
                        @can('attentions store')
                        <button id="newAttentionBtn" class="btn blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>  
                        @endcan
                    </div>    
                </div>         
            </div>
            <div class="portlet-body">
                <table id="attentionDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Fecha y Hora</th>
                            <th>Admitido por</th>
                            <th>Servicio</th>
                            <th>Costo (S/)</th>
                            <th>Especialista</th>
                            <th>Paciente</th>
                            <th>Doc. de Identidad</th>
                            <th>Edad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('attentions.create')
@include('attentions.edit')
@include('attentions.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Atencións - Read
        /**************************************************************************/
        var attentionDataTable = $('#attentionDataTable').DataTable({
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
                {data: 'id',                        name: 'id'},
                {data: 'status',                    name: 'status', render: function (data, type, row){
                    return  statusBadgeFormat(row.status)
                }},
                {data: 'created_at',                 name: 'created_at'},
                {data: 'user.patient.surnames',     name: 'user.patient.surnames', render: function (data, type, row){
                    return row.user.patient.surnames +' '+ row.user.patient.names
                }},
                {data: 'service.concept',           name: 'service.concept'},
                {data: 'amount',                    name: 'amount'},
                {data: 'employee.patient.surnames', name: 'employee.patient.surnames', render: function (data, type, row){
                    return row.employee.patient.surnames +' '+ row.employee.patient.names
                }},
                {data: 'patient.surnames',          name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }},
                {data: 'patient.document_numb',     name: 'patient.document_numb', render: function (data, type, row){
                    return row.patient.document_type +': '+ row.patient.document_numb
                }},
                {data: 'patient.birthdate',         name: 'patient.birthdate', render: function(data, type, row){

                    return ageFormat(row.patient.birthdate)

                }},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            columnDefs: [
                {
                    targets: [1, 4, 5, 6, 9],
                    visible: true,
                    searchable: false
                },{
                    targets: [2, 3],
                    visible: false,
                    searchable: false
                }
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Atenciones'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Atenciones'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Atenciones'
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

        $('#reloadAttentionDT').click( function () {
            attentionDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Atención - Create
        /*************************************************************************/

        $('#newAttentionBtn').click( function () {
            $('#newAttentionForm')[0].reset()

            $('#newPatients').empty()
            $('#newServices').empty()
            $('#newEmployees').empty()

            getPatients('#newPatients')
            getServices('#newServices')
            getEmployees('#newEmployees')

            $('#newAttentionModal').modal('show')
        })
        
        $('#newAttentionForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newAttentionForm').serialize()

            $.post('', formData, function(data) {
                //  console.log(data)

                $('#newAttentionForm')[0].reset()
                $('#newAttentionModal').modal('hide')

                attentionDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Atención Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Atención - Update
        /*************************************************************************/
        $('#attentionDataTable tbody').on('click', '#editAttentionBtn', function(){
            var data = attentionDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#updatePatients').empty()
            $('#updateServices').empty()
            $('#updateEmployees').empty()

            getPatients('#updatePatients')
            getServices('#updateServices')
            getEmployees('#updateEmployees')

            $('#id').val(data.id)

            selectPatient('#updatePatients', data.patient_id)
            selectService('#updateServices', data.service_id)
            selectEmployee('#updateEmployees', data.employee_id)

            $('#amount').val(data.amount)

            $('#updateAttentionModal').modal('show')
        })

        $('#updateAttentionForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateAttentionForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'attentions/' + currenId,
                data: formData,
                success: function(data) {
                    // console.log(data)
                    $('#updateAttentionModal').modal('hide')
                    $('#updateAttentionForm')[0].reset()
                    $('#updatePatients').empty()
                    $('#updateServices').empty()
                    $('#updateEmployees').empty()
                    

                    var rowId = $('#attentionDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    attentionDataTable.cell(rowId, 1).data(statusBadgeFormat(data.status)).draw(false)
                    attentionDataTable.cell(rowId, 2).data(data.created_at).draw(false)
                    attentionDataTable.cell(rowId, 3).data(data.user.patient.surnames +' '+ data.user.patient.names).draw(false)
                    attentionDataTable.cell(rowId, 4).data(data.service.concept).draw(false)
                    attentionDataTable.cell(rowId, 5).data(data.amount).draw(false)
                    attentionDataTable.cell(rowId, 6).data(data.employee.patient.surnames +' '+ data.employee.patient.names).draw(false)
                    attentionDataTable.cell(rowId, 7).data(data.patient.surnames +' '+ data.patient.names).draw(false)
                    attentionDataTable.cell(rowId, 8).data(data.patient.document_type +': '+ data.patient.document_numb).draw(false)
                    attentionDataTable.cell(rowId, 9).data(ageFormat(data.patient.birthdate)).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Atención Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Atención - Delete
        /**************************************************************************/
        $('#attentionDataTable tbody').on('click', '#deleteAttentionBtn', function(){
            var data = attentionDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('p').text(data.patient.document_type+': '+data.patient.document_numb+' — '+data.patient.surnames+' '+data.patient.names)
            $('#deleteAttentionModal').modal('show')
        })

        $('#deleteAttentionForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteAttentionForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'DELETE',
                url: 'attentions/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteAttentionForm')[0].reset()
                    $('#deleteAttentionModal').modal('hide')

                    var rowId = $('#attentionDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    attentionDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Atención Eliminado')
                }
            })
        })
    })
    /**************************************************************************/
    /* Funciones
    /**************************************************************************/
    function statusBadgeFormat(state){

        switch(state) {
            case 'T':
                return '<span class="badge badge-primary">Triaje</span>'
                break;
            case 'A':
                return '<span class="badge badge-warning">Atención</span>'
                break;
            case 'D':
                return '<span class="badge badge-success">Atendido</span>'
                break;  
            default:
            return '<span class="badge badge-default">Otro</span>'
                break;
        }  
    }

    function ageFormat(birthdate) {
        var today = new Date();
        var date  = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
        var diff  = moment.duration(moment(date, 'YYYY-MM-DD').diff(moment(birthdate, 'YYYY-MM-DD')))
        var age   = moment.duration(diff.asWeeks(), 'weeks').format('y [años,] M [meses,] D [días]')

        return age
    }

    function getPatients(obj){
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
                    placeholder: 'Seleccione un Paciente',
                    allowClear: true,

                    ajax: {
                        url: "{{ url('api/patients') }}",
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
                                        text: item.document_type +': '+ item.document_numb +' — '+ item.surnames +' '+ item.names
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

    function selectPatient(obj, patientId){
        // Fetch the preselected item, and add to the control
        var patientSelect = $(obj)

        $.ajax({
            type: 'GET',
            url: "{{ url('api/patients') }}" + "/" +  patientId
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.document_type +': '+ data.document_numb +' — '+ data.surnames +' '+ data.names, data.id, true, true)
            patientSelect.append(option).trigger('change')

            // manually trigger the `select2:select` event
            patientSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            })
        })
    }

    function getServices(obj){
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
                    placeholder: 'Seleccione un Servicio',
                    allowClear: true,

                    ajax: {
                        url: "{{ url('api/services') }}",
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
                                        text: item.concept+' — S/ '+ item.amount
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

    function selectService(obj, serviceId){
        // Fetch the preselected item, and add to the control
        var serviceSelect = $(obj)

        $.ajax({
            type: 'GET',
            url: "{{ url('api/services') }}" + "/" +  serviceId
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.concept+' — S/ '+ data.amount, data.id, true, true)
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

    function getEmployees(obj){
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
                    placeholder: 'Seleccione un Especialista',
                    allowClear: true,

                    ajax: {
                        url: "{{ url('api/users') }}",
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
                                    if(item.patient != null){
                                        return {
                                            id: item.id,
                                            text: 
                                                item.patient.document_numb+' — '+ 
                                                item.patient.surnames+' '+ 
                                                item.patient.names+' — '+
                                                item.specialty
                                        }
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

    function selectEmployee(obj, employeeId){
        // Fetch the preselected item, and add to the control
        var employeeSelect = $(obj)

        $.ajax({
            type: 'GET',
            url: "{{ url('api/users') }}" + "/" +  employeeId
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.document_numb+' — '+ 
                                    data.surnames+' '+ 
                                    data.names+' — '+
                                    data.specialty, data.id, true, true)

            employeeSelect.append(option).trigger('change')

            // manually trigger the `select2:select` event
            employeeSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            })
        })
    }
    </script>
@endpush