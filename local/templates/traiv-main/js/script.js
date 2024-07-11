$(function(){

    var $body = $('body');
    var $window = $(window);

    $(document).ready(function() {

        // plugins init

        if($.fn.bxSlider) {
            $('.js-slideshow').bxSlider({
                controls: false,
                pager: true,
                slideMargin: 10
            });

            $('.js-carousel').bxSlider({
                autoReload: true,
                pager: true,
                controls: false,
                infiniteLoop: false,
                moveSlides: 1,
                breaks: [{
                    screen: 0,
                    slides: 2,
                },
                    {
                        screen: 480,
                        slides: 3,
                    },
                    {
                        screen: 620,
                        slides: 5,
                    }, {
                        screen: 1180,
                        slides: 6,
                    }]
            });

            $('[data-slide-index="0"]').addClass('active');

            $('[data-slide-index]').click(function(){
                $(this).closest('li').siblings().find('a').removeClass('active')
                $(this).addClass('active');
            })
        }

        if($.fn.selectbox) {
            $('select').not(".chosen-select").selectbox();

            $('.selectbox__current').on('click', function(){
                $(this).addClass('is-active');
            })
        }

        if($.fn.validate){
            $(".js-validate").each(function(){

                $(this).validate({
                    rules: {
                        NAME: "required",
                        LAST_NAME: "required",
                        text: {
                            required: true,
                            minlength: 5
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                        confirm_password: {
                            required: true,
                            equalTo: '#password'
                        },
                        NEW_PASSWORD: {
                            required: true,
                            minlength: 6
                        },
                        NEW_PASSWORD_CONFIRM: {
                            required: true,
                            equalTo: '#new_password'
                        },
                        EMAIL: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true,
                            minlength: 22
                        }
                    },

                    messages: {
                        password: {
                            required: "",
                            minlength: "Минимум 6 символов"
                        },
                        confirm_password: {
                            required: "",
                            equalTo: "Пароли не совпадают"
                        },
                        NEW_PASSWORD: {
                            required: "",
                            minlength: "Минимум 6 символов"
                        },
                        NEW_PASSWORD_CONFIRM: {
                            required: "",
                            equalTo: "Пароли не совпадают"
                        },
                        EMAIL: "",
                        phone: "",
                        NAME: "",
                        LAST_NAME: "",
                        text: ""
                    }
                });
            })
        }


        if ($.fn.magnificPopup) {
            $('.btn-mfp-dialog').magnificPopup({
                type: 'inline',
                preloader: false,
                fixedContentPos: false
            });
        }

        if($.fn.imagezoomsl){
            $(".zoom-image").imagezoomsl({

                zoomrange: [1, 10],
                cursorshadeborder: "10px solid #000",
                magnifiereffectanimate: "fadeIn",
                magnifierpos: "left"
            });
        }


        // filter tooltip

        $('.c-filter .checkbox').click(function(){
            var $this = $(this);
            var offsetTop = $this.position().top;
            if($this.find('.checkbox__input').is(':checked')) {
                $('.c-filter__tooltip').css({'top' : offsetTop}).addClass('is-visible');
            } else {
                $('.c-filter__tooltip').removeClass('is-visible');
            }
        });


        // dialog

        $('[data-target]').on('click', function(e) {
            var id = $(this).attr('data-target');
            $('.layout').addClass('dialog-opened');
            $('.dialog').hide();
            $("[data-id='" + id +"']").show(0);

            e.preventDefault();
        });

        // location chooser

        $('.location-chooser__dropdown li').on('click', function() {
            var $this = $(this);
            var text = $this.text();

            $this.siblings().removeClass('is-active');
            $this.addClass('is-active');

            $('.location-chooser__current .location').html(text);
            closeDropdown();
        });


        $(".location-chooser__dropdown.dropdown-inner li").on("click",function () {

            //достаем название города в сокращенном виде

            var $id = $(this).attr("id");
            var $cityCode = $id.substring($id.indexOf("loc_") + 4);

            $(".header-phone").hide();
            $("#header-phone-" + $cityCode).show();    
            
            var mainDate = new Date();
            var year = mainDate.getFullYear();
            mainDate.setFullYear(year + 1);
            document.cookie = "TRAIV_USER_GEOTARGETING=" + $cityCode + "; path=/; expires=" + mainDate.toUTCString();
        });

        // sticky header

        var $stickyElement = $('.bottom-bar__inner'),
            $stickyParent = $stickyElement.closest('.bottom-bar'),
            stickyElementHeight = $stickyElement.outerHeight();

        if ($stickyParent != undefined){
            stickyElementOffsetTop = $stickyParent.offset().top;
        }



        $(window).resize(function() {
            stickyElementHeight = $stickyElement.outerHeight();
            if ($stickyParent != undefined) {
                stickyElementOffsetTop = $stickyParent.offset().top;
            }
        }).resize();

        function stick() {
            stickyElementOffsetTop = $stickyParent.offset().top;
            var windowTop = $(window).scrollTop();

            if (windowTop > stickyElementOffsetTop) {
                //$stickyParent.css({'padding-bottom' : stickyElementHeight});
                $stickyElement.addClass('is-fixed');
            } else {
                $stickyElement.removeClass('is-fixed');
                $stickyParent.removeAttr('style');
            }
        }
        stick();

        $(window).on('scroll', function(){
            stick();
        });

        // item counter

       /* $('.item-counter__increase').on('click', function (e) {
            var $qty = $(this).closest('.item-counter').find('input');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
            e.preventDefault();
        });

        $('.item-counter__decrease').on('click', function (e) {
            var $qty = $(this).closest('.item-counter').find('.item-counter__input');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
            }
            e.preventDefault();
        });*/

        $('.item-counter input').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        // collapse tab on click

        $(".tabs-nav__link").click(function(e) {

            var activeTab = $(this).attr("href");
            $(activeTab).siblings('.pane').removeClass('is-visible');
            $(activeTab).addClass('is-visible');

            $(this).closest('li').siblings().removeClass("is-active");
            $(this).closest('li').addClass("is-active");

            e.preventDefault();
        });

        $('body').on('click', function(e){
            if (!$(e.target).closest('.categories').length) {
                closeCategories();
            }
            if (!$(e.target).closest('.dropdown').length) {
                closeDropdown();
            }
            if (!$(e.target).closest('.dialog-holder, nav, .dialog, .popup-dialog').length) {
                closeDialog();
            }
            if (!$(e.target).closest('.nav-outer').length) {
                closeNav();
            }
        });

        $('.global-search__toggle').on('click', function(e){
            var $this = $(this),
                $parent = $this.closest('.global-search');

            var stateActive = 'is-active';

            if (!$parent.hasClass(stateActive)){
                $parent.addClass(stateActive);
                $parent.find('.global-search__input').focus();
            } else {
                $parent.removeClass(stateActive);
                $parent.find('.global-search__input').val('');
            }

            e.preventDefault();
        });

        /*if ($('#map').length > 0) {
            ymaps.ready(function() {
                var MAP,
                    place;
                MAP = new ymaps.Map('map', {
                    center: [59.899466, 30.502386],
                    zoom: 16
                });
                place = new ymaps.Placemark([59.899466, 30.502386]);
                MAP.geoObjects.add(place);
                MAP.behaviors.disable('scrollZoom')
            });
        }*/

        toggleClass('.nav-toggle', '.layout', 'nav-opened');
        toggleClass('.btn-collapse', '.order-table__item', 'is-opened');
        toggleClass('.product-details__toggle', '.product-details', 'is-opened');
        toggleClass('.categories__toggle', 'body', 'categories-opened');
        toggleClass('.dropdown-toggle', '.dropdown', 'is-opened');
        toggleClass('.pane-toggle', '.pane', 'is-d-visible');
        toggleClass('.c-filter__toggle', '.c-filter__section', 'is-opened');

        appendOnResize();

        $('.howto_buy_btn').click(function(){
            $(this).toggleClass('opened');
            $(this).html($(this).html() == '<i class="fas fa-angle-double-left"></i><i class="fas fa-coins" aria-hidden="true"></i>' ? '<i class="fas fa-angle-double-right"></i><a href="/mobile/payment/"> Как купить?</a>' : '<i class="fas fa-angle-double-left"></i><i class="fas fa-coins" aria-hidden="true"></i>');
        });


        $('.howto_deliver_btn').click(function(){
            $(this).toggleClass('opened');
            $(this).html($(this).html() == '<i class="fas fa-angle-double-left"></i><i class="fas fa-truck" aria-hidden="true"></i>' ? '<i class="fas fa-angle-double-right"></i><a href="/mobile/delivery/"> Как доставить?</a>' : '<i class="fas fa-angle-double-left"></i><i class="fas fa-truck" aria-hidden="true"></i>');
        });

        setTimeout(function() {
            $('.howto_buy_btn').click();
            $('.howto_deliver_btn').click();
        }, 10000);


        $(document).on('click', '[data-show-more]', function(){

            var targetContainer = $('.loadmore_wrap:last');
            var btn = $(this);
            var page = btn.attr('data-next-page');
            var id = btn.attr('data-show-more');
            var bx_ajax_id = btn.attr('data-ajax-id');
            var block_id = "#comp_"+bx_ajax_id;

            let startcount = $('.position-list').length;

            var data = {
                bxajaxid:bx_ajax_id
            };
            data['PAGEN_'+id] = page;
            var url = window.location.href/* + '?PAGEN_'+id+'='+page*/;

            $.ajax({
                type: "GET",
                url:url,
                data: data,
                timeout: 3000,
                success: function(data) {
                    $("#btn_"+bx_ajax_id).remove();
                    var elements = $(data).find('.loadmore_wrap'),  //  Ищем элементы
                        pagination = $(data).find("#btn_"+bx_ajax_id);//  Ищем навигацию
                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    targetContainer.append(pagination); //  добавляем навигацию следом
                    elements.find('.position-list').each(function(index){
                        $(this).text(parseInt(startcount)+parseInt(index)+1+'.');
                    });

                }
            });
        });
    }); // document.ready();

    // toggle parent class
    function toggleClass(item, target, state) {
        $('body').on('click',item,function (e) {
            var $this = $(this);
            if(!$this.closest(target).hasClass(state)) {
                $this.closest(target).addClass(state);
            } else {
                $this.closest(target).removeClass(state);
            }
            e.preventDefault();
        });
    }

    function closeNav() {
        $('.layout').removeClass('nav-opened');
    }

    function closeDialog() {
        $('.dialog').hide(0);
        $('.layout').removeClass('dialog-opened');
        
        $("#recall-form").removeClass("show");
    }

    function closeDropdown() {
        $('.dropdown').removeClass('is-opened');
    }

    function closeCategories() {
        $('body').removeClass('categories-opened');
    }

    function appendOnResize(){
        var flag640,
            flag1024;

        $(window).resize(function () {
            if (flag1024 !== false && window.innerWidth <= 1024) {
                $('.auth-controls').prependTo('.nav');
                $('.location-chooser').prependTo('.top-bar__right');
                flag1024 = false;
            }

            else if (flag1024 !== true && window.innerWidth > 1024) {
                $('.auth-controls').prependTo('.auth');
                $('.location-chooser').prependTo('.middle-bar__cell:first-child');
                flag1024 = true;
            }
        }).resize();
    }

}.call(this));
$(function() {
    $(".load-js").addClass("load");
    function getTimeRemaining(endtime){

        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor( (t/1000) % 60 );
        var minutes = Math.floor( (t/1000/60) % 60 );
        var hours = Math.floor( (t/(1000*60*60)) % 24 );
        var days = Math.floor( t/(1000*60*60*24) );

        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }
    function updateClock(){
        if (typeof TRAIV_NEWS_COUNTER_NEW_DATE !== "undefined") {
            var t = getTimeRemaining(TRAIV_NEWS_COUNTER_NEW_DATE);
            $(".order-germany .days").text(t.days);
            $(".order-germany .hours").text(t.hours);
            $(".order-germany .minutes").text(t.minutes);
            $(".order-germany .seconds").text(t.seconds);
        }
    }

    updateClock(); // запустите функцию один раз, чтобы избежать задержки
    var timeinterval = setInterval(updateClock, 1000);
});


 // проверка форм
 $(function() {
     /* Проверка обратного звонка
    $("body").on("click", "#recall-form button", function() {
        var stop = false;
        $("#recall-form .form-control").each(function() {
            if ($(this).val() == '') {
                $(this).addClass("f-input-error");
                stop = true;
            } else {
                $(this).removeClass("f-input-error");
            }
        });
        if (stop) {
            return false;
        }
     });
     */
    // При уводе фокуса если заполнено, то снимаем ошибку
    $("body").on("blur", ".f-input-error", function() {
        if ($(this).hasClass("form-email")) {
            if (isValidEmailAddress($(this).val())) {
                $(this).removeClass("f-input-error");
            }
        } else {
            if ($(this).val() != '') {
                $(this).removeClass("f-input-error");
            }
        }
    });
 });
 
// Проверка правильности ввода EMAIL
 function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}

function goPage(sPage)
{   console.log('123');
    window.open(sPage); }

function goPageAjax(sPage)
{
    $.ajax({
        type: 'get',
        url: sPage,
    }); }




