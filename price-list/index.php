<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Прайс-лист метизной и крепежной продукции компании");
$APPLICATION->SetPageProperty("title", "Прайс-лист");
$APPLICATION->SetTitle("Прайс-лист");
?>  <section id="content">
    <div class="container">

        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "zf",
        ),
            false
        ); ?>
        
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Прайс-лист</span></h1>
    </div>
</div>

<?php 
/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {*/
 ?>
 
 <div class="row">

<div class="col-12 col-xl-4 col-lg-4 col-md-4 pb-3 order-2 order-sm-2 order-lg-1">

<?php 
/*if ( $USER->IsAuthorized() )
{*/
    ?>
        
        <blockquote style="margin:0px;" class="d-none d-lg-block mb-3">
        <form method="post" action="/price-list/get_all_price.php">
        <div class="btn-group-blue"><a href="#" class="btn-404" id="getAllPrice" onclick="ym(18248638,'reachGoal','get_all_price'); return true;"><span><i class="fa fa-download"></i> Скачать полный прайс-лист</span></a></div>
        </form>       
        </blockquote>
        <?php
/*} else {
    ?>
        
        <blockquote style="margin:0px;" class="d-none d-lg-block mb-3">
<strong><em> Чтобы получить полный прайс-лист, необходимо <a href='/auth/' class="blockquote">авторизоваться</a> на сайте или <a href='/registration/' class="blockquote">зарегистрироваться</a>.</em></strong>       
        </blockquote>
        <?php
}*/
?>


                <blockquote style="margin:0px;" class="d-none d-lg-block">
 <strong><em> Для получения сформированного прайс-листа выберите соответствующие фильтры, после этого нажмите кнопку Выгрузить Excel.</em></strong>
 <!-- <strong><em> Для незарегистрированных пользователей количество, выбранных в фильтре значений ограниченно.</em></strong>
 <strong><em> Чтобы выгружать прайс-листы без ограничений и иметь возможность сохранять их в своем <a href='/lk/' class="blockquote">личном кабинете</a>, необходимо <a href='/registration/' class="blockquote">зарегистрироваться</a>.</em></strong>-->
</blockquote>


<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 price-list-note">
<p><i class="fa fa-exclamation-circle"></i>Если вы хотите получить Прайс-лист на почту или уточнить детали по телефону воспользуйте формой ниже:</p>     
        
        <div class="shadow-cont-filex">
         <? $APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"pricelist", 
	array(
		"COMPONENT_TEMPLATE" => "pricelist",
		"ELEMENT_ID" => $arResult["ID"],
		"WEB_FORM_ID" => "4",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "/ajax/forms/pricelist_saved.php",
		"EDIT_URL" => "/ajax/forms/pricelist_saved.php",
		"SUCCESS_URL" => "/ajax/forms/pricelist_saved.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
        
        <!--////////
        <div class="slam-easyform" style="max-width:450px"><form id="FORM5" enctype="multipart/form-data" method="POST" action="" autocomplete="on" novalidate="novalidate"><div class="alert alert-success hidden" role="alert">
            Ваше сообщение отправлено. Мы свяжемся с вами в течение ближайшего рабочего часа        </div><div class="alert alert-danger hidden" role="alert">
            Произошла ошибка. Сообщение не отправлено.                    </div><input type="hidden" name="FORM_ID" value="FORM5"><input type="text" name="ANTIBOT[NAME]" value="" class="hidden"><div class="row"><div class="col-xs-12"><div class="form-group"><label class="control-label" for="FORM5_FIELD_TITLE">Ваше имя<span class="asterisk">*</span>:</label><input class="form-control" type="text" id="FORM5_FIELD_TITLE" name="FIELDS[TITLE]" value="" required=""></div></div><div class="col-xs-12"><div class="form-group"><label class="control-label" for="FORM5_FIELD_PHONE">Мобильный телефон<span class="asterisk">*</span>:</label><input class="form-control" type="tel" id="FORM5_FIELD_PHONE" name="FIELDS[PHONE]" value="" placeholder="+7(999)999-99-99" required="" data-inputmask-mask="+7 (999) 999-9999" data-mask="+7 (999) 999-9999"></div></div><div class="col-xs-12 pt-2 pb-2 text-center"><button type="submit" class="btn-blue submit-button submit-big-text w100" data-default="Отправить" rel="1">Отправить</button></div></div></form></div>
        <!--////////-->
        
        
</div>

</div>

<div class="col-12 col-xl-8 col-lg-8 col-md-8 order-1 order-sm-1 order-lg-2">


<?php 
if ( $USER->IsAuthorized() ) {
        ?>
        
        <blockquote style="margin:0px;" class="d-block d-sm-none mb-3">
        <form method="post" action="/price-list/get_all_price.php">
        <div class="btn-group-blue"><a href="#" class="btn-404" id="getAllPrice" onclick="ym(18248638,'reachGoal','get_all_price'); return true;"><span><i class="fa fa-download"></i> Скачать полный прайс-лист</span></a></div>
        </form>
        </blockquote>
        <?php 
} else {
    ?>
        
        <blockquote style="margin:0px;" class="d-block d-sm-none mb-3">
<strong><em> Чтобы получить полный прайс-лист, необходимо <a href='/auth/' class="blockquote">авторизоваться</a> на сайте или <a href='/registration/' class="blockquote">зарегистрироваться</a>.</em></strong>       
        </blockquote>
        <?php
}
?>

<blockquote style="margin:0px;" class="d-block d-sm-none mb-2">
 <strong><em> Для получения сформированного прайс-листа выберите соответствующие фильтры, после этого нажмите кнопку Выгрузить Excel.</em></strong>
</blockquote>

    <div class="row">
    <?php 
            $file = "/price-list/get_list.php";
    ?>
<form method="post" action=<?php echo $file;?>>
    
    <!-- <form action="<?php echo $APPLICATION->GetCurPage();?>" method="post">-->
    	        <!-- Filex - start -->
	        <div class="section-sb-filex">
            <div class="section-filter-filex">
                <!-- <button id="section-filter-toggle-filex" class="section-filter-toggle-filex" data-close="Hide Filter" data-open="Show Filter">
                    <span>Show Filter</span> <i class="fa fa-angle-down"></i>
                </button>-->
                <div class="section-filter-cont-filex row">

                
                
                <!-- STANDART -->
                <div class="col-12 col-xl-3 col-lg-3 col-md-3 pt-3 pb-3">
                    <div class="section-filter-item-filex opened" id="section-filter-block-606">
                        <p class="section-filter-ttl-filex">Стандарт <span class="section-filter-item-filex-note" id="filex-standart-note">Выберите стандарт</span></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="606" id="section-filter-ttl-search-input-606" placeholder="Например, DIN 933"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <div data-simplebar data-simplebar-auto-hide="false" style="height:200px;">
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"STANDART"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="standart[]" <?php if(is_array($enum_fields['VALUE']) && count($enum_fields['VALUE'])>0){  if (in_array($enum_fields['VALUE'], $_POST['standart'])) {
    echo "checked";
                            }}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                        
                        }
                        ?>
                        </div>
                        </div>
                    </div>
                    </div>
            <!-- end STANDART -->
            
            <!-- DIAMETR -->
            <div class="col-12 col-xl-3 col-lg-3 col-md-3 pt-3 pb-3">
                    <div class="section-filter-item-filex opened" id="section-filter-block-613">
                        <p class="section-filter-ttl-filex">Диаметр <span class="section-filter-item-filex-note">Выберите стандарт</span></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="613" id="section-filter-ttl-search-input-613" placeholder="Например, 10"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <div data-simplebar data-simplebar-auto-hide="false" style="height:200px;">
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"DIAMETR_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="diametr[]" <?php if(is_array($enum_fields['VALUE']) && count($enum_fields['VALUE'])>0){ if (in_array($enum_fields['VALUE'], $_POST['diametr'])) {
    echo "checked";
                            }}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                        ?>
                            </div>
                        </div>
                    </div>
                     </div>
            <!-- DIAMETR -->
            
                        <!-- MATERIAL -->
                        <div class="col-12 col-xl-3 col-lg-3 col-md-3 pt-3 pb-3">
                    <div class="section-filter-item-filex opened" id="section-filter-block-610">
                        <p class="section-filter-ttl-filex">Материал <span class="section-filter-item-filex-note">Выберите стандарт</span></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="610" id="section-filter-ttl-search-input-610" placeholder="Например, А2"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <div data-simplebar data-simplebar-auto-hide="false" style="height:200px;">
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"MATERIAL_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="material[]" <?php if(is_array($enum_fields['VALUE']) && count($enum_fields['VALUE'])>0){ if (in_array($enum_fields['VALUE'], $_POST['material'])) {
    echo "checked";
                            }}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                        ?>
                            </div>
                        </div>
                    </div>
                     </div>
                <!-- MATERIAL -->
                
                                        <!-- ПОКРЫТИЕ -->
                                        <div class="col-12 col-xl-3 col-lg-3 col-md-3 pt-3 pb-3">
                    <div class="section-filter-item-filex opened" id="section-filter-block-611">
                        <p class="section-filter-ttl-filex">Покрытие <span class="section-filter-item-filex-note">Выберите стандарт</span></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="611" id="section-filter-ttl-search-input-611" placeholder="Например, цинк"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <div data-simplebar data-simplebar-auto-hide="false" style="height:200px;">
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"POKRYTIE_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-pokritie-<?php echo $enum_fields['ID'];?>" name="pokritie[]" <?php if(is_array($enum_fields['VALUE']) && count($enum_fields['VALUE'])>0){ if (in_array($enum_fields['VALUE'], $_POST['pokritie'])) {
    echo "checked";
                            }}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-pokritie-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                        ?>
                        </div>
                        </div>
                    </div>
                     </div>
                <!-- ПОКРЫТИЕ -->
                
                <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-2 pb-2 text-center">
                	<div class="btn-group-blue"><div class="btn-404" id="download_price" onclick="ym(18248638,'reachGoal','get_items_list'); return true;"><span><i class="fa fa-file-excel-o"></i> Выгрузить Excel</span></div></div>
                </div>
                
                </div>
                
                
                
            </div>
            </div>
            <!-- Filex - end -->
            

   </form>     
    </div>
    
     <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pb-3 text-center d-none d-lg-block">
                	<img src="<?=SITE_TEMPLATE_PATH?>/images/price_example2.jpg"/>
	</div>
    

