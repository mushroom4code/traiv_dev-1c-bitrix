(function(){
    $(document).ready(function(event) {

        const u = $('a#buy').attr('href');

        $('body').on('change', '#QUANTITY', function qty() {
            var q = $("#QUANTITY").val();
            var z = u+q;
            $('a#buy').attr({
                'href': z
            });

        })


        $(document).on('click', '[data-ajax-order-detail]', function(event){
            BX.showWait();
            event.preventDefault();
            var id = /id=\d+/g.exec(this.href);
            id = /\d+/g.exec(id[0])[0];

            console.log(event.currentTarget.href);

            var $b = $('[data-product_id="' + id + '"]');
            if($b.length) {//уже есть в корзине

                $b.find('.item-counter__increase').click();
            }else{
                sendAjaxOrderRequest(event.currentTarget.href);
            }

            var cord1 = $(".cart_total_count").offset()['left'];
            var cord2 = $(".cart_total_count").offset()['top'];
            var cord3 = $('#'+id).offset()['left'];
            var cord4 = $('#'+id).offset()['top'];
            var topTarget = cord4 - cord2;
            topTarget = topTarget*0.5;
            var leftTarget = cord1 - cord3;

            var clst = $('#'+id);

            clst
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', 'width' : '20%'})
                .appendTo("#itemid")
                .animate({opacity: 0.05,
                    left: leftTarget,
                    top: -topTarget,
                    width: 20}, 1000, function() {
                    $(this).remove();
                });

            BX.closeWait();

        });


    });

    function sendAjaxOrderRequest(url) {
        $.ajax({
            type: 'get',
            url: url,
            data: {
                ajax_basket: "Y"
            },
            success: function(){
                recalcBasketAjax({coupon: false});
                //  location.href=location.href;
            }
        });
    }
})();

$(document).ready(function(){



    $('.product-gallery a').click(function(e){

        let img  = $(this).attr("href");

        $("#main-image img").attr("src", img );

        e.preventDefault();

        return false;

    });




});