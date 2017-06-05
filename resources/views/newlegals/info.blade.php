<table class="table table-hover" id="documents-table">
    <thead>
    <th>Archivo</th>
    <th>Fecha</th>
    <th colspan="3">&nbsp;</th>
    </thead>
    <tbody>
    @foreach($documents as $document)
        <tr>
            <td style="text-align: left !important;"><a href="{{asset($document->path)}}" target="_blank" class=' btn-xs'>{!! $document->name !!}</a></td>
            <td>{!! $document->created_at->format('d-m-Y') !!}</td>
            <td>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'button', 'class' => 'btn btn-danger btn-xs removeFiles'.$area,'data-id'=>$document->id,'data-table'=>'reloadFiles','data-area'=>$area,'data-token'=>csrf_token(),'data-method'=>'delete','data-route'=>route('newlegals.destroy',$document->id)]) !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>