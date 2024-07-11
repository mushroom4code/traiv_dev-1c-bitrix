<?php
require('bd.php');
?>
<link rel="stylesheet" type="text/css" href="../calculator1/update/style.css"/>
<link media="print" rel="stylesheet" type="text/css" href="../calculator1/update/print.css"/>
<p align="center" style="font-size: 1em;"><span align="center" style="font-size: 1.2em; color: red;">!</span> Внимание: в калькуляторе используется расчетный вес изделий, который может незначительно отличаться от фактического (в зависимости от производителя и стандарта).</p>
<div class="container_calc">
    <div class="label_mark">
        <span class="sr0" style="padding-left: 11em">СТАНДАРТ </span>
        <span class="sr1" style="padding-left: 12.5em">ТИП МЕТИЗОВ </span>
        <span class="sr9" style="padding-left: 6.3em">МАТЕРИАЛ </span>
        <span class="sr2" style="padding-left: 6.7em">ДИАМЕТР </span>
        <span class="sr3" style="padding-left: 1.1em">ДЛИНА </span>
        <span class="sr4" style="padding-left: 3.5em">ТИП ПОКРЫТИЯ </span>
       <!-- <span class="sr5">КЛАСС ПРОЧНОСТИ </span> -->
        <span class="sr6" style="padding-left: 3.2em">КОЛ-ВО, ШТ. </span>
        <span class="sr7" style="padding-left: 5.2em">ВЕС, КГ. </span>
    </div>
    <div class="calc">

        <select list="standart" class="standart" name="standart" style="height: 32px" id="standartid" >

            <option>Выберите DIN/ISO/ГОСТ</option>
            <!--            --><?php
                        $ter1 = "SELECT * FROM `standart`";
                        $result1 = mysqli_query($link,$ter1); // запрос на выборку
                        while($row1 = mysqli_fetch_array($result1)) {
                            ?>
                            <option value="<?php echo $row1["id"];  ?>  ">
                                <?php echo $row1["name"];  ?> &nbsp </option>
            <!--                --><?php
                        }
                        ?>

        </select>

        <select class="metizi" name="metizi" >
            <option></option>
            <?php
          //  $ter1 = "SELECT * FROM `metizi`";
          //  $result1 = mysqli_query($link, $ter1); // запрос на выборку
          //  while ($row1 = mysqli_fetch_array($result1)) {
          //      $ter1_1 = "SELECT * FROM `position` WHERE `metiz` = " . $row1["id"];
          //      $result1_1 = mysqli_query($link, $ter1_1); // запрос на выборку
          //      if ($result1_1->num_rows) {
                    ?>
            <!--        <option value="<?php //echo $row1["id"]; ?>"> <?php // echo $row1["name"]; ?> &nbsp</option> -->
                    <?php //
           //     }
          //  }
            ?>
        </select>
        <select class="material" name="material" style="width: 227.2px;">
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
        <input type="text" name="count" value="1000" id="count"/>

        <span id="result_print">0.000</span>


    </div>
