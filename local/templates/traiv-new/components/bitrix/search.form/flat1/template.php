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
$this->setFrameMode(true);?>
<!-- <div class="search-form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<?
	echo $arParams["USE_SUGGEST"];
	if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 15,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
	);?><?else:?><input type="text" name="q" value="" size="15" maxlength="50" /><?endif;?>&nbsp;<input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
</form>
</div>-->

<div class="row d-flex align-items-center h-100 mb-5" id="s-art-area">
<div class="col-12 col-xl-2 col-lg-2 col-md-2">
<span>Поиск по статьям</span>
</div>
<div class="col-12 col-xl-10 col-lg-10 col-md-10">
<form action="<?=$arResult["FORM_ACTION"]?>">
<div class="search-art-area">
<input type="text" value="" placeholder="Поиск по статьям" name="q">
<button href="#" class="search-art-button rounded-circle"><i class="fa fa-search"></i></button>
</div>
</form>
</div>
</div>