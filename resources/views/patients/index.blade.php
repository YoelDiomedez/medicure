@extends('layouts.main')

@section('pagetitle', 'Pacientes')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadPatientDT">@yield('pagetitle')</a>
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
                        @can('patients store')
                        <button id="newPatientBtn" class="btn blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>                              
                        @endcan
                    </div>    
                </div>               
            </div>
            <div class="portlet-body">
                <table id="patientDataTable" class="table table-hover table-bordered">
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

                            <th>Alergias</th>
                            <th>Vacunas</th>
                            <th>№ Celular/Teléfono</th>
                            <th>Dirección</th>
                            <th>E-mail</th>
                            <th>Oficio</th>
                            <th>Tutor</th>

                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('patients.create')
@include('patients.edit')
@include('patients.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Pacientes - Read
        /**************************************************************************/
        var patientDataTable = $('#patientDataTable').DataTable({
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
                {data: 'id',             name: 'id'},
                {data: 'surnames',       name: 'surnames'},
                {data: 'names',          name: 'names'},
                {data: 'birthdate',      name: 'birthdate'},
                {data: 'gender',         name: 'gender'},
                {data: 'marital_status', name: 'marital_status'},
                {data: 'document_type',  name: 'document_type'},
                {data: 'document_numb',  name: 'document_numb'},

                {data: 'allergies',      name: 'allergies'},
                {data: 'vaccines',       name: 'vaccines'},
                {data: 'cellphone_num',  name: 'cellphone_num'},
                {data: 'address',        name: 'address'},
                {data: 'email',          name: 'email'},
                {data: 'profession',     name: 'profession'},
                {data: 'relative',       name: 'relative'},

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
                    title: 'Lista de Pacientes'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Pacientes'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4, 5, 6, 7]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Pacientes'
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

        $('#reloadPatientDT').click( function () {
            patientDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Paciente - Create
        /*************************************************************************/
        $('#newPatientBtn').click( function () {
            $('#newPatientForm')[0].reset()
            $('#newPatientModal').modal('show')
        })
        
        $('#newPatientForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newPatientForm').serialize()

            $.post('', formData, function(data) {
                // console.log(data);

                $('#newPatientForm')[0].reset()
                $('#newPatientModal').modal('hide')

                patientDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Paciente Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Paciente - Update
        /*************************************************************************/
        $('#patientDataTable tbody').on('click', '#editPatientBtn', function(){
            var data = patientDataTable.row($(this).parents('tr')).data()
            //console.log(data);            
            $('#id').val(data.id)
            $('#surnames').val(data.surnames)
            $('#names').val(data.names)
            $('#birthdate').val(data.birthdate)
            $('#document_numb').val(data.document_numb)

            $('#allergies').val(data.allergies)
            // $('#vaccines').val(data.vaccines)
            $('#cellphone_num').val(data.cellphone_num)
            $('#address').val(data.address)
            $('#email').val(data.email)
            $('#profession').val(data.profession)
            $('#relative').val(data.relative)

            var gender         = data.gender
            var vaccines       = data.vaccines
            var marital_status = data.marital_status
            var document_type  = data.document_type

            if(gender == 'M'){
                $('#male').prop('checked', true)
            }else if (gender == 'F'){
                $('#female').prop('checked', true)
            }
            
            if(vaccines == '1'){
                $('#yes').prop('checked', true)
            }else if (vaccines == '0'){
                $('#no').prop('checked', true)
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
            
            $('#updatePatientModal').modal('show')
        })

        $('#updatePatientForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updatePatientForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'patients/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data)
                    $('#updatePatientForm')[0].reset()
                    $('#updatePatientModal').modal('hide')

                    var rowId = $('#patientDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    patientDataTable.cell(rowId, 1).data(data.surnames).draw(false)
                    patientDataTable.cell(rowId, 2).data(data.names).draw(false)
                    patientDataTable.cell(rowId, 3).data(data.birthdate).draw(false)
                    patientDataTable.cell(rowId, 4).data(data.gender).draw(false)
                    patientDataTable.cell(rowId, 5).data(data.marital_status).draw(false)
                    patientDataTable.cell(rowId, 6).data(data.document_type).draw(false)
                    patientDataTable.cell(rowId, 7).data(data.document_numb).draw(false)

                    patientDataTable.cell(rowId, 8).data(data.allergies).draw(false)
                    patientDataTable.cell(rowId, 9).data(data.vaccines).draw(false)
                    patientDataTable.cell(rowId, 10).data(data.cellphone_num).draw(false)
                    patientDataTable.cell(rowId, 11).data(data.address).draw(false)
                    patientDataTable.cell(rowId, 12).data(data.email).draw(false)
                    patientDataTable.cell(rowId, 13).data(data.profession).draw(false)
                    patientDataTable.cell(rowId, 14).data(data.relative).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Paciente Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Paciente - Delete
        /**************************************************************************/
        $('#patientDataTable tbody').on('click', '#deletePatientBtn', function(){
            var data = patientDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('p').text(data.document_type +': '+ data.document_numb +' — '+ data.surnames +' '+ data.names)
            $('#deletePatientModal').modal('show')
        })

        $('#deletePatientForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deletePatientForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'DELETE',
                url: 'patients/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deletePatientForm')[0].reset()
                    $('#deletePatientModal').modal('hide')

                    var rowId = $('#patientDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    patientDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Paciente Eliminado')
                }
            })
        })

    })
    </script>
@endpush