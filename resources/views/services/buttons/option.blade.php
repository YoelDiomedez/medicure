@can('services update')
    <button id='editServiceBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>
@endcan

@can('services destroy')
    <button id='deleteServiceBtn' class='btn red'>
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>
@endcan