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
?>
<!-- <div class="news-detail"> -->


<!-- <h1><?=$arResult["META_TAGS"]["TITLE"]?></h1>-->
	 <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
		<span class="news-date-time">Дата публикации: <?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>

    <? endif; ?>


							<?php
							
							if (isset($arResult["PROPERTIES"]["ACT_END"]["VALUE"]) && $arResult["PROPERTIES"]["ACT_END"]["VALUE"] === 'Y'){
					            ?>
					            <br>
					            <span class="action-i-end">Акция завершена</span>
					            <?php 
					        }
					?>

    <? /*if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
        <img class="responsive detail_picture" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
    <? } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
        <img class="responsive preview_picture" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    <? } ?>


    <? }*/ ?>
    
   
  <?
  if (!empty($arResult["FIELDS"]["DETAIL_TEXT"])){
      echo $arResult["FIELDS"]["DETAIL_TEXT"];
  } else {
      echo $arResult["FIELDS"]["PREVIEW_TEXT"];
  }
  ?>

    <div class="bottom_zakaz_action" rel="11">
        <div class="row">
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-right text-lg-right">
        
            <div class="btn-group-blue">
                <a href="#w-form-recall" class="btn-blue">
                    <span>Нужна консультация? Закажите звонок!</span>
                </a>
            </div>  
        
        </div>
        
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left text-lg-left pt-2 pt-sm-0 pt-lg-0">
            <div class="btn-group-blue">
                <a href="#w-form" class="btn-blue">
                    <span>Отправить заявку на крепеж</span>
                </a>
            </div>        
        </div>
        
    </div>
    </div>



<noindex>
<span class="social_share_2020">
    <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
</span>
</noindex>

<?php
//if ($USER->GetID() == '3092') {
    //$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/atable.css");
//}
?>

<!-- </div> -->