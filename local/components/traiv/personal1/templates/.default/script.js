$(function() {
    // +-
    $("body").on("click", ".traiv-personal-cart .container-count .minus", function() {
        var container = $(this).closest(".cart-item");
        var count = $("input", container).val();
        count = parseInt(count) - 1;
        if (count > 0) {
            $("input", container).val(count);
        }
        updatePersonalBasket(container);
    });
    $("body").on("click", ".traiv-personal-cart .container-count .plus", function() {
        var container = $(this).closest(".cart-item");
        var count = $("input", container).val();
        count = parseInt(count) + 1;
        $("input", container).val(count);
        updatePersonalBasket(container);
    });
    $("body").on("change", ".traiv-personal-cart .container-count input", function() {
        var container = $(this).closest(".cart-item");
        updatePersonalBasket(container);
    });
    
    // Удалить товар
    $("body").on("click", ".traiv-personal-cart .del a", function() {
        if ($(".cart-item:visible").length > 1) {
            var tr = $(this).closest(".cart-item");
            var id = $(tr).attr("data-id");
            $.get(
                window.location.pathname,
                {
                    AJAX_MODE: "Y",
                    ID: id,
                    TASK: "DELETE_PRODUCT_BASKET"
                },
                function(data){
                    $(".traiv-personal-cart .button-header .count").text(data.MESSAGE);
                    $(".traiv-personal-cart .total-summ span").text(data.TOTAL);
                    $(".traiv-personal-cart .total-weight span").text(data.WEIGHT);
                    $(tr).fadeOut();
                }
            )
            return false;
        } else {
            $(".traiv-personal-cart .delete_all").click();
            return false;
        }
    });
    
    // Удалить все
    $("body").on("click", ".traiv-personal-cart .delete_all", function() {
        $.get(
            window.location.pathname,
            {
                AJAX_MODE: "Y",
                TASK: "CLEAR_ALL_BASKET"
            },
            function(){
                $(".traiv-personal-cart .form, .traiv-personal-cart .button-header").hide();
                $(".traiv-personal-cart .clear-cart").fadeIn();
            }
        )
        return false;
    });
});

function updatePersonalBasket(sender) {
    var id = $(sender).attr("data-id");
    var quantity = $("input", sender).val();
    $.get(
        window.location.pathname,
        {
            AJAX_MODE: "Y",
            ID: id,
            QUANTITY: quantity,
            TASK: "UPDATE_BASKET"            
        },
        function(data){
            $(".traiv-personal-cart .total-summ span").text(data.TOTAL);
            $(".traiv-personal-cart .total-weight span").text(data.WEIGHT);
            $(data.ITEMS).each(function() {
                if (this.ID == id) {
                    $(".total", sender).text(this.TOTAL);
                }
            });
            
            //$(".total", sender).text(data["TOTAL_PRICE"]);
            //$(".albatros-right-button-default .button-basket > span").html(data.MESSAGE);
        }
    )
}