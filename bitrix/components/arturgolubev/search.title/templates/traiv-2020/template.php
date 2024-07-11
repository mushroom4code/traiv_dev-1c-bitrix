<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "smart-title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "smart-title-search";

$PRELOADER_ID = CUtil::JSEscape($CONTAINER_ID."_preloader_item");
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

// echo '<pre>'; print_r($arResult["VISUAL_PARAMS"]); echo '</pre>';

if($arParams["SHOW_INPUT"] !== "N"):?>
<div id="<?echo $CONTAINER_ID?>" class="bx-searchtitle <?=$arResult["VISUAL_PARAMS"]["THEME_CLASS"]?>">
	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<div class="bx-input-group">
			<input id="<?echo $INPUT_ID?>" placeholder="Какой крепеж ищете?  (среди 86 680 товаров), поиск по артикулу, наименованию<?/*=$arResult["VISUAL_PARAMS"]["PLACEHOLDER"]*/?>" type="text" name="q" value="<?=htmlspecialcharsbx($_REQUEST["q"])?>" autocomplete="off" class="bx-form-control"/>
			<span class="bx-input-group-btn">
				<span class="bx-searchtitle-preloader <?if($arResult["MODULE_SETTING"]["SHOW_PRELOADER"] == 'Y') echo 'view';?>" id="<?echo $PRELOADER_ID?>"></span>
				<button class="" type="submit" name="s"></button>
			</span>
		</div>
	</form>
</div>
<?endif?>

<?if($arParams["NUM_CATEGORIES"] > 1):?>
	<?global $USER; if($USER->IsAdmin()):?>
		<div style="color: red; font-size: 13px;">
			<?=GetMessage("AG_SMARTIK_CATEGORY_WARRING", array("#NUM_VAL#" => $arParams["NUM_CATEGORIES"]));?>
		</div>
	<?endif;?>
<?endif;?>

<?if($arResult["VISUAL_PARAMS"]["THEME_COLOR"]):?>
	<style>
		.bx-searchtitle .bx-input-group .bx-form-control, .bx_smart_searche .bx_item_block.all_result .all_result_button, .bx-searchtitle .bx-input-group-btn button, .bx_smart_searche .bx_item_block_hrline {
			border-color: <?=$arResult["VISUAL_PARAMS"]["THEME_COLOR"]?> !important;
		}
		.bx_smart_searche .bx_item_block.all_result .all_result_button, .bx-searchtitle .bx-input-group-btn button {
			background-color: <?=$arResult["VISUAL_PARAMS"]["THEME_COLOR"]?>  !important;
		}
		.bx_smart_searche .bx_item_block_href_category_name, .bx_smart_searche .bx_item_block_item_name b, .bx_smart_searche .bx_item_block_item_simple_name b {
			color: <?=$arResult["VISUAL_PARAMS"]["THEME_COLOR"]?>  !important;
		}
	</style>
<?endif;?>

<script>
	BX.ready(function(){
		new JCTitleSearchAG({
			// 'AJAX_PAGE' : '/your-path/fast_search.php',
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'PRELODER_ID': '<?echo $PRELOADER_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>