{!! Form::open(['route' => 'operations.store', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone-{{$folder}}-{{$status}}' , 'class' => 'dropzone-{{$folder}}-{{$status}}','data-message'=>'Agregado Correctamente']) !!}
@include('operations.fields')
<div id="myModalFlow" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title titleModalFlow">Agregar</h4>
            </div>
            <div class="modal-body bodyModalFlow">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> </span>
                    <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="dateFlow" id="dateFlow" aria-label="fecha de la operación">
                </div>
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control" value="0" name="amountFlow" id="amountFlow" aria-label="monto de la operación">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnSaveFlow" data-dismiss="modal" name="btnSaveFlow" id="btnSaveFlow">Guardar</button>
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}
<script>$.get('{{route('operations.getDocuments',array($ref,$project,$folder,$status))}}',function(res){$(".createForm-{{$folder}}-{{$status}}").html(res);});</script>
<script>
    $('#myModalFlow').on('hidden.bs.modal', function (e) {
        $("#dateFlow").val("{{date('Y-m-d')}}");
        $("#amountFlow").val("0");
    });

     $(".dz-message-{{$folder}}-{{$status}}").dropzone({
        url: "{{route('operations.store')}}",
        autoProcessQueue: false,
        addRemoveLinks: true,
        dictRemoveFile: "X",
        uploadMultiple: true,
        maxFiles: 100,
        clickable: false,
        acceptedFiles: "image/*,application/pdf,",
        dictDefaultMessage: "",
         parallelUploads: 1,
        init: function () {
            var myDropzone = this;
            document.querySelector("button[name=btnSaveFlow]").addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });

            this.on("addedfile", function (file) {
                $("#myModalFlow").modal('show');
            });

            this.on("sending", function (file, xhr, formData) {
                formData.append("_token", $("input[name=_token]").val());
                formData.append("operator_id", $("#operator_id-{!! $folder !!}-{!! $status !!}").val());
                formData.append("project_id", $("#project_id-{!! $folder !!}-{!! $status !!}").val());
                formData.append("amount", $("#amountFlow").val());
                formData.append("date", $("#dateFlow").val());
                formData.append("status", $("#status-{!! $folder !!}-{!! $status !!}").val());
                formData.append("type", $("#type-{!! $folder !!}-{!! $status !!}").val());
            });

            this.on("success",
                    myDropzone.processQueue.bind(myDropzone)
            );


            this.on("complete", function(file) {
                myDropzone.removeFile(file);
                $("#myModalFlow").modal('hide');
                toastr.success("Agregado Correctamente", 'Casejo');
                $.get('{{route('operations.getDocuments',array($ref,$project,$folder,$status))}}',function(res){$(".createForm-{{$folder}}-{{$status}}").html(res);});
                $.getJSON( "{{route('operations.getAccounts',array($ref,$project,$folder))}}", function( data ) {
                    var items = [];
                    $( ".statusOperator" ).html("");
                    $( ".statusOperatorTotal" ).html("");
                    $.each( data.moves, function( key, val ) {
                        if(val.status==0){
                            items.push( "<div class='col-xs-4 text-left'>" + (val.date) + "</div>"+"<div class='col-xs-4 text-right'>$&nbsp;" + val.amount + "</div><div class='col-xs-4'>&nbsp;</div>" );
                        }else{
                            items.push( "<div class='col-xs-4 text-left'>" + (val.date) + "</div>"+"<div class='col-xs-4'>&nbsp;</div><div class='col-xs-4 text-right'>$&nbsp;" + val.amount + "</div>" );
                        }
                    });

                    $( "<div/>", {
                        "class": "row",
                        html: items.join( "" )
                    }).appendTo( ".statusOperator" );

                    $( "<div/>", {
                        "class": "row",
                        html: "<div class='col-xs-4 text-right'><b>SALDO</b></div><div class='col-xs-8 text-right'><b>$&nbsp;" + data.total + "</b></div>"
                    }).appendTo( ".statusOperatorTotal" );
                });
            });

        }
    });
</script>