</div>
<div class="plus">+</div>
<div class="print_r">Напечатать</div>
<div class="download_calc">Скачать результаты в таблице</div>
<a class="pss" href="#r_r">Связаться с менеджером</a>
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
    <div class="block_min_s" style="width: 100%; outline: 2px dashed #fff!important;"><div style="text-align:center;"><strong>Минимальная сумма заказа составляет 3 000 рублей.</strong></div></div>
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
<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"> </script>-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
<script src="../calculator1/js/xlsx.full.min.js"></script>
<script src="../calculator1/js/FileSaver.min.js"></script>
<script>
    $('.pss').on('click', function() {
        $('.dsjdjjdjjjjj').css('display','block');

    });
    $('.dsjdjjdjjjjj').click(function(e) {

        $('.dsjdjjdjjjjj').css('display','none');

    }).on('click', '#r_r', function(e) {
        e.stopPropagation();
    });

    $('body').on('change', '.standart', function() {
        //alert ('1!');
        var id = $(this).parents('.calc').find('.standart').val();
        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/metiz.php",
            data:  {
                id:id,
            },
            success:  function (data){
                $(tyy).parents('.calc').find('.metizi').html(data);
                $(tyy).parents('.calc').find('.metizi').change();
                result(tyy);
               // alert (id);
            }})
    });

    $('body').on('change', '.metizi', function() {
       // alert ('2!');
        var id = $(this).parents('.calc').find('.metizi').val();
        var standartid = $(this).parents('.calc').find('.standart').val();
        var metiziid = $(this).parents('.calc').find('.metizi').val();
        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/material.php",
            data:  {
                id:id,
                standartid:standartid,
                metiziid:metiziid,
            },
            success:  function (data){
                $(tyy).parents('.calc').find('.material').html(data);
                $(tyy).parents('.calc').find('.material').change();
                result(tyy);
              //  alert (id);
            }})
    });

    $('body').on('change', '.material', function() {
       // alert ('3!');
        var id = $(this).parents('.calc').find('.material').val();
        var metizid = $(this).parents('.calc').find('.metizi').val();
        var standartid = $(this).parents('.calc').find('.standart').val();
        var materialid = $(this).parents('.calc').find('.material').val();
        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/diametr.php",
            data:  {
                id:id,
                metizid:metizid,
                standartid:standartid,
                materialid:materialid,
            },
            success:  function (data){
                $(tyy).parents('.calc').find('.diametr').html(data);
                $(tyy).parents('.calc').find('.diametr').change();
                result(tyy);
               // alert (id);
            }})

    });
    $('body').on('change', '.diametr', function() {

        var id = $(this).parents('.calc').find('.diametr').val();
        var metizid = $(this).parents('.calc').find('.metizi').val();
        var standartid = $(this).parents('.calc').find('.standart').val();
        var materialid = $(this).parents('.calc').find('.material').val();
        var diametrid = $(this).parents('.calc').find('.diametr').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/dlina.php",
            data:  {
                id:id,
                metizid:metizid,
                standartid:standartid,
                materialid:materialid,
                diametrid:diametrid,
            },
            success:  function (data){
                $(tyy).parents('.calc').find('.dlina').html(data);
                $(tyy).parents('.calc').find('.dlina').change();
                result(tyy);
            }})
    });
    $('body').on('change', '.dlina', function() {
        var id = $(this).parents('.calc').find('.dlina').val();
        var metizid = $(this).parents('.calc').find('.metizi').val();
        var standartid = $(this).parents('.calc').find('.standart').val();
        var materialid = $(this).parents('.calc').find('.material').val();
        var diametrid = $(this).parents('.calc').find('.diametr').val();
        var dlinaid = $(this).parents('.calc').find('.dlina').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/pokr.php",
            data:  {
                id:id,
                metizid:metizid,
                standartid:standartid,
                materialid:materialid,
                diametrid:diametrid,
                dlinaid:dlinaid,
            },
            success:  function (data){
                $(tyy).parents('.calc').find('.pokr').html(data);
                $(tyy).parents('.calc').find('.pokr').change();
                result(tyy);
            }})
    });
    $('body').on('change', '.pokr', function() {
        var id = $(this).parents('.calc').find('.pokr').val();
        var metizid = $(this).parents('.calc').find('.metizi').val();
        var standartid = $(this).parents('.calc').find('.standart').val();
        var materialid = $(this).parents('.calc').find('.material').val();
        var diametrid = $(this).parents('.calc').find('.diametr').val();
        var dlinaid = $(this).parents('.calc').find('.dlina').val();
        var pokrid = $(this).parents('.calc').find('.pokr').val();

        var tyy = $(this);
        $.ajax({
            type: "POST",
            url: "../calculator1/update/classproch.php",
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
                $(tyy).parents('.calc').find('.classproch').html(data);
                $(tyy).parents('.calc').find('.classproch').change();
                result(tyy);
                $('.plus').one(click());
            }})

    })
    $('body').on('change', '.classproch', function() {
        var tyy = $(this);
        result(tyy);
    });
    $('body').on('input', '#count', function() {
        var cena = $(this).parents('.calc').find('#count').attr('attr');
        var colvo = $(this).parents('.calc').find('#count').val();
        cena = (cena / 1000) * colvo;
        cena = cena.toFixed(3);
        cena = $(this).parents('.calc').find('#result_print').html(cena);
    });
    function result(tyy) {
        var metizi = $(tyy).parents('.calc').find('.metizi').val();
        var standart = $(tyy).parents('.calc').find('.standart').val();
        var diametr = $(tyy).parents('.calc').find('.diametr').val();
        var dlina = $(tyy).parents('.calc').find('.dlina').val();
        var pokr = $(tyy).parents('.calc').find('.pokr').val();
        var classproch = $(tyy).parents('.calc').find('.classproch').val();
        var material = $(tyy).parents('.calc').find('.material').val();
        $.ajax({
            type: "POST",
            url: "../calculator1/update/result.php",
            data:  {material:material, metizi:metizi, standart:standart, diametr:diametr, dlina:dlina, pokr:pokr, classproch:classproch  },
            success:  function (data){

                $(tyy).parents('.calc').find('#count').attr('attr', data);

                var cena = $(tyy).parents('.calc').find('#count').attr('attr');
                var colvo = $(tyy).parents('.calc').find('#count').val();

                cena = (cena / 1000) * colvo;
                cena = cena.toFixed(3);
                cena = $(tyy).parents('.calc').find('#result_print').html(cena);
                hh();
            }})
    }
