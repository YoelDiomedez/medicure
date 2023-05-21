@extends('layouts.main')

@section('pagetitle', 'Historias')
@section('pagesubtitle', 'Clínicas')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadRecordDT">@yield('pagetitle')</a>
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
            <div class="portlet-title"></div>
            <div class="portlet-body">
                <table id="recordDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>№ Atención</th>
                            <th>#</th>
                            <th>Admitido por</th>
                            <th>Fecha y Hora</th>
                            <th>Paciente</th>
                            <th>Servicio</th>
                            <th>Costo (S/)</th>
                            <th>Especialista</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('records.edit')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Historias - Read
        /**************************************************************************/
        var recordDataTable = $('#recordDataTable').DataTable({
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
            ordering: false,
            ajax: "",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'DT_RowIndex',      name: 'DT_RowIndex', width: "5%"},
                {data: 'user.patient.surnames', name: 'user.patient.surnames', render: function (data, type, row){
                    return row.user.patient.surnames +' '+ row.user.patient.names
                }},
                {data: 'created_at', name: 'created_at'},
                {data: 'patient.surnames', name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }},
                {data: 'service.concept', name: 'service.concept'},
                {data: 'amount', name: 'amount'},
                {data: 'employee.patient.surnames', name: 'employee.patient.surnames', render: function (data, type, row){
                    return row.employee.patient.surnames +' '+ row.employee.patient.names
                }},
                {data: 'buttons', orderable: false, width: "10%", className: "text-center btn-actions"},
            ],
            columnDefs: [
                {
                    targets: [0, 2],
                    visible: false,
                },
                {
                    targets: 1,
                    searchable: false
                }
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Historias'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Historias'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Historias'
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

        $('#reloadRecordDT').click( function () {
            recordDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Actualizar Historia - Update
        /*************************************************************************/
        $('#recordDataTable tbody').on('click', '#editRecordBtn', function (){

            var data = recordDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#updateRecordForm')[0].reset()
            $('#diagnoses').empty()
            resetDR()

            $('#id').val(data.record.id)
            $('#document').val(data.patient.document_type +': '+ data.patient.document_numb)
            $('#patient').val(data.patient.surnames +' '+ data.patient.names)
            $('#age').val(ageFormat(data.patient.birthdate))
            $('#service').val(data.service.concept)
            $('#employee').val(data.employee.patient.surnames +' '+ data.employee.patient.names)
            $('#weight').val(data.triage.weight)
            $('#height').val(data.triage.height)
            $('#temperature').val(data.triage.temperature)
            $('#heart_rate').val(data.triage.heart_rate)
            $('#respiratory_rate').val(data.triage.respiratory_rate)
            $('#oxygen_saturation').val(data.triage.oxygen_saturation)
            $('#blood_pressure').val(data.triage.blood_pressure)

            calculateBMI()
            getDiagnoses('#diagnoses')

            $('#updateRecordModal').modal('show')
        })

        $('#updateRecordForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateRecordForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'records/' + currenId,
                data: formData,
                success: function(data) {

                    // console.log(data)

                    $('#updateRecordModal').modal('hide')
                    $('#updateRecordForm')[0].reset()
                    $('#diagnoses').empty()
                    resetDR()

                    recordDataTable.ajax.reload()
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Historia Actualizada')

                    urlr = "{{ url('records') }}" + "/" + data.attention_id
                    urlp = "{{ url('prescriptions') }}" + "/" + data.attention_id

                    window.open(urlr, '_blank')
                    window.open(urlp, '_blank')
                }
            })
        })

        $('#diagnoses').on('select2:select', function(e) {

            var data = e.params.data

            // console.log(data)

            var id = data.id
            var text = data.text

            addDiagnoses(id, text)
        })

        $('#updateRecordsBtn').hide()
    })

    /**************************************************************************/
    /* Funciones
    /**************************************************************************/
    var indexD = 0
    var indexP = 1
    var diagnoses = 0

    function ageFormat(birthdate) {
        var today = new Date();
        var date  = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
        var diff  = moment.duration(moment(date, 'YYYY-MM-DD').diff(moment(birthdate, 'YYYY-MM-DD')))
        var age   = moment.duration(diff.asWeeks(), 'weeks').format('y [años,] M [meses,] D [días]')

        return age
    }

    function calculateBMI(){

        var weight = $('#weight').val()
        var height = $('#height').val()

        if (weight != "" && height != ""){

            height    = height / 100
            var bmi   = weight / ( height * height)
            var type = ""

            if (bmi < 18){
                type = '(Peso Bajo)'
            }
            else if(bmi >= 18 && bmi < 25){
                type = '(Peso Normal)'
            }
            else if(bmi >= 25 && bmi < 27){
                type = '(Sobrepeso)'
            }
            else if(bmi >= 27 && bmi < 30){
                type = '(Obesidad Leve)'
            }
            else if(bmi >= 30 && bmi < 40){
                type = '(Obesidad Media)'
            }
            else {
                type = '(Obesidad Mórbida)'
            }

            $('#bmi').val(bmi.toFixed(2) +' '+ type)
        }
    }

    function getDiagnoses(obj){

        $(obj).select2({
            language: 'es',
            placeholder: 'Busque y Seleccione un Diagnóstico para Agregar',
            allowClear: true,
            dropdownParent: $("#updateRecordModal"),
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
    }

    function addDiagnoses(id, disease){

        if (id != ""){

            var row = '<tr id="rowD'+indexD+'" class="row-diagnoses">'+

            '<td><button type="button" class="btn btn-danger btn-icon-only" onclick="removeDiagnoses('+indexD+')"><i class="fa fa-trash"></i></button></td>'+
            '<td><select name="types[]" class="form-control input-xsmall"><option value="P">P</option><option value="D">D</option><option value="R">R</option></select></td>'+
            '<td><input type="hidden" name="diagnoses[]" value="'+id+'">'+disease+'</td>'+    	
            '</tr>'

            indexD++

            diagnoses = diagnoses + 1

            $('#diagnosesTable').append(row)

        } else {
            alert("Error al aplicar el diagnóstico, revise los datos.")
        }

        showSubmitBtn()
    }

    function removeDiagnoses(index){

        $('#rowD'+ index).remove()
        diagnoses = diagnoses - 1
        showSubmitBtn()
    }

    function addPrescription(){

    	var row = '<tr id="rowP'+indexP+'" class="row-prescription">'+

    	'<td><button type="button" class="btn btn-danger btn-icon-only" onclick="removePrescription('+indexP+')"><i class="fa fa-trash"></i></button></td>'+
    	'<td><input type="text" maxlength="255" class="form-control input-small" name="drugs[]" required></td>'+
    	'<td><input type="number" min="0" step="0.01" max="99999999.99" class="form-control input-xsmall" name="amounts[]" placeholder="#,##" required></td>'+
    	'<td><input type="text" maxlength="255" class="form-control input-small" name="shapes[]" required></td>'+
    	'<td><input type="number" min="0" step="0.01" max="99999999.99" class="form-control input-xsmall" name="doses[]" placeholder="#,##"></td>'+    	
    	'<td><input type="text" maxlength="255" class="form-control input-small" name="routes[]" required></td>'+    	
    	'<td><input type="text" maxlength="255" class="form-control input-small" name="frequencies[]" required></td>'+    	
    	'<td><input type="text" maxlength="255" class="form-control input-small" name="terms[]" required></td>'+  
        '<td><input type="text" maxlength="255" class="form-control input-small" name="notes[]"></td>'+  	
    	'</tr>'

    	indexP++

    	$('#prescriptionTable').append(row)
    }

    function removePrescription(index){

        $('#rowP' + index).remove()
    }

    function showSubmitBtn(){

        if (diagnoses > 0) { 

            $('#updateRecordsBtn').show()

        } else {

            $('#updateRecordsBtn').hide()

            indexD = 0
        }
    }

    function resetDR(){

        $('#navTab1').addClass('active')
        $('#navTab2').removeClass('active')
        $('#navTab3').removeClass('active')

        $('#tab_1_3').addClass('active in')
        $('#tab_2_3').removeClass('active')
        $('#tab_3_3').removeClass('active')

        $('.row-diagnoses').remove();
        $('.row-prescription').remove();

        indexD = 0
        indexP = 1
        diagnoses = 0

        $('#updateRecordsBtn').hide()

        //Agregamos la receta inicial
        var row = '<tr id="rowP0" class="row-prescription">'+
            '<td><button type="button" class="btn btn-danger btn-icon-only" onclick="removePrescription('+indexP+')"><i class="fa fa-trash"></i></button></td>'+
            '<td><input type="text" maxlength="255" class="form-control input-small" name="drugs[]" required autofocus></td>'+
            '<td><input type="number" min="0" step="0.01" max="99999999.99" class="form-control input-xsmall" name="amounts[]" placeholder="#,##" required></td>'+
            '<td><input type="text" maxlength="255" class="form-control input-small" name="shapes[]" required></td>'+
            '<td><input type="number" min="0" step="0.01" max="99999999.99" class="form-control input-xsmall" name="doses[]" placeholder="#,##"></td>'+    	
            '<td><input type="text" maxlength="255" class="form-control input-small" name="routes[]" required></td>'+    	
            '<td><input type="text" maxlength="255" class="form-control input-small" name="frequencies[]" required></td>'+    	
            '<td><input type="text" maxlength="255" class="form-control input-small" name="terms[]" required></td>'+
            '<td><input type="text" maxlength="255" class="form-control input-small" name="notes[]"></td>'+
            '</tr>' 

        $('#prescriptionTable').append(row)
    }

    </script>
@endpush