<table class="table table-responsive" id="operations-table">
    <thead>
        <th>Project Id</th>
        <th>Operator Id</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Amount</th>
        <th>Name</th>
        <th>Path</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($operations as $operation)
        <tr>
            <td>{!! $operation->project_id !!}</td>
            <td>{!! $operation->operator_id !!}</td>
            <td>{!! $operation->type !!}</td>
            <td>{!! $operation->amount !!}</td>
            <td>{!! $operation->amount !!}</td>
            <td>{!! $operation->name !!}</td>
            <td>{!! $operation->path !!}</td>
            <td>
                {!! Form::open(['route' => ['operations.destroy', $operation->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('operations.show', [$operation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('operations.edit', [$operation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>