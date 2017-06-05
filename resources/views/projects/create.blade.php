{!! Form::open(['route' => 'projects.store',
        'class' => 'form-horizontal',
        'method' => 'POST',
            'id'=>'form-store',
            'data-message'=>'Registrada Correctamente']) !!}

@include('projects.fields')

{!! Form::close() !!}
