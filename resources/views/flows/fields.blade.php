<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', 'Tipo de Operación:',['class'=>'control-label']) !!}
    <label class="radio-inline">
        {!! Form::radio('type', "Ingreso", null) !!} Ingreso
    </label>

    <label class="radio-inline">
        {!! Form::radio('type', "Egreso", null) !!} Egreso
    </label>
</div>

<!-- Area Field -->
<div class="form-group col-sm-12">
    {!! Form::label('area', 'Categoría:',['class'=>'control-label']) !!}
    {!! Form::select('area', array(''=>'Selecciona'), ['class' => 'form-control  input-sm', 'style'=>"width: 100%"]) !!}
</div>

<!-- Opetator Id Field -->
<div class="form-group col-sm-11">
    {!! Form::label('operator_id', 'Proveedor/Contratista/Inversionista/Cliente:',['class'=>'control-label']) !!}
    {!! Form::select('operator_id', array(''=>'Selecciona'), null, ['class' => 'form-control  input-sm']) !!}
</div>
<div class="form-group col-sm-1 vcenter">
    <button type="button" class="btn btn-primary btn-sm showModalsOperator" data-title="Agregar Socio,Cliente,Contratista,Proveedor" data-url="{{route('operators.create')}}">Agregar</button>
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Fecha:',['class'=>'control-label']) !!}
    <div class="input-group ">
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
        {!! Form::date('date', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Monto:',['class'=>'control-label']) !!}
    <div class="input-group ">
        <span class="input-group-addon">$</span>
        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'Interes Mensual:',['class'=>'control-label']) !!}
    <div class="input-group ">
        {!! Form::text('rate', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon">%</span>
    </div>
</div>

<!-- Submit Field -->
{!! Form::hidden('project_id',null,['id'=>'project_id']) !!}
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-success pull-right btnNewFlow','id'=>'sendFlow']) !!}
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
<div class="clearfix"></div>