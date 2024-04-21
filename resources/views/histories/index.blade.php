@extends('layouts.main')

@section('pagetitle', 'Historiales')
@section('pagesubtitle', 'Médicos')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{ route('histories.index') }}">@yield('pagetitle')</a>
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
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select 
                            id="patients" 
                            class="form-control"
                        >
                        </select> 
                    </div>    
                </div>             
            </div>
            <div class="portlet-body">
                <table id="historyDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>№ Atención</th>
                            <th>Fecha y Hora</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Historiales Médicos - Read
        /**************************************************************************/
        getHistoryDataTable(id = null, text = '')
        getPatients('#patients')

        function getHistoryDataTable (id, text) {

            var historyDataTable = $('#historyDataTable').DataTable({

                language: {
                    zeroRecords: "No se encontraron resultados",
                    info: "",
                    infoEmpty: "",
                    infoFiltered: "",
                    search:"Buscar ",
                    lengthMenu: "_MENU_",
                    processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><br> Cargando <span class="sr-only">Cargando...</span> ',
                },
                order: [[ 1, "desc" ]],
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
                serverSide: true,
                processing: true,
                ajax: {
                    url:"",
                    data:{
                         patient: id
                    }
                },
                columns: [
                    {data: 'id', name: 'id', width: "5%", className: "text-center"},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'buttons', width: "30%", className: "text-center btn-actions"},
                ],
                columnDefs: [
                    {
                        targets: [0, 2],
                        visible: true,
                        searchable: false,
                        orderable: false
                    }
                ],
                buttons: [
                    {
                        extend: "colvis",
                        className: "btn purple",
                        text: '<i class="fa fa-th-list"></i>'
                    }
                ],
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        }
        
        $.fn.dataTable.ext.errMode = 'throw'

        $('#patients').on('select2:select', function( e ) {

            var data = e.params.data
            var id   = data.id
            var text = data.text

            $('#historyDataTable').DataTable().destroy();

            getHistoryDataTable(id, text);
        });
    })

    /**************************************************************************/
    /* Funciones
    /**************************************************************************/
    function getPatients(obj){

        $(obj).select2({
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
     
    }
    </script>
@endpush