@extends('layouts.main')

@section('pagetitle', 'Quirúrgicos')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadSurgeryDT">@yield('pagetitle')</a>
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
                        @can('surgeries store')
                        <button id="newSurgeryBtn" class="btn blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>    
                        @endcan
                    </div>    
                </div> 
            </div>
            <div class="portlet-body">
                <table id="surgeryDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Paciente</th>
                            <th>Inicio</th>
                            <th>Termino</th>
                            <th>Costo (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('surgeries.edit')
@include('surgeries.create')
@include('surgeries.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Informes Quirúrgicos
        /**************************************************************************/
        var surgeryDataTable = $('#surgeryDataTable').DataTable({
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
                {data: 'id',   name: 'id', width: "5%"},
                {data: 'date', name: 'date'},

                {data: 'patient.surnames', name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }},

                {data: 'start_time', name: 'start_time'},
                {data: 'end_time',   name: 'end_time'},
                {data: 'amount',     name: 'amount'},

                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Informes Quirúrgicos'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Informes Quirúrgicos'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [0, 1, 2, 3, 4, 5]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Informes Quirúrgicos'
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

        $('#reloadSurgeryDT').click( function () {
            surgeryDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Informe Quirúrgico - Create
        /*************************************************************************/

        $('#newSurgeryBtn').click( function () {

            $('#newSurgeryForm')[0].reset()

            $('#newPatients').empty()
            $('#newEmployees').empty()
            $('#newPreDiagnoses').empty()
            $('#newPostDiagnoses').empty()

            getPatients('#newPatients')
            getEmployees('#newEmployees')
            getDiagnoses('#newPreDiagnoses')
            getDiagnoses('#newPostDiagnoses')

            $('#newSurgeryModal').modal('show')
        })
        
        $('#newSurgeryForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newSurgeryForm').serialize()

            $.post('', formData, function(data) {
                //  console.log(data)

                $('#newSurgeryModal').modal('hide')
                $('#newSurgeryForm')[0].reset()
                $('#newPatients').empty()
                $('#newEmployees').empty()
                $('#newPreDiagnoses').empty()
                $('#newPostDiagnoses').empty()

                surgeryDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Informe Quirúrgico Registrado')
            })
        })

        /*************************************************************************/
        /* Actualizar Informe Quirúrgico - Update
        /*************************************************************************/
        $('#surgeryDataTable tbody').on('click', '#editSurgeryBtn', function (){

            var data = surgeryDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#updateSurgeryForm')[0].reset()

            $('#idUpdate').val(data.id)
            $('#date').val(data.date)
            $('#start_time').val(data.start_time)
            $('#end_time').val(data.end_time)
            $('#bed_num').val(data.bed_num)
            $('#anesthesia_type').val(data.anesthesia_type)
            $('#procedure_findings').val(data.procedure_findings)
            $('#oxygen_use').val(data.oxygen_use)
            $('#equipment').val(data.equipment)
            $('#supplies').val(data.supplies)
            $('#observations').val(data.observations)
            $('#amount').val(data.amount)
            
            var employees = data.users

            $('#updatePatients').empty()
            $('#updateEmployees').empty()
            $('#updatePreDiagnoses').empty()
            $('#updatePostDiagnoses').empty()

            getPatients('#updatePatients')
            getEmployees('#updateEmployees')
            getDiagnoses('#updatePreDiagnoses')
            getDiagnoses('#updatePostDiagnoses')

            selectPatient('#updatePatients', data.patient_id)
            selectEmployees('#updateEmployees', employees)
            selectDiagnosis('#updatePreDiagnoses', data.pre_diagnosis_id)
            selectDiagnosis('#updatePostDiagnoses', data.post_diagnosis_id)

            $('#updateSurgeryModal').modal('show')
        })

        $('#updateSurgeryForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateSurgeryForm').serialize()
            var currenId = $('#idUpdate').val()

            $.ajax({
                type: 'PUT',
                url: 'surgeries/' + currenId,
                data: formData,
                success: function(data) {

                    // console.log(data)

                    $('#updateSurgeryModal').modal('hide')
                    $('#updateSurgeryForm')[0].reset()
                    $('#updatePatients').empty()
                    $('#updateEmployees').empty()
                    $('#updatePreDiagnoses').empty()
                    $('#updatePostDiagnoses').empty()
                    

                    var rowId = $('#surgeryDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)

                    surgeryDataTable.cell(rowId, 1).data(data.date).draw(false)
                    surgeryDataTable.cell(rowId, 2).data(data.patient.surnames).draw(false)
                    surgeryDataTable.cell(rowId, 3).data(data.start_time).draw(false)
                    surgeryDataTable.cell(rowId, 4).data(data.end_time).draw(false)
                    surgeryDataTable.cell(rowId, 5).data(data.amount).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Informe Quirúrgico Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Informe Quirúrgico - Delete
        /**************************************************************************/
        $('#surgeryDataTable tbody').on('click', '#deleteSurgeryBtn', function(){
            var data = surgeryDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#idDelete').val(data.id)
            $('p').text(data.patient.document_type+': '+data.patient.document_numb+' — '+data.patient.surnames+' '+data.patient.names)
            $('#deleteSurgeryModal').modal('show')
        })

        $('#deleteSurgeryForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteSurgeryForm').serialize()
            var currenId = $('#idDelete').val()

            $.ajax({
                type: 'DELETE',
                url: 'surgeries/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteSurgeryForm')[0].reset()
                    $('#deleteSurgeryModal').modal('hide')

                    var rowId = $('#surgeryDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    surgeryDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Informe Quirúrgico Eliminado')
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

    function getDiagnoses(obj){

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
                    placeholder: 'Seleccione un Diagnóstico',
                    allowClear: true,
                    ajax: {
                        url: "{{ url('api/diagnoses') }}",
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
                                        text: item.code +' — '+ item.disease
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

    function selectDiagnosis(obj, diagnosisId){
        // Fetch the preselected item, and add to the control
        var diagnosisSelect = $(obj)

        $.ajax({
            type: 'GET',
            url: "{{ url('api/diagnoses') }}" + "/" +  diagnosisId
        }).then(function (data) {
            // create the option and append to Select2
            var option = new Option(data.code+' — '+data.disease, data.id, true, true)
            diagnosisSelect.append(option).trigger('change')

            // manually trigger the `select2:select` event
            diagnosisSelect.trigger({
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
                    placeholder: 'Seleccione de 1 a 9',
                    allowClear: true,
                    multiple: true,
                    maximumSelectionLength: 9,
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
                                                item.patient.document_numb+' - '+ 
                                                item.patient.surnames+' '+ 
                                                item.patient.names+' - '+
                                                item.specialty+' - '+
                                                item.position
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

    function selectEmployees(obj, employees){

        var employeesSelect = $(obj)

        for(var i = 0; i < employees.length; i++) {

            var option = new Option(
                                    employees[i].patient.document_numb +' - '+ 
                                    employees[i].patient.surnames +' '+ 
                                    employees[i].patient.names +' - '+ 
                                    employees[i].specialty +' - '+
                                    employees[i].position,
                                    employees[i].user_id, true, true)

            employeesSelect.append(option).trigger('change')
        }

        employeesSelect.trigger({
            type: 'select2:select',
            params: {
                data: employees
            }
        })
    }

    </script>
@endpush