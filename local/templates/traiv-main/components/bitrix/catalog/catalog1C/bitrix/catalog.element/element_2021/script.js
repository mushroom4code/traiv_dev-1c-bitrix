(function(){
    $(document).ready(function(event) {

/*        $(document).on('click', '[data-ajax-order-detail]', function(event){
            BX.showWait();
            event.preventDefault();
            var id = /id=\d+/g.exec(this.href);
            id = /\d+/g.exec(id[0])[0];

            var $b = $('[data-product_id="' + id + '"]');
            if($b.length) {//уже есть в корзине
                let quant = $('#'+id+'-item-quantity').val();
                let basketquant = $b.find('.item-counter__input').val();
                basketquant = parseInt(basketquant) + parseInt(quant);
                $b.find('.item-counter__input').val(basketquant);
            }else{
                sendAjaxOrderRequest(event.currentTarget.href);
            }

            var cord1 = $(".cart_total_count").offset()['left'];
            var cord2 = $(".cart_total_count").offset()['top'];
            var cord3 = $('#'+id).offset()['left'];
            var cord4 = $('#'+id).offset()['top'];
            var topTarget = cord4 - cord2;
            topTarget = topTarget*0.5;
            var leftTarget = cord1 - cord3;

            var clst = $('#'+id);

            clst
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', 'width' : '20%'})
                .appendTo("#itemid")
                .animate({opacity: 0.05,
                    left: leftTarget,
                    top: -topTarget,
                    width: 20}, 1000, function() {
                    $(this).remove();
                });

            BX.closeWait();

        });*/

        if ($('.analog-material').length > 0) {
            $('.analog_materials_block').show();
        }

        if ($('.analog-material').length > 10){
            $('.analog-material').css({'padding' : '0 4px'});
        }
        if ($('.analog-material').length > 12) {
            $('.analog_materials_block').css({'margin' : '0', 'width' : '101%'});
        }

    });

})();


function openTab(evt, tabName) {
// Declare all variables
    var i, tabcontent, tablinks;

// Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

// Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

// Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

$(document).ready(function(){

    $('.product-gallery a').click(function(e){

        let img  = $(this).attr("href");

        $("#main-image img").attr("src", img );

        e.preventDefault();

        return false;

    });


});

$('.download_excel.stroy > a').on('click', function() {

    let counterID = 239211 ;

    $.ajax({
        type: 'POST',
        url: "/local/templates/traiv-main/components/bitrix/catalog/catalog1C/bitrix/catalog.element/.default/counter.php",
        data: {
            counterID:counterID
        },
        success: function(data){
            $('.stroy-number').html(data);
        }

    });


})

$('.download_excel.mash > a').on('click', function() {

    let counterID = 239212 ;

    $.ajax({
        type: 'POST',
        url: "/local/templates/traiv-main/components/bitrix/catalog/catalog1C/bitrix/catalog.element/.default/counter.php",
        data: {
            counterID:counterID
        },
        success: function(data){
            $('.mash-number').html(data);
        }

    });

})


