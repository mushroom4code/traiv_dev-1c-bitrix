(function(){
    
    $(document).ready(function() {
        $("body").on("click", "#callback-form .btn.btn--submit", function() {
            var $oneClickForm = $("#callback-form form");
            // Проверка на заполненность полей
            var stop = false;
            $("#callback-form .form-control").each(function() {
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

            //$oneClickForm.off('submit');
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/one_click_form.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.html(response);
                    }
                }
            );
        });
    });
})();