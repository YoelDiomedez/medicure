@extends('layouts.main')

@section('pagetitle', 'Auditorias')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadAuditDT">@yield('pagetitle')</a>
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
            </div>
            <div class="portlet-body">
                <table id="auditDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Evento</th>
                            <th>Modelo</th>
                            <th>Fecha y Hora</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('audits.show')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Servicios - Read
        /**************************************************************************/
        var auditDataTable = $('#auditDataTable').DataTable({
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
                {data: 'id', name: 'id'},

                {data: 'user.patient.surnames',     name: 'user.patient.surnames',  orderable: false, render: function (data, type, row){
                    return row.user.patient.surnames +' '+ row.user.patient.names
                }},
                {data: 'event',          name: 'event'},
                {data: 'auditable_type', name: 'auditable_type'},
                {data: 'created_at',     name: 'created_at'},

                {data: 'btnView', orderable: false, className: "text-center"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Auditorias'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Auditorias'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1, 2, 3, 4]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Auditorias'
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

        $('#reloadAuditDT').click( function () {
            auditDataTable.ajax.reload()
        })

        /*************************************************************************/
        /* Ver Detalles de Auditoria - Show
        /*************************************************************************/
        $('#auditDataTable tbody').on('click', '#viewAuditBtn', function(){

            var data = auditDataTable.row($(this).parents('tr')).data()

            // console.log(data)
            
            $('#datetime').text(data.created_at)
            $('#user').text(data.user.patient.names +' '+ data.user.patient.surnames)
            $('#event').text(data.event)
            $('#model').text(data.auditable_type)
            $('#ip').text(data.ip_address)
            $('#url').text(data.url)
            $('#agent').text(data.user_agent)

            document.getElementById("newValues").innerHTML = JSON.stringify(data.new_values, undefined, 2)
            document.getElementById("OldValues").innerHTML = JSON.stringify(data.old_values, undefined, 2)
            
            $('#viewAuditModal').modal('show')
        })
    })
    </script>
@endpush