$(document).ready(function() {
  if ($('.kombox-filter-property-body:last').children('.lvl2').length > 1){
      $('.measurment__item').show();
  }

    $('.opt').click(function () {
        let item = $(this).parent().parent().parent().parent().find('.new-item-line__title');
        let itemname = item.text();
        let itemurl = item.children().attr('href');
        $('#FORM4_FIELD_MESSAGE').val('Меня интересует оптовая цена на '+itemname);
        $('[name = "FIELDS[HIDDEN]"]').val(itemurl);
    });

})