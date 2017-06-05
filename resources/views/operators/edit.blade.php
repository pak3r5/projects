{!! Form::model($operator, ['route' => ['operators.update', $operator->id], 'method' => 'patch','id'=>'editFormOperator']) !!}

@include('operators.fields')

{!! Form::close() !!}
<script>
    $.post('{{route('address')}}', {
        cp: '{{$operator->cp}}',
        _token: $(document).find('input[name="_token"]').val()
    }, function (respuesta) {
        obj = (respuesta);
        //$('input[name="' + ($ref.data("mun")) + '"]').val(obj.mun);
        $('#colony').select2('destroy');
        $('#colony').html("");

        $.each(obj.col, function (key, value) {
            $('#colony')
                    .append($("<option></option>")
                            .attr("value", value.col)
                            .text(value.col));
        });

        $('#colony').select2({
            language: "es",
            placeholder: "Selecciona",
        });
        $('#colony').val('{{$operator->colony}}').trigger('change');
        $(".select2").attr('style', 'width:100%');
    });

    $(document).on("click","#sendOperator",function(e){
        console.log("asas");
    });

    $('#colony').select2({
        language: "es",
        placeholder: "Selecciona",
    });
    $("#colony").attr('style', 'width:100%');
    $(document).on("keyup", "#cp", function () {
        $ref = $(this);
        if ($ref.val().length == 5) {
            $.post('{{route('address')}}', {
                cp: $(this).val(),
                _token: $(document).find('input[name="_token"]').val()
            }, function (respuesta) {
                obj = (respuesta);
                //$('input[name="' + ($ref.data("mun")) + '"]').val(obj.mun);
                $('input[name="' + ($ref.data("city")) + '"]').val(obj.city);
                $('input[name="' + ($ref.data("state")) + '"]').val(obj.state);
                $('#' + ($ref.data('colony'))).select2('destroy');
                $('#' + ($ref.data('colony'))).html("");

                $.each(obj.col, function (key, value) {
                    $('#' + ($ref.data('colony')))
                            .append($("<option></option>")
                                    .attr("value", value.col)
                                    .text(value.col));
                });

                $('#' + ($ref.data('colony'))).select2({
                    language: "es",
                    placeholder: "Selecciona",
                });
                $(".select2").attr('style', 'width:100%');
            });
        }
    });
</script>