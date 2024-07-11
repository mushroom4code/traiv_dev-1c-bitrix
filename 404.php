<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>
<section id="content">
    <div class="container">

      
      <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/404_page_category.php"
                                )
                            );
                            ?>
<div class="row d-flex align-items-center">
<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center"><div class="title404">404</div></div>
</div>


<div class="row d-flex align-items-center">
<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-right">
<div class="btn-group-blue"><a href="/contacts/" class="btn-404" data-ajax-order-detail=""><span><i class="fa fa-phone"></i> Свяжитесь с нами</span></a></div>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-center">
	<div class="btn-group-blue"><a href="/" class="btn-404"><span><i class="fa fa-home"></i> Вернуться на главную</span></a></div>
</div>

<div class="col-12 col-xl-4 col-lg-4 col-md-4 text-left">
	<div class="btn-group-blue"><a href="/calculator/" class="btn-404"><span><i class="fa fa-calculator"></i> Калькулятор веса крепежа</span></a></div>
</div>



            </div>
            
            <div class="row d-flex align-items-center mt-3">

            <p style="text-align: center;">Вы будете перенаправлены на главную страницу через <span id="counter">30</span> секунд.</p>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById('counter');
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = 'https://traiv-komplekt.ru/';
                    }
                    if (parseInt(i.innerHTML)!=0) {
                        i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                }
                setInterval(function(){ countdown(); },1000);
            </script>
                <h1 style="text-align:center;margin-bottom:10px !important;">Вы только что сломали сайт Трайв-Комплект!</h1>
                <h2 style="text-align:center;padding-top:10px;">Шутка :)<br>Просто страница, к которой Вы обратились, не найдена или поменяла адрес.</h2>
                <p style="text-align:center;">
                    Пожалуйста, простите нас за данное недоразумение, мы делаем все возможное, чтобы таких проблем на нашем сайте у Вас не возникало.<br>
                    <br>
                    <!--	Чтобы сделать срочный заказ или задать вопрос:<br><br> -->

            </div>

    </div>
</section>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


