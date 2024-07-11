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

<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span><?=$arResult["META_TAGS"]["TITLE"]?></span></h1>
</div>
</div>

    <div class="index-item-line" style="width: -webkit-fill-available;     width: -moz-available;   width: fill-available;text-align: center;">
        <div class="category-item" style="display: inline-block; width: 9em; margin: 0.25em 0.25em;">
            <div class="category-item__image">
                <a class="v-aligner__cell" href="/catalog/po-svoistvam/vysokoprochnyi-krepezh/" ><img src="/images/vysokoprochnyi-krepezh.png" alt="Высокопрочный крепеж"></a>
            </div>
            <div class="category-item__title" style="display: block; height: 2.5em" >
                            <span class="v-aligner">
                            <a href="/catalog/po-svoistvam/vysokoprochnyi-krepezh/">Высокопрочный крепеж</a>
                                </span>
            </div>
        </div>
        <!--
        <div class="category-item" style="display: inline-block; width: 12em;">
            <div class="category-item__image">
                <a class="v-aligner__cell" href="/catalog/po-svoistvam/nerzhavejushchii-krepezh/" ><img src="/images/nerzhavejushchii-krepezh.gif"></a>
            </div>
            <h4 class="category-item__title" style="display: block; height: 1em">
            <span class="v-aligner">
            <a href="/catalog/po-svoistvam/nerzhavejushchii-krepezh/">Нержавеющий крепеж</a>
                </span>
            </h4>
        </div>
        -->
        <div class="category-item" style="display: inline-block; width: 9em; margin: 0.25em 0.25em;">
            <div class="category-item__image">
                <a href="/catalog/po-svoistvam/djuimovyi-krepezh/"><img src="/images/djuimovyi-krepezh.png"></a>
            </div>
            <div class="category-item__title" style="display: block; height: 2.5em">
                        <span class="v-aligner">
                        <a href="/catalog/po-svoistvam/djuimovyi-krepezh/">Дюймовый крепеж</a>
                            </span>
            </div>
        </div>

        <div class="category-item" style="display: inline-block; width: 9em; margin: 0.25em 0.25em;">
            <div class="category-item__image">
                <a href="/catalog/po-svoistvam/ocinkovannyi-krepezh/"><img src="/images/ocinkovannyi-krepezh.png"></a>
            </div>
            <div class="category-item__title" style="display: block; height: 2.5em">
                        <span class="v-aligner">
                        <a href="/catalog/po-svoistvam/ocinkovannyi-krepezh/">Оцинкованный крепеж</a>
                            </span>
            </div>
        </div>

        <div class="category-item" style="display: inline-block; width: 9em; margin: 0.25em 0.25em;">
            <div class="category-item__image">
                <a href="/catalog/po-vidy-materialov/poliamidnyi-krepezh/"><img src="/images/poliamidnyi-krepezh.png"></a>
            </div>
            <div class="category-item__title" style="display: block; height: 2.5em">
                <span class="v-aligner">
                <a href="/catalog/po-vidy-materialov/poliamidnyi-krepezh/">Полиамидный крепеж</a>
                    </span>
            </div>
        </div>

        <div class="category-item" style="display: inline-block; width: 9em; margin: 0.25em 0.25em;">
            <div class="category-item__image">
                <a href="/catalog/po-vidy-materialov/stalnoi-krepezh/"><img src="/images/stalnoi-krepezh.png"></a>
            </div>
            <div class="category-item__title" style="display: block; height: 2.5em">
                <span class="v-aligner">
                <a href="/catalog/po-vidy-materialov/stalnoi-krepezh/">Стальной<br>крепеж</a>
                    </span>
            </div>
        </div>


    </div>
    <div class="index-item-line" style="width: -webkit-fill-available;     width: -moz-available;   width: fill-available; text-align: center;">

        <div class="category-item" style="display: inline-block;vertical-align: top; width: 13em; height: 10em; margin: 0.25em 0.25em;">

            <a href="/poleznoe/sootvetstvie-din-gost-iso-so-skhemami/">
                <p class="index-item__title" style="display: block; height: 1em; margin: 0.5em 1em;">Таблица соответствия ГОСТ - DIN - ISO</p>

                <img alt="Соответствие DIN-ГОСТ-ISO" src="/images/din-gost-iso-perevod.png" style="max-width: 4em; margin-top: 1.5em">
            </a>
        </div>

        <div class="category-item" style="display: inline-block;vertical-align: top; width: 13em; height: 10em; margin: 0.25em 0.25em;">

            <a href="/poleznoe/ves-izdeliy-po-din/">
                <p class="index-item__title" style="display: block; height: 1em; margin: 0.5em 1em;">Вес изделий по DIN </p>
                <img alt="Вес изделий по DIN " src="/images/ves_din.png" style="max-width: 6em; margin-top: 1.5em">
            </a>
        </div>

        <div class="category-item" style="display: inline-block;vertical-align: top; width: 13em; height: 10em; margin: 0.25em 0.25em;">

            <a href="/calculator/">
                <p class="index-item__title" style="display: block; height: 1em; margin: 0.5em 1em;">Калькулятор крепежа и метизов </p>

                <img alt="Калькулятор крепежа и метизов" src="/images/calc-ico.png" style="max-width: 4em; margin-top: 1.5em">
            </a>
        </div>

        <div class="category-item" style="display: inline-block; vertical-align: top; width: 13em; height: 10em; margin: 0.25em 0.25em;">

            <a href="/catalog/">
                <p class="index-item__title" style="display: block; height: 1em; margin: 0.5em 1em;">Каталог продукции</p>

                <img src="/upload/resize_cache/iblock/edf/200_140_0/edf1edc7d39e333e0abf0740b7f04696.png?154866527724235" alt="Категории" style="max-width: 6em; margin-top: 1.5em">
            </a>
        </div>
        <br><br>
    </div>

    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
            <?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?>
                <img
                        border="0"
                        src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                        width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
                        id="image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>"
                        style="display:block;cursor:pointer;cursor: hand;"
                        OnClick="document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='block'"
                />
                <img
                        border="0"
                        src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                        width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                        id="image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>"
                        style="display:none;cursor:pointer;cursor: hand;"
                        OnClick="document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='block'"
                />
            <?elseif(is_array($arResult["DETAIL_PICTURE"])):?>
                <img
                        border="0"
                        src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                        width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
                />
            <?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
                <img
                        border="0"
                        src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
                        width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>"
                        height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>"
                        alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
                        title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
                />
            <?endif?>
            <td>

                <div class="file_upl" style="text-align:center">
                    <a href="#download_gost"> <img src="/images/gost/icons.png">
                        <br>
                        Скачать ГОСТ в формате .pdf и .doc. </a>
                        
                        <?
                        
                       