</div>
</div>
 

<div class="row d-none">

<div class="col-12 col-xl-8 col-lg-8 col-md-8 pb-5">
<p>«Трайв-Комплект» поставляет метизную продукцию и крепежные изделия оптом и в розницу из Европы.</p>

<p>Сейчас крепеж используются практически везде. Например: в производстве мебели, в строительстве, автомобильной и железнодорожной промышленности.</p>

<p>Для заказа прайс-листа с ценами заполните форму, расположенную слева и укажите какой крепеж вас интересует.</p>

<p>И помните, приобретая крепеж у нас, Вы можете не сомневаться в его качестве!</p>
</div>
<div class="col-12 col-xl-4 col-lg-4 col-md-4">
<div class="pricelist-form-area">
            <? /*$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"pricelist", 
	array(
		"COMPONENT_TEMPLATE" => "pricelist",
		"ELEMENT_ID" => $arResult["ID"],
		"WEB_FORM_ID" => "4",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "/ajax/forms/pricelist_saved.php",
		"EDIT_URL" => "/ajax/forms/pricelist_saved.php",
		"SUCCESS_URL" => "/ajax/forms/pricelist_saved.php",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);*/?>
</div>
<script>
	var parmas = {
		selector: "#complaint-form",
		url:  "/ajax/forms/complaint.php"
	};
</script>
<script defer src='<?=SITE_TEMPLATE_PATH."/js/sendFormAjax.js"?>'></script>
</div>
</div>

    </div>
</section>

    <script>
        $(document).ready(function() {
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".categories").removeClass('u-none');
        });
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>