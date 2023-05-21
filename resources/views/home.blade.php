@extends('layouts.main')

@section('pagetitle', 'Inicio')
@section('pagesubtitle', '')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('home') }}">@yield('pagetitle')</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Escritorio</span>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="portlet light">
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
                        <table id="triagesDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>№ Atención</th>
                                    <th >#</th>
                                    <th class="text-center">Triaje</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table id="attentionsDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>№ Atención</th>
                                    <th>#</th>
                                    <th class="text-center">Atención</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    $(document).ready( function () {

        var triagesDataTable = $('#triagesDataTable').DataTable({

            language: {
                zeroRecords: "Ningún paciente en espera.",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Cargando...</span> ',
            },
            serverSide: true,
            processing: true,
            paging: false,
            searching: false,
            ordering: false,
            lengthChange: false,
            ajax: "{{ url('api/triages') }}",
            columns: [
                {data: 'id',               name: 'id'},
                {data: 'DT_RowIndex',      name: 'DT_RowIndex', width: "10%"},
                {data: 'patient.surnames', name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }}
            ],
            columnDefs: [
                {
                    targets: [0],
                    visible: false,
                }
            ]
        })

        var attentionsDataTable = $('#attentionsDataTable').DataTable({

            language: {
                zeroRecords: "Ningún paciente en espera.",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Cargando...</span> ',
            },
            serverSide: true,
            processing: true,
            paging: false,
            searching: false,
            ordering: false,
            lengthChange: false,
            ajax: "{{ url('api/attentions') }}",
            columns: [
                {data: 'id',               name: 'id'},
                {data: 'DT_RowIndex',      name: 'DT_RowIndex', width: "10%"},
                {data: 'patient.surnames', name: 'patient.surnames', render: function (data, type, row){
                    return row.patient.surnames +' '+ row.patient.names
                }}
            ],
            columnDefs: [
                {
                    targets: [0],
                    visible: false,
                }
            ]
        })

        $.fn.dataTable.ext.errMode = 'throw'
    })

    function reloadTriagesDataTable () { 
        $('#triagesDataTable').DataTable().ajax.reload()
    }

    function reloadAttentionsDataTable () {
        $('#attentionsDataTable').DataTable().ajax.reload()
    }

    setInterval(reloadTriagesDataTable, 5000)
    setInterval(reloadAttentionsDataTable, 6000)
    </script>
@endpush