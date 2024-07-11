$(function() {
    // Инициализация масок
    $('.traiv-order-default #u-inn').mask('9999999999?99');
    $('.traiv-order-default #u-kpp').mask('999999999');

    //Подмена суммы
    if ('.list-block:contains("Запросить цену")') {
        $(".big-price").text("Сумма заказа будет сформирована менеджером");
    };
    
    $(".traiv-order-default input[type=radio]").click(function() {
        var id = $(this).val();
         $(".traiv-order-default .person-container").hide();
         $(".traiv-order-default .person-container[data-id=" + id + "]").fadeIn();
         
    });
    
    // +-
    $("body").on("click", ".traiv-order-default .container-count .minus", function() {
        var container = $(this).closest(".basket-item");
        var count = $("input", container).val();
        var summ = parseInt(count) - parseInt(count);
        if (count > 0) {
            $("input", container).val(summ);
        }
        updatePersonalOrder(container);
    });
    $("body").on("click", ".traiv-order-default .container-count .plus", function() {
        var container = $(this).closest(".basket-item");
        var count = $("input", container).val();
        var summ = parseInt(count) + parseInt(count);
        $("input", container).val(summ);
        updatePersonalOrder(container);
    });
    $("body").on("change", ".traiv-order-default .container-count input", function() {
        var container = $(this).closest(".basket-item");
        updatePersonalOrder(container);
    });
    
    // Удалить товар
    $("body").on("click", ".traiv-order-default a.del", function() {
        if ($(".basket-item:visible").length > 1) {
            var tr = $(this).closest(".basket-item");
            var id = $(tr).attr("data-id");
            $.get(
                "/personal/cart/",
                {
                    AJAX_MODE: "Y",
                    ID: id,
                    TASK: "DELETE_PRODUCT_BASKET"
                },
                function(data){
                    $(".traiv-order-default .big-price span").text(data.TOTAL);
                    $(".traiv-order-default .weight span").text(data.WEIGHT);
                    $(tr).fadeOut();
                }
            )
            return false;
        } else {
            var tr = $(this).closest(".basket-item");
            var id = $(tr).attr("data-id");
            $.get(
                "/personal/cart/",
                {
                    AJAX_MODE: "Y",
                    ID: id,
                    TASK: "DELETE_PRODUCT_BASKET"
                },
                function(data){
                    window.location.reload(true);
                }
            )
            
            return false;
        }
    });
    
    $(".traiv-order-default .btn-form").click(function() {
        
        var stop = false;
        $(".traiv-order-default input[required]").each(function() {
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
            
            var delivery = ($("#ch1").prop("checked")) ? "Y" : "N";

            $.post(
                "/local/components/traiv/order/ajax.php",
                {
                    TYPE: $(".traiv-order-default input[type=radio]:checked").val(),
                    DELIVERY: delivery,
                    
                    F_FIO: $(".traiv-order-default input[name=F_FIO]").val(),
                    F_PHONE: $(".traiv-order-default input[name=F_PHONE]").val(),
                    F_EMAIL: $(".traiv-order-default input[name=F_EMAIL]").val(),
                    F_CITY: $(".traiv-order-default input[name=F_CITY]").val(),
                    F_ADDRESS: $(".traiv-order-default input[name=F_ADDRESS]").val(),
                    
                    U_FIO: $(".traiv-order-default input[name=U_FIO]").val(),
                    U_NAME: $(".traiv-order-default input[name=U_NAME]").val(),
                    U_PHONE: $(".traiv-order-default input[name=U_PHONE]").val(),
                    U_EMAIL: $(".traiv-order-default input[name=U_EMAIL]").val(),
                    U_MANAGER: $(".traiv-order-default input[name=U_MANAGER]").val(),
                    U_INN: $(".traiv-order-default input[name=U_INN]").val(),
                    U_KPP: $(".traiv-order-default input[name=U_KPP]").val(),
                    U_CITY: $(".traiv-order-default input[name=U_CITY]").val(),
                    U_ADDRESS: $(".traiv-order-default input[name=U_ADDRESS]").val(),
                    
                    USER_DESCRIPTION: $(".traiv-order-default textarea[name=comments]").val()
                    
                }, 
                function(data) {

                    if (data.STATUS == "SUCCESS") {
                        $(".traiv-order-default .order.bg-white.clearfix").html('<div class="message-good">Ваш заказ №' + data.ORDER_ID + ' успешно оформлен, в ближайшее время с вами свяжется наш менеджер для уточнения деталей заказа.</div>');
                        
                    } else {
                        //alert(data.ERROR);
                        alert('В данный момент заказ через корзину временно недоступен! Воспользуйтесь функцией Заказ в 1 клик! Извините за временные неудобства!');

                    }
                }
                
            )
        
        return false
    })
    
    function updatePersonalOrder(sender) {
        var id = $(sender).attr("data-id");
        var quantity = $("input", sender).val();
        $.get(
            "/personal/cart/",
            {
                AJAX_MODE: "Y",
                ID: id,
                QUANTITY: quantity,
                TASK: "UPDATE_BASKET"            
            },
            function(data){
                $(".traiv-order-default .big-price span").text(data.TOTAL);
                $(".traiv-order-default .weight span").text(data.WEIGHT);
                $(data.ITEMS).each(function() {
                if (this.ID == id) {
                    $(".li-quantity span", sender).text(this.QUANTITY);
                }
            });
            }
        )
    }
});
