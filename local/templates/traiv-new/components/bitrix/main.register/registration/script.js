$(function() {
    $(document).on("click", ".traiv-bitrix-main-register-registration #register_submit_button", function() {
        console.log('this');
    	$("#input-login").val($("#input-email").val());
        if (!$(".traiv-bitrix-main-register-registration input[name='license'])").prop("checked")) {
            $(".traiv-bitrix-main-register-registration input[name='license'])").css("color", "red");
            return false;
        }
    });
});