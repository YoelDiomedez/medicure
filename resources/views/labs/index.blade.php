@extends('layouts.main')

@section('pagetitle', 'Laboratoriales')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadLabDT">@yield('pagetitle')</a>
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
                        @can('labs store')
                        <button id="newLabBtn" class="btn blue">
                            <i class="fa fa-plus"></i> Agregar
                        </button>   
                        @endcan
                    </div>    
                </div> 
            </div>
            <div class="portlet-body">
                <table id="labDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha y Hora</th>
                            <th>Paciente</th>
                            <th>Especialista</th>
                            <th>Servicio</th>
                            <th>Costo (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('labs.create')
@include('labs.edit')
@include('labs.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Informes Laboratoriales- Read
        /**************************************************************************/
        var labDataTable = $('#labDataTable').DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Cargando...</span>',
            },
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            order: [[ 0, "desc" ]],
            ajax: "",
            columns: [
                {data: 'id',               name: 'id', width: "5%"},
                {data: 'updated_at',       name: 'updated_at'},

                {data: 'patient.surnames', name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }},

                {data: 'user.patient.surnames', name: 'user.patient.surnames', render: function (data, type, row){
                    return row.user.patient.surnames +' '+ row.user.patient.names
                }},

                {data: 'service.concept', name: 'service.concept'},
                {data: 'amount', name: 'amount'},

                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Informes Laboratoriales'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Informes Laboratoriales'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Informes Laboratoriales'
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

        $('#reloadLabDT').click( function () {
            labDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Informe Laboratorial - Create
        /*************************************************************************/

        $('#newLabBtn').click( function () {
            $('#newLabForm')[0].reset()

            $('#newPatients').empty()
            $('#newServices').empty()

            getPatients('#newPatients')
            getServices('#newServices')

            $('#newLabModal').modal('show')
        })
        
        $('#newLabForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newLabForm').serialize()

            $.post('', formData, function(data) {
                
                //  console.log(data)

                $('#newLabModal').modal('hide')
                $('#newLabForm')[0].reset()
                $('#newPatients').empty()
                $('#newServices').empty()

                labDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Informe Laboratorial Registrado')
            })
        })

        /*************************************************************************/
        /* Actualizar Informe Laboratorial - Update
        /*************************************************************************/
        $('#labDataTable tbody').on('click', '#editLabBtn', function (){

            var data = labDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#updateLabForm')[0].reset()

            $('#idUpdate').val(data.id)
            $('#amount').val(data.amount)
            $('#report').val(data.report)
            
            $('#updatePatients').empty()
            $('#updateServices').empty()

            getPatients('#updatePatients')
            getServices('#updateServices')

            selectPatient('#updatePatients', data.patient_id)
            selectService('#updateServices', data.service_id)

            $('#updateLabModal').modal('show')
        })

        $('#updateLabForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateLabForm').serialize()
            var currenId = $('#idUpdate').val()

            $.ajax({
                type: 'PUT',
                url: 'labs/' + currenId,
                data: formData,
                success: function(data) {

                    // console.log(data)

                    $('#updateLabModal').modal('hide')
                    $('#updateLabForm')[0].reset()
                    $('#updatePatients').empty()
                    $('#updateServices').empty()
                    
                    var rowId = $('#labDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    labDataTable.cell(rowId, 1).data(data.updated_at).draw(false)
                    labDataTable.cell(rowId, 2).data(data.patient.surnames).draw(false)
                    labDataTable.cell(rowId, 3).data(data.user.patient.surnames).draw(false)
                    labDataTable.cell(rowId, 4).data(data.service.concept).draw(false)
                    labDataTable.cell(rowId, 5).data(data.amount).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Informe Laboratorial Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Informe Laboratorial - Delete
        /**************************************************************************/
        $('#labDataTable tbody').on('click', '#deleteLabBtn', function(){
            var data = labDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#idDelete').val(data.id)
            $('p').text(data.patient.document_type+': '+data.patient.document_numb+' — '+data.patient.surnames+' '+data.patient.names)
            $('#deleteLabModal').modal('show')
        })

        $('#deleteLabForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteLabForm').serialize()
            var currenId = $('#idDelete').val()

            $.ajax({
                type: 'DELETE',
                url: 'labs/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteLabForm')[0].reset()
                    $('#deleteLabModal').modal('hide')

                    var rowId = $('#labDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    labDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Informe Laboratorial Eliminado')
                }
            })
        })
    })

    /**************************************************************************/
    /* Funciones
    /**************************************************************************/
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
    </script>
@endpush