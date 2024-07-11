<?// if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->IncludeComponentTemplate();

require('bd.php');
CModule::IncludeModule('iblock');
//$this->getTemplate()->addExternalCss("/local/components/traiv/calculator1/templates/.default/style.css");
?>


<blockquote>
 <strong><em> Внимание: в калькуляторе используется расчетный вес изделий, который может незначительно отличаться от фактического (в зависимости от производителя и стандарта).</em></strong>
</blockquote>

<!--
<div id="BtnTitiles">


    <div class="item">Распечатать</div>
    <div class="item">Скачать в xls</div>
    <div class="item">Запросить</div>
    <div class="item">Сбросить</div>


</div>
-->




<div class="dsjdjjdjjjjj" style="display: none">
    <div class="r_r" id="r_r">
        <form method="POST">
            <div class="sjsjj">
                <input type="text" id="name" placeholder="Имя"/>
                <input type="text" required id="phone" placeholder="Телефон*"/>
                <input type="text" id="campany" placeholder="Компания"/>
                <input type="text" id="city" placeholder="Город"/>
                <input type="text" required id="E-mail" placeholder="E-mail*"/>
                <input type="text" id="inn" placeholder="ИНН"/>
                <label>Комментарий</label>
                <textarea id="comments"></textarea>
                <label>Если вы уже работали с нами, заполненный ИНН увеличит скорость обработки Вашей заявки.</label>
                <label>* - поля обязательны для заполнения</label>

                <div class="col x1d1 x1d1--m form-control-row2" style="margin-top: 20px;">
                    <div class="block_min_s" style="width: 100%; outline: 2px dashed #fff!important;"><div style="text-align:center;"><strong>Минимальная сумма заказа составляет 500 рублей.</strong></div></div>
                </div>

                <input type="submit" value="Отправить" class="send_messege"/>
            </div>
            <div class="sadasd">
                Сообщение отправлено! <br/>
                С Вами в ближайшее время свяжется менеджер!

            </div>
        </form>
    </div>
</div>


<div class="container_calc">

    <div class="calc">



<!--<div class="inputs">-->

  <!--  <div class="label_mark"> -->

        <!-- <span class="sr1" style="padding-left: 12.2em">ТИП МЕТИЗОВ </span> -->




        <!-- <span class="sr5">КЛАСС ПРОЧНОСТИ </span> -->


  <!--  </div> -->
<div class="selects">
<div class="b_block">
    <span class="sr0">СТАНДАРТ </span>
    <input list="standart" class="standart" name="standart" placeholder="Начните вводить стандарт или изделие">
        <datalist id="standart" class="standart">
            <option></option>
            <!--            --><?php
            $ter1 = "SELECT * FROM `standart`";
            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            while($row1 = mysqli_fetch_array($result1)) {
                ?>
                <option value="<?php echo $row1["name"];  ?>">
                   </option>
                <!--                --><?php
            }
            ?>
        </datalist>
</div>
    <div class="b_block">
        <select class="metizi" name="metizi" hidden>
            <option></option>
            <?//php
            //$ter1 = "SELECT * FROM `metizi`";
            //$result1 = mysqli_query($link, $ter1); // запрос на выборку
            // while ($row1 = mysqli_fetch_array($result1)) {
            //   $ter1_1 = "SELECT * FROM `position` WHERE `metiz` = " . $row1["id"];
            //   $result1_1 = mysqli_query($link, $ter1_1); // запрос на выборку
            //    if ($result1_1->num_rows) {
                    ?>
             <!--       <option value=" --><?php // echo $row1["id"]; ?><!--">--> <?php // echo $row1["name"]; ?><!-- &nbsp</option> -->
                    <?php
             //   }
            //}
            ?>
        </select>
    </div>
<div class="b_block">
    <span class="sr2">ДИАМЕТР, ММ. </span>
        <select class="diametr" name="diametr">
            <option></option>
            <!--            --><?php
            //            $ter1 = "SELECT * FROM `diametr`";
            //            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            //            while($row1 = mysqli_fetch_array($result1)) {
            //                ?>
            <!--                <option value="--><?php //echo $row1["id"];  ?><!--"> -->
            <?php //echo $row1["name"];  ?><!-- &nbsp </option>-->
            <!--                --><?php
            //            }
            //            ?>
        </select>
