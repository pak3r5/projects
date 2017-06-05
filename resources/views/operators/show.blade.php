<div class="content no-padding operatorInfo-{{$id}}">
</div>
<script>
    function reloadOperatorInfo{{$id}}() {
        $(".operatorInfo-{{$id}}").html("");
        $.get('{{route('operators.show',array($id))}}', function (res) {
            var title="<section class='content-header'><h1>" + res.operator.name +"&nbsp;-&nbsp;"+res.operator.type+"&nbsp;&nbsp;&nbsp;<a href='#' data-url='{!! route('operators.edit', $id) !!}' class='btn btn-default btn-xs showModalsOperator' data-title='Editar datos' data-toggle='modal' data-target='#modalFormOperator'><span class='glyphicon glyphicon-edit'></span></a></h1> </section>";
            var rfc="<div class='col-xs-4 text-left'><b>RFC</b></div><div class='col-xs-8 text-left'>" + (res.operator.rfc?res.operator.rfc:"") + "</div>";
            var address="<div class='col-xs-4 text-left'><b>Dirección</b></div><div class='col-xs-8 text-left'>"+(res.operator.street?res.operator.street:"")+(res.operator.colony?","+res.operator.colony:"")+(res.operator.city?"."+res.operator.city:"")+(res.operator.state?","+res.operator.state:"")+(res.operator.cp?". CP."+res.operator.cp:"")+"</div>";
            $("<div/>", {
                "class": "row",
                html: title+rfc+address
            }).appendTo(".operatorInfo-{{$id}}");
        });
    }
    reloadOperatorInfo{{$id}}();

    $(document).on("click", "#sendOperator", function () {
        $.ajax({
                    method: "POST",
                    url: $("#editFormOperator").attr('action'),
                    data: $("#editFormOperator").serialize(),
                    cache: false
                })
                .done(function (msg) {
                    reloadOperatorInfo{{$id}}();
                    $("#modalFormOperator").modal('hide');
                });


    });
</script>