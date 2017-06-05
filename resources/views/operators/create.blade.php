{!! Form::open(['route' => 'operators.store','id'=>'createOperator']) !!}
    @include('operators.fields')
{!! Form::close() !!}

<script>
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

<script>
    /**
     * Created by pak3r5 on 14/05/17.
     */
    'use strict';

    (function ($) {

        $(function () {

            function submitFormStoreOperator() {
                var formNew = $('#createOperator');
                //formNew.on('submit', function (e) {
                //e.preventDefault();
                var options = {
                    target: null,
                    beforeSubmit: showRequestStoreOperator,  // validate
                    success: showResponseStoreOperator,
                    error: showErrorStoreOperator,
                    url: formNew.attr("action"),
                    type: formNew.attr("method"),
                    dataType: 'json',
                    clearForm: true,
                    resetForm: true
                };
                formNew.ajaxSubmit(options);
                //});

                function showRequestStoreOperator(formData, jqForm, options) { //validate
                    /*var form = jqForm[0];
                     $.each(form, function (index, value) {
                     console.log(index, "->", value);
                     });*/
                }

                function showResponseStoreOperator(responseText, statusText)
                {
                    if(responseText.type=="success"){
                        toastr.success(responseText.res, 'Casejo');
                        getTemplateData(responseText.ref,responseText.id);
                    }else if(responseText.type=="danger"){
                        toastr.danger(responseText.res, 'Casejo');
                    }else if(responseText.type=="warning"){
                        toastr.danger(responseText.res, 'Casejo');
                    }

                }

                function showErrorStoreOperator(responseText, statusText) {
                    $.each(responseText, function (index, value) {
                        if (index === "responseJSON") {
                            var notification = $(".notificationsForm");
                            notification.html("");
                            $.each(value, function (i, val) {
                                var field = $(".fields" + i);
                                field.addClass("has-error");
                                notification.append('<span class="help-block"><strong>' + val + '</strong> </span>');
                            });
                        }
                    });
                }
            }

            var btnNew = ".btnNewOperator";
            $(document).on("click", btnNew, function () {
                submitFormStoreOperator();
                $("#modalFormOperator").modal('hide');
            });

            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

    })(jQuery);
</script>