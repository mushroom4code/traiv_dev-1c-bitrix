/*(function(){
    $(document).on('submit', params.selector, function(event){
        $(this).off('submit');
        event.preventDefault();

        /*Send
        var formData = $(params.selector).serialize();
        var request = {};
        request.type = "POST";
        request.url = params.url;
        request.data = formData;
        request.dataType = 'html';
        request.success = function(response){
            $(params.selector).html(response);
        };
        $.ajax(request);

        return false;
    });
})(jQuery);*/

(function(){
    
    $(document).ready(function() {
        //$oneClickForm.submit(function(event){
        $("body").on("click", "#reg-form .btn.btn--submit", function() {
            var $oneClickForm = $("#reg-form form");
            // Проверка на заполненность полей
            var stop = false;
            $("#reg-form .form-control").each(function() {
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
                    url: '/ajax/forms/registr.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.closest("div").html(response);
                    }
                }
            );
        });
    });
})();