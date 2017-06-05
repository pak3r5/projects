@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Newlegal
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($newlegal, ['route' => ['newlegals.update', $newlegal->id], 'method' => 'patch']) !!}

                        @include('newlegals.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection