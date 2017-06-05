{!! Form::model($project, ['route' => ['projects.update', $project->id],'class' => 'form-horizontal',
                 'method' => 'patch',
            'id'=>'form-store',
            'data-message'=>'Registrada Correctamente']) !!}

@include('projects.fields')

{!! Form::close() !!}
