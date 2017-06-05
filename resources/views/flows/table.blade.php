<table class="table table-responsive" id="flows-table">
    <thead>
        <th>Project Id</th>
        <th>Opetator Id</th>
        <th>Type</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Area</th>
        <th>Rate</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($flows as $flow)
        <tr>
            <td>{!! $flow->project_id !!}</td>
            <td>{!! $flow->opetator_id !!}</td>
            <td>{!! $flow->type !!}</td>
            <td>{!! $flow->date !!}</td>
            <td>{!! $flow->amount !!}</td>
            <td>{!! $flow->area !!}</td>
            <td>{!! $flow->rate !!}</td>
            <td>
                {!! Form::open(['route' => ['flows.destroy', $flow->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('flows.show', [$flow->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('flows.edit', [$flow->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>