$(function() {
    $("#traiv-catalog-section-link-more").click(function() {
        $(this).addClass("loader");
        var link = $("a.pagination__link[rel=next]").attr("href");
        
       $.post(
            link,
            {AJAX_MODE: "Y"}, 
            function(data){
                var navigation = $(data).find(".bottom-nav").addBack(".bottom-nav").html();
                var elements = '<div class="slide-elements">' + $(data).find("ul.row").addBack("ul.row:eq(0)").html() + '</div>';
                $(".u-offset-top-25.overflow-h").html(navigation);
                $(".subsection > ul.row").append(elements);
                $(".slide-elements").slideDown();
                
                if (!$(data).find("a.pagination__link[rel=next]").addBack("a.pagination__link[rel=next]").html()) {
                    $("#traiv-catalog-section-link-more").hide();
                }
                $("#traiv-catalog-section-link-more").removeClass("loader");
            }
        )
    })
})