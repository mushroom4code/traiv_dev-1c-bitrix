
$(document).ready(function(){
    /*onOut();

    $(function () {
        $(".slider").hover(onIn, onOut);
    });

    function onIn() {
        $(".fa").animate({opacity: 0.8}, 800);
    };

    function onOut() {
        $(".fa").animate({opacity: 0}, 800);
    };*/

    $('.single-item').slick({
        lazyLoad: 'ondemand',
        dots: true,
        dotsClass: "my-dots",
        arrows: true,
           nextArrow: '<i class="fa fa-angle-right fa_this" aria-hidden="true"></i>',
            prevArrow: '<i class="fa fa-angle-left fa_this" aria-hidden="true"></i>',
        infinite: true,
        autoplay: true,
        speed: 800,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
});
