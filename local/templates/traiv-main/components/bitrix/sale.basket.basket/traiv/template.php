<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

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
/** @var CBitrixBasketComponent $component */

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
    'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
);
$this->addExternalCss($templateData['TEMPLATE_THEME']);

$curPage = $APPLICATION->GetCurPage().'?'.$arParams["ACTION_VARIABLE"].'=';
$arUrls = array(
    "delete" => $curPage."delete&id=#ID#",
    "delay" => $curPage."delay&id=#ID#",
    "add" => $curPage."add&id=#ID#",
);
unset($curPage);

$arBasketJSParams = array(
    'SALE_DELETE' => GetMessage("SALE_DELETE"),
    'SALE_DELAY' => GetMessage("SALE_DELAY"),
    'SALE_TYPE' => GetMessage("SALE_TYPE"),
    'TEMPLATE_FOLDER' => $templateFolder,
    'DELETE_URL' => $arUrls["delete"],
    'DELAY_URL' => $arUrls["delay"],
    'ADD_URL' => $arUrls["add"],
    'EVENT_ONCHANGE_ON_START' => (!empty($arResult['EVENT_ONCHANGE_ON_START']) && $arResult['EVENT_ONCHANGE_ON_START'] === 'Y') ? 'Y' : 'N'
);
?>
<script type="text/javascript">
    var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>
</script>

<?
$APPLICATION->AddHeadScript($templateFolder."/script.js");

