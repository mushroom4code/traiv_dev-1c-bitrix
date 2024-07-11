<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>


<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?=$arResult['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']?></span></h1>
    </div>
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
<img src="<?=SITE_TEMPLATE_PATH?>/images/orig.png" class="img-responsive" style="padding:10px 0px;"/>
</div>
</div>

        <div class="col-12 col-xl-12 col-lg-12 col-md-12 mb-3">
            <div class="search-gso-area">
            	<input type="text" value="" placeholder="Поиск по стандарту" id="search_gso"><a href="#" class="search-gso-link rounded-circle"><i class="fa fa-search"></i></a>
            </div>
        </div>
        


<div class="gosti">
<!-- <span class="name_gost"><?=GetMessage("CATALOG_TITLE")?></span> -->
		<?if(count($arResult["ITEMS"]) > 0):
			foreach($arResult["ITEMS"][0]["DISPLAY_PROPERTIES"] as $arProperty):?>
				<?=$arProperty["NAME"]?>
			<?endforeach;
		endif;?>
		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
			<?=$arPrice["TITLE"]?>
		<?endforeach?>
		<?if(count($arResult["PRICES"]) > 0):?>

		<?endif?>

	
	<?
	$i = 0;
	foreach($arResult["ITEMS"] as $arElement):?>
	<?
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	
	?>
	<div class="gso_list_item" id="<?=$this->GetEditAreaId($arElement['ID']);?>" data-filter-val="<?=$arElement["NAME"]?>">
	<?php 

	        if ($i%2 == 0){
	            $link = "gdo_list_link1";
	        } else {
	            $link = "gdo_list_link2";
	        }	
	?>
			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="<?php echo $link;?>"><?=$arElement["NAME"]?></a>
			<?if(count($arElement["SECTION"]["PATH"])>0):?>
				<br />
				<?foreach($arElement["SECTION"]["PATH"] as $arPath):?>
					/ <a href="<?=$arPath["SECTION_PAGE_URL"]?>"><?=$arPath["NAME"]?></a>
				<?endforeach?>
			<?endif?>
		</div>
		<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
		
			<?if(is_array($arProperty["DISPLAY_VALUE"]))
				echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
			elseif($arProperty["DISPLAY_VALUE"] === false)
				echo "&nbsp;";
			else
				echo $arProperty["DISPLAY_VALUE"];?>
		
		<?endforeach?>
		<?foreach($arResult["PRICES"] as $code=>$arPrice):?>
		
			<?if($arPrice = $arElement["PRICES"][$code]):?>
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<s><?=$arPrice["PRINT_VALUE"]?></s><br /><span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
				<?else:?>
					<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif?>
			<?else:?>
				&nbsp;
			<?endif;?>
		
		<?endforeach;?>
		<?if(count($arResult["PRICES"]) > 0):?>
		
			<?if($arElement["CAN_BUY"]):?>
				<noindex>
				<a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
				&nbsp;<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
				</noindex>
			<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
				<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
				<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arElement['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
			<?endif?>&nbsp;
		
		<?endif;?>
	
	<?
	$i++;
	endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
</div>
