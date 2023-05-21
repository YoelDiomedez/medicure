@extends('layouts.main')

@section('pagetitle', 'Accesos')
@section('pagesubtitle', 'Roles y Permisos')

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="JavaScript:;" id="reloadRoleDT">@yield('pagetitle')</a>
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
                        @can('roles store')
                            <button id="newRoleBtn" class="btn blue"> 
                                <i class="fa fa-plus"></i> Agregar
                            </button>    
                        @endcan
                    </div>    
                </div>              
            </div>
            <div class="portlet-body">
                <table id="roleDataTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@include('roles.create')
@include('roles.edit')
@include('roles.delete')

@endsection

@push('scripts')
    <script>
    $(document).ready( function () {
        /**************************************************************************/
        /* Lista de Roles - Read
        /**************************************************************************/
        var roleDataTable = $('#roleDataTable').DataTable({
            language: {
                zeroRecords: "No se encontraron resultados",
                info: "",
                infoEmpty: "",
                infoFiltered: "",
                search:"Buscar ",
                lengthMenu: "_MENU_",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Cargando...</span>',
            },
            order: [[ 0, "desc" ]],
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todo"]],
            serverSide: true,
            processing: true,
            ajax: "",
            columns: [
                {data: 'id',      name: 'id', width: "5%"},
                {data: 'name',    name: 'name'},
                {data: 'buttons', orderable: false, width: "30%", className: "text-center btn-actions"},
            ],
            buttons: [
                {
                    extend: "print",
                    className: "btn dark",
                    exportOptions: { columns: [ 0, 1]},
                    text: '<i class="icon-printer"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    title: 'Lista de Roles'
                }, 
                {
                    extend: "pdf",
                    className: "btn red",
                    exportOptions: { columns: [ 0, 1]},
                    text:      '<i class="fa fa-file-pdf-o"></i> PDF',
                    titleAttr: 'PDF',
                    title: 'Lista de Roles'
                }, 
                {
                    extend: "excel",
                    className: "btn green-meadow",
                    exportOptions: { columns: [ 0, 1]},
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    titleAttr: 'Excel',
                    title: 'Lista de Roles'
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

        $('#reloadRoleDT').click( function () {
            roleDataTable.ajax.reload()
        })
        /*************************************************************************/
        /* Agregar Rol - Create
        /*************************************************************************/
        $('#newRoleBtn').click( function () {
            $('#newRoleForm')[0].reset()
            orderNewTabs()
            $('#newRoleModal').modal('show')
        })
        
        $('#newRoleForm').submit( function(e) {

            e.preventDefault()

            var formData = $('#newRoleForm').serialize()

            $.post('', formData, function(data) {

                // console.log(data);

                $('#newRoleForm')[0].reset()
                $('#newRoleModal').modal('hide')

                roleDataTable.ajax.reload()
                toastr.options.positionClass = 'toast-top-center'
                toastr.success('Acceso Registrado')
            })
        })

        /*************************************************************************/
        /* Editar Rol - Update
        /*************************************************************************/
        $('#roleDataTable tbody').on('click', '#editRoleBtn', function(){

            $('#updateRoleForm')[0].reset()
            orderUpdateTabs()

            var data        = roleDataTable.row($(this).parents('tr')).data()
            var permissions = data.permissions

            //console.log(data);

            $('#idUpdate').val(data.id)
            $('#name').val(data.name)

            checkPermissions(permissions)

            $('#updateRoleModal').modal('show')
        })

        $('#updateRoleForm').submit(function(e){

            e.preventDefault()

            var formData = $('#updateRoleForm').serialize()
            var currenId = $('#idUpdate').val()

            $.ajax({
                type: 'PUT',
                url: 'roles/' + currenId,
                data: formData,
                success: function(data) {

                    //console.log(data)

                    $('#updateRoleForm')[0].reset()
                    $('#updateRoleModal').modal('hide')

                    var rowId = $('#roleDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    
                    roleDataTable.cell(rowId, 1).data(data.name).draw(false)
                    
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.info('Acceso Actualizado')
                }
            })
        })

        /**************************************************************************/
        /* Eliminar Rol - Delete
        /**************************************************************************/
        $('#roleDataTable tbody').on('click', '#deleteRoleBtn', function(){

            var data = roleDataTable.row($(this).parents('tr')).data()

            //console.log(data);

            $('#idDelete').val(data.id)
            $('p').text(data.name)
            $('#deleteRoleModal').modal('show')
        })

        $('#deleteRoleForm').submit(function(e){

            e.preventDefault();

            var formData = $('#deleteRoleForm').serialize()
            var currenId = $('#idDelete').val()

            $.ajax({
                type: 'DELETE',
                url: 'roles/' + currenId,
                data: formData,
                success: function(data) {

                    //console.log(data);

                    $('#deleteRoleForm')[0].reset()
                    $('#deleteRoleModal').modal('hide')

                    var rowId = $('#roleDataTable').dataTable().fnFindCellRowIndexes(currenId, 0)
                    roleDataTable.row(rowId).remove().draw()
                        
                    toastr.options.positionClass = 'toast-top-center'
                    toastr.warning('Acceso Eliminado')
                }
            })
        })
    })
    
    /**************************************************************************/
    /* Funciones
    /**************************************************************************/
    function orderNewTabs(){

        $('#newTab1').addClass('active')
        $('#newTab2').removeClass('active')
        $('#newTab3').removeClass('active')
        $('#newTab4').removeClass('active')

        $('#newAccessTab1').addClass('active in')
        $('#newAccessTab2').removeClass('active')
        $('#newAccessTab3').removeClass('active')
        $('#newAccessTab4').removeClass('active')
    }

    function orderUpdateTabs(){

        $('#updateTab1').addClass('active')
        $('#updateTab2').removeClass('active')
        $('#updateTab3').removeClass('active')
        $('#updateTab4').removeClass('active')

        $('#updateAccessTab1').addClass('active in')
        $('#updateAccessTab2').removeClass('active')
        $('#updateAccessTab3').removeClass('active')
        $('#updateAccessTab4').removeClass('active')
    }

    function checkPermissions(permissions){

        for (let index = 0; index < permissions.length; index++) {

            const permission = permissions[index].name;

            switch (permission) {
            // Inicio
                case 'home index':
                    $('#homeIndex').prop('checked', true)
                break;

                case 'home triages':
                    $('#homeTriages').prop('checked', true) 
                break;

                case 'home attentions':
                    $('#homeAttentions').prop('checked', true) 
                break;
            // Historiales
                case 'histories index':
                    $('#historiesIndex').prop('checked', true)
                break;

                case 'histories record':
                    $('#historiesRecord').prop('checked', true) 
                break;

                case 'histories prescription':
                    $('#historiesPrescription').prop('checked', true) 
                break;
            // Atenciones
                case 'attentions index':
                    $('#attentionsIndex').prop('checked', true) 
                break;

                case 'attentions store':
                    $('#attentionsStore').prop('checked', true) 
                break;

                case 'attentions update':
                    $('#attentionsUpdate').prop('checked', true) 
                break;

                case 'attentions destroy':
                    $('#attentionsDestroy').prop('checked', true) 
                break;
            // Pacientes
                case 'patients index':
                    $('#patientsIndex').prop('checked', true) 
                break;

                case 'patients store':
                    $('#patientsStore').prop('checked', true) 
                break;

                case 'patients update':
                    $('#patientsUpdate').prop('checked', true) 
                break;

                case 'patients destroy':
                    $('#patientsDestroy').prop('checked', true) 
                break;

                case 'patients get':
                    $('#patientsGet').prop('checked', true) 
                break;

                case 'patients show':
                    $('#patientsShow').prop('checked', true) 
                break;
            // Triajes
                case 'triages index':
                    $('#triagesIndex').prop('checked', true) 
                break;

                case 'triages update':
                    $('#triagesUpdate').prop('checked', true) 
                break;
            // Historias
                case 'records index':
                    $('#recordsIndex').prop('checked', true) 
                break;
                
                case 'records update':
                    $('#recordsUpdate').prop('checked', true) 
                break;
            // Informes Quirúrgicos
                case 'surgeries index':
                    $('#surgeriesIndex').prop('checked', true) 
                break;

                case 'surgeries store':
                    $('#surgeriesStore').prop('checked', true) 
                break;

                case 'surgeries show':
                    $('#surgeriesShow').prop('checked', true) 
                break;

                case 'surgeries update':
                    $('#surgeriesUpdate').prop('checked', true) 
                break;

                case 'surgeries destroy':
                    $('#surgeriesDestroy').prop('checked', true) 
                break;
            // Informes Quirúrgicos
                case 'labs index':
                    $('#labsIndex').prop('checked', true) 
                break;

                case 'labs store':
                    $('#labsStore').prop('checked', true) 
                break;

                case 'labs show':
                    $('#labsShow').prop('checked', true) 
                break;

                case 'labs update':
                    $('#labsUpdate').prop('checked', true) 
                break;

                case 'labs destroy':
                    $('#labsDestroy').prop('checked', true) 
                break;
            // Accesos
                case 'roles index':
                    $('#rolesIndex').prop('checked', true) 
                break;

                case 'roles store':
                    $('#rolesStore').prop('checked', true) 
                break;

                case 'roles update':
                    $('#rolesUpdate').prop('checked', true) 
                break;

                case 'roles destroy':
                    $('#rolesDestroy').prop('checked', true) 
                break;

                case 'roles get':
                    $('#rolesGet').prop('checked', true) 
                break;

                case 'roles show':
                    $('#rolesShow').prop('checked', true) 
                break;
            // Servicios
                case 'services index':
                    $('#servicesIndex').prop('checked', true) 
                break;

                case 'services store':
                    $('#servicesStore').prop('checked', true) 
                break;

                case 'services update':
                    $('#servicesUpdate').prop('checked', true) 
                break;

                case 'services destroy':
                    $('#servicesDestroy').prop('checked', true) 
                break;

                case 'services get':
                    $('#servicesGet').prop('checked', true) 
                break;

                case 'services show':
                    $('#servicesShow').prop('checked', true) 
                break;
            // Diagnósticos
                case 'diagnoses index':
                    $('#diagnosesIndex').prop('checked', true) 
                break;

                case 'diagnoses store':
                    $('#diagnosesStore').prop('checked', true) 
                break;

                case 'diagnoses update':
                    $('#diagnosesUpdate').prop('checked', true) 
                break;

                case 'diagnoses destroy':
                    $('#diagnosesDestroy').prop('checked', true) 
                break;

                case 'diagnoses get':
                    $('#diagnosesGet').prop('checked', true) 
                break;

                case 'diagnoses show':
                    $('#diagnosesShow').prop('checked', true) 
                break;
            // Usuarios
                case 'users index':
                    $('#usersIndex').prop('checked', true) 
                break;

                case 'users store':
                    $('#usersStore').prop('checked', true) 
                break;

                case 'users update':
                    $('#usersUpdate').prop('checked', true) 
                break;

                case 'users destroy':
                    $('#usersDestroy').prop('checked', true) 
                break;

                case 'users get':
                    $('#usersGet').prop('checked', true) 
                break;

                case 'users show':
                    $('#usersShow').prop('checked', true) 
                break;

                default:
                    console.log('Nothing to Check')
                break;
            }
        } 
    }
    </script>
@endpush