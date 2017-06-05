{!! Form::open(['route' => 'newlegals.store','files' => true, 'enctype' => 'multipart/form-data','data-message'=>'Agregado Correctamente']) !!}
@include('newlegals.fields')
{!! Form::close() !!}

<script>
    reloadFiles{{$area}}();
    $(".dz-message-{{$area}}").dropzone({
        url: "{{route('newlegals.store')}}",
        autoProcessQueue: true,
        addRemoveLinks: false,
        dictRemoveFile: "Eliminar",
        uploadMultiple: true,
        maxFiles: 10,
        clickable: true,
        acceptedFiles: "image/*,application/pdf,",
        dictDefaultMessage: "",
        init: function () {
            myDropzone = this;

            this.on("addedfile", function (file) {
                myDropzone.processQueue.bind(myDropzone)
            });

            this.on("sending", function (file, xhr, formData) {
                formData.append("_token", $("input[name=_token]").val());
                formData.append("folder", $("#folder-{!! $area !!}").val());
                formData.append("area", $("#area-{!! $area !!}").val());
                formData.append("operator_id", $("#operator_id-{!! $area !!}").val());
                formData.append("project_id", $("#project_id-{!! $area !!}").val());
            });

            this.on("complete", function (file) {
                myDropzone.removeFile(file);
                reloadFiles{{$area}}();
                toastr.success("Agregado Correctamente", 'Casejo');
            });
        }
    });

    function reloadFiles{{$area}}() {
        $.get('{{route('newlegals.getDocuments',array($ref,$project,$area,$folder))}}', function (res) {
            $(".createForm-{{$area}}").html(res);
        });
    }

    $(document).on("click", ".removeFiles{{$area}}", function () {
        var form = $(this);

        if (confirm('Estas seguro de eliminar el documento?')) {
            $.ajax({
                        method: "POST",
                        url: form.data('route'),
                        data: { _token: form.data('token'),_method:form.data('method')},
                        cache: false
                    })
                    .done(function (msg) {
                        reloadFiles{{$area}}();
                    });
        }

    });
</script>