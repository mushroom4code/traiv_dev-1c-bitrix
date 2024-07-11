(function(){
    $(document).ready(function(event) {

      /*  $('body').on('change', '.quantity', function qty() {

            var val = ~~this.value || 0;
            var pack = ~~this.getAttribute('step') || 0;
            var krat = pack/2;
            if(val%pack < krat){
                if (val - val%pack != 0){
                    this.value = val - val%pack;
                } else {
                    this.value = pack;
                }
            } else if(val%pack > krat){
                this.value = Math.ceil(val/pack)*pack;
            }
            if (val <= 0){
                val = pack;
                this.value = pack;
            }

            if ($('[data-ajax-order]').length > 0 || $('[data-ajax-order-recomended]').length > 0 || $('[data-ajax-order-detail]').length) {


                let u = $(this).parent().parent().find($('[data-ajax-order]')).data("href");
                if (u === undefined) {
                    u = $(this).parent().parent().find($('[data-ajax-order-recomended]')).data("href");
                };
                if (u === undefined) {
                    u = $(this).parent().parent().find($('[data-ajax-order-detail]')).data("href");
                }
                let r = u.replace(/(QUANTITY=)[0-9]+/ig, '$1');
                let q = $(this).val();
                let a=r+q;
                $(this).parent().parent().find($('[data-ajax-order]')).data("href", a).attr({
                    'data-href': a
                });
                $(this).parent().parent().find($('[data-ajax-order-recomended]')).data("href", a).attr({
                    'data-href': a
                });
                $(this).parent().parent().find($('[data-ajax-order-detail]')).data("href", a).attr({
                    'data-href': a
                });

            }

        })*/


        //$('[data-ajax-order]').on('click', handleAjaxOrderClick);
        $(document).on('click', '[data-ajax-order]', function(event){
            BX.showWait();
            event.preventDefault();
            console.log('fff');
            let buyUrl = $(this).data("href");
            let id = /id=\d+/g.exec(buyUrl);

            id = /\d+/g.exec(id[0])[0];
            
            console.log(id);

            var $b = $('[data-product_id="' + id + '"]');
            if($b.length) {//уже есть в корзине

                /*$b.find('.item-counter__increase').click();*/

                let quant = $('#'+id+'-item-quantity').val();
                quant = parseInt(quant);
                let basketquant = $b.find('.item-counter__input').val();
                let basketID = parseInt($b.attr('id'));
                let sign = 'up';
                setQuantity(basketID, quant, sign, false);


            }else{

                sendAjaxOrderRequest(buyUrl);
            }

            var basket = $('#cart_total_count');  //TODO to function, crear mess

            var clst = $('#'+id);

            var cart_offset = $("#cart_total_count").offset();
            
            	$('.cart_tips').show();
            	$('.cart_tips').stop().animate({"opacity": "1"}, "200", function(){
            		
            		setTimeout(function(){
            			$('.cart_tips').stop().animate({"opacity": "0"},"200", function(){
            				$('.cart_tips').hide();
            			});
            		}, 1000);
            		
            	});

            
            
          /*  console.log(cart_offset);
            $('<style id="transferEffect" type="text/css">' + '.ui-effects-transfer { z-index:1000; opacity:0.5; border:1px solid #000000; background-image: url(' + $(clst).attr('src') + '); background-size: cover; }' + '</style>').appendTo('head');*/
            /*$(clst).effect("transfer", {
                clone: clst,
                to: basket
            }, 1000);*/



            BX.closeWait();

        });

        $(document).on('click', '[data-ajax-order-recomended], [data-ajax-order-detail]', function(event){
            BX.showWait();
            event.preventDefault();
            let buyUrl = $(this).data("href");
            let id = /id=\d+/g.exec(buyUrl);

            id = /\d+/g.exec(id[0])[0];

            var $b = $('[data-product_id="' + id + '"]');
            if($b.length) {//уже есть в корзине

                /*$b.find('.item-counter__increase').click();*/

                let quant = $('#'+id+'-item-quantity').val();
                quant = parseInt(quant);
                let basketquant = $b.find('.item-counter__input').val();
                let basketID = parseInt($b.attr('id'));
                let sign = 'up';
                setQuantity(basketID, quant, sign, false);

            }else{
            	
            	//let temp_quant = parseInt($('.prod-qnt-input').val());
            	
                sendAjaxOrderRequest(buyUrl/* + temp_quant*/);
            }
            
            $('.cart_tips').show();
        	$('.cart_tips').stop().animate({"opacity": "1"}, "200", function(){
        		
        		setTimeout(function(){
        			$('.cart_tips').stop().animate({"opacity": "0"},"200", function(){
        				$('.cart_tips').hide();
        			});
        		}, 1000);
        		
        	});

            BX.closeWait();

        });



        BX.addCustomEvent(window, 'OnBasketChange', function(){
            $('#cart_total_summ').html('на сумму ' + $('#allSum_FORMATED').html() + ' руб.');
            $('#cart_total_count').html($('#basket-content tr').length);


            var $p = $("td.cart__col.cart-item__price");

            $p.each(function() {
                var textsum = $(this).text();
                var replacer = $(this).find("span");

                if (textsum === '0 руб.'){
                    replacer.replaceWith('Запросить цену');
                }

            });

            if ( // because i got sick of jq text selectors
                (document.documentElement.textContent || document.documentElement.innerText).indexOf('Запросить цену') > -1
            ) {

                document.getElementById("allSum_FORMATED").textContent = "будет сформирована для вас менеджером";
            };

        });

        $('#basket-content').bind("DOMSubtreeModified", function(){
            if ($('#basket-content tr').length > 0) {
                $('.empty-cart').removeClass('active');
            }else{
                $('.empty-cart').addClass('active');
            }
        });

        $(document).on('click', '.btn-remove', function(event){
            BX.showWait();
            event.preventDefault();
            var $tr = $(this).closest('tr');
            var $reurl = this.href.replace('undefined','');
            $.ajax({
                type: 'GET',
                url: $reurl,
                data: {
                    ajax_basket: "Y",
                    basketAction: 'delete',
                    id: $tr.id
                },
                success: function(){
                    $tr.remove();
                    recalcBasketAjax({coupon: false});
                    BX.closeWait();
                }
            });
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
    /*function sendAjaxOrderRequestUpdate(url) {   TO DO - IF NO EMPTY UPDATE QUANTITY
        $.ajax({
            type: 'get',
            url: url,
            data: {
                ajax_basket: "Y"
            },
            success: function(){
                updateQuantity({
                    controlId: id,
                    basketId: id,
                    ratio: quant,
                    bUseFloatQuantity: false,
                    productID: id

                });
                //  location.href=location.href;
            }
        });
    }*/
})();