if($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP')
{
    $APPLICATION->IncludeComponent(
        "bitrix:sale.gift.basket",
        ".default",
        array(
            "SHOW_PRICE_COUNT" => 1,
            "PRODUCT_SUBSCRIPTION" => 'N',
            'PRODUCT_ID_VARIABLE' => 'id',
            "PARTIAL_PRODUCT_PROPERTIES" => 'N',
            "USE_PRODUCT_QUANTITY" => 'N',
            "ACTION_VARIABLE" => "actionGift",
            "ADD_PROPERTIES_TO_BASKET" => "Y",

            "BASKET_URL" => $APPLICATION->GetCurPage(),
            "APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
            "FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],

            "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_SHOW_VALUE"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

            'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
            'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
            'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],
            'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
            'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
            'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
            'SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
            'SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
            'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
            'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
            'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
            'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
            'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

            "LINE_ELEMENT_COUNT" => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
        ),
        false
    );
}

$normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
$normalHidden = ($normalCount == 0) ? 'style="display:none;"' : '';

$delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
$delayHidden = ($delayCount == 0) ? 'style="display:none;"' : '';

$subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
$subscribeHidden = ($subscribeCount == 0) ? 'style="display:none;"' : '';

$naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
$naHidden = ($naCount == 0) ? 'style="display:none;"' : '';

$index = 1;

?><pre><?//print_r($arProps)?></pre><?

?>
<!--noindex-->
<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">
    <script src="<?=$templateFolder . "/script.js"?>" type="text/javascript"></script>
    <div id="basket_form_container">
        <div class="bx_ordercart <?=$templateData['TEMPLATE_CLASS']; ?>">
            <?

            $bDelayColumn = false;
            $bDeleteColumn = false;
            $bWeightColumn = false;
            $bPropsColumn = false;
            $bPriceType = false;

            foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader) {
                $arHeaders[] = $arHeader["id"];
            }
            ?>
            <div class="container cart-slider">
                <div class="empty-cart <?= ($normalCount == 0 ? 'active' : '') ?>">
                    <p><font class="errortext"><?= GetMessage("SALE_NO_ITEMS"); ?> </font></p>
                </div>
                <table class="cart-inner"  id="basket_items">
                    <thead class="cart__header">
                    <tr>
                        <td colspan="2">Наименование</td>
                        <?//TODO добавить единицу измерения в цену
                        ?>
                        <td>Артикул</td>
                        <td>Цена (руб.)</td>
                        <?//TODO добавить единицу измерения в количество
                        ?>
                        <td>Кол-во</td>
                        <td>Упаковка</td>
                        <td>Итого (руб.)</td>
                    </tr>
                    </thead>

                    <div class="errortext" id="errortext_area">
                        <p class="warning">
                        <?
                        if($arParams['IS_SET_MIN_SUM'] == '1' || $arParams['IS_SET_MIN_SUM'] == 'Да')
                        {
                            echo 'Обратите внимание: минимальная сумма заказа составляет '; $arParams['MIN_SUM'];
                            echo $arParams['MIN_SUM'];
                            echo ' рублей';
                            ?><pre><?//print_r($arResult);?></pre><?
                        }
                        false
                        ?>
                        </p>
                    </div>

                    <tbody class="cart-item" id="basket-content">
                    <? if ($normalCount > 0):

                    if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {
                           /* echo "<pre>";
                            print_r($arResult["GRID"]["ROWS"]);
                            echo "</pre>";*/
                        }
                    }
                    
                        foreach ($arResult["GRID"]["ROWS"] as $k => $arItem) {?>

<?
                            $origname = $arItem["NAME"];
                            $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                            $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);


                            ?>


                            <tr class="cart__row" id="<?=$arItem["ID"]?>" data-product_id="<?= $arItem['PRODUCT_ID'] ?>">
                                <td class="item-name"><p class="item_index"><?=$index.'. '?></p> <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?=$formatedname ?></a></td>
                                <td class="cart__col cart-item__image">
                                    <?
                                    if (!empty($arItem["DETAIL_PICTURE"])):
                                        $img = $arItem["DETAIL_PICTURE"];
                                    elseif (!empty($arItem["PREVIEW_PICTURE"])):
                                        $img = $arItem["PREVIEW_PICTURE"];
                                    else:
                                        // $url = $templateFolder."/images/no_photo.png";

                                        $arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID");
                                        $arSort = array('NAME'=>'ASC');
                                        $arFilter = array('IBLOCK_ID'=>"18", 'ID'=> $arItem['PRODUCT_ID']);
                                        $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                                        $ar_fields = $res->GetNext();


                                        $foo = CIBlockSection::GetList(array('NAME' => 'ASC'), array('IBLOCK_ID' => "18", 'ID' => $ar_fields["IBLOCK_SECTION_ID"]), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "PICTURE"));
                                        $bar = $foo -> GetNext();

                                        if (!empty($bar['PICTURE'])):
                                            $img = $bar['PICTURE'];
                                        elseif (!empty($bar['DETAIL_PICTURE'])):
                                            $img = $bar['DETAIL_PICTURE'];
                                        else:
                                            $img = $templateFolder."/images/no_photo_50x41.png";

                                        endif;

                                    endif;

                                    $ResizedImg = CFile::ResizeImageGet($img,array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);

                                    ?>
                                    <img src="<?= $ResizedImg['src'] ?>" alt="<?= $arItem["NAME"] ?>" class="responsive">
                                </td>
                                <td class="cart__col cart-item__art"><span><?php echo  $arItem["PROPERTY_CML2_ARTICLE_VALUE"];?></span></td>
                                <td class="cart__col cart-item__price" id="itemprice">
                                    <?If ($arItem["PRICE_FORMATED"] !== "0 руб."){?>
                                        <span id="current_price_<?= $arItem["ID"] ?>"><?= $arItem["PRICE"] ?></span><div class="rubls"><b> р.</b></div>
                                    <?} else
                                        echo "Запросить цену"
                                    ?>
                                </td>
                                <td class="cart__col cart-item__qnty">
                                    <div class="item-counter">
                                        <?
                                        $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                        $max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"".$arItem["AVAILABLE_QUANTITY"]."\"" : "";
                                        $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                        $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");
                                        if (!isset($arItem["MEASURE_RATIO"])) {
                                            $arItem["MEASURE_RATIO"] = 1;
                                        }

                                        $PackQuantity = $arItem["QUANTITY"] / $ratio;

                                        ?>
                                        <a rel="nofollow" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'down', <?= $useFloatQuantityJS ?>);" href="javascript:void(0);" class="item-counter__btn item-counter__decrease">
                                            <i class="icon icon--minus"></i> </a>
                                        <input type="hidden" id="QUANTITY_<?=$arItem['ID']?>" name="QUANTITY_<?=$arItem['ID']?>" value="<?=$arItem["QUANTITY"]?>" />
                                        <input id="QUANTITY_INPUT_<?= $arItem["ID"] ?>" name="QUANTITY_INPUT_<?= $arItem["ID"] ?>"  min="0"
                                            <?= $max ?>
                                               step="<?= $ratio //write ajax for ratio //?>" class="item-counter__input form-control" value="<?= $arItem["QUANTITY"] ?>"
                                               onchange="updateQuantity('QUANTITY_INPUT_<?= $arItem["ID"] ?>', '<?= $arItem["ID"] ?>', <?= $ratio ?>, <?= $useFloatQuantityJS ?>)">
                                        <a rel="nofollow" href="javascript:void(0);" onclick="setQuantity(<?= $arItem["ID"] ?>, <?= $arItem["MEASURE_RATIO"] ?>, 'up', <?= $useFloatQuantityJS ?>);" class="item-counter__btn item-counter__increase"> <i class="icon icon--add"></i>
                                        </a>

                                    </div>
                                </td>

                                <td>

                                    <div class="item_packs"><div class="quantity_packs"></div><div class="word_packs"></div></div>

                                </td>
                                <td class="cart__col cart-item__price">
                                    <?If ($arItem["PRICE_FORMATED"] !== "0 руб."){?>
                                        <span id="sum_<?=$arItem["ID"]?>"><?= $arItem["BASE_PRICE"]?></span><div class="rubls"><b> р.</b></div>
                                    <?} else
                                        echo "Запросить цену"
                                    ?>
                                    <a class="btn-remove" rel="nofollow" onclick='goPageAjax("<?= str_replace("#ID#", $arItem["ID"],
                                        $arUrls["delete"]) ?>"); return false;' ><i class="icon icon--cancel"></i></a>
                                </td>
                            </tr>

                            <? $index++; ?>

                        <? } ?>
                    <? endif; ?>

                    </tbody>
                    <?//if ($arResult['allSum'] >= $arParams['MIN_SUM']):?>
                </table>

                    <div class="cart__row" id="basket_items_button_list">
                        <div colspan="5" class="cart__col">
                            <a href="#buy-one-click" onclick="yaCounter18248638.reachGoal ('one_click_buy'); return true;" class="btn btn-mfp-dialog" rel="nofollow">Купить в 1 клик</a>
                            <a href="/personal/order/make/" class="btn" rel="nofollow">Оформить</a>
                            Сумма заказа:
                            <span class="price-small">
                                <?//If ($arItem["PRICE_FORMATED"] !== "0 руб."){?>
                                            <span id="allSum_FORMATED" class="price-small__units"><?= str_replace(" ","&nbsp;", $arResult["allSum"]) ?></span><div class="rubls"> р.</div>
                                <?//} else
                                //  echo "будет сформирована менеджером"
                                ?>
                                        </span>

                        </div>
                    </div>

                    <?//endif;?>

            </div>
        </div>
        <input type="hidden" name="BasketOrder" value="BasketOrder">
    </div>
    <input type="hidden" name="ajax_post" id="ajax_post" value="Y">
