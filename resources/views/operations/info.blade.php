<table class="table table-hover" id="documents-table">
    <thead>
    <th>Archivo</th>
    <th>Monto</th>
    <th>Fecha</th>
    <th colspan="3">&nbsp;</th>
    </thead>
    <tbody>
    @foreach($documents as $document)
        <tr>
            <td style="text-align: left !important;"><a href="{{ URL::asset($document->path) }}" target="_blank" class='btn-xs'>{!! $document->name !!}</a></td>
            <td style="text-align: left !important;">$ {!! number_format($document->amount,2,".",",") !!}</td>
            <td>{!! $document->date->format('d-m-Y') !!}</td>
            <td  class='btn-group'>
                {!! Form::open(['route' => ['operations.destroy', $document->id], 'method' => 'delete', 'onsubmit'=>'return false;','class'=>"removeFiles"]) !!}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>