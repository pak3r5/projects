<table class="table table-responsive" id="newlegals-table">
    <thead>
        <th>Project Id</th>
        <th>Operator Id</th>
        <th>Area</th>
        <th>Name</th>
        <th>Path</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($newlegals as $newlegal)
        <tr>
            <td>{!! $newlegal->project_id !!}</td>
            <td>{!! $newlegal->operator_id !!}</td>
            <td>{!! $newlegal->area !!}</td>
            <td>{!! $newlegal->name !!}</td>
            <td>{!! $newlegal->path !!}</td>
            <td>
                {!! Form::open(['route' => ['newlegals.destroy', $newlegal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('newlegals.show', [$newlegal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('newlegals.edit', [$newlegal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>