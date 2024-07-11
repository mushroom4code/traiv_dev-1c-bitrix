// (function(){
//
//     var params = {};
//     params.selector = "#pricelist-form";
//     $(document).on('submit', params.selector, function(event){
//         $(params.selector).off('submit');
//         event.preventDefault();
//
//         /*Send*/
//         var formData = $(params.selector).serialize();
//         var request = {};
//         request.type = "POST";
//         request.url = '/ajax/forms/pricelist.php';
//         //request.url = window.location;
//         request.data = formData;
//         request.dataType = 'html';
//         request.success = function(response){
//             $(params.selector).html(response);
//         };
//         $.ajax(request);
//
//         return false;
//     });
// })(jQuery);

(function(){
    
    $(document).ready(function() {
        //$oneClickForm.submit(function(event){
        $("body").on("click", "#pricelist-form .btn.btn--submit", function() {
            var $oneClickForm = $("#pricelist-form");
            
           
            
            // Проверка на заполненность полей
            var stop = false;
            $("#pricelist-form .form-control").each(function() {
            	 console.log($(this));
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
            
            // Проверка согласия
            if ($("#pricelist-form input[type=checkbox]").prop("checked")) {
                $("#pricelist-form input[type=checkbox]").closest("div").css("color", "#000");
            } else {
                $("#pricelist-form input[type=checkbox]").closest("div").css("color", "red");
                stop = true;
            }
            
            if (stop) {
                return false;
            }

            //$oneClickForm.off('submit');
            event.preventDefault();
            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/pricelist.php',
                    data: $oneClickForm.serialize(),
                    success: function(response){
                        $oneClickForm.closest("div").html(response);
                    }
                }
            );
        });
    });
})();