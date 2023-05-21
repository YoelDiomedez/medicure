@can('labs show')
    <a href="{{ route ('labs.show', $id)}}" class='btn green' target="_blank"> 
        <i class='fa fa-eye'></i> <span class="hidden-xs">Ver</span> 
    </a>      
@endcan

@can('labs update')
    <button id='editLabBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>    
@endcan

@can('labs destroy')
    <button id='deleteLabBtn' class='btn red'>
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>    
@endcan

