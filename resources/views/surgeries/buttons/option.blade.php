@can('surgeries show')
    <a href="{{ route ('surgeries.show', $id)}}" class='btn green' target="_blank"> 
        <i class='fa fa-eye'></i> <span class="hidden-xs">Ver</span> 
    </a>
@endcan

@can('surgeries update')
    <button id='editSurgeryBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>
@endcan

@can('surgeries destroy')
    <button id='deleteSurgeryBtn' class='btn red'>
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>
@endcan

    


    