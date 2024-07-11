<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$cartStyle = 'bx-basket';
$cartId = "bx_basket".$component->randString();
$arParams['cartId'] = $cartId;

if ($arParams['POSITION_FIXED'] == 'Y') {
    $cartStyle .= "-fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
    if ($arParams['SHOW_PRODUCTS'] == 'Y') {
        $cartStyle .= ' bx-closed';
    }
} else {
    $cartStyle .= ' bx-opener';
}
?>
<script>
    var <?=$cartId?> = new BitrixSmallCart;
</script>
<? // a id="<?= $cartId " ?>
<a href="#" class="btn-square cart__toggle dropdown-toggle" rel="nofollow">

    <div class="image-basket"></div>

    <!--  <span id="cart_total_count"><?//=$arResult['NUM_PRODUCTS']?></span> -->

    <div class="label-baslet">Корзина</div>
    <br>
    <!-- <span id="cart_total_summ"><?=$arResult['TOTAL_PRICE']?></span> -->
    <? if ($arResult['NUM_PRODUCTS']) { ?>
        <!--<span id="cart_total_summ">--><p class="cart_total_count"><?echo $arResult['NUM_PRODUCTS'];?></p><!--</span>-->
    <? } else { ?>
        <p class="cart_total_count">+</p>
    <? };
    //print_r($arResult['NUM_PRODUCTS']);

    ?>

</a>

    <?
    /** @var \Bitrix\Main\Page\FrameBuffered $frame */
    $frame = $this->createFrame($cartId, false)->begin();
    require(realpath(dirname(__FILE__)).'/ajax_template.php');
    $frame->beginStub();
    $arResult['COMPOSITE_STUB'] = 'Y';
    require(realpath(dirname(__FILE__)).'/top_template.php');
    unset($arResult['COMPOSITE_STUB']);
    $frame->end();
    ?>
	<script type="text/javascript">
        <?=$cartId?>.siteId = '<?=SITE_ID?>';
        <?=$cartId?>.cartId = '<?=$cartId?>';
        <?=$cartId?>.ajaxPath = '<?=$componentPath?>/ajax.php';
        <?=$cartId?>.templateName = '<?=$templateName?>';
        <?=$cartId?>.arParams =  <?=CUtil::PhpToJSObject($arParams)?>; // TODO \Bitrix\Main\Web\Json::encode
        <?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
        <?=$cartId?>.openMessage = '<?=GetMessage('TSB1_EXPAND')?>';
        <?=$cartId?>.activate();
	</script>

