{!! Form::open(['route' => 'flows.store','class' => 'form-horizontal','files' => true]) !!}

@include('flows.fields')

{!! Form::close() !!}
<script>
    function createSelect2(){
        $("#area").select2({
            placeholder: "Selecciona la categoría",
            language: "es",
        });
        $("#operator_id").select2({
            placeholder: "Selecciona",
            language: "es",
        });
    }
    createSelect2();
    $(document).on("change", "#type", function () {
        $ref = $(this);
        $url = "";
        if ($ref.val() == "Ingreso") {
            $url = "{{route('flows.getIngreso')}}";
        } else if ($ref.val() == "Egreso") {
            $url = "{{route('flows.getEgreso')}}";
        }
        $('#area').select2('destroy');
        $.getJSON($url, function (data) {
            var items = [];
            $.each(data, function (key, val) {
                items.push("<option value='" + val + "'>" + val + "</option>");
            });
            $("#area").html(items);
        });
        createSelect2();
    });

    $("#date").inputmask("date");
    $("#amount").inputmask("currency");
    $("#rate").inputmask({ mask: "9{1,2}.9{1,2}"});

    $('#date').datepicker({
        autoclose: true,
        format:'yyyy-mm-dd',
        language: 'es'
    });
</script>