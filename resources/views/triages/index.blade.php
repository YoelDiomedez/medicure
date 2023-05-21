@extends('layouts.main')

@section('pagetitle', 'Triajes')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadTriageDT">@yield('pagetitle')</a>
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
                <table id="triageDataTable" class="table table-hover table-bordered">
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

@include('triages.edit')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Triajes - Read
        /**************************************************************************/
        var triageDataTable = $('#triageDataTable').DataTable({
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
                    title: 'Lista de Triajes'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Triajes'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [1, 3, 4, 5, 6, 7]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Triajes'
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

        $('#reloadTriageDT').click( function () {
            triageDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Actualizar Triaje - Update
        /*************************************************************************/
        $('#triageDataTable tbody').on('click', '#editTriageBtn', function (){

            var data = triageDataTable.row($(this).parents('tr')).data()
            // console.log(data);
            $('#updateTriageForm')[0].reset()
            $('#id').val(data.triage.id)
            $('#document').val(data.patient.document_type +': '+ data.patient.document_numb)
            $('#patient').val(data.patient.surnames +' '+ data.patient.names)
            $('#age').val(ageFormat(data.patient.birthdate))
            $('#service').val(data.service.concept)
            $('#employee').val(data.employee.patient.surnames +' '+ data.employee.patient.names)

            $('#updateTriageModal').modal('show')
        })

        $('#updateTriageForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateTriageForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'triages/' + currenId,
                data: formData,
                success: function(data) {

                    // console.log(data)

                    $('#updateTriageForm')[0].reset()
                    $('#updateTriageModal').modal('hide')

                    triageDataTable.ajax.reload()
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Triaje Actualizado')
                }
            })
        })

        $('#weight').change(calculateBMI)
        $('#height').change(calculateBMI)
    })

    /**************************************************************************/
    /* Funciones
    /**************************************************************************/

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
                type = 'Peso Bajo'
            }
            else if(bmi >= 18 && bmi < 25){
                type = 'Peso Normal'
            }
            else if(bmi >= 25 && bmi < 27){
                type = 'Sobrepeso'
            }
            else if(bmi >= 27 && bmi < 30){
                type = 'Obesidad Leve'
            }
            else if(bmi >= 30 && bmi < 40){
                type = 'Obesidad Media'
            }
            else {
                type = 'Obesidad Mórbida'
            }

            $('#bmi').val(bmi.toFixed(2));
            $('#type').val(type);
        }
    }
    </script>
@endpush