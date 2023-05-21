@extends('layouts.main')

@section('pagetitle', 'Servicios')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadServiceDT">@yield('pagetitle')</a>
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
                    @can('services store')
                        <button id="newServiceBtn" class="btn blue"> 
                            <i class="fa fa-plus"></i> Agregar
                        </button>
                    @endcan
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="serviceDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Concepto</th>
                            <th>Costo (S/)</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('services.create')
@include('services.edit')
@include('services.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Servicios - Read
        /**************************************************************************/
        var serviceDataTable = $('#serviceDataTable').DataTable({
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
                {data: 'concept', name: 'concept'},
                {data: 'amount',  name: 'amount'},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Servicios'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Servicios'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Servicios'
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

        $('#reloadServiceDT').click( function () {
            serviceDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Servicio - Create
        /*************************************************************************/
        $('#newServiceBtn').click( function () {
            $('#newServiceForm')[0].reset()
            $('#newServiceModal').modal('show')
        })
        
        $('#newServiceForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newServiceForm').serialize()

            $.post('', formData, function(data) {
                // console.log(data);

                $('#newServiceForm')[0].reset()
                $('#newServiceModal').modal('hide')

                serviceDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Servicio Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Servicio - Update
        /*************************************************************************/
        $('#serviceDataTable tbody').on('click', '#editServiceBtn', function(){
            var data = serviceDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('#concept').val(data.concept)
            $('#amount').val(data.amount)

            $('#updateServiceModal').modal('show')
        })

        $('#updateServiceForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateServiceForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'PUT',
                url: 'services/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data)
                    $('#updateServiceForm')[0].reset()
                    $('#updateServiceModal').modal('hide')

                    var rowId = $('#serviceDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    serviceDataTable.cell(rowId, 1).data(data.concept).draw(false)
                    serviceDataTable.cell(rowId, 2).data(data.amount).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Servicio Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Servicio - Delete
        /**************************************************************************/
        $('#serviceDataTable tbody').on('click', '#deleteServiceBtn', function(){
            var data = serviceDataTable.row($(this).parents('tr')).data()
            //console.log(data);
            $('#id').val(data.id)
            $('p').text(data.concept)
            $('#deleteServiceModal').modal('show')
        })

        $('#deleteServiceForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteServiceForm').serialize()
            var currenId = $('#id').val()

            $.ajax({
                type: 'DELETE',
                url: 'services/' + currenId,
                data: formData,
                success: function(data) {
                    //console.log(data);
                    $('#deleteServiceForm')[0].reset()
                    $('#deleteServiceModal').modal('hide')

                    var rowId = $('#serviceDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    serviceDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Servicio Eliminado')
                }
            })
        })
    })
    </script>
@endpush