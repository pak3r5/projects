<table class="table table-responsive" id="operators-table">
    <thead>
        <th>Rfc</th>
        <th>Name</th>
        <th>Type</th>
        <th>Street</th>
        <th>Colony</th>
        <th>City</th>
        <th>State</th>
        <th>Cp</th>
        <th>Country</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($operators as $operator)
        <tr>
            <td>{!! $operator->rfc !!}</td>
            <td>{!! $operator->name !!}</td>
            <td>{!! $operator->type !!}</td>
            <td>{!! $operator->street !!}</td>
            <td>{!! $operator->colony !!}</td>
            <td>{!! $operator->city !!}</td>
            <td>{!! $operator->state !!}</td>
            <td>{!! $operator->cp !!}</td>
            <td>{!! $operator->country !!}</td>
            <td>
                {!! Form::open(['route' => ['operators.destroy', $operator->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('operators.show', [$operator->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('operators.edit', [$operator->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>