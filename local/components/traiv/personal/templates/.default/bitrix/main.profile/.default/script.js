$(function() {
    $(document).on("click", ".traiv-personal-profile-default .traiv-orange-button", function() {
        $("#input-login").val($("#input-email").val());
    });
    
    $(".traiv-personal-profile-default .radio").click(function() {
        var container = $(this).closest(".user-type");
        if (!$(container).hasClass("active")) {
            $(".traiv-personal-profile-default .user-type").removeClass("active");
            $(container).addClass("active");
            $(".traiv-personal-profile-default .container-slide").slideUp();
            $(container).find(".container-slide").slideDown();
        }
    });
    
    $(".traiv-personal-profile-default .change-password").click(function() {
        var container = $(".traiv-personal-profile-default .user-password");
        if ($(container).hasClass("active")) {
            $(container).removeClass("active");
        } else {
            $(container).addClass("active");
        }
        $(".traiv-personal-profile-default .container-password").slideToggle();
    });
    
    $('.traiv-personal-profile-default input[name=UF_INN]').mask('9999999999');
})