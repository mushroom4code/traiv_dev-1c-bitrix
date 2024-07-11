<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="search-page">
<!-- <div class="row d-flex align-items-center h-100 mb-5" id="s-art-area">
    <div class="col-12 col-xl-2 col-lg-2 col-md-2">
    	<span>Поиск по статьям</span>
    </div>
    <div class="col-12 col-xl-10 col-lg-10 col-md-10">
    <form action="<?=$arResult["FORM_ACTION"]?>">
    <div class="search-art-area">
    <input type="text" value="<?=$arResult["REQUEST"]["QUERY"]?>" placeholder="Поиск по статьям" name="q">
    <button href="#" class="search-art-button rounded-circle"><i class="fa fa-search"></i></button>
    </div>
    </form>
    </div>
</div>-->

<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
	?>
	<div class="search-language-guess">
		<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
	</div><br /><?
endif;?>

<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
	<p><?=GetMessage("SEARCH_ERROR")?></p>
	<?ShowError($arResult["ERROR_TEXT"]);?>
	<p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
	<br /><br />
	<p><?=GetMessage("SEARCH_SINTAX")?><br /><b><?=GetMessage("SEARCH_LOGIC")?></b></p>
	<table border="0" cellpadding="5">
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OPERATOR")?></td><td valign="top"><?=GetMessage("SEARCH_SYNONIM")?></td>
			<td><?=GetMessage("SEARCH_DESCRIPTION")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_AND")?></td><td valign="top">and, &amp;, +</td>
			<td><?=GetMessage("SEARCH_AND_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_OR")?></td><td valign="top">or, |</td>
			<td><?=GetMessage("SEARCH_OR_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top"><?=GetMessage("SEARCH_NOT")?></td><td valign="top">not, ~</td>
			<td><?=GetMessage("SEARCH_NOT_ALT")?></td>
		</tr>
		<tr>
			<td align="center" valign="top">( )</td>
			<td valign="top">&nbsp;</td>
			<td><?=GetMessage("SEARCH_BRACKETS_ALT")?></td>
		</tr>
	</table>
<?elseif(count($arResult["SEARCH"])>0):?>
	<?/*if($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"]*/?>
	<!-- <br /><hr />-->
	<?
	/*echo "<pre>";
	   print_r($arResult["SEARCH"]);
	echo "<pre>";*/
	foreach($arResult["SEARCH"] as $arItem):
	?>
		<p><b><?echo $arItem["TYPE_ARTICLES"]?></b></p>
		<a href="<?echo $arItem["URL"]?>" class="s-art-area-link pb-5"><?echo $arItem["TITLE_FORMATED"]?></a>
		<p><?echo $arItem["BODY_FORMATED"]?></p>
		<small><?=$arItem["DATE_CHANGE"]?></small><br /><?
		/*if($arItem["CHAIN_PATH"]):?>
			<small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
		endif;*/
		?><hr />
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") /*echo $arResult["NAV_STRING"]*/?>
	<br />
	<p>
	<?/*if($arResult["REQUEST"]["HOW"]=="d"):?>
		<a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_RANK")?></a>&nbsp;|&nbsp;<b><?=GetMessage("SEARCH_SORTED_BY_DATE")?></b>
	<?else:?>
		<b><?=GetMessage("SEARCH_SORTED_BY_RANK")?></b>&nbsp;|&nbsp;<a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>"><?=GetMessage("SEARCH_SORT_BY_DATE")?></a>
	<?endif;*/?>
	</p>
<?else:?>
	<?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>
</div>