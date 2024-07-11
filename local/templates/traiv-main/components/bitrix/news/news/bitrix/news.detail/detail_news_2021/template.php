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
<div class="news-detail">

    <h1><?=$arResult["META_TAGS"]["TITLE"]?></h1>

	 <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
		<span class="news-date-time">Дата публикации: <?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>

    <? endif; ?>


    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
        <div class="eraser-9000">
        <img class="responsive detail_picture lazy" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>

            <? } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
    <div class="eraser-9000">
        <img class="responsive preview_picture lazy" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    </div>
        <? } ?>







    <? } ?>


  <?
  if (!empty($arResult["FIELDS"]["DETAIL_TEXT"])){
      echo $arResult["FIELDS"]["DETAIL_TEXT"];
  } else {
      echo $arResult["FIELDS"]["PREVIEW_TEXT"];
  }

  if (!empty($arResult['PROPERTIES']['LONG_TEXT']['~VALUE']['TEXT'])) {
      echo($arResult['PROPERTIES']['LONG_TEXT']['~VALUE']['TEXT']);
  }
  ?>
    <!-- <p class="CopyWarning" style="text-align: right">

        Материалы подготовлены специалистами компании «Трайв-Комплект».<br>
        При копировании текстов и других материалов сайта - указание
        ссылки на сайт www.traiv-komplekt.ru обязательно!

    </p>-->

<div style="text-align:right;padding:10px 0px;">
            <span class="social_share_2020" style="float:none !important;">
            <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="common" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="false" data-exclude-show-more="true" data-share-style="9" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
            </span>
</div>

    <div class="bottom_zakaz">
        <a href="#w-form-recall" class="zakazat">Нужна консультация? Закажите звонок!</a> <a  href="#w-form" class="zakazat">Отправить заявку на крепеж</a>
    </div>



<div class="counter_one">
<?//show counter with session refresh
    session_start();
    if (!isset($_SESSION['counter'])) $_SESSION['counter'] = 0;

    $res = CIBlockElement::GetByID($arResult["ID"]);
    if($ar_res = $res->GetNext())
        $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
    echo 'Просмотров: '.$ar_res_hundred;


    CModule::IncludeModule("iblock");
    if(CModule::IncludeModule("iblock")) {
        CIBlockElement::CounterInc($arResult["ID"]);
    }

    $ar_res['SHOW_COUNTER_START'] = substr( $ar_res['SHOW_COUNTER_START'], 0, -9);
    echo '<br>'.$ar_res['SHOW_COUNTER_START'];
    ?>
</div>

<noindex>
<div class="yastatic_articles ">

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>

</div>
</noindex>

</div>