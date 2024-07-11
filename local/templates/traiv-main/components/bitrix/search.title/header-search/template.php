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
<?
    $INPUT_ID = trim($arParams["~INPUT_ID"]);
    if(strlen($INPUT_ID) <= 0)
        $INPUT_ID = "title-search-input";
    $INPUT_ID = CUtil::JSEscape($INPUT_ID);

    $CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
    if(strlen($CONTAINER_ID) <= 0)
        $CONTAINER_ID = "title-search";
    $CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);


    if($arParams["SHOW_INPUT"] !== "N"):?>
        <div>
            <form  id="<?echo $CONTAINER_ID?>" method="get" class="global-search" action="<?echo $arResult["FORM_ACTION"]?>">
                <input class="form-control global-search__input" id="<?echo $INPUT_ID?>" placeholder="Поиск среди <?=$arResult['ITEMS_COUNT']["CNT"]?> товаров" type="text" name="q" value="" autocomplete="off" />&nbsp;
                <button class="global-search__submit" name="s" type="submit"><?=GetMessage("CT_BST_SEARCH_BUTTON");?></button>
                <a href="#" class="btn-square global-search__toggle"><i class="icon icon--search"></i></a>
            </form>
        </div>
    <?endif?>
<script>
    BX.ready(function(){
        new JCTitleSearch({
            'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
            'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
            'INPUT_ID': '<?echo $INPUT_ID?>',
            'MIN_QUERY_LEN': 2
        });
    });
</script>