</div>
<div class="b_block">
    <span class="sr3">ДЛИНА, ММ. </span>
        <select class="dlina" name="dlina">
            <option></option>
            <!--            --><?php
            //            $ter1 = "SELECT * FROM `dlina`";
            //            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            //            while($row1 = mysqli_fetch_array($result1)) {
            //                ?>
            <!--                <option value="--><?php //echo $row1["id"];  ?><!--"> -->
            <?php //echo $row1["name"];  ?><!-- &nbsp </option>-->
            <!--                --><?php
            //            }
            //            ?>
        </select>
</div>
<div class="b_block">
    <span class="sr9">МАТЕРИАЛ </span>
        <select class="material" name="material">
            <option></option>
            <!--            --><?php
            //            $ter1 = "SELECT * FROM `material`";
            //            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            //            while($row1 = mysqli_fetch_array($result1)) {
            //                ?>
            <!--                <option value="--><?php //echo $row1["id"];  ?><!--"> -->
            <?php //echo $row1["name"];  ?><!-- &nbsp </option>-->
            <!--                --><?php
            //            }
            //            ?>
        </select>
</div>
<div class="b_block">
    <span class="sr4">ТИП ПОКРЫТИЯ </span>
        <select class="pokr" name="pokr">
            <option></option>
            <!--            --><?php
            //            $ter1 = "SELECT * FROM `pokr`";
            //            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            //            while($row1 = mysqli_fetch_array($result1)) {
            //                ?>
            <!--                <option value="--><?php //echo $row1["id"];  ?><!--"> -->
            <?php //echo $row1["name"];  ?><!-- &nbsp </option>-->
            <!--                --><?php
            //            }
            //            ?>
        </select>
</div>
<div class="b_block">
        <select class="classproch" name="classproch" hidden>
            <option></option>
                       --><?php
            //            $ter1 = "SELECT * FROM `classproch`";
            //            $result1 = mysqli_query($link,$ter1); // запрос на выборку
            //            while($row1 = mysqli_fetch_array($result1)) {
            //                ?>
            <!--                <option value="--><?php //echo $row1["id"];  ?><!--"> -->
            <?php //echo $row1["name"];  ?><!-- &nbsp </option>-->
            <!--                --><?php
            //            }
            //            ?>
      </select>
</div>
<div class="b_block">
    <span class="sr6">КОЛ-ВО, ШТ. </span>
        <input type="text" name="count" value="1" id="count" autocomplete="off"/>
</div>
<div class="b_block_weight">
    <span class="sr7">ВЕС, КГ. </span>
        <input class="result_print" autocomplete="off">
    <div class="del_place"></div>

</div>


    </div>
<div class="plus"><img src="/local/components/traiv/calculator1/img/plus.png" class="plus_img"></div>
    </div>

        
             <div class="row d-flex align-items-center mt-3" id ="ActionBtns">
<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-left">
<!-- <div class="btn-group-blue"><a href="#" class="btn-404 print_r" id="print_r"><span><i class="fa fa-print"></i> Распечатать</span></a></div>-->
<!-- <div class="print_r" id="print_r"></div>-->

<div class="btn-group-blue"><div class="btn-404 print_r" id="print_r"><span><i class="fa fa-print"></i>Распечатать</span></div></div>

</div>

<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-left">
	<div class="btn-group-blue"><div class="btn-404 download_calc" id="download_calc"><span><i class="fa fa-download"></i>Скачать</span></div></div>
</div>

<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-left">
	<div class="btn-group-blue"><div class="btn-404" id="calc_favorites"><span><i class="fa fa-star"></i> В избранное</span></div></div>
</div>

<div class="col-12 col-xl-2 offset-xl-1 col-lg-2 offset-lg-1 col-md-2 offset-md-1 text-right">
	<!-- <div class="btn-group-blue"><a href="/" class="btn-404 ResetItems"><span><i class="fa fa-refresh"></i> Сбросить</span></a></div> -->
	<div class="btn-group-blue"><div class="btn-red ResetItems"><span><i class="fa fa-refresh"></i>Сбросить</span></div></div>
