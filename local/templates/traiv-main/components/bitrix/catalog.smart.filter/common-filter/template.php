<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

//search needed properties

?>
<h3 class="md-title"><? echo GetMessage("CT_BCSF_FILTER_TITLE") ?></h3>
<div class="smart-search bx-filter">
    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter smart-search__aligner">
        <?foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <?endforeach;?>
        <div class="smart-search__cell smart-search__label">
            <? echo GetMessage("CT_BCSF_FILTER_NEED") ?>
        </div>
        <?showCommonFilter($arResult["ITEMS"][$arParams["SEARCH_PROPERTIES"][0]])?>
        <div class="smart-search__cell smart-search__label">
            <? echo GetMessage("CT_BCSF_FILTER_NEED_FOR") ?>
        </div>
        <?showCommonFilter($arResult["ITEMS"][$arParams["SEARCH_PROPERTIES"][1]])?>
        <div class="smart-search__cell smart-search__box">
            <input class="btn btn--fullw" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
            <div style="display: none">
                <div id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
                    <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                    <a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(".smart-search__box select").change(function(){
        //disables the button while ajax working. for those who wants to click too soon.
        $("form[name='<? echo $arResult["FILTER_NAME"] . "_form" ?>'] input#set_filter").attr("disabled","disabled");

        var inputId = $(this).children("option:selected").data("role");
        //dropdown list doesn't close without timeout, so don't touch it!
        setTimeout(function(){$("div[data-container='filter-inputs'] input#"+inputId).click();},0);
    });

    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>