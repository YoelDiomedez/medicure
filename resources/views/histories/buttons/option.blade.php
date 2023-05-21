@can('histories record')
    <a href="{{ route ('histories.record', $id)}}" class="btn btn-info" target="_blank"> 
        <i class='fa fa-history'></i> Historia
    </a>
@endcan

@can('histories prescription')
    <a href="{{ route ('histories.prescription', $id)}}" class="btn btn-warning" target="_blank"> 
        <i class='fa fa-flask'></i> Receta
    </a>
@endcan