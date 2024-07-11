// Проверка правильности ввода EMAIL
 function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

(function(){
    
    $(document).ready(function() {
        //$oneClickForm.submit(function(event){

        $("body").on("click", "#is-form .btn-blue.submit-button", function() {
            var $oneClickForm = $("#is-form");
            
            // Проверка на заполненность полей
            var stop = false;
            $("#is-form .form-control").each(function() {

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
                //return false;
            });
            
            // Проверка согласия
            if ($("#is-form input[type=checkbox]").prop("checked")) {
                $("#is-form input[type=checkbox]").closest("div").css("color", "#000");
            } else {
                $("#is-form input[type=checkbox]").closest("div").css("color", "red");
                stop = true;
            }
            
            if (stop) {
                return false;
            }
            //return false;

            //$oneClickForm.off('submit');
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/is.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.closest("div").html(response);
                    }
                }
            );
        });
    });
})();