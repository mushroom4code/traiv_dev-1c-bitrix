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

<a href="/personal/cart/" class="header-new-link-cart" rel="nofollow">
	<div class="header-new-cart-area">
		<div class="header-new-cart-img text-center"><img src="<?=SITE_TEMPLATE_PATH?>/images/cart_icon_new.png"></div>
		
		<?
        		if ($arResult['NUM_PRODUCTS']) {
        		?>
        		<span id="decodeCardNums">
        				<div id="cart_total_count" class="header-new-cart-count rounded-circle"><?=$arResult['NUM_PRODUCTS'];?></div>
				</span>
        		<?php 
        		} else {
        		    ?>
        		    <span id="decodeCardNums">
        		    	<div id="cart_total_count" class="header-new-cart-count rounded-circle">0</div>
					</span>
        		    <?php 
        		}
        		?>
		
		
	</div>
</a>

<a class="btn-square cart__toggle d-none">

		<div class="top-cart">
		
        		<div class="top-cart-link">
        		<i class="fa fa-shopping-cart">
        		<?
        		if ($arResult['NUM_PRODUCTS']) {
        		?>
        				<div id="cart_total_count" class="rounded-circle"><?=$arResult['NUM_PRODUCTS'];?></div>
        		<?php 
        		} else {
        		    ?>
        		    	<div id="cart_total_count" class="rounded-circle">0</div>
        		    <?php 
        		}
        		?>
        		
        		
        		</i><!-- <span class="top-cart-word">корзина</span> -->
        		</div>
        	</div>
        	<!-- 
        	<div class="top-cart-summ d-none d-lg-block" id="cart_total_summ">
        		<div class="link-cart"><?
        		if ($arResult['NUM_PRODUCTS']) {
        		echo "на сумму ".$arResult['TOTAL_PRICE'];
        		} else {
        		    echo "пуста";
        		}
        		?></div>
        	</div>-->
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

