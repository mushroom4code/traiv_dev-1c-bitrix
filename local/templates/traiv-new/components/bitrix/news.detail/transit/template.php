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
$this->setFrameMode(true);
?>
<div class="news-detail">

	<?
	/*if (count($arResult["PROPERTIES"]["OFFER_LINK"]["VALUE"]) > 0){
	    ?>
             <div class="text-right">
             
                <div class="btn-group-blue mt-3 mb-3 pl-2">
                        	<a href="<?= $arResult["PROPERTIES"]["OFFER_LINK"]["VALUE"] ?>" target="_blank" class="btn-404">
                            	<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Коммерческое предложение</span>
                            </a>
                        </div>
             </div>
             <?php
        }*/

        ?>
        <img
			class="detail_picture mb-3 mt-3"
			border="0"
			src="<?=SITE_TEMPLATE_PATH?>/images/transit/detail_picture_transit.jpg"/>
        <?php 
	
	if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		
		<!-- <img
			class="detail_picture mb-3"
			border="0"
			src="<?=SITE_TEMPLATE_PATH?>/images/transit/detail_picture_transit.jpg"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>-->
		
		<!-- <img
			class="detail_picture mb-3"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>-->
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
		<?
		if ($arResult["ID"] != '272441') {
		echo $arResult["DETAIL_TEXT"];
		}?>
	<?else:?>
		<?
		  echo $arResult["PREVIEW_TEXT"];
		?>
	<?endif?>

	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			
		}
		?><br />
	<?endforeach;
?>
</div>

<div class="row">



<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-right text-lg-right">
    <div class="bottom_zakaz2">
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
      <!-- <a href="https://api.whatsapp.com/send?phone=+7 905 233-81-63&text=hello">Whatsapp</a>-->
        
    </div>
    </div>
    </div>
    
    <div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-sm-right text-lg-right">

<div style="text-align:right;padding:10px 0px;">
            <span class="social_share_2020" style="float:none !important;">
            <div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="common" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="false" data-exclude-show-more="true" data-share-style="9" data-counter-background-alpha="1.0" data-top-button="false" class="uptolike-buttons" ></div>
            </span>
</div>

</div>
    
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