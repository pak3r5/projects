<!-- Rfc Field -->
<div class="form-group col-sm-4">
    {!! Form::label('rfc', 'RFC:') !!}
    {!! Form::text('rfc', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-8">
    {!! Form::label('name', 'Razón Social:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Tipo:') !!}
    {!! Form::select('type', ['Cliente' => 'Cliente', 'Contratista' => 'Contratista', 'Financiera' => 'Financiera', 'Proveedor' => 'Proveedor', 'Socio' => 'Socio'], null, ['class' => 'form-control']) !!}
</div>

<!-- Cp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cp', 'CP:') !!}
    {!! Form::text('cp', null, ['class' => 'form-control','data-colony'=>'colony','data-city'=>'city','data-state'=>'state']) !!}
</div>

<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street', 'Calle con número:') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<!-- Colony Field -->
<div class="form-group col-sm-6">
    {!! Form::label('colony', 'Colonia:') !!}
    {!! Form::select('colony', array(''=>'Selecciona'), ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>
<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'Ciudad/Municipio:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'Estado:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>


<!-- Country Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country', 'Pais:') !!}
    {!! Form::text('country', "México", ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<!-- Submit Field -->
{!! Form::hidden('project_id',null,['id'=>'project_id']) !!}
<div class="form-group col-sm-12">
    {!! Form::button('Guardar', ['class' => 'btn btn-success pull-right btnNewOperator','id'=>'sendOperator']) !!}
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<div class="clearfix"></div>
