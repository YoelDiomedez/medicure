@can('diagnoses update')
    <button id='editDiagnosisBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>
@endcan

@can('diagnoses destroy')
    <button id='deleteDiagnosisBtn' class='btn red'>  
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>
@endcan
