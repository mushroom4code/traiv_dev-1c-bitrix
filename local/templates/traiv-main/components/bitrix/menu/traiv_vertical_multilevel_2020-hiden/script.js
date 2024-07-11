$(function() {
    $(".traiv-menu-catalog-sections .header-menu").click(function() {
        $(".traiv-menu-catalog-sections .header-menu").closest(".traiv-menu-catalog-sections").toggleClass("open");
    });
});


    $(".menu-showmore").click(function() {
        $(".menu-block-2").show();
        $(".menu-block-3").show();
        $(".menu-showless").show();
        $(".menu-showmore").hide();
        });

    $(".menu-showless").click(function() {
        $(".menu-block-2").hide();
        $(".menu-block-3").hide();
        $(".menu-showless").hide();
        $(".menu-showmore").show();
        });

    $(".open-menu").click(function() {
        $(".menu-switch-area").toggleClass("open");
        $(".header-menu-catalog i").toggleClass("fa-angle-down fa-angle-up");
    });
