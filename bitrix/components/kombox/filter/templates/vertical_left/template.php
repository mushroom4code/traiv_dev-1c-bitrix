<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(method_exists($this, 'setFrameMode')) 
	$this->setFrameMode(true);
	
if(count($arResult['ELEMENTS']) > 1 && $arResult["ITEMS_COUNT_SHOW"]):
$arParams['MESSAGE_ALIGN'] = isset($arParams['MESSAGE_ALIGN']) ? $arParams['MESSAGE_ALIGN'] : 'LEFT';
$arParams['MESSAGE_TIME'] = intval($arParams['MESSAGE_TIME']) >= 0 ? intval($arParams['MESSAGE_TIME']) : 5;

include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/functions.php");

CJSCore::Init(array("popup"));
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/ion.rangeSlider.js");
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/jquery.cookie.js");
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/jquery.filter.new.js");
$APPLICATION->AddHeadScript("/bitrix/js/kombox/filter/jquery.bitronic.js");
?>
<div class="section-sb">
<div id="ys_filter_bitronic" class="item_filters kombox-filter section-filter">
<button id="section-filter-toggle" class="section-filter-toggle" data-close="Скрыть фильтр" data-open="Показать фильтр">
	<span>Показать фильтр</span> <i class="fa fa-angle-down"></i>
</button>
<?php 

if ( $USER->IsAuthorized() )
{
    if (/*$USER->GetID() == '3092' ||*/ $USER->GetID() == '1788')  {
 ?>
 <div class="serg_standart"></div>
 <?php        
    }
}

?>
                 <div class="section-filter-cont">

	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get"<?if($arResult['IS_SEF']):?> data-sef="yes"<?endif;?> class="smartfilter">
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
			/>
		<?endforeach;?>

		<?
		foreach($arResult["ITEMS"] as $arItem):
			$showProperty = false;
			if($arItem["SETTINGS"]["VIEW"] == "SLIDER")
			{
				if(isset($arItem["VALUES"]["MIN"]["VALUE"]) && isset($arItem["VALUES"]["MAX"]["VALUE"]) && $arItem["VALUES"]["MAX"]["VALUE"] > $arItem["VALUES"]["MIN"]["VALUE"])
					$showProperty = true;
			}
			elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"]))
			{
				$showProperty = true;
			}
			?>
			<?if($showProperty):?>
			
			<div class="section-filter-item opened" data-id="<?echo $arItem["CODE_ALT"].'-'.$arItem["ID"]?>">
				
				<p class="section-filter-ttl"><?=$arItem["NAME"]?> <i class="fa fa-angle-down" style="display: block !important;"></i></p>
				 
				<span class="for_modef"></span>	
				<div class="section-filter-fields" id="section-filter-block-<?=$arItem["ID"]?>">
				<?php if ($arItem['ID'] == '606' || $arItem['ID'] == '613' || $arItem['ID'] == '612' || $arItem['ID'] == '612' || $arItem['ID'] == '1100' || $arItem['ID'] == '1101' || $arItem['ID'] == '1102' || $arItem['ID'] == '1103' || $arItem['ID'] == '1104' || $arItem['ID'] == '1105' || $arItem['ID'] == '1106') {
    				?>
    				
    					<p class="section-filter-ttl-search"><input type="text" placeholder="Поиск" class="section-filter-ttl-search-input" rel="<?php echo $arItem['ID']; ?>" id="section-filter-ttl-search-input-<?php echo $arItem['ID'];?>"/><i class="fa fa-ttl-search fa-ttl-icon"></i></p>
    				<?
				}
				komboxShowField($arItem);?>
				</div>
			</div>
			<?endif;?>
		<?endforeach;?>
		
		<div class="section-filter-buttons">
		<div class="btn-group-blue">
                    <a href="<?php echo $APPLICATION->GetCurPage();?>" class="btn-blue" id="set_filter" name="set_filter">
                        <span>Сбросить фильтр</span>
                    </a>
                </div>
                </div>
		
		<!-- <div class="section-filter-buttons">
                        <a href="<?php echo $APPLICATION->GetCurPage();?>" class="btn btn-themes" id="set_filter" name="set_filter">Сбросить фильтр</a>
                    </div>-->


		
		<div class="ye_clear"></div>
	</form>
	</div>
	<div id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> alt="Показать" title="Показать">
			<div class="ye_result">
			
				<?/*echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));*/?>
				<p class="f-res">
				<!-- <i class="fa fa-ttl-search fa-ttl-icon"></i> -->
				
				<a href="<?echo $arResult["FILTER_URL"]?>" class="showchild f-res-run"><!-- <i class="icofont icofont-filter"></i>--><span class="f-res-run-word"><?echo GetMessage("CT_BCSF_FILTER_SHOW");?></span> (<span id="modef_num" style="color: #ffffff;font-weight:100;padding-left:0px;/*display:block;*/min-width: 24px;position:relative;"><?php echo intval($arResult["ELEMENT_COUNT"]);?></span>)</a>
				</p>
			</div>
		</div>
</div>
</div>

<div class='f_loader'></div>

<script>
	$(function(){
		$('#ys_filter_bitronic').komboxBitronicSmartFilter({
			ajaxURL: '<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
			urlDelete: '<?echo CUtil::JSEscape($arResult["DELETE_URL"])?>',
			align: '<?echo $arParams['MESSAGE_ALIGN']?>',
			modeftimeout: <?echo $arParams['MESSAGE_TIME']?>,
			ajax_enable: '<?=($arParams['AJAX_FILTER'] == "Y")? "Y":"N";?>', 
			cfajaxURL: '<?=SITE_TEMPLATE_PATH."/ajax/catalog_filter.php"?>', 
			site_id: '<?=SITE_ID;?>', 
			iblock_id: '<?=$arParams["IBLOCK_ID"];?>'
		});
	});
</script>
<?endif;?>