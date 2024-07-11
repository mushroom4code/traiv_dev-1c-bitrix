<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; ?>

<div class="row lk_right_menu h-100 g-0">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
		<div class="row row d-flex align-items-center lk-item-block g-0">
<?

$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail","orderview",Array(
        "PATH_TO_LIST" => "order_list.php",
        "PATH_TO_CANCEL" => "order_cancel.php",
        "PATH_TO_PAYMENT" => "payment.php",
        "PATH_TO_COPY" => "",
        "ID" => $_REQUEST["SECTION_CODE"],
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "PICTURE_WIDTH" => "110",
        "PICTURE_HEIGHT" => "110",
        "PICTURE_RESAMPLE_TYPE" => "1",
        "CUSTOM_SELECT_PROPS" => array(),
        "PROP_1" => Array(),
        "PROP_2" => Array()
    )
);

//echo $_REQUEST["SECTION_CODE"];

?>		
		</div>
	</div>
</div>

<? include_once 'bottom.php'; ?>
