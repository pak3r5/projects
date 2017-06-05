<div class="col-sm-12 no-padding">
    <div class="dz-message-{{$folder}}-{{ $status }} dragandrophandlear dropzone createForm-{{$folder}}-{{$status}}">
    </div>
</div>
<div class="clearfix"></div>
{!! Form::hidden('amount',$folder,['id'=>'amount-'.$folder."-".$status]) !!}
{!! Form::hidden('date',date('Y-m-d'),['id'=>'date-'.$folder."-".$status]) !!}
{!! Form::hidden('status',$status,['id'=>'status-'.$folder."-".$status]) !!}
{!! Form::hidden('type',$folder,['id'=>'type-'.$folder."-".$status]) !!}
{!! Form::hidden('operator_id',$ref,['id'=>'operator_id-'.$folder."-".$status]) !!}
{!! Form::hidden('project_id',$project,['id'=>'project_id-'.$folder."-".$status]) !!}