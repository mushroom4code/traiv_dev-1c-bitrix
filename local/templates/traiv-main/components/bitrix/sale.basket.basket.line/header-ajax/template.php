<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}
?>
<span class="cart__summ">

<?
if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) {
	echo $arResult['NUM_PRODUCTS'] . ' ' . $arResult['PRODUCT(S)'];
}
if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>

	<?= GetMessage('TSB1_TOTAL_PRICE') ?><? if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'): ?>
		<?= $arResult['TOTAL_PRICE'] ?><? endif ?>
	
<? endif; ?>
</span>

