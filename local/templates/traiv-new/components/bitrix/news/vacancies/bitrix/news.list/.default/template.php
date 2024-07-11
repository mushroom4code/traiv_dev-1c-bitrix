<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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

/*if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {*/
        ?>
        <div class="row d-flex align-items-center h-100">
        
            <? foreach ($arResult["ITEMS"] as $arItem): ?><?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        
        <!-- item -->
            <div class="col-12 col-lg-12 col-md-12 item-vac" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            	<div class="row d-flex align-items-center h-100">
            		<div class="col-lg-2 col-md-2 text-center">
            		
            		           <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <img border="0" class="item-vac-img" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/></a>
                <? endif; ?>
            <? endif; ?>
            		
            		</div>
            		<div class="col-lg-10 col-md-10">
            			<div>
            			
            			<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?><? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="item-vac-title">
                <? echo $arItem["NAME"] ?>
                </a>
            <? else: ?>
                <?= $arItem["NAME"] ?>
            <? endif; ?><? endif; ?>
            			
            			</div>
            			<div class="item-vac-note pt-2">
            			
            			<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                <p><? echo $arItem["PREVIEW_TEXT"]; ?> <!--a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="iconed iconed--right">Подробнее...</a--></p> 
            <? endif; ?>
            			</div>
            			<div class="pt-2">
            				<div class="btn-group-blue-small"><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="btn-blue-small"><span>Подробнее...</span></a></div>
            			</div>
            		</div>	
            	</div>
            </div>
        <!-- item -->

        
    <? endforeach; ?>
        
        
            
        </div>
        <?php 
    /*}
}*/

?>

<div class="col x1d1 services-list d-none">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?><?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col x1d2 x1d1--s services-element" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?><? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <h3 class=""><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></h3>
            <? else: ?>
                <h3 class="md-title news-item__title"><?= $arItem["NAME"] ?></h3>
            <? endif; ?><? endif; ?>
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><img class="img_service" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/></a>
                <? endif; ?>
            <? endif; ?>
            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                <p><? echo $arItem["PREVIEW_TEXT"]; ?> <!--a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="iconed iconed--right">Подробнее...</a--></p> 
            <? endif; ?>

        </div>
    <? endforeach; ?>
</div>