</div>

<div class="col-12 col-xl-3 col-lg-3 col-md-3 text-right">
	<!-- <div class="btn-group-blue"><a href="#" class="btn-404 phone pss" id="phone"><span><i class="fa fa-envelope-o"></i> Отправить заявку менеджеру</span></a></div>-->
	<div class="btn-group-blue"><a href="#w-form" class="btn-404"><span><i class="fa fa-envelope-o"></i>Отправить заявку менеджеру</span></a></div>
</div>



            </div>
        



</div>


     


<div class="sum_weight"></div>


<div class="elementid"> </div><div class="elid" > </div><div class="elitem row"> </div>


<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"> </script>-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="../calculator1/js/xlsx.full.min.js"></script>
<script src="../calculator1/js/FileSaver.min.js"></script>
<script>
console.log('calc - ');
    $('.pss').on('click', function() {
        $('.dsjdjjdjjjjj').css('display','block');

    });

	$('#calc_favorites').on('click', function() { 
	    if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
		      window.sidebar.addPanel(document.title, window.location.href, '');
		    } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
		      window.external.AddFavorite(location.href, document.title);
		    } else if (window.opera && window.print) { // Opera Hotlist
		      this.title = document.title;
		      return true;
		    } else { // webkit - safari/chrome
		      alert('Нажмите ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D для добавления страницы в избранное.');
		    }
	});
    
    $('.dsjdjjdjjjjj').click(function(e) {

        $('.dsjdjjdjjjjj').css('display','none');

    }).on('click', '#r_r', function(e) {
        e.stopPropagation();
    });

    $('body').on('change', '.standart', function() {

        var id = $(this).parent().parent().find('.standart').val();
        var tyy = $(this);

        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/metiz.php",
            data:  {
                id:id,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.metizi').html(data);
                $(tyy).parent().parent().find('.metizi').change();
                result(tyy);

            }})
    });

    $('body').on('change', '.metizi', function() {
        var id = $(this).parent().parent().find('.metizi').val();
        var standartid = $(this).parent().parent().find('.standart').val();
        var metiziid = $(this).parent().find('.metizi').val();
        var tyy = $(this);

        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/diametr.php",
            data:  {
                id:id,
                standartid:standartid,
                metiziid:metiziid,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.diametr').html(data);
                $(tyy).parent().parent().find('.diametr').change();
                result(tyy);
            }})
    });

    $('body').on('change', '.diametr', function() {
        var id = $(this).parent().parent().find('.diametr').val();
        var standartid = $(this).parent().parent().find('.standart').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/dlina.php",
            data:  {
                id:id,
                standartid:standartid,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.dlina').html(data);
                $(tyy).parent().parent().find('.dlina').change();
                result(tyy);
            }})
    });

    $('body').on('change', '.dlina', function() {

        var id = $(this).parent().parent().find('.diametr').val();
        var standartid = $(this).parent().parent().find('.standart').val();
        var diametrid = $(this).parent().parent().find('.diametr').val();
        var dlinaid = $(this).parent().parent().find('.dlina').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/material.php",
            data:  {
                id:id,
                standartid:standartid,
                diametrid:diametrid,
                dlinaid:dlinaid,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.material').html(data);
                $(tyy).parent().parent().find('.material').change();
                result(tyy);
            }})
    });



    $('body').on('change', '.material', function() {
        var id = $(this).parent().parent().find('.material').val();
        var standartid = $(this).parent().parent().find('.standart').val();
        var materialid = $(this).parent().parent().find('.material').val();
        var diametrid = $(this).parent().parent().find('.diametr').val();
        var dlinaid = $(this).parent().parent().find('.dlina').val();
        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/pokr.php",
            data:  {
                id:id,
                standartid:standartid,
                diametrid:diametrid,
                dlinaid:dlinaid,
                materialid:materialid,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.pokr').html(data);
                $(tyy).parent().parent().find('.pokr').change();
                result(tyy);
            }})

    });


    $('body').on('change', '.pokr', function() {
        var id = $(this).parent().parent().find('.pokr').val();
        var metizid = $(this).parent().parent().find('.metizi').val();
        var standartid = $(this).parent().parent().find('.standart').val();
        var materialid = $(this).parent().parent().find('.material').val();
        var diametrid = $(this).parent().parent().find('.diametr').val();
        var dlinaid = $(this).parent().parent().find('.dlina').val();
        var pokrid = $(this).parent().parent().find('.pokr').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/classproch.php",
            data:  {
                id:id,
                metizid:metizid,
                standartid:standartid,
                materialid:materialid,
                diametrid:diametrid,
                dlinaid:dlinaid,
                pokrid:pokrid,
            },
            success:  function (data){
                $(tyy).parent().parent().find('.classproch').html(data);
                $(tyy).parent().parent().find('.classproch').change();
                result(tyy);
            }})

    })
    $('body').on('change', '.classproch', function() {
        var tyy = $(this);
        result(tyy);



            var metizi = $(tyy).parent().parent().find('.metizi').val();
            var standart = $(tyy).parent().parent().find('.standart').val();
            var diametr = $(tyy).parent().parent().find('.diametr').val();
            var dlina = $(tyy).parent().parent().find('.dlina').val();
            var pokr = $(tyy).parent().parent().find('.pokr').val();
            var classproch = $(tyy).parent().parent().find('.classproch').val();
            var material = $(tyy).parent().parent().find('.material').val();

            $.ajax({
                type: "POST",
                url: "../local/components/traiv/calculator1/update/elementid.php",
                data:  {material:material, metizi:metizi, standart:standart, diametr:diametr, dlina:dlina, pokr:pokr, classproch:classproch  },
                success:  function (data){

                    $(tyy).parent().parent().find('#count').attr('attr', data);


                    result(tyy);


                    $('.elid').text(data);
                    $('.elid').change();
                    $('.elid').hide();

                    hh();
                }})



    });


    $('body').on('change', '.elid', function() {

        var elementid = $('.elid').text();

        $.ajax({
            type: "GET",
            url: "/local/components/traiv/calculator1/elementid_new.php",
            data:  {elementid:elementid},
            cache: false,
            success:  function (response){


                $('.elitem').append(response).children(':last').hide().fadeIn();
            }})


    });


    $('body').on('input', '#count', function() {
        var cena = $(this).parent().parent().find('#count').attr('attr');
        var colvo = $(this).parent().parent().find('#count').val();
        cena = (cena / 1000) * colvo;
        cena = cena.toFixed(3);
        cena = $(this).parent().parent().find('.result_print').val(cena);
    });
    function result(tyy) {
        var metizi = $(tyy).parent().parent().find('.metizi').val();
        var standart = $(tyy).parent().parent().find('.standart').val();
        var diametr = $(tyy).parent().parent().find('.diametr').val();
        var dlina = $(tyy).parent().parent().find('.dlina').val();
        var pokr = $(tyy).parent().parent().find('.pokr').val();
        var classproch = $(tyy).parent().parent().find('.classproch').val();
        var material = $(tyy).parent().parent().find('.material').val();
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/result.php",
            data:  {material:material, metizi:metizi, standart:standart, diametr:diametr, dlina:dlina, pokr:pokr, classproch:classproch  },
            success:  function (data){
console.log(data);
                $(tyy).parent().parent().find('#count').attr('attr', data);

                var cena = $(tyy).parent().parent().find('#count').attr('attr');
                var colvo = $(tyy).parent().parent().find('#count').val();

                cena = (cena / 1000) * colvo;
                cena = cena.toFixed(3);
                cena = $(tyy).parent().parent().find('.result_print').val(cena);
                hh();
            }})
    }

    $('body').on('focus', '.result_print', function() {

        var old = $(this).parent().parent().find('.result_print').val();
        var oldcolich = $(this).parent().parent().find('#count').val();

    $('body').on('input', '.result_print', function() {
        var attr = $(this).parent().parent().find('.result_print').attr('attr');
        var colich = $(this).parent().parent().find('.result_print').val();
        var colich = oldcolich / (old / colich);
        colich = Math.round(colich);
        colich = $(this).parent().parent().find('#count').val(colich);
    });
    });


    function totalSumm() {

        let weights = $('.result_print');
        let weightOutput = $('.sum_weight');
        let summ = 0;
        weightOutput.val(0);

        weights.each(function () {
            summ = parseFloat(weightOutput.val()) + parseFloat($(this).val());
            summ.toFixed(3);
            weightOutput.val(summ);
        });

        if (!isNaN(summ) && $('.selects').length > 1){
            weightOutput.html('Итого: '+ ' ' +summ.toFixed(3)+' кг.');
        }
    };

    $('body').on('change blur input', '.result_print', function() {
        totalSumm();
    });

    $('body').on('change blur input', '#count', function() {
        totalSumm();
    });

    $('body').on('change', '.material', function() {
        totalSumm();
    });

    $(".calc").bind( 'DOMSubtreeModified input',function() {
        totalSumm();
    });






    //$('.plus').on('click', function() {
    	$("body").on("click", ".plus", function(e){
        var calc = $('.selects').html();

        calc.replace(/С/g, '');


        calc = '<div class="selects">' + calc + '</div>';
        var $closebutton = '<button class="closetwo">X</button>';
     //   var $newitemdiv = '<div class="elitem">X</div>';
        var $calc =$(calc);


      //  $('.selects').append($calc);


//        $('.selects').clone(true).find('input').remove().appendTo('.selects');
//        $(this).find('select').remove();


        var cont = $('.selects:last').clone(true);//.css({'background':'url(/local/components/traiv/calculator1/img/stripe2.png) no-repeat','height':'140px','width':'1120px','margin':'0px'});
        $(cont).find(".b_block:first");//.css('margin-left','4.6%');
        $(cont).find("span").remove();
        $(cont).find(".closetwo").remove();
        $(cont).find("#ActionBtns").remove().end().insertAfter(".selects:last");

        var $select = $calc.find('select');
        $select.each(function (index, element) {
            var $element = $(element);
            if(!$element.is('.standart')){
                $element.find('option').each(function (i, el) {
                    var $el = $(el);
                    if($el.val()){
                        $el.detach();
                    }
                });
            }
        });
        $calc.find('.result_print').text('');
        $('.standart').last().val('');


        $(".del_place:last").html($closebutton);
      //  $('.elitem:last').append($newitemdiv);
        // $('.calc:last').find('.metizi option:last').prop('selected','selected').change();
    });
    $('.download_calc').on('click', function() {
        var $headers = $('.b_block span');
        var $lastheader = $('.b_block_weight span');
        $headers.push($lastheader);

        var $calc = $('.calc');
        var $lines = $('.selects');
        var header = [];
        var rows = [];

        let headername = ['ГК Трайв-Комплект',' '];
        let headerphone = ['Телефон:','+7 (812) 313-22-80'];
        let headeraddress = ['Адрес','Санкт-Петербург, г. Кудрово, ул. Центральная д.41'];
        let headeremail = ['email:','info@traiv-komplekt.ru'];

        $headers.each(function (index,element) {
            header.push($(element).text().trim());
        });

        $lines.each(function (index, element) {
            var $element = $(element);
            var temp = [];

            var $labels = $element.find('select:visible');
            var count = $element.find('#count').val();
            var summ = $element.find('.result_print').val();
            var standt = $element.find('.standart').val();
            temp.push(standt);
            $labels.each(function (i, el) {
                temp.push($(el).find('option:selected').text())
            });
            temp.push(count);
            temp.push(summ);
            rows.push(temp);

        });
        var wb = XLSX.utils.book_new();
        wb.SheetNames.push("Download");
        var ws_data = [];
        ws_data.push(headername);
        ws_data.push(headerphone);
        ws_data.push(headeraddress);
        ws_data.push(headeremail);
        ws_data.push(header);

        rows.forEach(function (element) {
            ws_data.push(element);
        });

        let weightsum = $('.sum_weight').text();

        let printsum = ['','','','','','Итого: ',weightsum.replace('Итого: ','')];
        ws_data.push(printsum);


        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets["Download"] = ws;
        var wbcols = [];

        header.forEach(function (element) {
            wbcols.push({wpx:115});
        });


        wb['Sheets']['Download']['!cols'] = wbcols;
        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Рассчет веса крепежа - Трайв Комплект.xlsx');
        return;

        /*  $.ajax({
              url:'../local/components/traiv/calculator1/download.php',
              type:'post',
              dataType:'json',
              data:{
                  header:header,
                  data:rows
              },
              success:function (dt) {
                  if(dt.result){
                      var href = '/calculator1/'+dt.link;
                      $('<a>',{href:href,download:'true',text:'Скачать'}).appendTo($('body'));
                  }
              }
          }); */
    });
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
        var view = new Uint8Array(buf);  //create uint8array as viewer
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
        return buf;
    }
    $('.print_r').on('click', function() {
        window.print();
    });
    $('.r_r form').on('submit', function(e) {
        e.preventDefault();

        var ggg = $('.calc');
        var i = 0;
        var text = '';
        while(ggg[i]) {

            n = i + 1;
            text = text + '<h3>Позиция ' + n + '</h3>';
            text = text +  'Тип метизов: ' + $(ggg[i]).find('.metizi option:selected').text() + '<br/>';
            text = text +  'Стандарт: ' + $(ggg[i]).find('.standart').val() + '<br/>';
            text = text +  'Диаметр: ' + $(ggg[i]).find('.diametr option:selected').text() + '<br/>';
            text = text +  'Длина: ' + $(ggg[i]).find('.dlina option:selected').text() + '<br/>';
            text = text +  'Покрытие: ' + $(ggg[i]).find('.pokr option:selected').text() + '<br/>';
            text = text +  'Клас прочности: ' + $(ggg[i]).find('.classproch option:selected').text() + '<br/>';
            text = text +  'Количество: ' + $(ggg[i]).find('#count').val() + '<br/>';
            text = text +  'Заявленный вес: ' + $(ggg[i]).find('.result_print').val() + '<br/>';
            i++;
        }
        var name = $('#name').val();
        var phone = $('#phone').val();
        var campany = $('#campany').val();
        var city = $('#city').val();
        var inn = $('#inn').val();
        var comments = $('#comments').val();
        $.ajax({
            type: "POST",
            url: "../local/components/traiv/calculator1/update/mail.php",
            data:  {name:name, phone:phone, campany:campany, city:city, inn:inn, comments:comments, text:text  },
            success:  function (data){

                $('.sjsjj').css('display','none');
                $('.sadasd').css('display','block');
            }})
    });

    $('body').on('mousedown', '.standart', function() {
        $(this).val('');
    });


    $('body').on('click', '.closetwo', function() {

        $(this).parent().parent().parent().remove();
        if ($('.selects').length === 1){$('.sum_weight').text('');}
    });

    $('body').on('click', '.CloseItem', function() {

        $(this).parent().parent().parent().fadeOut("slow");
        $('h3').fadeOut("slow");
    });

    $('body').on('click', '.ResetItems', function() {

        $('.standart:first').val('');
        $('.standart:first').change();

        $('.elitem').children().remove();
        $('.selects').not(':first').remove();
        $('.sum_weight').text('');
        $('#count').val('1');

        $('html, body').animate({scrollTop: 0},900);
        return false;

    });

    function hh() {

        var  w1 = $('.metizi').width() + 2;
       // $('.sr0').width(w1);

        var w2 = $('.standart').width() + 2;
      //  $('.sr1').width(w2);

        var w3 = $('.material').width() + 2;
      // $('.sr9').width(w3);

        var w4 = $('.diametr').width() + 2;
      //  $('.sr2').width(w4);

        var w5 = $('.dlina').width() + 2;
      //  $('.sr3').width(w5);

        var w6 = $('.pokr').width() + 2;
     //   $('.sr4').width(w6);

        var w7 = $('.classproch').width() + 2;
     //   $('.sr5').width(w7);
    }
    $('window').ready(function() {

        $('.classproch').change();

    });
</script>