</form>

<?

if($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM')
{
    ?>
    <div style="margin-top: 35px;"><? $APPLICATION->IncludeComponent(
    "bitrix:sale.gift.basket",
    ".default",
    array(
        "SHOW_PRICE_COUNT" => 1,
        "PRODUCT_SUBSCRIPTION" => 'N',
        'PRODUCT_ID_VARIABLE' => 'id',
        "PARTIAL_PRODUCT_PROPERTIES" => 'N',
        "USE_PRODUCT_QUANTITY" => 'N',
        "ACTION_VARIABLE" => "actionGift",
        "ADD_PROPERTIES_TO_BASKET" => "Y",

        "BASKET_URL" => $APPLICATION->GetCurPage(),
        "APPLIED_DISCOUNT_LIST" => $arResult["APPLIED_DISCOUNT_LIST"],
        "FULL_DISCOUNT_LIST" => $arResult["FULL_DISCOUNT_LIST"],

        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_SHOW_VALUE"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

        'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
        'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
        'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],
        'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
        'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
        'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
        'SHOW_NAME' => $arParams['GIFTS_SHOW_NAME'],
        'SHOW_IMAGE' => $arParams['GIFTS_SHOW_IMAGE'],
        'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
        'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
        'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
        'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
        'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

        "LINE_ELEMENT_COUNT" => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],
    ),
    false
); ?>
    </div><?
}
?>

