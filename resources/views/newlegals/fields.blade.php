<div class="col-sm-12 no-padding">
    <div class="dz-message-{{$area}} dragandrophandlear dropzone createForm-{{$area}}">
    </div>
</div>
<div class="clearfix"></div>
{!! Form::hidden('folder',$folder,['id'=>'folder-'.$area]) !!}
{!! Form::hidden('area',$area,['id'=>'area-'.$area]) !!}
{!! Form::hidden('operator_id',$ref,['id'=>'operator_id-'.$area]) !!}
{!! Form::hidden('project_id',$project,['id'=>'project_id-'.$area]) !!}