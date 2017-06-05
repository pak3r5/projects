<div class="tableMoves">
    <div class="row">
        <div class="col-sm-4 text-center"><b>Fecha</b></div>
        <div class="col-sm-4 text-center"><b>Cargo</b></div>
        <div class="col-sm-4 text-center"><b>Abono</b></div>
    </div>
    <div class="statusOperator">

    </div>
    <div class="statusOperatorTotal">

    </div>
</div>
<script>
    $.getJSON( "{{route('operations.getAccounts',array($ref,$project,$folder))}}", function( data ) {
        var items = [];
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
</script>
