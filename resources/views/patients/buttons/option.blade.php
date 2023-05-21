@can('patients update')
    <button id='editPatientBtn'   class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>    
@endcan

@can('patients destroy')
    <button id='deletePatientBtn' class='btn red'>   
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>    
@endcan