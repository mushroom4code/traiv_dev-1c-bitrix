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

	
	<div class="row position-relative" itemid="<? echo 'https://traiv-komplekt.ru'.$APPLICATION->GetCurPage();?>" itemscope itemtype="http://schema.org/Article">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<div class="row d-flex align-items-center">
    	
        	<div class="col-12 col-xl-6 col-lg-6 col-md-6">
        	<a href="#" rel="nofollow" class="magazine_link_menu_active"><i class="fa fa-microphone"></i><span class="magazine-list-count">Интервью</span></a>
        	<span class="mb-0 magazine-i-date-top"><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span>
        	</div>
        	
        	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-right">
        	<a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 10px;"><i class="fa fa-eye"></i>
        	<?
    session_start();
    if (!isset($_SESSION['counter'])) $_SESSION['counter'] = 0;

    $res = CIBlockElement::GetByID($arResult["ID"]);
    if($ar_res = $res->GetNext())
        $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
    echo $ar_res_hundred;


    CModule::IncludeModule("iblock");
    if(CModule::IncludeModule("iblock")) {
        CIBlockElement::CounterInc($arResult["ID"]);
    }

    $ar_res['SHOW_COUNTER_START'] = substr( $ar_res['SHOW_COUNTER_START'], 0, -9);
    //echo '<br>'.$ar_res['SHOW_COUNTER_START'];
    ?>
        	</a> <a href="#" rel="nofollow" class="magazine_link_gray"><i class="fa  fa-clock-o"></i><?php echo rand(5,10);?> мин.</a>
        	</div>
    	
    	</div>
    </div>
</div>

<div class="row"><div class="col-12 col-xl-12 col-lg-12 col-md-12 magazine_area_item"><h1>
<?=$arResult["META_TAGS"]["TITLE"]?></h1></div></div>

<div class="row" id="article-char-elem">
    <div class="col-12 col-xl-8 col-lg-8 col-md-8">
    <img class="responsive magazine_detail_picture lazy" border="0" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="<?= $arResult["DETAIL_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["DETAIL_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"/>
    </div>
    
    <div class="col-12 col-xl-4 col-lg-4 col-md-4">
    	<div class="news-detail-content-area"></div>
    </div>

</div>

<div class="row mt-5">
		<div class="col-12 col-xl-8 col-lg-8 col-md-8">
        <div itemprop="articleBody" class="magazine_area_item magazine_area_item_content">
        
          <?
  if (!empty($arResult["FIELDS"]["DETAIL_TEXT"])){
     
      
      if ( $USER->IsAuthorized() )
      {
          if (/*$USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2938'*/ 1==2) {

              
              $responseText = getCorrectedString($arResult["FIELDS"]["DETAIL_TEXT"]);
              echo $responseText;
              
          }
          else {
                      
                      $link_bp = $APPLICATION->GetCurPage(false);
                      
                      $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(6)->fetch();
                      
                      $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                      $entity_data_class = $entity->getDataClass();
                      
                      $data = $entity_data_class::getList(array(
                          "select" => array("*"),
                          "filter" => array(
                              'LOGIC' => 'AND',
                              array('%=UF_BP_LINK' => '%'.$link_bp.'%')
                          )
                      ));
                      
                      if (intval($data->getSelectedRowsCount()) > 0){
                          while($arData = $data->Fetch()){
                             $tolink = $arData['UF_BP_LINK_TO'];
                             $bptype = $arData['UF_BP_TYPE'];
                             $bptext = $arData['UF_BP_TEXT'];
                          }
                          
                          ?>
		<div class="bp-area">
      		<div class="bp-area-content"><span><?php echo $bptext;?></span></div>	
      		<div class="bp-area-button">
      			<div class="btn-group-blue"><a href="<?php echo $tolink;?>" class="btn-cart-roundw-big font new-item-line-buy"><span>Заказать на производстве!</span></a></div>
      		</div>
      	</div>
<?php
        }

          }
      }
      
  }
  ?>
        
                  <?php              
              echo $arResult["FIELDS"]["DETAIL_TEXT"];
              ?>
              </div>
		</div>
		<div class="col-12 col-xl-4 col-lg-4 col-md-4">
		</div>
	</div>

<div class="news-detail">

<!-- <div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span itemprop="headline"><?=$arResult["META_TAGS"]["TITLE"]?></span></h1>
</div>
</div>-->

<meta itemprop="author" content="Трайв">
<meta itemprop="datePublished" content="<?= $arResult["DISPLAY_ACTIVE_FROM"] ?>">
    <? 
    
    if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])) { ?>
        <div class="eraser-9000">
        <div class="row mb-3">
        

        
        </div>
        

            <? } else { ?><? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["PREVIEW_PICTURE"])) { ?>
    <div class="eraser-9000">
        <img class="responsive preview_picture lazy" border="0" src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arResult["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arResult["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arResult["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arResult["PREVIEW_PICTURE"]["TITLE"] ?>"/>
    </div>
        <? } ?>

    <? } ?>

  <!-- Информация о сайте -->
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<link itemprop="url" href="https://traiv-komplekt.ru">
		<meta itemprop="name" content="Трайв - крепёж и метизы оптом по России">
		<meta itemprop="description" content="Болты, метизы, крепеж оптом в ООО «Трайв», такелаж, высокопрочные болты, гайки, нержавеющий строительный крепеж, крепежные изделия - талреп, стопорные кольца, гровер шпилька резьбовая, винты">
		<meta itemprop="address" content="Россия, Санкт-Петербург, Кудрово, ул. Центральная, д. 41">
		<meta itemprop="telephone" content="8 800 333-91-16">
		<div itemprop="logo" itemscope itemtype="https://www.schema.org/ImageObject">
			<link itemprop="url" href="<?=SITE_TEMPLATE_PATH?>/images/logo_new_magazine1.png">
			<link itemprop="contentUrl" href="<?=SITE_TEMPLATE_PATH?>/images/logo_new_magazine1.png">
		</div>
	</div>
  
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
    <div class="bottom_zakaz1">
        <div class="row">
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-right text-lg-right">
        
            <div class="btn-group-blue">
                <a href="#w-form-recall" class="btn-blue min-w-300">
                    <span>Нужна консультация? Закажите звонок!</span>
                </a>
            </div>  
        
        </div>
        
        <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-left text-lg-left pt-2 pt-sm-0 pt-lg-0">
            <div class="btn-group-blue">
                <a href="#w-form" class="btn-blue min-w-300">
                    <span>Отправить заявку на крепеж</span>
                </a>
            </div>        
        </div>
        
    </div>
    </div>



<div class="counter_one">

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