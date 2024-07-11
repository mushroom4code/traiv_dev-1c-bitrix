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
        <div class="row">
        
        <div class="col x1d3 x1d1--md x1d1--s"><img class="responsive detail_picture lazy" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/></div>
        <div class='col x2d3 x1d1--md x1d1--s news-detail-content-area'></div>
        <div style="clear:both;"></div>
        
        </div>
        

            <? } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
    <div class="eraser-9000">
        <img class="responsive preview_picture lazy" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    </div>
        <? } ?>

    <? } ?>


  <?
  if (!empty($arResult["FIELDS"]["DETAIL_TEXT"])){
     
      
      if ( $USER->IsAuthorized() )
      {
          if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2938') {
              
              function getCorrectedString(string $inputText): string {
                  $resultText = $inputText;
                  $curlContent = getUrlContent(
                      'http://speller.yandex.net/services/spellservice.json/checkTexts',
                      [
                          'text' => $inputText,
                          'lang' => 'ru'
                      ],
                      [
                          CURLOPT_TIMEOUT => 10,
                          CURLOPT_CONNECTTIMEOUT => 10
                      ]
                      );
                  
                  if (
                      isset($curlContent['result'])
                      && !empty($curlContent['result'])
                      ) {
                          $spellResult = current(
                              json_decode($curlContent['result'])
                              );
                          
                          $correctionMap = [];
                          foreach ($spellResult as $correction) {
                              $correctionMap[$correction->word] = current($correction->s);
                          }
                          
                          foreach($spellResult as $repl){
                              if (current($repl->s) != false) {
                                  $resultText = str_replace($repl->word, "<span style='background-color:yellow;padding:2px 5px;'>".$repl->word." (".current($repl->s).")</span>", $resultText);
                              }
                          }
                      }
                      return $resultText;
              }
              
              function mb_substr_replace($original, $replacement, $position, $length)
              {
                  $startString = mb_substr($original, 0, $position, "UTF-8");
                  $endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");
                  
                  $out = $startString . $replacement . $endString;
                  
                  return $out;
              }
              
              function getUrlContent(
                  string $url, array $postData = [], array $optionsList = []
                  ) {
                      $curl = curl_init();
                      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                      curl_setopt($curl, CURLOPT_URL, $url);
                      if (!empty($postData)) {
                          curl_setopt($curl, CURLOPT_POST, 1);
                          curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
                      }
                      if (!empty($optionsList)) {
                          foreach ($optionsList as $optionKey => $optionValue) {
                              curl_setopt($curl, $optionKey, $optionValue);
                          }
                      }
                      $result = [
                          'result' => curl_exec($curl),
                          'errno' => curl_errno($curl),
                          'error' => curl_error($curl),
                          'http_code' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
                      ];
                      curl_close($curl);
                      return $result;
              }
              
              $responseText = getCorrectedString($arResult["FIELDS"]["DETAIL_TEXT"]);
              echo $responseText;
              
          }
          else {
              echo $arResult["FIELDS"]["DETAIL_TEXT"];
          }
      }
      else
      {
          echo $arResult["FIELDS"]["DETAIL_TEXT"];
      }
      
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
<script type="text/javascript">(function(w,doc) {
if (!w.__utlWdgt ) {
w.__utlWdgt = true;
var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
var h=d[g]('body')[0];
h.appendChild(s);
}})(window,document);
</script>
</div>
</noindex>

</div>