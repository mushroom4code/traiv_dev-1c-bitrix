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

<div class="catalog-element">
<h1><?=$arResult["META_TAGS"]["TITLE"]?></h1>

    <?
    
    if(is_array($arResult["SECTION"])):?>
<?php 
	        $resItem = CIBlockElement::GetByID($arResult["ID"]);
	        if ($ar_res = $resItem->GetNextElement()) {
	            
	            $arProps = $ar_res->GetProperties();
	     
	            
	            if (!empty($arProps['FILE_GOST_PDF']['VALUE'])){
	                ?>
	                <?php
	                $arFile = CFile::GetFileArray($arProps['FILE_GOST_PDF']['VALUE']);
	                ?>
	                
	                <div class="row mb-3">
                    	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center text-sm-left">
                    		<div class="btn-group-blue">
                    			<a href="<?php echo str_replace("/doc-view/","/",$arResult['ORIGINAL_PARAMETERS']['CURRENT_BASE_PAGE']);?>" class="btn-404"><span><i class="fa fa-arrow-left"></i> Вернуться назад</span></a>
                    		</div>
                    	</div>
                    	
                    	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center text-sm-left">
                    		<div class="btn-group-blue">
                    			<a href="<?php echo $arFile['SRC'];?>" class="btn-i" target="_blank">
                    				<span><i class="fa fa-download"></i> Сохранить файл</span>
                    			</a>
                    		</div>
                    	</div>
                    	
                    </div>
	                
	                <object><embed src="<?php echo $arFile['SRC'];?>" width="100%" height="900" /></object>
	                
	                <?php
	            }
	        }
	            ?>
        <noindex>
            <div class="social_share_2020" style="margin-top: 7%"><div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
    </div>
        </noindex>


        <div class="data_gost">
            <?
            $res = CIBlockElement::GetByID($arResult["ID"]);
            if($ar_res = $res->GetNext())
                $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100;
            echo 'Просмотров: '.$ar_res_hundred;
            echo '<br>Дата первого показа: '.$ar_res['SHOW_COUNTER_START'];
            ?>
            <br>
            <?
            $pub_date = '';
            if ($arResult["ACTIVE_FROM"])
                $pub_date = $arResult["ACTIVE_FROM"];
            elseif ($arResult["DATE_CREATE"])
                $pub_date = $arResult["DATE_CREATE"];

            if ($pub_date)
                echo '<b>'.GetMessage('PUB_DATE').'</b>&nbsp;'.$pub_date.'<br />';
            ?>
            <?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                <b><?=$arProperty["NAME"]?>:</b>&nbsp;<?
                if(is_array($arProperty["DISPLAY_VALUE"])):
                    echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                elseif($pid=="MANUAL"):

                    ?><a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a><?
                else:
                    echo $arProperty["DISPLAY_VALUE"];?>
                <?endif?><br />
            <?endforeach?>
        </div>

        <br /><a href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>"><?=GetMessage("CATALOG_BACK")?></a>
    <?endif?>
</div>