?>
	  
                        
                </div>

            </td>
        </tr>
    </table>
    <?foreach($arResult["PRICES"] as $code=>$arPrice):?>
        <?if($arPrice["CAN_ACCESS"]):?>
            <p><?=$arResult["CAT_PRICES"][$code]["TITLE"];?>&nbsp;
                <?if($arParams["PRICE_VAT_SHOW_VALUE"] && ($arPrice["VATRATE_VALUE"] > 0)):?>
                    <?if($arParams["PRICE_VAT_INCLUDE"]):?>
                        (<?echo GetMessage("CATALOG_PRICE_VAT")?>)
                    <?else:?>
                        (<?echo GetMessage("CATALOG_PRICE_NOVAT")?>)
                    <?endif?>
                <?endif;?>:&nbsp;
                <?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                    <s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
                    <?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
                        <?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["DISCOUNT_VATRATE_VALUE"] > 0 ? $arPrice["PRINT_DISCOUNT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
                    <?endif;?>
                <?else:?>
                    <span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
                    <?if($arParams["PRICE_VAT_SHOW_VALUE"]):?><br />
                        <?=GetMessage("CATALOG_VAT")?>:&nbsp;&nbsp;<span class="catalog-vat catalog-price"><?=$arPrice["VATRATE_VALUE"] > 0 ? $arPrice["PRINT_VATRATE_VALUE"] : GetMessage("CATALOG_NO_VAT")?></span>
                    <?endif;?>
                <?endif?>
            </p>
        <?endif;?>
    <?endforeach;?>
    <?if(is_array($arResult["PRICE_MATRIX"])):?>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
            <thead>
            <tr>
                <?if(count($arResult["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
                    <td><?= GetMessage("CATALOG_QUANTITY") ?></td>
                <?endif;?>
                <?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
                    <td><?= $arType["NAME_LANG"] ?></td>
                <?endforeach?>
            </tr>
            </thead>
            <?foreach ($arResult["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
                <tr>
                    <?if(count($arResult["PRICE_MATRIX"]["ROWS"]) > 1 || count($arResult["PRICE_MATRIX"]["ROWS"]) == 1 && ($arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arResult["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
                        <th nowrap>
                            <?if(IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
                            elseif(IntVal($arQuantity["QUANTITY_FROM"]) > 0)
                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
                            elseif(IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
                            ?>
                        </th>
                    <?endif;?>
                    <?foreach($arResult["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
                        <td>
                            <?if($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"])
                                echo '<s>'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]).'</s> <span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
                            else
                                echo '<span class="catalog-price">'.FormatCurrency($arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arResult["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])."</span>";
                            ?>
                        </td>
                    <?endforeach?>
                </tr>
            <?endforeach?>
        </table>
        <?if($arParams["PRICE_VAT_SHOW_VALUE"]):?>
            <?if($arParams["PRICE_VAT_INCLUDE"]):?>
                <small><?=GetMessage('CATALOG_VAT_INCLUDED')?></small>
            <?else:?>
                <small><?=GetMessage('CATALOG_VAT_NOT_INCLUDED')?></small>
            <?endif?>
        <?endif;?><br />
    <?endif?>
    <?if($arResult["CAN_BUY"]):?>
        <?if($arParams["USE_PRODUCT_QUANTITY"] || count($arResult["PRODUCT_PROPERTIES"])):?>
            <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
                <table border="0" cellspacing="0" cellpadding="2">
                    <?if($arParams["USE_PRODUCT_QUANTITY"]):?>
                        <tr valign="top">
                            <td><?echo GetMessage("CT_BCE_QUANTITY")?>:</td>
                            <td>
                                <input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
                            </td>
                        </tr>
                    <?endif;?>
                    <?foreach($arResult["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
                        <tr valign="top">
                            <td><?echo $arResult["PROPERTIES"][$pid]["NAME"]?>:</td>
                            <td>
                                <?if(
                                    $arResult["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
                                    && $arResult["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
                                ):?>
                                    <?foreach($product_property["VALUES"] as $k => $v):?>
                                        <label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
                                    <?endforeach;?>
                                <?else:?>
                                    <select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
                                        <?foreach($product_property["VALUES"] as $k => $v):?>
                                            <option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
                                        <?endforeach;?>
                                    </select>
                                <?endif;?>
                            </td>
                        </tr>
                    <?endforeach;?>
                </table>
                <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
                <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
                <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>">
                <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_ADD_TO_BASKET")?>">
            </form>
        <?else:?>

            <noindex>
                <a href="<?echo $arResult["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
                &nbsp;<a href="<?echo $arResult["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></a>
            </noindex>

        <?endif;?>
    <?elseif((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])):?>
        <?=GetMessage("CATALOG_NOT_AVAILABLE")?>
        <?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
            "NOTIFY_ID" => $arResult['ID'],
            "NOTIFY_URL" => htmlspecialcharsback($arResult["SUBSCRIBE_URL"]),
            "NOTIFY_USE_CAPTHA" => "N"
        ),
            $component
        );?>
    <?endif?>
    <br />

    <?if($arResult["PREVIEW_TEXT"]):?>
        <br /><?=$arResult["PREVIEW_TEXT"]?><br />
    <?elseif($arResult["DETAIL_TEXT"]):?>
        <br />
        
        <?php 
 
                    /*  if ( $USER->IsAuthorized() )
              {
                  if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '2938') {*/
                      
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
		<div class="bp-area bp-area-100">
      		<div class="bp-area-content"><span><?php echo $bptext;?></span></div>	
      		<div class="bp-area-button">
      			<div class="btn-group-blue"><a href="<?php echo $tolink;?>" class="btn-cart-roundw-big font new-item-line-buy"><span>Заказать на производстве!</span></a></div>
      		</div>
      	</div>
<?php
             
        }
        ?>
                  <?php 
                  
            /*  }
          }*/

?>

        <?=$arResult["DETAIL_TEXT"]?><br />
    <?endif;?>
    <?if(count($arResult["LINKED_ELEMENTS"])>0):?>
        <br /><b><?=$arResult["LINKED_ELEMENTS"][0]["IBLOCK_NAME"]?>:</b>

        <ul>
            <?foreach($arResult["LINKED_ELEMENTS"] as $arElement):?>
                <li><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></li>
            <?endforeach;?>
        </ul>
    <?endif?>
    <?
    // additional photos
    $LINE_ELEMENT_COUNT = 2; // number of elements in a row
    if(count($arResult["MORE_PHOTO"])>0):?>
        <a name="more_photo"></a>
        <?foreach($arResult["MORE_PHOTO"] as $PHOTO):?>
            <img border="0" src="<?=$PHOTO["SRC"]?>" width="<?=$PHOTO["WIDTH"]?>" height="<?=$PHOTO["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" /><br />
        <?endforeach?>
    <?endif?>
    <?if(is_array($arResult["SECTION"])):?>
 <a name="download_gost"></a>
<?php 
	        $resItem = CIBlockElement::GetByID($arResult["ID"]);
	        if ($ar_res = $resItem->GetNextElement()) {
	            
	            $arProps = $ar_res->GetProperties();
	     
	            ?>
	            <div class="din_download">
	            <?php
	            
	            /*if ( $USER->IsAuthorized() )
	            {
	                if ($USER->GetID() == '3092' || $USER->GetID() == '1788' || $USER->GetID() == '6775' ) {
	                    ?>
	                    <div style="border:1px green solid;">
	                    <a href="<?php echo $arResult['ORIGINAL_PARAMETERS']['CURRENT_BASE_PAGE'];?>doc-view/" >Смотреть <?php echo $arResult['META_TAGS']['TITLE'];?> в формате PDF</a>
	                    </div>
	                    <?php 
	                    }
	                }*/
	            
	            if (!empty($arProps['FILE_DIN_PDF']['VALUE'])){
	                ?>
	                <?php 	                
	                $arFile = CFile::GetFileArray($arProps['FILE_DIN_PDF']['VALUE']);
	                ?>
	                <span><a href="<?php echo $arResult['ORIGINAL_PARAMETERS']['CURRENT_BASE_PAGE'];?>doc-view/" class="din_download_link"><img class="ami-lazy loaded" src="/upload/adwex.minified/webp/02c/100/02cd8671c11171d5a7944ecaeb34a1ca.webp" data-src="/upload/adwex.minified/webp/02c/100/02cd8671c11171d5a7944ecaeb34a1ca.webp" data-was-processed="true" style="vertical-align: middle;
    margin-right: 5px;
    margin-bottom: 5px;"><!-- <i class="icofont icofont-file-pdf"></i>-->Скачать <?php echo $arResult['META_TAGS']['TITLE'];?> в формате PDF</a></span>

	                
	                <?php
	            }
	            ?>
	            <br>
	             <?php 
	            
	            if (!empty($arProps['FILE_DIN_DOC']['VALUE'])){
	                ?>
	                <?php 	                
	                $arFile = CFile::GetFileArray($arProps['FILE_DIN_DOC']['VALUE']);
	                ?>
	                <span><a href="<?php echo $arFile['SRC'];?>" class="din_download_link" target="_blank"><img class="ami-lazy loaded" src="/upload/adwex.minified/webp/b70/100/b709b70a185d613159d289d4fc9f8c99.webp" data-src="/upload/adwex.minified/webp/b70/100/b709b70a185d613159d289d4fc9f8c99.webp" data-was-processed="true" style="vertical-align: middle;
    margin-right: 5px;
    margin-bottom: 5px;"><!-- <i class="icofont icofont-file-word"></i>-->Скачать <?php echo $arResult['META_TAGS']['TITLE'];?> в формате DOC</a></span>

	                
	                <?php
	            }
	        }
	            ?>
	            </div>

       

        <noindex>
            <div class="social_share_2020" style="margin-top: 7%"><div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
    </div>
        </noindex>


        <div class="data_gost d-none">
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



