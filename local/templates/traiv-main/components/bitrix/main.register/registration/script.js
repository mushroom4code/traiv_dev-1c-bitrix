$(function() {
    $(document).on("click", ".traiv-bitrix-main-register-registration .traiv-orange-button", function() {
        $("#input-login").val($("#input-email").val());
        if (!$(".traiv-bitrix-main-register-registration td.license input").prop("checked")) {
            $(".traiv-bitrix-main-register-registration td.license").css("color", "red");
            return false;
        }
    });
});