<!--
    var des = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value');
    var elem = document.getElementById('standartid');
    Object.defineProperty(elem, 'value', { get: function() {
            if(this.type === 'text' && this.list) {
                var value = des.get.call(this);
                var opt = [].find.call(this.list.options, function(option) {
                    return option.value === value;
                });
                return opt ? opt.dataset.value : value;
            }
        }});
-->
    $('.plus').on('click', function() {
        var calc = $('.calc').html();
        calc = '<div class="calc"><span class="close">X</span>' + calc + '</div>';
        var $calc =$(calc);
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
        $calc.find('#result_print').text('');

        $('.container_calc').append($calc);
        // $('.calc:last').find('.metizi option:last').prop('selected','selected').change();
    });
    $('.download_calc').on('click', function() {
        var $headers = $('.label_mark span');
        var $calc = $('.calc');
        var header = [];
        var rows = [];
        $headers.each(function (index,element) {
            header.push($(element).text().trim());
        });
        $calc.each(function (index, element) {
            var $element = $(element);
            var temp = [];
            var $labels = $element.find('select');
            var count = $element.find('#count').val();
            var summ = $element.find('#result_print').text().trim();
            $labels.each(function (i, el) {
                temp.push($(el).find('option:selected').text())
            });
            temp.push(count);
            temp.push(summ);
            rows.push(temp);
        });
        var wb = XLSX.utils.book_new();
        wb.SheetNames.push("Download");
        var ws_data = [header];
        rows.forEach(function (element) {
            ws_data.push(element);
        });
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets["Download"] = ws;
        var wbcols = [];

        header.forEach(function (element) {
            wbcols.push({wpx:115});
        });

        wb['Sheets']['Download']['!cols'] = wbcols;
        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Calculator_table_Traiv-Komplekt.ru.xlsx');
        return;
        $.ajax({
            url:'../calculator1/download.php',
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
        });
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
            text = text + '<h1>Позиция ' + n + '</h1>';
            text = text +  'Тип метизов: ' + $(ggg[i]).find('.metizi option:selected').text() + '<br/>';
            text = text +  'Стандарт: ' + $(ggg[i]).find('.standart option:selected').text() + '<br/>';
            text = text +  'Диаметр: ' + $(ggg[i]).find('.diametr option:selected').text() + '<br/>';
            text = text +  'Длина: ' + $(ggg[i]).find('.dlina option:selected').text() + '<br/>';
            text = text +  'Покрытие: ' + $(ggg[i]).find('.pokr option:selected').text() + '<br/>';
            text = text +  'Клас прочности: ' + $(ggg[i]).find('.classproch option:selected').text() + '<br/>';
            text = text +  'Количество: ' + $(ggg[i]).find('#count').val() + '<br/>';
            text = text +  'Заявленный вес: ' + $(ggg[i]).find('#result_print').html() + '<br/>';
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
            url: "../calculator1/update/mail.php",
            data:  {name:name, phone:phone, campany:campany, city:city, inn:inn, comments:comments, text:text  },
            success:  function (data){
            	ym(18248638,'reachGoal','calman');
                $('.sjsjj').css('display','none');
                $('.sadasd').css('display','block');
            }})
    });
    $('body').on('click', '.close', function() {

        $(this).parents('.calc').remove();
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