<div>
    <input type="hidden" id="column_headers" value="<?=CUtil::JSEscape(implode($arHeaders, ","))?>" />
    <input type="hidden" id="offers_props" value="<?=CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ","))?>" />
    <input type="hidden" id="action_var" value="<?=CUtil::JSEscape($arParams["ACTION_VARIABLE"])?>" />
    <input type="hidden" id="quantity_float" value="<?=$arParams["QUANTITY_FLOAT"]?>" />
    <input type="hidden" id="count_discount_4_all_quantity" value="<?=($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="price_vat_show_value" value="<?=($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="hide_coupon" value="<?=($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="use_prepayment" value="<?=($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N"?>" />
    <input type="hidden" id="auto_calculation" value="<?=($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y"?>" />
</div>
<table class="template-cart__row">
    <tbody>
    <tr class="cart__row" id="template-cart__row" data-product_id="{product_id}">
        <td class="item-name">
            <p class="item_index">{index}</p>
                <a rel="nofollow" href="{href}">{name}</a>
        </td>
        <td class="cart__col cart-item__image">
            <img data-src="{src}" alt="{name}" class="responsive">
        </td>
        <td class="cart__col cart-item__art">
            <span>{art}</span>
        </td>
        <td class="cart__col cart-item__price">
            <span id="current_price_{ID}">{price}</span><span> р.</span>
        </td>
        <td class="cart__col cart-item__qnty">
            <div class="item-counter">
                <a rel="nofollow" onclick="setQuantity({ID}, {rat}, 'down', false);" href="javascript:void(0);" class="item-counter__btn item-counter__decrease">
                    <i class="icon icon--minus"></i>
                </a>
                <input type="hidden" id="QUANTITY_{ID}" name="QUANTITY_{ID}" value="0">
                <input type="text" id="QUANTITY_INPUT_{ID}" name="QUANTITY_INPUT_{ID}" min="0" max="0" step="{rat}" class="item-counter__input form-control" value="" onchange="updateQuantity('QUANTITY_INPUT_{ID}', '{ID}', '{rat}', false)"/>
                <a rel="nofollow" href="javascript:void(0);" onclick="setQuantity({ID}, {rat}, 'up', false);" class="item-counter__btn item-counter__increase"><i class="icon icon--add"></i></a>

            </div>
        </td>
        <td>
            <div class="item_packs"><div class="quantity_packs">{packs_number}</div><div class="word_packs">{packs_word}</div></div>
        </td>
        <td class="cart__col cart-item__price">
            <span id="sum_{ID}">{price_print}</span><span> р.</span>
            <a class="btn-remove" rel="nofollow" onclick='goPageAjax("/?basketAction=delete&amp;id={ID}"); return false;'>
                <i class="icon icon--cancel"></i>
            </a>
        </td>
    </tr>
    </tbody>
</table>
<!--/noindex-->
