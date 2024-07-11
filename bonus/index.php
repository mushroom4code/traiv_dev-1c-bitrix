<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Бонусная программа");
$APPLICATION->SetPageProperty("title", "Бонусная программа");
$APPLICATION->SetTitle("Бонусная программа");

?>    
<section id="content">
	<div class="container">

            <? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-new", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Бонусная программа</span></h1>
    </div>
</div>

<div class="bonus-item-area">

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/" class="btn-404"><span><i class="fa fa-info-circle "></i> Как накопить?</span></a></div>
</div>

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/pravila-bonusnoy-programmy/" class="btn-404"><span><i class="fa fa-file-text-o"></i> Правила программы</span></a></div>
</div>

<div class="bonus-item">
	<div class="btn-group-blue"><a href="/bonus/katalog-prizov/" class="btn-404"><span><i class="fa fa-gift"></i> Каталог призов</span></a></div>
</div>

</div>

<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-4">
Бонусная программа Трайв — программа
лояльности для покупателей нашей продукции. Участники программы копят баллы и
обменивают их на призы из витрины подарков Трайв.
</div>

   <!--  <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-4">
    	<img src='<?=SITE_TEMPLATE_PATH?>/images/bonus_guide3.jpg' class="img-responsive"/>
    </div>
    -->
    
    <!-- <div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 text-center">
    	<div class="btn-group-blue"><a href="#" id="bonus-block-item-run" class="btn-cart-roundw-big new-item-line-buy"><span>Хочу получать бонусы!</span></a></div>
    </div> -->
    
    <div id="bonus-block-item">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
    <div class="row justify-content-center">
    
    	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        			<div class='bonus-block-title'>Зарегистрируйтесь на сайте!</div>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center pt-3">
        	<div class="bonus-block-item-area">
            	<div class="bonus-block-p">
            		<div class='bonus-block-title'>Поздравляем!</div>
            		<p>Вы стали участником программы лояльности, и теперь получаете Трайв-токены!</p>
            	</div>
        	</div>
    	</div>
    	
    	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        			<div class='bonus-block-title'>Класс! Что дальше?</div>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center d-none d-sm-block d-lg-block d-md-block d-xl-block pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        			<p>Выполняйте действия за которые будут начисляться токены!</p>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-6 col-xl-6 col-lg-6 col-md-6 text-center d-none d-sm-block d-lg-block d-md-block d-xl-block pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        			<div class='bonus-block-title'>Какие? Хочу узнать!</div>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-6 col-xl-6 col-lg-6 col-md-6 d-none d-sm-block d-lg-block d-md-block d-xl-block text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        			<div class='bonus-block-title'>А если я не хочу!</div>
        		</div>
        	</div>
    	</div>
    	
    	<!-- // -->
    	
		<div class="col-6 col-xl-6 col-lg-6 col-md-6 d-none d-sm-block d-lg-block d-md-block d-xl-block text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        				<p>Каждое из действий позволяет заработать Статус Пользователя</p>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-6 col-xl-6 col-lg-6 col-md-6 d-none d-sm-block d-lg-block d-md-block d-xl-block text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        				<p>Совершайте покупки, и получайте 1% токенами от суммы заказа</p>
        		</div>
        	</div>
    	</div>
    	
    	<!-- // -->
    	
    	    	<!-- // -->
    	
		<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        				<div class='bonus-block-title'>Как заработать через действия?</div>
        		</div>
        	</div>
    	</div>
    	
    	<div class="col-6 col-xl-6 col-lg-6 col-md-6 d-none d-sm-block d-lg-block d-md-block d-xl-block text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
        				<div class='bonus-block-title'>Как заработать через покупки?</div>
        		</div>
        	</div>
    	</div>
    	
    	<!-- // -->
    	
    	    	    	<!-- // -->
    	
		<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p-list">
        				
        				
        				
        				<?php 
$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(5)->fetch();

$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("UF_BONUS_LIST_SORT" => "ASC"),
    "filter" => Array("UF_BONUSITEM_TYPE"=>"1723")
));

if (intval($data->getSelectedRowsCount()) > 0){
    while($arData = $data->Fetch()){
        $b_list_name = $arData['UF_BONUS_LIST_NAME'];
        $b_list_icon = $arData['UF_BONUS_LIST_ICON'];
        $b_list_val = $arData['UF_BONUS_LIST_VAL_TEXT'];
        ?>
        <div class="row align-items-center h-100 bonus-token-icon-area-p">
                					<div class="col-8 col-xl-10 col-lg-10 col-md-10 text-left bonus-list-name"><i class="fa fa-<?php echo $b_list_icon;?>"></i><?php echo $b_list_name;?></div>
        					<div class="col-2 col-xl-1 col-lg-1 col-md-1 text-right">
        						
        						<span class="bonus-token-icon-area">
            						<span class="bonus-token-icon"></span>
        						</span>
        					</div>
        					<div class="col-2 col-xl-1 col-lg-1 col-md-1 text-left">
        					<span class="bonus-token-val">+<?php echo $b_list_val;?></span>
        					</div>
        					</div>        
        <?php
    }
}
?>
        				
        				

        				
        				
        		</div>
        	</div>
    	</div>    	
    	<!-- // -->
    	
		<div class="col-12 col-xl-6 col-lg-6 col-md-6 d-block d-sm-none d-lg-none d-md-none d-xl-none text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p">
					<div class='bonus-block-title'>Как заработать через покупки?</div>
        		</div>
        	</div>
    	</div>
    	
    	
    			<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center pt-3">
        	<div class="bonus-block-item-area">
        		<div class="bonus-block-p-list">
        				<?php 
$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(5)->fetch();

$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("UF_BONUS_LIST_SORT" => "ASC"),
    "filter" => Array("UF_BONUSITEM_TYPE"=>"1724")
));

if (intval($data->getSelectedRowsCount()) > 0){
    while($arData = $data->Fetch()){
        $b_list_name = $arData['UF_BONUS_LIST_NAME'];
        $b_list_icon = $arData['UF_BONUS_LIST_ICON'];
        $b_list_val = $arData['UF_BONUS_LIST_VAL_TEXT'];
        ?>
        <div class="row align-items-center h-100 bonus-token-icon-area-p">
                					<div class="col-8 col-xl-10 col-lg-10 col-md-10 text-left bonus-list-name"><i class="fa fa-<?php echo $b_list_icon;?>"></i><?php echo $b_list_name;?></div>
        					<div class="col-2 col-xl-1 col-lg-1 col-md-1 text-right">
        						
        						<span class="bonus-token-icon-area">
            						<span class="bonus-token-icon"></span>
        						</span>
        					</div>
        					<div class="col-2 col-xl-1 col-lg-1 col-md-1 text-left">
        					<span class="bonus-token-val">+<?php echo $b_list_val;?></span>
        					</div>
        					</div>        
        <?php
    }
}
?>
        				
        				

        				
        				
        		</div>
        	</div>
    	</div>
    	
    	<!-- // -->
    	
    	
    	
    </div>
    </div>
    </div>
    
    
</div>

	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>