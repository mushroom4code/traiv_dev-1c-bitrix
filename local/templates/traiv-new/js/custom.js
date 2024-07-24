function getGridSize_brands() {
    return (window.innerWidth < 400) ? 1 :
        (window.innerWidth < 550) ? 2 :
            (window.innerWidth < 650) ? 3 :
                (window.innerWidth < 992) ? 4 :
                    (window.innerWidth < 1200) ? 5 : 6;
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).attr('rel')).select();
    document.execCommand("copy");
    $temp.remove();
}

$(document).ready(function () {
    $(window).on('hashchange', function (e) {
        if ($('.w-form__overlay:target').length || $('.w-form__overlay-one-click:target').length) {
            // $('html').css('margin-right', '17px');
            $('html').css('overflow', 'hidden')
        } else {
            // $('html').css('margin-right', '');
            $('html').css('overflow', '');
        }
    });

    if ($('.search-gso-area').length > 0) {
        $("#search_gso").on('keyup input', function () {
            var valFilter = $(this).val().toLowerCase();
            var lenFilter = $(this).val().toLowerCase().length;

            if (lenFilter > 0) {
                $(".gso_list_item").each(function () {
                    var $this = $(this);
                    var value = $this.attr("data-filter-val").toLowerCase();
                    if (value.length > 0) {
                        if (value.includes(valFilter)) {
                            $this.css('display', 'block');

                        } else {
                            $this.css('display', 'none');
                        }
                    }
                });
            } else {
                $(".gso_list_item").css('display', 'block');
            }
        });
    }

    if ($('#item-video-one-bg').length > 0) {
        $('.item-player').YTPlayer();
    }

    if ($('#item-video-content').length > 0) {
        $('.item-player-content').YTPlayer();
    }

    /*price-list-right*/

    /*full price*/
    $("body").on("click", "#getAllPrice", function (e) {
        e.preventDefault();
        $(this).closest('form').submit();
    });
    /*end full price*/

    if ($('.price-list-right-area').length > 0) {
        $('#price-list-right-area-button').on('click', function (e) {
            if ($('.price-list-right-area').hasClass('active')) {
                $('.price-list-right-area').stop().animate({'right': '-360px'}, 200, function () {
                    $('.price-list-right-area').removeClass('active');
                });
            } else {
                $('.price-list-right-area').stop().animate({'right': '0px'}, 200, function () {
                    $('.price-list-right-area').addClass('active');
                });
            }
        });

        $('body').on('click', function (e) {
            //console.log(e.target.className);
            if ((e.target.className !== 'price-list-right-span' && e.target.className !== 'button-area') && $('.price-list-right-area').hasClass('active')) {
                $('.price-list-right-area').stop().animate({'right': '-360px'}, 200, function () {
                    $('.price-list-right-area').removeClass('active');
                });
            }
        });
    }

    /*end price-list-right */

    /*popup-price-ex*/
    /*if ($('#price-popup').length > 0 && !$.cookie('price_list_popup') ) {

setTimeout(function(){

	$.magnificPopup.open({
	    items: {
	        src: '#price-popup'
	    },
	    type: 'inline',
	    midClick: true
	});

	$.cookie("price_list_popup", "1", {expires: 1, path: '/'});
	            $.ajax(
                {
                    type : "POST",
                    url: '/ajax/forms/pops.php',
                    data: "price_list_popup = 1",
                    success: function(){
                    }
                }
            );
},50000);


	}*/
    /*end popup-price-ex*/

    /*mp-serv-slider */
    /*end mp-serv-slider */

    if ($('.np-serv-slider').length > 0) {

        $('.np-serv-slider').slick({
            lazyLoad: 'ondemand',
            dots: true,
            arrows: false,
            nextArrow: '<i class="fa fa-arrow-circle-o-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-arrow-circle-o-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }

    if ($('.mp-serv-slider').length > 0) {

        $('.mp-serv-slider').slick({
            lazyLoad: 'ondemand',
            dots: true,
            arrows: false,
            nextArrow: '<i class="fa fa-arrow-circle-o-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-arrow-circle-o-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }


    if ($('.hr-serv-slider').length > 0) {

        $('.hr-serv-slider').slick({
            lazyLoad: 'ondemand',
            dots: false,
            arrows: false,
            nextArrow: '<i class="fa fa-arrow-circle-o-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-arrow-circle-o-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }

    /* mp-photogallery */
    //console.log('mobileDetect' + mobileDetect);
    if ($('.mpgallery-area').length > 0) {

        $('.mpgallery-area').slick({
            lazyLoad: 'ondemand',
            dots: false,
            arrows: false,
            nextArrow: '<i class="fa fa-arrow-circle-o-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-arrow-circle-o-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 6,
            slidesToScroll: 6,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }

    /* end mp-photogallery */

    /*LANDING LIST*/

    if ($('.land-case-area').length > 0) {

        /*$('.btn-land_nav_link').on('click',function(e){
			$(this).stop().animate({'left':'-50px'},100);
		});*/

        var $container = $('#pfolio');
        // init
        $container.isotope({
            // options
            itemSelector: '.portfolio-item',
            layoutMode: 'fitRows'
        });

        // Filter items
        $('#pfolio-filters').on('click', 'a', function (e) {
            e.preventDefault();
            var filterValue = $(this).attr('data-filter');
            $container.isotope({filter: filterValue});
        });

        $('.case-item-slick').slick({
            lazyLoad: 'ondemand',
            dots: false,
            arrows: true,
            nextArrow: '<i class="fa fa-angle-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }

    /*END LANDING LIST*/

    if ($('.header-new-servlink').length > 0) {
        $('.header-new-servlink').on('click', function (e) {
            e.preventDefault();
            if ($(this).hasClass('active') == true) {
                $(this).removeClass('active');
                $('.header-new-servarea').css('display', 'none');
            } else {
                $(this).addClass('active');
                $('.header-new-servarea').css('display', 'block');
            }
        });

        $('body').on('click', function (e) {
            if ($(e.target).closest('.header-new-servlink').length == 0) {
                $('.header-new-servarea').css('display', 'none');
                $('.header-new-servlink').removeClass('active');
            }
        });

    }

    if ($('.header-new-catlink').length > 0) {


        $('.mail-copied').on('click', function () {
            copyToClipboard($(this));
        });

        $('.header-new-catlink').on('click', function (e) {
            e.preventDefault();

            if ($('.header-new-servlink').hasClass('active') == true) {
                $('.header-new-servlink').removeClass('active');
                $('.header-new-servarea').css('display', 'none');
            }

            if ($(this).hasClass('active') == true) {
                $(this).removeClass('active');
                $('.header-new-catarea').css('display', 'none');
            } else {
                $(this).addClass('active');
                $('.header-new-catarea').css('display', 'block');
            }
        });

        $('body').on('click', function (e) {
            if ($(e.target).closest('.header-new-catlink').length == 0) {
                $('.header-new-catarea').css('display', 'none');
                $('.header-new-catlink').removeClass('active');
            }
        });

        $('#header-new-fixed-content').scrollToFixed({
            preFixed: function () {

                $('#logotype-area').removeClass('col-xl-3 col-lg-3 col-md-3');
                $('#logotype-area').addClass('col-xl-1 col-lg-1 col-md-1');
                $('.logotype').addClass('fixed');
                $('.logotype').stop().animate({'width': '100%'}, 100);
                $('#bottom-header').css('display', 'none');
                $('.right-button-form').removeClass('top-fixed').addClass('text-right');
                $('.w-form-recall-area').addClass('top-fixed');
                $('#header-new-catarea-copy').removeClass('col-xl-3 col-lg-3 col-md-3').addClass('col-xl-6 col-lg-6 col-md-6');
                $('#header-new-catarea-copy').appendTo('#catalog-copy-area');

                $('#header-new-servarea-copy').removeClass('col-xl-3 col-lg-3 col-md-3').addClass('col-xl-6 col-lg-6 col-md-6');
                $('#header-new-servarea-copy').appendTo('#catalog-copy-area');

                //$('.header-new-catlink').css('min-width','100px');
                $('.header-new-catlink').removeClass('w-auto');
                $('#catalog-copy-area-parent').removeClass('top-fixed');
                $('#header-new-top-search').removeClass('col-xl-5 col-lg-5 col-md-5 offset-xl-1 offset-lg-1 offset-md-1').addClass('col-xl-3 col-lg-3 col-md-3');
                $('#header-new-provo-top').addClass('fixed');
                $('#header-new-basket-line').addClass('top-fixed');
                $('#header-new-fixed-icon-area').removeClass('top-fixed');
                $('.header-new-catarea').addClass('width-fixed');
                $('#ajax_basket').appendTo('#ajax-basket-copy-parent');
                $('.header-new-cart-area').addClass('hn-fixed');
            },
            preUnfixed: function () {
                $('#logotype-area').removeClass('col-xl-1 col-lg-1 col-md-1');
                $('#logotype-area').addClass('col-xl-3 col-lg-3 col-md-3');
                $('.logotype').removeClass('fixed');
                $('.logotype').stop().animate({'width': '100%'}, 100);
                $('#bottom-header').css('display', 'block');
                $('.right-button-form').addClass('top-fixed').removeClass('text-right');
                $('.w-form-recall-area').removeClass('top-fixed');
                //$('.header-new-catlink').css('min-width','200px');
                $('.header-new-catlink').addClass('w-auto');
                $('#catalog-copy-area-parent').addClass('top-fixed');

                $('#header-new-servarea-copy').prependTo('#header-new-catarea-copy-parent');
                $('#header-new-servarea-copy').removeClass('col-xl-6 col-lg-6 col-md-6').addClass('col-xl-3 col-lg-3 col-md-3');

                $('#header-new-catarea-copy').prependTo('#header-new-catarea-copy-parent');
                $('#header-new-catarea-copy').removeClass('col-xl-6 col-lg-6 col-md-6').addClass('col-xl-3 col-lg-3 col-md-3');

                $('#header-new-provo-top').removeClass('fixed');
                $('#header-new-top-search').removeClass('col-xl-3 col-lg-3 col-md-3').addClass('col-xl-5 col-lg-5 col-md-5 offset-xl-1 offset-lg-1 offset-md-1');
                $('#header-new-basket-line').removeClass('top-fixed');
                $('#header-new-fixed-icon-area').addClass('top-fixed');
                $('.header-new-catarea').removeClass('width-fixed');
                $('#ajax_basket').appendTo('#header-new-basket-line');
                $('.header-new-cart-area').removeClass('hn-fixed');
            }
        });

    }

    if ($.cookie('fav_list')) {
        var fav_list = $.parseJSON($.cookie("fav_list"));
    } else {
        var fav_list = [];
    }

    if ($('.search-text-custom-area').length > 0) {
        //console.log($('.search-text-custom-area').length);
        $('.check-data-search').on('mouseenter', function (e) {
            e.preventDefault();
            $(this).children('.category-item-fullname').css('display', 'block');
        });

        $('.check-data-search').on('mouseleave', function (e) {
            e.preventDefault();
            $(this).children('.category-item-fullname').css('display', 'none');
        });
    }

    /*bonus-block-item*/
    /*if($('#bonus-block-item').length > 0) {
		$('#bonus-block-item-run').on('click', function(e){
			e.preventDefault();
			$('#bonus-block-item').fadeIn();

			$('.bonus-block-item-area').each(function(index) {
			    $(this).delay(100*index).fadeIn(300);
			});
		})
	}*/

    /*function getRandomIntInclusive(min, max) {
		  min = Math.ceil(min);
		  max = Math.floor(max);
		  return Math.floor(Math.random() * (max - min + 1)) + min;
		}

	if($('.import-title-back-black').length > 0) {
		$('.import-title-cloud-item').each(function(){
			console.log(getRandomIntInclusive(30,70));
			$(this).css('top',getRandomIntInclusive(10,90) + '%');
		});
	}*/

    if ($('.lk-progress-gift').length > 0) {

        $('.lk-item').each(function (index) {
            $(this).delay(200 * index).fadeIn(100);
        });

        setTimeout(function () {
            $('.lk-progress-line-res').animate({width: '17%'}, 1000);
        }, 2000);

    }

    /*end bonus-block-item*/


    /*eShopDelivery Button*/

    function getDeliveryLen() {
        if ($('.widget-services-list').length > 0) {
            return true;
        }
        return false;
    }

    if ($('.setDeliveryShop').length > 0) {

        console.log('$(".widget-form")' + $(".widget-form"));

        $('body').on('submit', 'form.widget-form', function (e) {

            setTimeout(checkDeliveryWidjet, 10);

            function checkDeliveryWidjet() {
                if (getDeliveryLen() == false) {
                    setTimeout(checkDeliveryWidjet, 10);
                } else {
                    setDeliveryCheckbox();
                }
            }

        });

        function setDeliveryCheckbox() {
            $.each($(".widget-service"), function () {
                let inEl = $(this).find('.widget-service__logo');
                $("<div class='widget-check-area' style='position:absolute;top:10px;'><input class='form-check-input widget-check' style='cursor:pointer;' type='checkbox'></div>").insertBefore(inEl);
            });
        }

        $('.setDeliveryShop').on('click', function () {

            $('.delivery-block-vid').remove();
            var del_from = $('.widget-input-search__input').eq(0).val();
            var del_to = $('.widget-input-search__input').eq(1).val();
            var del_weight = $('*[placeholder="Общий вес"]').val();/*$('.widget-input_size-medium').eq(0).val();*/
            var del_info_item = "";
            var del_info_item_form = "";

            $.each($(".widget-service"), function () {

                var checkItem = $(this).find('.widget-check-area').children('.widget-check').is(":checked");
                if (checkItem) {
                    del_info_item += "\n";
                    del_info_item += $(this).find('.widget-image').attr('alt');
                    del_info_item += " - ";
                    del_info_item += $(this).find('.widget-service__description').text();

                    del_info_item_form += "<br>";
                    del_info_item_form += $(this).find('.widget-image').attr('alt');
                    del_info_item_form += " - ";
                    del_info_item_form += $(this).find('.widget-service__description').text();
                }
            });
            //console.log('del_from' + del_from + ' del_to ' + del_to + ' del_weight ' + del_weight);
            $("input[name='FIELDS[HIDDEN]']").val('Откуда:  ' + del_from + ' \n Куда: ' + del_to + '\n Вес: ' + del_weight + '\n' + del_info_item);
            //console.log(del_info_item.length);
            if (del_info_item.length > 0) {
                var toforminfo = 'Откуда:  ' + del_from + ' <br> Куда: ' + del_to + '<br> Вес: ' + del_weight + '<br>' + del_info_item_form
                $("#FORM6").find('.col-xs-12').eq(2).after('<div class="col-xs-12 delivery-block-vid">' + toforminfo + '</div>');
            }
            //console.log($("#FORM6").find('.col-xs-12').eq(3));
            //console.log('setDeliveryShop');
        });
    }


    $('.new-2020.input_tel').mask("+7(999) 999-99-99");

    /*if ($('.bp-area-button').length > 0) {

		function bp_loop() {

			$('.font').animate({opacity:'1'}, 500);
			$('.font').animate({opacity:'0.5'}, 500, bp_loop);

	    }
		bp_loop();

	}*/

    if ($('.slider').length > 0) {
        //$('.slider_preloader').animate({'opacity':0},1500,function(){
        $/*(this).css('display','none');
			$('.slider').fadeIn('normal');*/
        $('.slider').bxSlider({
            adaptiveHeight: true,
            mode: 'horizontal',
            infiniteLoop: true,
            auto: true,
            autoStart: true,
            autoDirection: 'next',
            autoHover: true,
            pause: 7000,
            autoControls: false,
            pager: true,
            pagerType: 'full',
            controls: true,
            captions: true,
            speed: 500,
            easing: 'linear',
            preloadImages: 'visible'
        });
        //});
    }

    if ($('.bxslider_catalog').length > 0) {

        /*$('.bxslider_catalog').bxSlider({
				adaptiveHeight: true,
				mode: 'horizontal',
				infiniteLoop: true,
				auto: true,
				autoStart: true,
				autoDirection: 'next',
				autoHover: false,
				pause: 3000,
				autoControls: false,
				pager: true,
				pagerType: 'full',
				controls: false,
				captions: true,
				speed: 500,
				easing: 'linear',
				preloadImages: 'visible'
			});*/
    }

    $(".up_area").bind("click", function (t) {
        t.preventDefault(),
            $("body,html").animate({
                scrollTop: 0
            }, 400)
    });


    $(window).scroll(function () {

        if (mobileDetect == true) {
            var up_bottom = 100;
        } else {
            var up_bottom = 180;
        }


        if ($(this).scrollTop() > 1400) {
            $(".up_area").css('visibility', 'visible');
            $(".up_area").stop().animate({opacity: '1', bottom: up_bottom + 'px'}, 200);
        } else {
            $(".up_area").stop().animate({opacity: '0', bottom: '20px'}, 200, function () {
                $(".up_area").css('visibility', 'hidden');
            });
        }
    });

    /*needcalloper func*/

    $('#needOperCall').on('change.bootstrapSwitch', function (e) {

        if (e.target.checked == true) {
            $('.needcallopercheck .soa-property-container').find(":hidden:eq(0)").val('Y');
            $('.needcallopercheck .soa-property-container').find(":checkbox:eq(0)").attr("checked", "checked");
        } else {
            $('.needcallopercheck .soa-property-container').find(":hidden:eq(0)").val('N');
            $('.needcallopercheck .soa-property-container').find(":checkbox:eq(0)").removeAttr("checked");
        }
    });

    /*needcalloper func end*/

    function toggleClass(item, target, state) {
        $('body').on('click', item, function (e) {
            var $this = $(this);
            if (!$this.closest(target).hasClass(state)) {
                $this.closest(target).addClass(state);
            } else {
                $this.closest(target).removeClass(state);
            }
            e.preventDefault();
        });
    }

    toggleClass('.btn-collapse', '.order-table__item', 'is-opened');

    /*edu-map */

    if ($('#edu-map').length > 0) {

        var offices_edu = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.899466, 30.502386],
                        name: "Санкт-Петербург",
                        address: "193168, Кудрово, Центральная ул., д.41",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_edu);

            function init_edu() {

                var myMap = new ymaps.Map('edu-map', {
                    center: [59.899466, 30.502386],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_edu.length; i < l; i++) {
                    createMenuGroup(offices_edu[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 1000);

    }


    /*end edu-map */

    if ($('#map_spb').length > 0) {

        var offices_spb = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.899466, 30.502386],
                        name: "Санкт-Петербург",
                        address: "193168, Кудрово, Центральная ул., д.41",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_spb);

            function init_spb() {

                var myMap = new ymaps.Map('map_spb', {
                    center: [59.899466, 30.502386],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_spb.length; i < l; i++) {
                    createMenuGroup(offices_spb[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_service').length > 0) {
        console.log('this');
        var map_service_point = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.82477806431605, 30.52483449999998],
                        name: "Санкт-Петербург",
                        address: "192177, г. Санкт-Петербург, Россия, Санкт-Петербург​, ул. Караваевская 57С",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                    }
                ]
            }
        ];

        setTimeout(function () {
            console.log('this');
            ymaps.ready(init_service_map);

            function init_service_map() {
                console.log('this');
                var myMap = new ymaps.Map('map_service', {
                    center: [59.82477806431605, 30.52483449999998],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = map_service_point.length; i < l; i++) {
                    createMenuGroup(map_service_point[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_spb2').length > 0) {

        var offices_spb2 = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.94799156416559, 30.268050499999962],
                        name: "Санкт-Петербург",
                        address: "199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_spb2);

            function init_spb2() {

                var myMap = new ymaps.Map('map_spb2', {
                    center: [59.94799156416559, 30.268050499999962],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_spb2.length; i < l; i++) {
                    createMenuGroup(offices_spb2[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_kazan').length > 0) {

        var offices_kazan = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [55.76530556897139, 49.12703949999988],
                        name: "Казань",
                        address: "420021, Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502",
                        phone: " 8 (800) 333-91-16 доб. 183",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_eka);

            function init_eka() {

                var myMap = new ymaps.Map('map_kazan', {
                    center: [55.76530556897139, 49.12703949999988],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_kazan.length; i < l; i++) {
                    createMenuGroup(offices_kazan[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_eka').length > 0) {

        var offices_eka = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [56.759587067959714, 60.624405999999965],
                        name: "Екатеринбург",
                        address: "620024, Екатеринбург, Елизаветинское шоссе, 39",
                        phone: " 8 (343) 288-79-40",
                        phone1: "",
                        worktime: "ПН-ПТ: 11:00 - 19:30",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_eka);

            function init_eka() {

                var myMap = new ymaps.Map('map_eka', {
                    center: [56.759587067959714, 60.624405999999965],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_eka.length; i < l; i++) {
                    createMenuGroup(offices_eka[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_perm').length > 0) {

        var offices_eka = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [57.99185506657476, 56.20378749999999],
                        name: "Пермь",
                        address: "614066, Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36",
                        phone: " 8 (965) 060-59-95",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_perm);

            function init_perm() {

                var myMap = new ymaps.Map('map_perm', {
                    center: [57.99185506657476, 56.20378749999999],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_eka.length; i < l; i++) {
                    createMenuGroup(offices_eka[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_krasnodar').length > 0) {

        var offices_eka = [
            {
                style: "islands#redIcon",
                items: [
                    {
                        center: [45.09197107458731, 39.00153499999998],
                        name: "Краснодар",
                        address: "350024, Краснодар, ул. Московская д.123, оф. 207",
                        phone: " 8 (800) 333-91-16 доб. 189",
                        phone1: "",
                        worktime: "ПН-ПТ: 8:00 - 17:30",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_perm);

            function init_perm() {

                var myMap = new ymaps.Map('map_krasnodar', {
                    center: [45.09197107458731, 39.00153499999998],
                    zoom: 15
                }, {
                    searchControlProvider: 'yandex#search'
                });
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices_eka.length; i < l; i++) {
                    createMenuGroup(offices_eka[i]);
                }

                function createMenuGroup(office) {
                    var collection = new ymaps.GeoObjectCollection(null, {preset: office.style});

                    myMap.geoObjects.add(collection);
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection);
                    }
                }

                function createSubMenu(item, collection) {
                    var placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    placemark.balloon.open();

                }
            }

        }, 2000);

    }

    if ($('#map_mos').length > 0) {

        var offices = [
            {
                name: "Офис и склад в Москве",
                style: "islands#redIcon",
                items: [
                    {
                        center: [55.73044106903082, 37.73674299999999],
                        name: "Москва - Офис",
                        address: 'Россия, Москва, Рязанский проспект, 2с49, БЦ "Карачарово", офис 203',
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 8:00 - 17:30",
                    },
                    {
                        center: [55.7297615689993, 38.08167799999997],
                        name: "Москва - Склад",
                        address: "143921, Москва, Балашиха, д. Дятловка, владение 57 А",
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 17:00",
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init_mos);

            function init_mos() {


                var myMap = new ymaps.Map('map_mos', {
                        center: [55.73044106903082, 37.73674299999999],
                        zoom: 15
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    menu = $('<ul class="office_menu_mp"/>');
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices.length; i < l; i++) {
                    createMenuGroup(offices[i]);
                }

                function createMenuGroup(office) {
                    var menuItem = $('<li><div class="office_menu_mp_title">' + office.name + '</div></li>'),
                        collection = new ymaps.GeoObjectCollection(null, {preset: office.style}),
                        submenu = $('<ul class="submenu"/>');

                    myMap.geoObjects.add(collection);
                    menuItem
                        .append(submenu)
                        .appendTo(menu)
                        .find('a')
                        .bind('click', function () {
                            if (collection.getParent()) {
                                myMap.geoObjects.remove(collection);
                                submenu.hide();
                            } else {
                                myMap.geoObjects.add(collection);
                                submenu.show();
                            }
                        });
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection, submenu);
                    }
                }

                function createSubMenu(item, collection, submenu) {
                    var submenuItem = $('<li><a href="#"><div>' + item.name + '</div><div>' + item.address + '</div></a></li>'),
                        placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    submenuItem
                        .appendTo(submenu)
                        .find('a')
                        .bind('click', function () {
                            if (!placemark.balloon.isOpen()) {
                                placemark.balloon.open();
                                myMap.setCenter(new_center, 15);
                            } else {
                                placemark.balloon.close();
                            }
                            return false;
                        });
                }

                menu.appendTo($('.map_office_area'));
            }

        }, 2000);
    }


    if ($('#map_mp').length > 0) {

        var offices = [
            {
                name: "Наши адреса",
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.899466, 30.502386],
                        name: "Санкт-Петербург",
                        address: "193168, Кудрово, Центральная ул., д.41",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/contacts/sankt-peterburg/"
                    },
                    {
                        center: [59.94799156416559, 30.268050499999962],
                        name: "Санкт-Петербург",
                        address: "199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                        link: "https://traiv-komplekt.ru/contacts/sankt-peterburg2/"
                    },
                    {
                        center: [55.73044106903082, 37.73674299999999],
                        name: "Москва - Офис",
                        address: 'Россия, Москва, Рязанский проспект, 2с49, БЦ "Карачарово", офис 203',
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/msk-office/"
                    },
                    {
                        center: [55.7297615689993, 38.08167799999997],
                        name: "Москва - Склад",
                        address: "143921, Москва, Балашиха, д. Дятловка, владение 57 А",
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 17:00",
                        link: "https://traiv-komplekt.ru/contacts/moskva/"
                    },
                    {
                        center: [59.82477806431605, 30.52483449999998],
                        name: "Производство",
                        address: "192177, г. Санкт-Петербург, Россия, Санкт-Петербург​, ул. Караваевская 57С",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                        link: "https://traiv-komplekt.ru/contacts/service/"
                    },
                    {
                        center: [57.99185506657476, 56.20378749999999],
                        name: "Пермь",
                        address: "614066, Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36",
                        phone: " 8 (965) 060-59-95",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                        link: "https://traiv-komplekt.ru/contacts/perm/"
                    },
                    {
                        center: [45.09197107458731, 39.00153499999998],
                        name: "Краснодар",
                        address: "350024, Краснодар, ул. Московская д.123, оф. 207",
                        phone: " 8 (800) 333-91-16 доб. 189",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/contacts/krasnodar/"
                    }, {
                        center: [55.76530556897139, 49.12703949999988],
                        name: "Казань",
                        address: "420021, Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502",
                        phone: " 8 (800) 333-91-16 доб. 183",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                        link: "https://traiv-komplekt.ru/contacts/kazan/"
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init);

            function init() {


                var myMap = new ymaps.Map('map_mp', {
                        center: [59.899466, 30.502386],
                        zoom: 15
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    menu = $('<ul class="office_menu_mp"/>');
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices.length; i < l; i++) {
                    createMenuGroup(offices[i]);
                }

                function createMenuGroup(office) {
                    var menuItem = $('<li><div class="office_menu_mp_title">' + office.name + '</div></li>'),
                        collection = new ymaps.GeoObjectCollection(null, {preset: office.style}),
                        submenu = $('<ul class="submenu"/>');

                    myMap.geoObjects.add(collection);
                    menuItem
                        .append(submenu)
                        .appendTo(menu)
                        .find('a')
                        .bind('click', function () {
                            if (collection.getParent()) {
                                myMap.geoObjects.remove(collection);
                                submenu.hide();
                            } else {
                                myMap.geoObjects.add(collection);
                                submenu.show();
                            }
                        });
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection, submenu);
                    }
                }

                function createSubMenu(item, collection, submenu) {
                    var submenuItem = $('<li><a href="#" class="map-link-main"><div>' + item.name + '</div><div>' + item.address + '</div></a><a href="' + item.link + '" class="map-link-more"><div class="active">Подробнее</div></a></li>'),
                        placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li><li><i class="fa fa-link"></i><a href="' + item.link + '">Подробнее...</li></ul></div>'});
                    var new_center = item.center;
                    collection.add(placemark);
                    submenuItem
                        .appendTo(submenu)
                        .find('a.map-link-main')
                        .bind('click', function () {
                            if (!placemark.balloon.isOpen()) {
                                placemark.balloon.open();
                                myMap.setCenter(new_center, 15);
                            } else {
                                placemark.balloon.close();
                            }
                            return false;
                        });
                }

                menu.appendTo($('.map_office_area'));
            }

            /*var MAP = new ymaps.Map("map_mp",{center: [59.899466, 30.502386],zoom: 13});
	        ymaps.ready(function() {
	            place = new ymaps.Placemark([59.899466, 30.502386]);
	            MAP.geoObjects.add(place);
	            MAP.behaviors.disable('scrollZoom')
	        });*/
        }, 2000);
    }


    /* np-new-map */
    if ($('#map_mp_np').length > 0) {

        var offices = [
            {
                name: "Наши адреса",
                style: "islands#redIcon",
                items: [
                    {
                        center: [59.899466, 30.502386],
                        name: "Санкт-Петербург",
                        address: "193168, Кудрово, Центральная ул., д.41",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/contacts/sankt-peterburg/"
                    },
                    {
                        center: [59.94799156416559, 30.268050499999962],
                        name: "Санкт-Петербург",
                        address: "199178, г. Санкт-Петербург, набережная реки Смоленки, д. 14",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                        link: "https://traiv-komplekt.ru/contacts/sankt-peterburg2/"
                    },
                    {
                        center: [55.73044106903082, 37.73674299999999],
                        name: "Москва - Офис",
                        address: 'Россия, Москва, Рязанский проспект, 2с49, БЦ "Карачарово", офис 203',
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/msk-office/"
                    },
                    {
                        center: [55.7297615689993, 38.08167799999997],
                        name: "Москва - Склад",
                        address: "143921, Москва, Балашиха, д. Дятловка, владение 57 А",
                        phone: "8 (495) 374-82-70",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 17:00",
                        link: "https://traiv-komplekt.ru/contacts/moskva/"
                    },
                    {
                        center: [59.82477806431605, 30.52483449999998],
                        name: "Производство",
                        address: "192177, г. Санкт-Петербург, Россия, Санкт-Петербург​, ул. Караваевская 57С",
                        phone: "8 (812) 313-22-80",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 18:00",
                        link: "https://traiv-komplekt.ru/contacts/service/"
                    },
                    {
                        center: [57.99185506657476, 56.20378749999999],
                        name: "Пермь",
                        address: "614066, Пермь, шоссе Космонавтов 111И, корпус 1, 2 этаж, офис 36",
                        phone: " 8 (965) 060-59-95",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                        link: "https://traiv-komplekt.ru/contacts/perm/"
                    },
                    {
                        center: [45.09197107458731, 39.00153499999998],
                        name: "Краснодар",
                        address: "350024, Краснодар, ул. Московская д.123, оф. 207",
                        phone: " 8 (800) 333-91-16 доб. 189",
                        phone1: "",
                        worktime: "ПН-ПТ: 08:00 - 17:30",
                        link: "https://traiv-komplekt.ru/contacts/krasnodar/"
                    }, {
                        center: [55.76530556897139, 49.12703949999988],
                        name: "Казань",
                        address: "420021, Казань, ул. Габдуллы Тукая д. 115, к.3, оф. 502",
                        phone: " 8 (800) 333-91-16 доб. 183",
                        phone1: "",
                        worktime: "ПН-ПТ: 10:00 - 19:30",
                        link: "https://traiv-komplekt.ru/contacts/kazan/"
                    }
                ]
            }
        ];

        setTimeout(function () {

            ymaps.ready(init);

            function init() {


                var myMap = new ymaps.Map('map_mp_np', {
                        center: [52.62694227423576, 54.814671575435234],
                        zoom: 4
                    }, {
                        searchControlProvider: 'yandex#search'
                    }),
                    menu = $('<ul class="office_menu_mp"/>');
                myMap.behaviors.disable('scrollZoom')

                for (var i = 0, l = offices.length; i < l; i++) {
                    createMenuGroup(offices[i]);
                }

                function createMenuGroup(office) {
                    var menuItem = $('<li><div class="office_menu_mp_title">' + office.name + '</div></li>'),
                        collection = new ymaps.GeoObjectCollection(null, {preset: office.style}),
                        submenu = $('<ul class="submenu"/>');

                    myMap.geoObjects.add(collection);
                    menuItem
                        .append(submenu)
                        .appendTo(menu)
                        .find('a')
                        .bind('click', function () {
                            if (collection.getParent()) {
                                myMap.geoObjects.remove(collection);
                                submenu.hide();
                            } else {
                                myMap.geoObjects.add(collection);
                                submenu.show();
                            }
                        });
                    for (var j = 0, m = office.items.length; j < m; j++) {
                        createSubMenu(office.items[j], collection, submenu);
                    }
                }

                function createSubMenu(item, collection, submenu) {
                    var submenuItem = $('<li><a href="#" class="map-link-main"><div>' + item.name + '</div><div>' + item.address + '</div></a><a href="' + item.link + '" class="map-link-more"><div class="active">Подробнее</div></a></li>'),
                        placemark = new ymaps.Placemark(item.center, {balloonContent: '<div class="bTitle">' + item.name + '</div><div><ul class="bList"><li><i class="fa fa-map-marker"></i>' + item.address + '</li><li><i class="fa fa-phone"></i>' + item.phone + item.phone1 + '</li><li><i class="fa fa-clock-o"></i>' + item.worktime + '</li><li><i class="fa fa-link"></i><a href="' + item.link + '">Подробнее...</li></ul></div>'}, {
                            // Опции.
                            // Необходимо указать данный тип макета.
                            iconLayout: 'default#image',
                            // Своё изображение иконки метки.
                            iconImageHref: '/local/templates/traiv-new/images/logo-maps1.png',
                            // Размеры метки.
                            iconImageSize: [30, 30],
                            // Смещение левого верхнего угла иконки относительно
                            // её "ножки" (точки привязки).
                            iconImageOffset: [-5, -38]
                        });
                    var new_center = item.center;
                    collection.add(placemark);
                    submenuItem
                        .appendTo(submenu)
                        .find('a.map-link-main')
                        .bind('click', function () {
                            if (!placemark.balloon.isOpen()) {
                                placemark.balloon.open();
                                myMap.setCenter(new_center, 15);
                            } else {
                                placemark.balloon.close();
                            }
                            return false;
                        });
                }

                menu.appendTo($('.map_office_area'));
            }

            /*var MAP = new ymaps.Map("map_mp",{center: [59.899466, 30.502386],zoom: 13});
	        ymaps.ready(function() {
	            place = new ymaps.Placemark([59.899466, 30.502386]);
	            MAP.geoObjects.add(place);
	            MAP.behaviors.disable('scrollZoom')
	        });*/
        }, 2000);
    }
    /* end np-new-map */
    /*$('#title-search-input').on('focus',function() {
		$('.top-phone').parent().css('display','none');
		$('#ajax_basket').parent().css('display','none').removeClass('d-lg-block');
		$('#title-search').animate({'width':'100%'},500);
	});*/

    //SmoothScroll({ stepSize: 60 });

    var mobileDetect = false;

    function checkMobile() {
        if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)) {
            mobileDetect = true;
        }
        ;
    }

    checkMobile();

    if ($('#mfi-FORM12_FIELD_DOCS-button').children('.webform-button-upload').length > 0) {
        $('#vac-form').find('.webform-button-upload').text('Прикрепить резюме');
        if (mobileDetect == true) {
            $("#vac-form").detach().appendTo(".vac-form-copy");
        }
    }


    $('#topbottom').scrollToFixed({
        preFixed: function () {
            //$('#mainmenu').scrollToFixed();
            $('#topbottom .topbottom_scroll').css('min-height', '60px');
            $('#title-search').parent()
                .removeClass('col-xl-5 col-lg-5 col-md-5 ')
                .addClass('col-xl-3 col-lg-3 col-md-3');
            $('#scroll-to-fixed-button').css('display', 'block');
            $('.logotype').children('img').stop().animate({'width': '70%'}, 100);
            $('.logotype-description').css('display', 'none');
            //$('.logotype').children('img').css('width','70%');
            //$('.logotype').children('img').stop().animate({'width':'70%'},100);
        },
        postFixed: function () {
            //$('.logotype').children('img').css('width','100%');
            $('.logotype').children('img').stop().animate({'width': '80%'}, 100);
            $('.logotype-description').css('display', 'block');
        },
        preUnfixed: function () {
            $('#topbottom .topbottom_scroll').css('min-height', '110px');
            $('#title-search').parent()
                .removeClass('col-xl-3 col-lg-3 col-md-3')
                .addClass('col-xl-5 col-lg-5 col-md-5');
            $('#scroll-to-fixed-button').css('display', 'none');
        },
        minWidth: 576,
        zIndex: 1003
    });


    if (!mobileDetect) {

        if ($('#topbottom').hasClass('scroll-to-fixed-fixed') == true) {
            setTimeout(function () {
                var topbottomH = $('#topbottom').outerHeight();
                $('#mainmenu').scrollToFixed({marginTop: topbottomH});
            }, 200);

        } else {
            var topnavH = $('#topnav').height() - 8;
            var topbottomH = $('#topbottom').height();
            $('#mainmenu').scrollToFixed({marginTop: topbottomH - topnavH});
        }
    } else {
        $('#mainmenu').scrollToFixed();
    }


    //$('#mainmenu').scrollToFixed();

    /*favorites*/
    $('.prod-favorites').on('click', function (e) {
        e.preventDefault();

        var element_id = parseInt($(this).attr('data-fid'));
        var index = getArrayIndexForKey(fav_list, "element_id", element_id);


        if (element_id > 0 && index == -1) {
            fav_list.push({'element_id': element_id});
            $(this).addClass('prod-favorites-active');
            $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
            $('#prod-favorites-top-count').text(fav_list.length);
        } else if (element_id > 0 && index >= 0) {
            fav_list = $.grep(fav_list, function (e) {
                return e.element_id != element_id;
            });
            $(this).removeClass('prod-favorites-active');
            $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
            $('#prod-favorites-top-count').text(fav_list.length);
        }

    });


    $('body').on('click', '.catalog-item-tile-favorites-link', function (e) {
        e.preventDefault();

        var element_id = parseInt($(this).attr('data-fid'));
        var index = getArrayIndexForKey(fav_list, "element_id", element_id);


        if (element_id > 0 && index == -1) {
            fav_list.push({'element_id': element_id});
            $(this).children('i').removeClass('fa-heart-o').addClass('fa-heart');
            $(this).attr('alt', 'Удалить из избранного').attr('title', 'Удалить из избранного');
            $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
            $('#prod-favorites-top-count').text(fav_list.length);
        } else if (element_id > 0 && index >= 0) {
            fav_list = $.grep(fav_list, function (e) {
                return e.element_id != element_id;
            });
            $(this).children('i').removeClass('fa-heart').addClass('fa-heart-o');
            $(this).attr('alt', 'Удалить из избранного').attr('title', 'Удалить из избранного');
            $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
            $('#prod-favorites-top-count').text(fav_list.length);
        }

    });

    if ($.fn.magnificPopup) {
        $('.btn-one-click').magnificPopup({
            type: 'inline',
            preloader: false,
            fixedContentPos: false,
            /* callbacks: {
	            open: function() {
	            	$('.backlayer').removeClass('active');
	            }
            }*/
        });

    }

    /*menu tips*/
    $('.link_location').on('click', function (e) {
        e.preventDefault();
        $('.menu_tips').toggleClass('active');
    });

    $('.menu_tips_link').on('click', function (e) {
        e.preventDefault();
        var loc_val = $(this).attr('id');
        var loc_name = $(this).text();
        $('.top_location_text').text(loc_name);
        $('.top-phone').children('a').css('display', 'none');
        $('#' + loc_val + '_phone').css('display', 'block');
        $('.menu_tips').toggleClass('active');
    });

    /*end menu tips*/

    $('.prod-favorites-remove').on('click', function (e) {
        e.preventDefault();

        var element_id = parseInt($(this).attr('data-fid-remove'));
        var index = getArrayIndexForKey(fav_list, "element_id", element_id);

        fav_list = $.grep(fav_list, function (e) {
            return e.element_id != element_id;
        });
        $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
        $('#prod-favorites-top-count').text(fav_list.length);
        location.reload();
    });


    function getArrayIndexForKey(arr, key, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == val)
                return i;
        }
        return -1;
    }

    /*end favorites*/

    /*DelPayBlock*/
    $('.delivery_block_link').on('click', function (e) {
        e.preventDefault();
        if ($(this).hasClass('btn-gray-round') == true) {
            $('#delivery_block').toggleClass('active');
            $('#payment_block').toggleClass('active');
            $(this).removeClass('btn-gray-round').addClass('btn-blue-round');
            $('.payment_block_link').removeClass('btn-blue-round').addClass('btn-gray-round');
        }
    });

    $('.payment_block_link').on('click', function (e) {
        e.preventDefault();
        if ($(this).hasClass('btn-gray-round') == true) {
            $('#delivery_block').toggleClass('active');
            $('#payment_block').toggleClass('active');
            $(this).removeClass('btn-gray-round').addClass('btn-blue-round');
            $('.delivery_block_link').removeClass('btn-blue-round').addClass('btn-gray-round');
        }

    });
    /*end DelPayBlock*/

    /*header basket*/
    var cart_toggle_open = true;
    $('.cart__toggle').on('click', function () {
        $('.cart__dropdown').toggleClass('active');
        $('.backlayer').toggleClass('active');

        if (cart_toggle_open == true) {
            var areaH = $('.cart__dropdown').height() - 50;
            $('.cart-inner-area').css('height', areaH + 'px');
            cart_toggle_open = false;
        }

        new SimpleBar($('.cart-inner-area')[0], {
            autoHide: false,
            classNames: {
                content: 'simplebar-content-cart',
                scrollContent: 'simplebar-scroll-content',
                scrollbar: 'simplebar-scrollbar',
                track: 'simplebar-track'

            }
        });
    });
    /*end header basket*/

    /*catalog-item-more*/

    $(document).on('click', '[data-show-more]', function () {

        var targetContainer = $('.loadmore_wrap:last');
        var btn = $(this);
        var page = btn.attr('data-next-page');
        var id = btn.attr('data-show-more');
        var bx_ajax_id = btn.attr('data-ajax-id');
        var block_id = "#comp_" + bx_ajax_id;

        btn.children('.load_more_btn_text').css('display', 'none');
        btn.children('.load_more_btn_preloader').css('display', 'block');

        let startcount = $('.position-list').length;

        var data = {
            bxajaxid: bx_ajax_id
        };
        data['PAGEN_' + id] = page;
        var url = window.location.href/* + '?PAGEN_'+id+'='+page*/;

        $.ajax({
            type: "GET",
            url: url,
            data: data,
            timeout: 3000,
            success: function (data) {
                $("#btn_" + bx_ajax_id).remove();
                $('.new-item__price_val').on('click', function () {
                    //alert('sdfsadfsd');
                });
                var elements = $(data).find('.loadmore_wrap').children(),  //  Ищем элементы
                    pagination = $(data).find("#btn_" + bx_ajax_id);//  Ищем навигацию
                targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                $('#load_more_area').append(pagination); //  добавляем навигацию следом
                elements.find('.position-list').each(function (index) {
                    $(this).text(parseInt(startcount) + parseInt(index) + 1 + '.');
                });

            }
        });
    });

    /*end catalog-item-more*/

    /*quantity catalog-item list*/

    /*function set_price_summ_item(cnt) {
		let buyLink = $('#buy').attr('data-href');
		let qnt = GetURLParameter(buyLink,'QUANTITY');
		let qntpos = strpos(buyLink,'QUANTITY');
		let buyNewLink = buyLink.substring(0,qntpos) + 'QUANTITY=' + cnt;

		if (cnt && buyNewLink) {

			 $('#buy').attr({
              'data-href': buyNewLink
          });

		}

		if($('.price_summ_item').length > 0) {
			var price = parseFloat($('.price_summ_item').attr("data-summ-price").replace(/ /g,''));

			var pro_all_summ_val = (price * cnt).toFixed(2);
          if (pro_all_summ_val)
          	{
          		$('.price_summ_item').empty().html('Общая стоимость: <b>' + pro_all_summ_val + ' руб.</b>');
          	}
		}
	}*/

    $('body').on('click', '.quantity_link_plus', function (e) {
        //$('.quantity_link_plus').on('click',function(e){
        e.preventDefault();
        var id_element = $(this).attr('rel');
        if (id_element) {
            var element_quantity = $('#' + id_element + '-item-quantity');
            var value = parseInt(element_quantity.val());
            var step = parseInt(element_quantity.attr('step'));
            var resval = value + step;
            element_quantity.val(resval);
            let buyLink = $('#quan-item-line-' + id_element).attr('data-href');
            let qnt = GetURLParameter(buyLink, 'QUANTITY');
            let qntpos = strpos(buyLink, 'QUANTITY');
            let buyNewLink = buyLink.substring(0, qntpos) + 'QUANTITY=' + resval;

            if (resval && buyNewLink) {
                $('#quan-item-line-' + id_element).attr({
                    'data-href': buyNewLink
                });
            }
        }
    });

    $('body').on('click', '.quantity_link_minus', function (e) {
        //$('.quantity_link_minus').on('click',function(e){
        e.preventDefault();
        var id_element = $(this).attr('rel');
        if (id_element) {
            var element_quantity = $('#' + id_element + '-item-quantity');
            var value = parseInt(element_quantity.val());
            var step = parseInt(element_quantity.attr('step'));
            if (value == step) {
                return false;
            } else {
                var resval = value - step;
            }

            element_quantity.val(resval);

            let buyLink = $('#quan-item-line-' + id_element).attr('data-href');
            let qnt = GetURLParameter(buyLink, 'QUANTITY');
            let qntpos = strpos(buyLink, 'QUANTITY');
            let buyNewLink = buyLink.substring(0, qntpos) + 'QUANTITY=' + resval;

            if (resval && buyNewLink) {
                $('#quan-item-line-' + id_element).attr({
                    'data-href': buyNewLink
                });
            }
        }
    });

    $('body').on('change', '.catalog-list-quantity-area > input', function (e) {
        //$('.catalog-list-quantity-area > input').on('change',function(e){
        e.preventDefault();
        var value = parseInt($(this).val());
        var min = parseInt($(this).attr('min'));
        if (value < min) {
            $(this).val(min);
        }
    });

    /*end quantity catalog-item list*/


    /*mobil catalog menu */
    $('.mv_catalog_link').on('click', function (e) {
        e.preventDefault();

        $('.mv_menu_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
        $('#horizontal-multilevel-menu-mobil-area').fadeOut('fast');
        $('#mainmenu').css('height', 'auto');

        if ($('.left_catalog_area_mobil').css('display') === 'block') {
            $('.mv_catalog_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
            $('.left_catalog_area_mobil').fadeOut('fast');
            $('#mainmenu').css('height', 'auto');
        } else {
            $(this).children('.fa').removeClass('fa-bars').addClass('fa-times');
            $('.left_catalog_area_mobil').fadeIn('fast');
            $('#mainmenu').css('height', '100%');
        }
    });

    $('.mv_menu_link').on('click', function (e) {
        e.preventDefault();

        $('.mv_catalog_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
        $('.left_catalog_area_mobil').fadeOut('fast');
        $('#mainmenu').css('height', 'auto');

        if ($('#horizontal-multilevel-menu-mobil-area').css('display') === 'block') {
            $('.mv_menu_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
            $('#horizontal-multilevel-menu-mobil-area').fadeOut('fast');
            $('#mainmenu').css('height', 'auto');
        } else {
            $(this).children('.fa').removeClass('fa-bars').addClass('fa-times');
            $('#horizontal-multilevel-menu-mobil-area').fadeIn('fast');
            $('#mainmenu').css('height', '100%');
        }
    });


    $('.item_mobil_nav').on('click', function (e) {
        e.preventDefault();
        let item_id = $(this).attr('rel');
        if (item_id) {
            $('.sub_item_content_mobil').css('display', 'none');
            $('#sic-mobil-' + item_id).fadeIn('fast');
            $('.centered_mobil').animate({'left': 0}, 100);
        }
    });

    $('.item_mobil_nav_back').on('click', function (e) {
        e.preventDefault();
        $('.centered_mobil').animate({'left': 100 + '%'}, 100);
    });

    /*start right main menu mobil*/
    $('#horizontal-multilevel-menu-mobil li .main_menu_arrow').on('click', function (e) {
        e.preventDefault();
        let item_id = $(this).attr('rel');
        if (item_id) {
            $('#sic_' + item_id).animate({'left': 0}, 100);
            $('.root-item, .root-item-selected').css('display', 'none');
            $('#horizontal-multilevel-menu-mobil li .main_menu_arrow').css('display', 'none');
            $('#horizontal-multilevel-menu-mobil .f-level').css('border-width', '0px');

            /*$('.sub_item_content_mobil').css('display','none');
			$('#sic-mobil-' + item_id).fadeIn('fast');
			$('.centered_mobil').animate({'left':0},100);*/
        }
    });

    $('.sic_m_mobil_nav_back').on('click', function (e) {
        e.preventDefault();
        $('#horizontal-multilevel-menu-mobil .root_back').animate({'left': 100 + '%'}, 100);
        $('.root-item, .root-item-selected').css('display', 'block');
        $('#horizontal-multilevel-menu-mobil li .main_menu_arrow').css('display', 'block');
        $('#horizontal-multilevel-menu-mobil .f-level').css('border-width', '1px');
    });
    /*end right main menu mobil*/

    /*end mobil catalog menu */

    /*service more*/

    if ($('#service-more').length > 0) {
        $('#service-more').on('click', function () {
            $(this).remove();
            $('.service-is-item .posts-i').each(function (i) {
                $(this).css('display', '');
            });
        });

    }

    /*end service more*/

    /*sub category search*/

    if ($('.category-item').length > 0) {
        var name_descr = $('.category-item').first().find('.v-aligner').text();
        if (name_descr) {
            $("#search-text-custom").attr("placeholder", "Фильтр по разделам, например: " + $.trim(name_descr));
        }
    }

    $("#search-text-custom").on('keyup input', function () {
        var stc = $("#search-text-custom").val().toLowerCase();

        $(".check-data-search").each(function () {
            var $this = $(this);
            var value = $this.attr("data-find").toLowerCase(); //convert attribute value to lowercase
            if (value.length > 3) {

                if (value.includes(stc)) {
                    $this.css('display', 'inline-block');

                } else {
                    $this.css('display', 'none');
                }
            }
            //$this.toggleClass( "hidden-data-search-custom", !value.includes( stc ) );
        })

    });

    /*end sub category search*/

    /*start filter*/

    if ($('.section-filter-ttl').length > 0) {
        $('.section-filter').on('click', '.section-filter-ttl', function () {
            if ($(this).parents('.section-filter-item').hasClass('opened')) {
                $(this).parents('.section-filter-item').removeClass('opened');

            } else {
                $(this).parents('.section-filter-item').addClass('opened');
            }
            return false;
        });

        $('.section-filter-fields').each(function () {
            var section_len = $(this).children().length;
            var section_id = $(this).attr('id');

            if (section_len >= 6) {
                $(this).append('<p class="section-filter-ttl-view-all" id="ttl-link-all-' + section_id + '"><a href="#" class="section-filter-ttl-view-all-link" rel="' + section_id + '">Показать все...</a></p>');
                //$(this).after('<p class="section-filter-ttl-view-all" id="ttl-link-all-' + section_id + '"><a href="#" class="section-filter-ttl-view-all-link" rel="' + section_id + '">Показать все...</a></p>');
                $(this).children().not('.section-filter-ttl-view-all').each(function (e) {
                    if (e >= 6) {
                        $(this).css('display', 'none');
                    }
                });
            }
        });

        $('.section-filter-ttl-view-all-link').on('click', function (e) {
            e.preventDefault();
            var section_link_id = $(this).attr('rel');
            $('#' + section_link_id).children('.section-filter-field').css('display', 'block');
            $(this).css('display', 'none').attr('data-check', '1');
        });

        $('.section-filter-checkbox').on('click', function () {
            //console.log($(this).hasClass('kombox-disabled'));
            if ($(this).hasClass('kombox-disabled') !== true) {
                if (mobileDetect == true) {
                    var ptop = 50;
                } else {
                    var ptop = 2;
                }
                var toppos = $(this).position().top + ptop;
                $("#modef").css("display", "block");
                $("#modef").stop().animate({'top': toppos + 'px'}, 200);
            }
        });

        /*section filter search*/
        $(".section-filter-ttl-search-input").on('keyup input', function () {
            //console.log($(this).val().toLowerCase());

            $(this).val($(this).val().replace(/[.]/g, ','));

            var rel_filter = $(this).attr('rel');
            var ws_filter = $(this).val().toLowerCase();
            var len_filter = $(this).val().toLowerCase().length;
            //console.log('len_filter' + len_filter);
            if (len_filter > 0) {

                $("#section-filter-block-" + rel_filter + " .section-filter-field").each(function () {
                    var $this = $(this);
                    var value = $this.attr("data-filter-val").toLowerCase(); //convert attribute value to lowercase
                    if (value.length > 0) {
                        if (value.includes(ws_filter)) {
                            $this.css('display', 'block');

                        } else {
                            $this.css('display', 'none');
                        }
                    }
                });

            } else {
                if ($('#ttl-link-all-section-filter-block-' + rel_filter).children('.section-filter-ttl-view-all-link').attr('data-check') === '1') {
                    $("#section-filter-block-" + rel_filter + " .section-filter-field").css('display', 'block');
                } else {
                    $("#section-filter-block-" + rel_filter + " .section-filter-field").css('display', 'none');
                    $("#section-filter-block-" + rel_filter + " .section-filter-field").slice(0, 6).css('display', 'block');
                }

            }
        });
        /*section filter search*/

        $('#section-filter-toggle').on('click', function () {
            $(this).next('.section-filter-cont').slideToggle();
            if ($(this).hasClass('opened')) {
                $(this).removeClass("opened").find('span').text($(this).data("open"));
            } else {
                $(this).addClass('opened').find('span').text($(this).data("close"));
            }
            return false;
        });

    }

    // Select Styles
    if ($('.chosen-select').length > 0) {
        $('.chosen-select').chosen();
    }

    /*end start filter*/

    /*link_location*/
    $('.link_location').on('click', function () {
        //console.log('THIS');
    });
    /*end link_location*/

    /*about-company*/
    if ($('.brands-list').length > 0) {
        $('.brands-list').each(function () {
            var flexslider_brands;
            $(this).flexslider({
                animation: "slide",
                controlNav: false,
                slideshow: false,
                itemWidth: 150,
                itemMargin: 20,
                minItems: getGridSize_brands(),
                maxItems: getGridSize_brands()
            });
            $(window).resize(function () {
                var gridSize = getGridSize_brands();
            });
        });
    }
    /*end about-company*/

    /*left catalog parents menu */
    $('.catalog_parents_left_menu_all').on('click', function (e) {
        e.preventDefault();
        $('.catalog_parents_left_menu:gt(7)').toggleClass('action');
    });
    /*end left catalog parents menu */

    /*main_right_menu*/

    if ($('#cont_catalog_menu').length > 0) {
        var width_menu_right = $('#cont_catalog_menu').width();
        var left_menu_right = $('#catalog_item').offset().left;

        $('#horizontal-multilevel-menu .root_back').each(function (i) {
            $(this).css('width', width_menu_right + 'px');
            var left_col = $(this).closest(".col").position().left - 16;
            $(this).css('left', "-" + left_col + 'px');
        });

    }

    /*subcategory*/
    if ($('.subcategory-area-shadow').length > 0) {
        $('#subcategory-area').css('height', '400px');
        $('.subcategory-link-more').on('click', function (e) {
            console.log('sdfsdf');
            e.preventDefault();
            var state = $('#subcategory-area').attr('rel');
            if (state == 0) {
                $('#subcategory-area').css('height', '100%').attr('rel', '1');
                $('.subcategory-area-shadow').fadeOut('fast');
                $(this).children('span').text('Свернуть');
                $(this).children('i').removeClass('fa-angle-down').addClass('fa-angle-up');
            }

            if (state == 1) {
                $('#subcategory-area').css('height', '400px').attr('rel', '0');
                $('.subcategory-area-shadow').fadeIn('fast');
                $(this).children('span').text('Больше категорий');
                $(this).children('i').removeClass('fa-angle-up').addClass('fa-angle-down');
                $('body,html').animate({scrollTop: 0}, 400);
            }
            return false;
        });
    }

    $('#tlink').on('click', function (e) {
        e.preventDefault();
        $('.test').animate({'height': '200px'}, 1000);
        return false;
    });
    /*end subcategory*/

    /*prod menu*/

    $('.prod_link').on('click', function (e) {
        e.preventDefault();
        console.log('Меню производства');

        if ($('.left_prod_area').css('display') === 'block') {
            $('.left_prod_area')/*.css('display','none')*/.fadeOut('fast');
            $('.prod_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
        } else {
            $('.left_prod_area')/*.css('display','block')*/.fadeIn('fast');
            $(this).children('.fa').removeClass('fa-bars').addClass('fa-times');
        }

    });

    /*prod menu end*/

    /*left catalog menu */

    if ($('.left_catalog_main_menu').length > 0) {
        //console.log(document.getElementById('left_catalog_menu_simplebar'));
        //new SimpleBar(document.getElementById('left_catalog_menu_simplebar'));


        /*let set_width = $('.content').children('.container').width();
		$('.sub-item').css('width',set_width - 210 + 'px');

		$('.sub-item').on('mouseenter',function(e){
			e.preventDefault();
			$(this).prev().removeClass('item').addClass('active');
			$(this).prev().children('.spriten').removeClass('spriten').addClass('active_icon');
		})

		$('.sub-item').on('mouseleave',function(e){
			e.preventDefault();
			$(this).prev().removeClass('active').addClass('item');
			$(this).prev().children('.active_icon').removeClass('active_icon').addClass('spriten');
		})*/

        $('.catalog_link').on('click', function (e) {
            e.preventDefault();


            if ($('.left_catalog_area').css('display') === 'block') {
                $('#horizontal-multilevel-menu-open-cat').css('display', 'none');
                $('#horizontal-multilevel-menu').css('display', 'flex');
                $('.left_catalog_area_overlay')/*.css('display','none')*/.fadeOut('fast');
                $('.bottom-bar__inner').css('z-index', '100');
                //$('.middle-bar').css('background-color','none');
                //$('.middle-bar,.traiv-menu-top-bottom').css('position','relative').css('z-index','100');
                $('.left_catalog_area,.top_mm_items')/*.css('display','none')*/.fadeOut('fast');
                $('.catalog_link').children('.fa').removeClass('fa-times').addClass('fa-bars');

            } else {
                $('#horizontal-multilevel-menu').css('display', 'none');
                $('#horizontal-multilevel-menu-open-cat').css('display', 'flex');
                $('.left_catalog_area_overlay')/*.css('display','block')*/.fadeIn('fast');
                $('.bottom-bar__inner').css('z-index', '1000');
                //$('.middle-bar').css('background-color','#eee');
                //$('.middle-bar,.traiv-menu-top-bottom').css('position','relative').css('z-index','999');
                $('.left_catalog_area,.top_mm_items')/*.css('display','block')*/.fadeIn('fast');
                $(this).children('.fa').removeClass('fa-bars').addClass('fa-times');
            }
        });


        $('body').on('click', function (e) {
            //console.log(e.target.className);


            if (e.target.className !== 'price-list-right-area' && $('.price-list-right-area').hasClass('active')) {
                $('.price-list-right-area').stop().animate({'right': '-360px'}, 300, function () {
                    $('.price-list-right-area').removeClass('active');
                });
            }


            if (e.target.className !== 'howto_buy_btn' && e.target.className !== 'howto_deliver_btn' && e.target.className !== 'root-item') {
                if (!$(e.target).closest('.left_catalog_area,.catalog_link').length) {
                    $('.left_catalog_area,.top_mm_items').css('display', 'none');
                    $('.left_catalog_area_overlay').css('display', 'none');
                    $('#horizontal-multilevel-menu-open-cat').css('display', 'none');
                    $('#horizontal-multilevel-menu').css('display', 'flex');
                    $('.catalog_link').children('.fa').removeClass('fa-times').addClass('fa-bars');
                }
            }

            if ($(e.target).closest('.header-new-catlink').length == 0) {
                $('.header-new-catarea').css('display', 'none');
                $('.header-new-catlink').removeClass('active');
            }

            if ($(e.target).closest('#ajax_basket').length != '1') {
                if ($('.cart__dropdown').hasClass('active') == true && $(e.target).closest('.cart__dropdown').length != '1') {
                    $('.cart__dropdown').toggleClass('active');
                    $('.backlayer').toggleClass('active');
                }
            }
            //console.log(e.target.className);

            if (e.target.className !== 'menu_tips' && e.target.className !== 'top_location_text') {
                if ($('.menu_tips').hasClass('active') == true) {
                    $('.menu_tips').toggleClass('active');
                    //$('.menu_tips').css('display','none');
                }
            }


        });


        $('.item').on('mouseenter', function (e) {
            $('.sub_item_content').css('display', 'none');
            $('.sub_item_content_help').css('display', 'none');

            $('.item').removeClass('active');
            $('.item').children('.active_icon').removeClass('active_icon').addClass('spriten');

            $(this).addClass('active');
            $(this).children('.spriten').removeClass('spriten').addClass('active_icon');
            e.preventDefault();
            let rel = $(this).attr('rel');
            if (rel) {
                $('#sic-' + rel).css('display', 'block');
                $('#sich-' + rel).css('display', 'block');
            }
        });


        $('.sub_item_content_help_link').on('click', function (e) {
            e.preventDefault();
            let help_pid = $(this).parents(".sub_item_content_help").attr('rel');
            let help_name = $(this).attr("data-help-name").toLowerCase();
            $("#sich-" + help_pid).find('.sub_item_content_help_link').children('div').removeClass('active');
            $(this).children('div').addClass('active');

            $("#sich-" + help_pid).find(".icofont").removeClass('fa-check-circle-o').addClass('fa-circle-thin');
            $(this).children('.icofont').removeClass('icofont-spinner-alt-4').addClass('icofont-check-circled');

            $("#sich-" + help_pid).children('.sub_item_content_help_link_second_note').css('display', 'block');

            if (help_name === 'din' || help_name === 'iso' || help_name === 'en' || help_name === 'гост') {
                $("#sich-" + help_pid).find('.sub_item_content_help_link_second').css('display', 'block');
                $("#sich-" + help_pid).find('.sub_item_content_help_link_second_note').css('display', 'block');

                /**/
                $("#sich-" + help_pid).find('.sub_item_content_help_link_second').each(function () {
                    let $this = $(this);
                    let val = $this.attr("data-help-name").toLowerCase(); //convert attribute value to lowercase
                    //console.log(val);
                    console.clear();
                    $("#sich-" + help_pid).find(".sub_item_content_help_link_second").css('display', 'none');
                    $("#sich-" + help_pid).find(".sub_item_content_help_link_second").parent('span').addClass('notactive');
                    $("#sic-" + help_pid).children(".catalog_item_help[data-helps-name='" + help_name + "']").each(function () {
                        let $thisis = $(this);
                        let valueis = $thisis.attr("data-helps-name-second").toLowerCase();
                        console.log(valueis + ' // ' + val);
                        $("#sich-" + help_pid).find(".sub_item_content_help_link_second[data-help-name='" + valueis + "']").css('display', 'block');
                    });

                });
                /**/

            } else {
                $("#sich-" + help_pid).find('.sub_item_content_help_link_second').css('display', 'none');
                $("#sich-" + help_pid).find('.sub_item_content_help_link_second_note').css('display', 'none');
            }

            $("#sic-" + help_pid).children(".catalog_item_help").each(function () {
                var $this = $(this);
                var value = $this.attr("data-helps-name").toLowerCase();

                if (value.includes(help_name)) {
                    $this.css('display', 'block').addClass('catalog_item_help_change');
                } else {
                    $this.css('display', 'none').removeClass('catalog_item_help_change');
                }
            })

            var check_column_help = $("#sic-" + help_pid).children(".catalog_item_help_change").length;

            /*if (check_column_help < 4) {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','unset')
			    	.css('-webkit-column-count','unset')
			    	.css('column-count','unset');
			    }
			    else {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','4')
			    	.css('-webkit-column-count','4')
			    	.css('column-count','4');
			    }*/

        });


        $('.sub_item_content_help_link_second').on('click', function (e) {
            e.preventDefault();
            let help_pid = $(this).parents(".sub_item_content_help").attr('rel');
            let help_name = $(this).attr("data-help-name").toLowerCase();
            let check_active = $(this).attr("rel");

            //console.log('check_active' + check_active);

            if (check_active !== '1') {

                $("#sich-" + help_pid).find(".sub_item_content_help_link_second").children("div").children(".icofont").removeClass('fa-check-circle-o').addClass('fa-circle-thin');
                $("#sich-" + help_pid).find(".sub_item_content_help_link_second").attr('rel', '0');
                $(this).children("div").children('.icofont').removeClass('fa-circle-thin').addClass('fa-check-circle-o');
                $(this).attr('rel', '1');


                $("#sic-" + help_pid).children(".catalog_item_help_change").each(function () {
                    var $this = $(this);
                    var value = $this.attr("data-helps-name-second").toLowerCase(); //convert attribute value to lowercase

                    if (value.includes(help_name)) {
                        $this.css('display', 'block');
                    } else {
                        $this.css('display', 'none');
                    }

                })
                var check_column_help_change = $("#sic-" + help_pid).children(".catalog_item_help_change:visible").length;


                /*if (check_column_help_change < 4) {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','unset')
			    	.css('-webkit-column-count','unset')
			    	.css('column-count','unset');
			    }
			    else {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','4')
			    	.css('-webkit-column-count','4')
			    	.css('column-count','4');
			    }*/
            } else {

                $("#sich-" + help_pid).find(".sub_item_content_help_link_second").children("div").children(".icofont").removeClass('fa-check-circle-o').addClass('fa-circle-thin');
                $(this).children('div').children('.icofont').removeClass('fa-check-circle-o').addClass('fa-circle-thin');
                $(this).attr('rel', '0');

                $("#sic-" + help_pid).children(".catalog_item_help_change").css('display', 'block');


                var check_column_help_change = $("#sic-" + help_pid).children(".catalog_item_help_change:visible").length;


                /*if (check_column_help_change < 4) {
				    	$("#sic-" + help_pid)
				    	.css('-moz-column-count','unset')
				    	.css('-webkit-column-count','unset')
				    	.css('column-count','unset');
				    }
				    else {
				    	$("#sic-" + help_pid)
				    	.css('-moz-column-count','4')
				    	.css('-webkit-column-count','4')
				    	.css('column-count','4');
				    }*/
            }

        });

    }

    /*end left catalog menu */

    /*prod_slider*/

    //size table link
    $('#size_table_link').on('click', function (e) {
        e.preventDefault();
        //console.log('size_table_link');
        $('.prod-tabs').find('li a').removeClass('active');
        // main
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tabs').find('li a').removeClass('active');
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto').hide().fadeIn();
    });

    // product tabs
    $('.prod-tabs li').on('click', 'a', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tabs').find('li a').removeClass('active');
        $(this).addClass('active');

        // mobile
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto');
        return false;
    });

    // product tabs new
    $('.prod-tabs-new li').on('click', 'a', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        /*$(this).parents('.prod-tabs-new').find('li a').removeClass('active');
	        $(this).addClass('active');*/

        // mobile
        /*$('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
	        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

	        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
	        $($(this).attr('data-prodtab')).css('height', 'auto');*/
        return false;
    });

    if ($('#prod-price-block-area').length > 0) {
        if (mobileDetect == true) {
            $('#prod-price-block-area').clone(true).unwrap().appendTo('#prod-price-block-copy');
        } else {
            $('#prod-price-block-copy').empty();
        }

        /*$(window).resize(function () {
	    		if (mobileDetect == true) {
		    		$('#prod-price-block-area').clone(true).unwrap().appendTo('#prod-price-block-copy');
				} else {
					$('#prod-price-block-copy').empty();
				}
			});*/

    }

    /*element nav*/
    $('[data-toggle="elementscroll"]').on("click", function () {

        //'use strict';

        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                if (mobileDetect == true) {
                    $('html,body').animate({scrollTop: target.offset().top - 30}, 500);
                } else {
                    $('html,body').animate({scrollTop: target.offset().top - 120}, 500);
                }
                return false;
            }
        }

    });

    // prosuct (mobile)
    $('.prod-tab-cont').on('click', '.prod-tab-mob', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $(this).addClass('active');

        // main
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tabs').find('li a').removeClass('active');
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto').hide().fadeIn();
        return false;
    });

    /*prod-note-more*/
    $('.prod-note-more').on('click', function (e) {
        e.preventDefault();
        $(this).css('display', 'none');
        $('.prod-note').find('p').css('display', 'inline-block');
    });

    /*check-prod-select*/

    if ($('.prod-character').length > 0) {
        var check_prod_select = $('.prod-character').attr('rel');
        if (check_prod_select) {
            $('.prod-select').css('padding-top', '0px');
        }
    }
    /*end check-prod-select*/

    if ($('.prod-nal').length > 0) {
        if ($('.prod-nal-list-item').length == 0) {
            $('.prod-nal').css('display', 'none');
        }
    }

    // Product Images Slider
    if ($('.prod-slider-car').length > 0) {
        $('.prod-slider-car').each(function () {
            $(this).bxSlider({
                pagerCustom: $(this).parents('.prod-slider-wrap').find('.prod-thumbs-car'),
                adaptiveHeight: true,
                infiniteLoop: false,
            });
            $(this).parents('.prod-slider-wrap').find('.prod-thumbs-car').bxSlider({
                slideWidth: 5000,
                slideMargin: 8,
                moveSlides: 1,
                infiniteLoop: false,
                minSlides: 5,
                maxSlides: 5,
                pager: false
            });
        });
    }

    if ($('.service-row-image').length > 0) {

        /* $('.expopage-is-item').slick({
            lazyLoad: 'ondemand',
            dots: false,
            arrows: true,
            nextArrow: '<i class="fa fa-angle-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });*/

    }

    if ($('.expopage-is-item').length > 0) {

        $('.expopage-is-item').slick({
            lazyLoad: 'ondemand',
            dots: true,
            arrows: true,
            nextArrow: '<i class="fa fa-angle-right expopage-slick-arrow expopage-slick-right-arrow" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left expopage-slick-arrow expopage-slick-left-arrow" aria-hidden="true"></i>',
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });

    }

    if ($('.bxslider_sklad').length > 0) {
        /*$('.bxslider_sklad').bxSlider({
    	    mode: 'fade',
    	    captions: true,
    	    slideWidth: 600
    	  });*/
        //	$("div.skm_elem").fancybox();
    }


    /*end_prod_slider*/

    /*items cart function*/

    $('.prod-minus,.prod-minus-new').on('click', function (e) {
        e.preventDefault();
        let qnt = parseInt($('.prod-qnt-input').val());
        let qnt_step = parseInt($('.prod-qnt-input').attr('step'));

        if (qnt != qnt_step) {
            qnt -= qnt_step;
            $('.prod-qnt-input').val(qnt);
            set_price_summ_item(qnt);
        }
    });

    $('.prod-plus,.prod-plus-new').on('click', function (e) {
        e.preventDefault();
        let qnt = parseInt($('.prod-qnt-input').val());
        let qnt_step = parseInt($('.prod-qnt-input').attr('step'));

        qnt += qnt_step;
        $('.prod-qnt-input').val(qnt);
        set_price_summ_item(qnt);


    });

    /*$('.prod-qnt-input').on("keypress keyup blur",function (event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
         }
     });*/

    $('.prod-qnt-input').on('change', function (e) {

        e.preventDefault();
        /*let qnt = parseInt($('.prod-qnt-input').val());
		let qnt_step = parseInt($('.prod-qnt-input').attr('step'));*/

        var value = parseInt($(this).val());
        var min = parseInt($(this).attr('min'));
        if (value < min) {
            $(this).val(min);
        }

        /*$('.prod-qnt-input').val(qnt);*/
        set_price_summ_item(value);

    });

    /*items cart function*/

    function GetURLParameter(sUrl, sParam) {
        var sPageURL = sUrl/*window.location.search.substring(1)*/;
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) {
                return sParameterName[1];
            }
        }
    }

    function strpos(haystack, needle, offset) {
        var i = (haystack + '').indexOf(needle, (offset || 0));
        return i === -1 ? false : i;
    }

    /*price_summ_item*/
    function set_price_summ_item(cnt) {
        let buyLink = $('#buy').attr('data-href');
        let qnt = GetURLParameter(buyLink, 'QUANTITY');
        let qntpos = strpos(buyLink, 'QUANTITY');
        let buyNewLink = buyLink.substring(0, qntpos) + 'QUANTITY=' + cnt;

        if (cnt && buyNewLink) {

            $('#buy').attr({
                'data-href': buyNewLink
            });

        }

        if ($('.price_summ_item').length > 0) {
            var price = parseFloat($('.price_summ_item').attr("data-summ-price").replace(/ /g, ''));

            var pro_all_summ_val = (price * cnt).toFixed(2);
            if (pro_all_summ_val) {
                $('.price_summ_item').empty().html('Общая стоимость: <b>' + pro_all_summ_val + ' руб.</b>');
            }
        }
    }

    /*end price_summ_item*/

    /*cross item*/
    /*if ($('.cross_item_tr').length > 0) {
		let cil = parseInt($('.cross_item_area').find('.cross_item_tr').length);
		let cih = parseInt($('.cross_item_area').find('.cross_item_tr').height());
		let ch = cil * cih + 30;

		setTimeout(function(){
			$('.cross_item_area').animate({'opacity':1,'height':ch + 'px'},300);
		}, 700);
	}*/
    /*end cross item*/


    /*kviz*/
    if ($('#kviz-area').length > 0) {

        var ans = [
            {
                name: "Шуточный квиз",
                description: "<p>Иногда вы можете смотреть на мир несколько пессимистично. Не будьте слишком  пассивны, чтобы не «заржаветь» в своих эмоциях, ведь часто неприятные события заставляют вас переживать, мешая радоваться жизни. Однако вы можете показывать пример другим своей бесконечной добротой, мягкостью и честностью, быть незаменимым как стальные винты, которые буквально скрепляют собой мир.</p>",
                imgsrc: "/local/templates/traiv-main/img/kviz/kvizimg.jpg",
                res: [
                    {
                        name: 'yellow',
                        title: 'Вы - латунная гайка!',
                        note: '<p>Вы очень жизнерадостны и оптимистичны, как цвет латуни. Любите находиться в движении и не можете усидеть на месте, поэтому ваш внутренний мир сияет всеми цветами радуги. Ваша активность проявляется во всех сферах жизни - от общения до профессиональной деятельности также, как латунь - проводит электричество.  Однако латунь - относительно мягкий материал, вы можете переоценить свои свои возможности и проявлять непостоянство в действиях и поступках.</p>',
                        img: '/local/templates/traiv-main/img/kviz/yellow.jpeg'
                    }, {
                        name: 'blue',
                        title: 'Вы - полиамидная шайба!',
                        note: '<p>Вы очень спокойны и уравновешены, как полиамид, который устойчив к кислотам и не пропускает электричество. Ваш внутренний мир напоминает тихую гавань, где вас никто не потревожит. Вы не проявляете сильных эмоций, но тем не менее  вы - эмпатичный человек, готовый всегда прийти на помощь в сложной ситуации.</p>',
                        img: '/local/templates/traiv-main/img/kviz/blue.jpg'
                    }
                    , {
                        name: 'gray',
                        title: 'Вы - стальной винт!',
                        note: '<p> Иногда вы можете смотреть на мир несколько пессимистично. Не будьте слишком  пассивны, чтобы не «заржаветь» в своих эмоциях, ведь часто неприятные события заставляют вас переживать, мешая радоваться жизни. Однако вы можете показывать пример другим своей бесконечной добротой, мягкостью и честностью, быть незаменимым как стальные винты, которые буквально скрепляют собой мир.</p>',
                        img: '/local/templates/traiv-main/img/kviz/gray.jpg'
                    }, {
                        name: 'black',
                        title: 'Вы - высокопрочный болт!',
                        note: '<p>Вы тверды в своих намерениях и трезво смотрите на окружающую жизнь. Ваша нервная система - как железобетонная конструкция с болтами - вас сложно вывести из равновесия. Вы можете казаться холодным замкнутым человеком. Но на самом деле, вы можете быть самым верным другом, на которого можно положиться, как на высокопрочный крепеж.</p>',
                        img: '/local/templates/traiv-main/img/kviz/black.jpg'
                    }
                ],
                q: [
                    {
                        name: "Вы предпочли бы быть...?",
                        ans: [
                            {
                                note: "Энергичным, но вспыльчивым",
                                res: "yellow"
                            },
                            {
                                note: "Строгим, но справедливым",
                                res: "black"
                            },
                            {
                                note: "Спокойным, но замкнутым",
                                res: "blue"
                            },
                            {
                                note: "Добрым, но грустным",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },/*q*/
                    {
                        name: "Если бы вы были невидимым, куда бы пошли?",
                        ans: [
                            {
                                note: "На вечеринку, всех разыграть",
                                res: "yellow"
                            },
                            {
                                note: "В логово злодея, чтобы сорвать его планы",
                                res: "black"
                            },
                            {
                                note: "Домой к тому, кто мне интересен",
                                res: "blue"
                            },
                            {
                                note: "Я и так почти невидимый, меня никто не замечает",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg3.jpg"
                    },
                    {
                        name: "Что для вас значат мечты?",
                        ans: [
                            {
                                note: "Яркие фантазии",
                                res: "yellow"
                            },
                            {
                                note: "Руководство к действию",
                                res: "black"
                            },
                            {
                                note: "То, к чему стараемся идти",
                                res: "blue"
                            },
                            {
                                note: "Место, чтобы укрыться от злого мира",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Что бы вы сделали во время отпуска?",
                        ans: [
                            {
                                note: "Вдоволь пообщаюсь с друзьями",
                                res: "yellow"
                            },
                            {
                                note: "Занялся экстремальным спортом",
                                res: "black"
                            },
                            {
                                note: "Займусь делами, на которые не хватало времени",
                                res: "blue"
                            },
                            {
                                note: "Посижу дома, отдохну от всех",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Что вы думаете о дружбе?",
                        ans: [
                            {
                                note: "Дружба - это когда вместе интересно и весело",
                                res: "yellow"
                            },
                            {
                                note: "Настоящие друзья должны быть всегда на вашей стороне",
                                res: "black"
                            },
                            {
                                note: "Дружба - это нечто согревающее и доброе, но не очень понятное",
                                res: "blue"
                            },
                            {
                                note: "Это полная поддержка и понимание",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Вы чувствуете себя неуверенно, если...",
                        ans: [
                            {
                                note: "Нужно заниматься монотонной работой",
                                res: "yellow"
                            },
                            {
                                note: "Мне нужно с кем-то поговорить по душам",
                                res: "black"
                            },
                            {
                                note: "Нужно принять важное решение",
                                res: "blue"
                            },
                            {
                                note: "Нужно выступать на публике",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Лучший подарок от Деда Мороза - это...",
                        ans: [
                            {
                                note: "Ежедневник, чтобы записывать дела и встречи",
                                res: "yellow"
                            },
                            {
                                note: "Успокоительное. У меня много стресса",
                                res: "black"
                            },
                            {
                                note: "Хорошую книгу, чтобы читать по вечерам",
                                res: "blue"
                            },
                            {
                                note: "Немного уверенности в себе",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Как часто вы используете жесты при общении?",
                        ans: [
                            {
                                note: "Очень часто, я экспрессивный",
                                res: "yellow"
                            },
                            {
                                note: "Не очень часто",
                                res: "black"
                            },
                            {
                                note: "Умеренно, по ситуации",
                                res: "blue"
                            },
                            {
                                note: "Почти не использую",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Если вам нужно остаться на день в одиночестве в своей квартире, что вы почувствуете?",
                        ans: [
                            {
                                note: "Грусть",
                                res: "yellow"
                            },
                            {
                                note: "Отчаяние",
                                res: "black"
                            },
                            {
                                note: "Ничего",
                                res: "blue"
                            },
                            {
                                note: "Радость",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    },

                    {
                        name: "Вы с трудом выносите людей, которые...",
                        ans: [
                            {
                                note: "Вечно сидят на одном месте",
                                res: "yellow"
                            },
                            {
                                note: "Я со всеми не очень-то лажу",
                                res: "black"
                            },
                            {
                                note: "Не уделяют мне должного внимания",
                                res: "blue"
                            },
                            {
                                note: "Активны и болтливы",
                                res: "gray"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
                    }
                ]
            }
        ];

        $('body').kviz({'dataJson': ans, 'typeKviz': 'funny'});
    }

    if ($('#kviz-area2').length > 0) {

        var ans2 = [
            {
                name: "КВИЗ на тему крепежа",
                description: "<p>Проверьте свои знания по теме и получите 40 баллов за успешное прохождение! Для получение баллов, необходимо пройти КВИЗ с первого раза!</p>",
                imgsrc: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg",
                res: [
                    {
                        name: '8',
                        title: 'Вы прошли КВИЗ!',
                        note: '<p>40 баллов будет начислено на Ваш бонусный счет в течении суток!</p>',
                        img: '/local/templates/traiv-main/img/kviz/yellow.jpeg'
                    }, {
                        name: '7',
                        title: 'К сожалению Вы не прошли КВИЗ!',
                        note: '<p>К сожалению Вы не прошли КВИЗ!.</p>',
                        img: '/local/templates/traiv-main/img/kviz/blue.jpg'
                    }
                ],
                q: [
                    {
                        name: "Из каких материалов изготавливают шайбу-гровер?",
                        ans: [
                            {
                                note: "Латунь",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa4_t.jpg"
                            },
                            {
                                note: "Бронза",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa2_t.jpg"
                            },
                            {
                                note: "Медь",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa3_t.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }, {
                        name: "Выберите маркировку дюймового крепежа на шляпке болта?",
                        ans: [
                            {
                                note: "Вариант 1",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa5.jpg"
                            },
                            {
                                note: "Вариант 2",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa6.jpg"
                            },
                            {
                                note: "Вариант 3",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa7.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }
                    , {
                        name: "Выберите корректное изображение шлица Torx",
                        ans: [
                            {
                                note: "Вариант 1",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa8_t.jpg"
                            },
                            {
                                note: "Вариант 2",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa9_t.jpg"
                            },
                            {
                                note: "Вариант 3",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa10_t.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }
                    , {
                        name: "Как правильно маркируется горячий цинк?",
                        ans: [
                            {
                                note: "HDG",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa11.jpg"
                            },
                            {
                                note: "09Г2С",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa12.jpg"
                            },
                            {
                                note: "GLV",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa13.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }
                    , {
                        name: "Какое крепежное изделие изобрели раньше остальных?",
                        ans: [
                            {
                                note: "Болт",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa14.jpg"
                            },
                            {
                                note: "Винт",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa15.jpg"
                            },
                            {
                                note: "Саморез",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa16.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }, {
                        name: "Болт из какого материала имеет наибольший вес?",
                        ans: [
                            {
                                note: "Стальной",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa17.jpg"
                            },
                            {
                                note: "Серебряный",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa18.jpg"
                            },
                            {
                                note: "Медный",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa19.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }, {
                        name: "Из какого материала используют крепеж при строительстве комических кораблей?",
                        ans: [
                            {
                                note: "Серебро",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa20.jpg"
                            },
                            {
                                note: "Титан",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa21.jpg"
                            },
                            {
                                note: "Алюминий",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa22.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }

                    , {
                        name: "Какие из представленных соединений относятся к неразъемным?",
                        ans: [
                            {
                                note: "Шпоночное",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa23.jpg"
                            },
                            {
                                note: "Штифтовое",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa24.jpg"
                            },
                            {
                                note: "Заклепочное",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa25.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }
                    , {
                        name: "Какая из шайб называется быстросъемной?",
                        ans: [
                            {
                                note: "Стопорная упорная",
                                res: "correct",
                                imgans: "/local/templates/traiv-new/images/skviz/sa26.jpg"
                            },
                            {
                                note: "Стопорное кольцо",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa27.jpg"
                            },
                            {
                                note: "Starlock",
                                res: "none",
                                imgans: "/local/templates/traiv-new/images/skviz/sa28.jpg"
                            }
                        ],
                        img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
                    }

                ]
            }
        ];

        $('body').kviz({'dataJson': ans2, 'typeKviz': 'correct', 'withNextB': true, 'ansDirection': 'horizontal'});
    }
    /*kviz*/

});

function goPageAjax(sPage) {
    $.ajax({
        type: 'get',
        url: sPage,
    });
}
