$(document).ready(function() {
    if ($('.kombox-filter-property-body:last').children('.lvl2').length > 1){
        $('.measurment__item').show();
    }

    $('.opt').click(function () {
        let item = $(this).parent().parent().find('.new-item__title');
        let itemname = item.text();
        itemname = itemname.replace(/\s{2,}/g, ' ');
        let itemurl = item.children().attr('href');
        $('#FORM4_FIELD_MESSAGE').val('Меня интересует оптовая цена на '+itemname);
        $('[name = "FIELDS[HIDDEN]"]').val(itemurl);
    });
})