@extends('layouts.main')

@section('pagetitle', 'Diagnósticos')
@section('pagesubtitle', 'CIE-10')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadDiagnosesDT">@yield('pagetitle')</a>
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
                        @can('diagnoses store')
                        <button id="newDiagnosisBtn" class="btn blue">
                            <i class="fa fa-plus"></i> Agregar
                        </button> 
                        @endcan
                    </div>    
                </div>        
            </div>
            <div class="portlet-body">
                <table id="diagnosisDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código</th>
                            <th>Enfermedad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('diagnoses.create')
@include('diagnoses.edit')
@include('diagnoses.delete')
@include('diagnoses.restore')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Diagnósticos - Read
        /**************************************************************************/
        var diagnosisDataTable = $('#diagnosisDataTable').DataTable({
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
                {data: 'id',      name: 'id'},
                {data: 'code',    name: 'code'},
                {data: 'disease', name: 'disease'},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Enfermedades CIE-10-ES'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Enfermedades CIE-10-ES'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Enfermedades CIE-10-ES'
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

        $('#reloadDiagnosesDT').click( function () {
            diagnosisDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Diagnóstico - Create
        /*************************************************************************/
        $('#newDiagnosisBtn').click( function () {
            $('#newDiagnosisForm')[0].reset()
            $('#newDiagnosisModal').modal('show')
        })
        
        $('#newDiagnosisForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newDiagnosisForm').serialize()

            $.post('', formData, function(data) {
                // console.log(data);

                $('#newDiagnosisForm')[0].reset()
                $('#newDiagnosisModal').modal('hide')

                diagnosisDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Diagnóstico Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Diagnóstico - Update
        /*************************************************************************/
        $('#diagnosisDataTable tbody').on('click', '#editDiagnosisBtn', function(){
            var data = diagnosisDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('#code').val(data.code)
            $('#disease').val(data.disease)

            $('#updateDiagnosisModal').modal('show')
        })

        $('#updateDiagnosisForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateDiagnosisForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'diagnoses/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data)
                    $('#updateDiagnosisForm')[0].reset()
                    $('#updateDiagnosisModal').modal('hide')

                    var rowId = $('#diagnosisDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    diagnosisDataTable.cell(rowId, 1).data(data.code).draw(false)
                    diagnosisDataTable.cell(rowId, 2).data(data.disease).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Diagnóstico Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Diagnóstico - Delete
        /**************************************************************************/
        $('#diagnosisDataTable tbody').on('click', '#deleteDiagnosisBtn', function(){
            var data = diagnosisDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('p').text(data.code + ' — ' + data.disease)
            $('#deleteDiagnosisModal').modal('show')
        })

        $('#deleteDiagnosisForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteDiagnosisForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'DELETE',
                url: 'diagnoses/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteDiagnosisForm')[0].reset()
                    $('#deleteDiagnosisModal').modal('hide')

                    var rowId = $('#diagnosisDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    diagnosisDataTable.row(rowId).remove().draw()
                                            
                    toastr.options = {                 
                        positionClass: 'toast-top-center',
                        timeOut: 0,
                        extendedTimeOut: 0,   
                        closeButton: true,
                        tapToDismiss: false,
                        onclick: function() { 
                            $('#idRestore').val(data.id)
                            $('p').text(data.code + ' — ' + data.disease)
                            $('#restoreDiagnosisModal').modal('show')
                        }
                    }

                    toastr.warning('Click, si desea deshacer el cambio.', 'Diagnóstico Eliminado')
                }
            })
        })

        /**************************************************************************/
        /* Restaurar Diagnóstico - Restore
        /**************************************************************************/
        $('#restoreDiagnosisForm').submit(function(e){

            e.preventDefault();

            var formData = $('#restoreDiagnosisForm').serialize()
            var currenId = $('#idRestore').val()

            $.ajax({
                type: 'PATCH',
                url: 'diagnoses/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                   
                    $('#restoreDiagnosisModal').modal('hide')
                    $('#restoreDiagnosisForm')[0].reset()

                    diagnosisDataTable.ajax.reload()  

                    toastr.options = {
                        positionClass: 'toast-top-center',                 
                        timeOut: 5000,
                        extendedTimeOut: 1000,   
                        tapToDismiss: true,
                        closeButton: true,
                        onclick: null
                    }

                    toastr.info('', 'Diagnóstico Restaurado')
                }
            })
        })
    })
    </script>
@endpush