$(function() {
    // +-	
	
	$("body").on("click", "#lk-cart-list-shadow .catalog-list-line .catalog-list-quantity-area .quantity_link_minus", function() {
        var container = $(this).closest(".catalog-list-line");
        var count = parseInt($("input", container).val());
        var count_step = parseInt($("input", container).attr('step'));
        
        if (count != count_step) {
        	count -= count_step;
            $("input", container).val(count);
            updatePersonalBasket(container);
        }
        
    });
	
    $("body").on("click", "#lk-cart-list-shadow .catalog-list-line .catalog-list-quantity-area .quantity_link_plus", function(e) {
        e.preventDefault();
    	var container = $(this).closest(".catalog-list-line");
        var count = parseInt($("input", container).val());
        var count_step = parseInt($("input", container).attr('step'));
        
        //console.log('count' + count);
        count += count_step;
      //  count = parseInt(count) + 1;
        $("input", container).val(count);
        updatePersonalBasket(container);
    });
    
    $("body").on("keypress keyup blur", "#lk-cart-list-shadow .catalog-list-line .catalog-list-quantity-area input", function(event) {
    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    	
    	/*var container = $(this).closest(".catalog-list-line");
        updatePersonalBasket(container);*/
    });
    
    
    $("body").on("change", "#lk-cart-list-shadow .catalog-list-line .catalog-list-quantity-area input", function(e) {
    	e.preventDefault();
    	
    	var container = $(this).closest(".catalog-list-line");
        var count = parseInt($("input", container).val());
        var count_step = parseInt($("input", container).attr('step'));
        
        if (count < count_step) {
        	$("input", container).val(count_step);	
        } else {
        	$("input", container).val(count);
        }
        
        updatePersonalBasket(container);
    });
    
    // Удалить товар
    $("body").on("click", ".lk-cart-item-del", function() {
       
    	if ($(".catalog-list-line:visible").length > 1) {
            var tr = $(this).closest(".catalog-list-line");
            var id = $(tr).attr("data-id");
            $.get(
                window.location.pathname,
                {
                    AJAX_MODE: "Y",
                    ID: id,
                    TASK: "DELETE_PRODUCT_BASKET"
                },
                function(data){
                    //console.log(data);
                	$("#lk-cart-list .lk-cart-list-count").text(data.MESSAGE);
                    $("#lk-cart-list .lk-cart-list-total span").text(data.TOTAL);
                    $("#lk-cart-list .lk-cart-list-weight").text('Общий вес: ' + data.WEIGHT + ' гр.');
                    $(tr).fadeOut();
                }
            )
            return false;
        } else {
            $("#lk-cart-list .delete_all").click();
            return false;
        }
    });
    
    // Удалить все
    $("body").on("click", "#lk-cart-list .delete_all", function() {
        $.get(
            window.location.pathname,
            {
                AJAX_MODE: "Y",
                TASK: "CLEAR_ALL_BASKET"
            },
            function(){
                $("#lk-cart-list .row").hide();
                $("#lk-cart-empty-button").fadeIn();
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
            
        	$("#lk-cart-list .lk-cart-list-total span").text(data.TOTAL);
            $("#lk-cart-list .lk-cart-list-weight span").text(data.WEIGHT);
            $(data.ITEMS).each(function() {
            	if (this.ID == id) {
                    $(".total_line_item", sender).text(this.TOTAL);
                }
            });
            if (data.TOTAL_UNFORMATED < 5000) {
                $('.btn-group-blue-w').addClass('d-none');
                $('.check_type_pack_basket').removeClass('d-none');
            } else {
                $('.btn-group-blue-w').removeClass('d-none');
                $('.check_type_pack_basket').addClass('d-none');
            }


            $(".total").text(data["TOTAL"]);
            // $(".total", sender).text(data["TOTAL"]);
            //$(".albatros-right-button-default .button-basket > span").html(data.MESSAGE);
        }
    )
}