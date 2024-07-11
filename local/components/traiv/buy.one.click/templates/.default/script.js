$(function() {
	
	$("#order-phone").mask("+7 (999) 999-9999");
	
    $("#buy-one-click .btn--submit").click(function() {
        var name = $("#order-name").val();
        var phone = $("#order-phone").val();
        var email = $("#order-email").val();
        if (name.length == 0) {
            $("#order-name").css("border", "1px solid red");
        }
        if (phone.length == 0) {
            $("#order-phone").css("border", "1px solid red");
        }
        if (phone.email == 0) {
            $("#order-email").css("border", "1px solid red");
        }

        if (name.length > 0 && phone.length > 0 && email.length > 0) {
            $.post(
                "/local/components/traiv/buy.one.click/ajax.php",
                {
                    NAME: name,
                    PHONE: phone,
                    EMAIL: email
                },
                function(data) {
                    if (data.STATUS == "SUCCESS") {
						ym(18248638,'reachGoal','oneclick');
                        $("#buy-one-click .form-control-row").hide();
                        $(".main-user-consent-request").hide();
                        $("#buy-one-click p").addClass("success").text("Ваш заказ №" + data.ORDER_ID + " успешно создан. В ближайшее время наш менеджер свяжется с Вами, " + name + "!");
                        BX.onCustomEvent('OnBasketChange');
                    } else {
                        alert(data.ERROR);
                    }
                }
            )

        }
    })
});