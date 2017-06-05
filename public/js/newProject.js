'use strict';

(function ($) {

    $(function () {
        var body = $(".modal-body");
        var title=$("#myModalLabel");
        $(document).on("click", ".addProject", function () {
            $.get($(this).data("href"), function (data) {
                title.html($(this).data('title'));
                body.html(data);
            });
        });

        function submitFormStore() {
            var formNew = $('#form-store');
            //formNew.on('submit', function (e) {
                //e.preventDefault();
                var options = {
                    target: null,
                    beforeSubmit: showRequestStore,  // validate
                    success: showResponseStore,
                    error: showErrorStore,
                    url: formNew.attr("action"),
                    type: formNew.attr("method"),
                    dataType: 'json',
                    clearForm: true,
                    resetForm: true
                };
                console.log(options);
                formNew.ajaxSubmit(options);
            //});

            function showRequestStore(formData, jqForm, options) { //validate
                /*var form = jqForm[0];
                 $.each(form, function (index, value) {
                 console.log(index, "->", value);
                 });*/
            }

            function showResponseStore(responseText, statusText)
            {
                console.log(responseText);
                if(responseText.type=="success"){
                    toastr.success(responseText.res, 'Casejo');
                }else if(responseText.type=="danger"){
                    toastr.danger(responseText.res, 'Casejo');
                }else if(responseText.type=="warning"){
                    toastr.danger(responseText.res, 'Casejo');
                }

                if(responseText.name){
                    $(".projectName").html(responseText.name);
                }
                getMenu();
            }

            function showErrorStore(responseText, statusText) {
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

        var btnNew = ".btnNewProject";
        $(document).on("click", btnNew, function () {
            submitFormStore();
            $("#newProyect").modal('hide');
        });

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

})(jQuery);
