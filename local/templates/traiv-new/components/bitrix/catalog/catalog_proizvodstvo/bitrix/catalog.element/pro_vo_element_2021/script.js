$('.prod-standart-more').click(function() {
    $(this).hide()
$('.prod-standart-block').css({'width':'100%', 'height':'inherit'});
/*    $('.prod-comma:last').remove();*/
    $('.prod-standart-less').show();
})
$('.prod-standart-less').click(function() {
    $(this).hide()
    $('.prod-standart-block').css({'width':'87%', 'height':'14pt'});
    $('.prod-standart-more').show();
})

$( document ).ready(function() { /* because fuck it im quit this job */

    $('.form-question:nth-child(6)').children().html('<input class="form-control" type="text" id="FORM10_FIELD_Контакты для связи" name="FIELDS[Контакты для связи]" value="" placeholder="Контакты для связи">');

});