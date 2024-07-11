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

function month3char($mname){
    
    if ($mname == '01'){
        $mname_true = "янв";
    }
    else if ($mname == '02'){
        $mname_true = "фев";
    }
    else if ($mname == '03'){
        $mname_true = "мар";
    }
    else if ($mname == '04'){
        $mname_true = "апр";
    }
    else if ($mname == '05'){
        $mname_true = "май";
    }
    else if ($mname == '06'){
        $mname_true = "июн";
    }
    else if ($mname == '07'){
        $mname_true = "июл";
    }
    else if ($mname == '08'){
        $mname_true = "авг";
    }
    else if ($mname == '09'){
        $mname_true = "сен";
    }
    else if ($mname == '10'){
        $mname_true = "окт";
    }
    else if ($mname == '11'){
        $mname_true = "ноя";
    }
    else if ($mname == '12'){
        $mname_true = "дек";
    }
    return $mname_true;
}

?>


<div class="posts-wrap">
<div class="row posts-list">
    <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
    <?    
    foreach ($arResult["ITEMS"] as $arItem): ?><?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        
        <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts2-i" data-pro-tags="<?php echo $arItem["PROPERTIES"]["SERVTAGS"]["VALUE"]["0"];?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
		<a class="posts-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></a>
		<time class="posts-i-date" datetime="<?=$arItem['DISPLAY_ACTIVE_FROM'] ?>"><span><?=substr($arItem['DISPLAY_ACTIVE_FROM'],0,2) ?></span> 
		<?php 
		
		echo month3char(substr($arItem['DISPLAY_ACTIVE_FROM'],3,2));
		?>
		</time>
		<h3 class="posts-i-ttl"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></h3>
		<p>
		<?=TruncateText($arItem['PREVIEW_TEXT'], 150);?>
		</p>		<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="posts-i-more">Подробнее...</a>
	</div>
        
        <!-- <li class="col x1d3 x1d1--m posts2-i"  id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="news-item">
            <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                <span class="date"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
            <? endif ?>

            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <div class="eraser-9000">
                    <img class="responsive news-item__image" border="0" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="400" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"/>
                </div>
                    <? endif; ?>
            <? endif; ?>
            <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?><? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                <h4 class="md-title news-item__title">
                    <a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></h4>
            <? else: ?>
                <h4 class="md-title news-item__title"><?= $arItem["NAME"] ?></h4>
            <? endif; ?><? endif; ?>
            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                <p><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news-item__more">
                    <span>Узнать подробнее...</span>
                    </a>
            <? endif; ?>
            </div>
        </li>-->
    <? endforeach; ?>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; ?>
</div>
</div>

