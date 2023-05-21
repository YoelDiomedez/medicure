@can('attentions update')
    <button id='editAttentionBtn' class='btn yellow'>
        <i class='fa fa-edit'></i> <span class="hidden-xs">Editar</span> 
    </button>    
@endcan

@can('attentions destroy')
    <button id='deleteAttentionBtn' class='btn red'>
        <i class='fa fa-trash'></i> <span class="hidden-xs">Eliminar</span> 
    </button>    
@endcan