@can('users update')
    <button id='editUserBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>
@endcan

@can('users destroy')
    <button id='deleteUserBtn' class='btn red'>
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>
@endcan