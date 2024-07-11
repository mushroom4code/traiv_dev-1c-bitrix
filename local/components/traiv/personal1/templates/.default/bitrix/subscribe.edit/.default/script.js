$(function() {
    $(".traiv-personal-subscribe-edit .save-subscribe").click(function() {
        if (!$(".traiv-personal-subscribe-edit .traiv-container-checkbox input").prop("checked")) {
            $(".traiv-personal-subscribe-edit .traiv-container-checkbox .label").css("color", "red");
            return false;
        }
    });
});