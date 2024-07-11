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



    <?
    if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
        <img class="responsive detail_picture" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
    <? } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
        <img class="responsive preview_picture" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    <? } ?>



    <? if ($arParams["DISPLAY_DATE"] != "N" && $arResult["DISPLAY_ACTIVE_FROM"]): ?>
        <span class="news-date-time"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
    <? endif; ?>



    <? } ?>

  <?
  echo "<h1 style='text-align:left;'>".$arResult["NAME"]."</h1>";
  if (!empty($arResult["FIELDS"]["DETAIL_TEXT"])){
      echo $arResult["FIELDS"]["DETAIL_TEXT"];
      ?>

      <?      //canonical
      $TermCanonical = $arResult['PROPERTIES']['CANT']['VALUE'];
      // $APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$TermCanonical.'" rel="canonical" />',true);
      ?>

      <br>


      <?
      $SectPageUrl = $TermCanonical;

      $SectPageUrl = explode('/',$SectPageUrl);

      $SectCode = array_pop($SectPageUrl);

      $rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 18, 'CODE' => end($SectPageUrl)));
      if ($arSection = $rsSections->GetNext())
      {
          If (!empty($TermCanonical)):?>
              <a href = "<?=$TermCanonical?>"><?=$arSection['NAME']?></a><br><br>
          <?endif;
      }

      ?>

      <p style="text-align: right">

          Материалы подготовлены специалистами компании «Трайв-Комплект».<br>
          При копировании текстов и других материалов сайта - указание
          ссылки на сайт www.traiv-komplekt.ru обязательно!

      </p>
    <?
  } else {
      echo $arResult["FIELDS"]["PREVIEW_TEXT"];
  }
  ?>

    <?     //SEO links to categories
    $RazdArray = $arResult['DISPLAY_PROPERTIES']['RAZD']['DISPLAY_VALUE'];

    If (count ($RazdArray) > 1 ){ ?>
        <? foreach ($RazdArray as $razd) : ?>
            <? print_r ($razd)?>
            <br>
        <? endforeach; ?>
    <? } else { ?>
        <?echo $RazdArray ?>
    <? } ?>



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

    <span class="social_share_2020">
            <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
            </span>
    <br>
    <br>


</div>

