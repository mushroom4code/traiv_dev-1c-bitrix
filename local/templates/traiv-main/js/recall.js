(function(){

    $(document).ready(function() {
        $("body").on("click", "#recall-form .btn.btn--submit", function() {
            // Проверка заполнености полей
            var stop = false;
            $("#recall-form .form-control").each(function() {
                if ($(this).val() == '') {
                    console.log($(this).val());
                    $(this).addClass("f-input-error");
                    stop = true;
                } else {
                    $(this).removeClass("f-input-error");
                }
            });
            if (stop) {
                return false;
            }

        //$oneClickForm.submit(function(event){
            var $oneClickForm = $("#recall-form form");
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/recall.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.html(response);
                    }
                }
            );
            return false;
        });


        $("body").on("click", "#dialog-request #request_submit", function() {

            // Проверка на заполненность полей
                var stop = false;
                $("#dialog-request input[type=text], #dialog-request textarea").each(function() {

                    if ($(this).hasClass("form-email")) {
                        if (isValidEmailAddress($(this).val())) {
                            $(this).removeClass("f-input-error");
                        } else {
                            $(this).addClass("f-input-error");
                            stop = true;
                        }
                    } else {
                        if ($(this).val() == '') {
                            $(this).addClass("f-input-error");
                            stop = true;
                        } else {
                            $(this).removeClass("f-input-error");
                        }
                    }
                });
                if (stop) {
                    return false;
                }
/*
        //$oneClickForm.submit(function(event){
            var $oneClickForm = $("#dialog-request form");
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/request.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.html(response);
                    }
                }
            );
            return false;
            */
        });


    });

})();