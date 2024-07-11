$(function() {    
    $(document).on("click", "#traiv-system-pagenavigation-ajax", function() {
        TRAIV_SYSTEM_PAGENAVIGATION_AJAX_CURENT++;
        $.get(
            $(this).attr('href'),
            {
                AJAX_PAGE: "Y",
                PAGEN_1: TRAIV_SYSTEM_PAGENAVIGATION_AJAX_CURENT, //!!!!! Заменить PAGEN_1 на содержимое переменной TRAIV_SYSTEM_PAGENAVIGATION_AJAX_NAV
            }, 
            function(data) {
                $(".container-ajax-content").append(data);
                
                if (TRAIV_SYSTEM_PAGENAVIGATION_AJAX_CURENT >= TRAIV_SYSTEM_PAGENAVIGATION_AJAX_COUNT) {
                    $("#traiv-system-pagenavigation-ajax").fadeOut();
                }
            }
        );
        return false;
    });
});
