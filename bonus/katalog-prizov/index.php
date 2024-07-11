<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Каталог призов");
$APPLICATION->SetPageProperty("title", "Каталог призов");
$APPLICATION->SetTitle("Каталог призов");


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
    	<h1><span>Каталог призов</span></h1>
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

<!-- gifts -->
<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-4">

<div class="row d-flex">

<?php 
$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(4)->fetch();

$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("UF_BONUS_ITEM_SORT" => "ASC")
));

if (intval($data->getSelectedRowsCount()) > 0){
    while($arData = $data->Fetch()){
        $b_item_name = $arData['UF_BONUS_ITEM_NAME'];
        $b_item_img = CFile::GetPath($arData['UF_BONUS_ITEM_IMG']);
        $b_item_num = $arData['UF_BONUS_ITEM_NUM'];
        ?>
        
        <div class="col-lg-3 col-md-6 mb-3 text-md-left text-center bonus-element">
            <div class="fe-item bordered">
            <div class="bonus-item-item">
            <div class="bonus-item-item__image">
           	 <img src="<?php echo $b_item_img;?>" class="img-fluid">
            </div>
            	
            	<div class="bonus-element-name">
        							<?php echo $b_item_name;?>
        						</div>
        						<div class="bonus-element-num">
        							<?php echo number_format($b_item_num, 0, '', ' ')." баллов";?>
        						</div>
        						
        						<div class="bonus-element-num">
        						<div class="btn-group-blue"><a href="#" class="btn-cart-roundw"><span><i class="fa fa-gift"></i> Обменять на баллы</span></a></div>
        						</div>
            	
            </div>
            </div>
        </div>
        <?php
    }
}
?>

</div>

</div>
<!-- end gifts -->
    
</div>

	</div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>