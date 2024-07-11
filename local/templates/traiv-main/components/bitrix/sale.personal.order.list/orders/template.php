<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
CJSCore::Init(array('clipboard'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	/*
	if (!count($arResult['ORDERS']))
	{
		if ($_REQUEST["filter_history"] == 'Y')
		{
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
	*/
	?>
	<div class="island">
	<div class="">
		<?
		$nothing = !isset($_REQUEST["filter_history"]) && !isset($_REQUEST["show_all"]);
		$clearFromLink = array("filter_history","filter_status","show_all", "show_canceled");

		if ($nothing || $_REQUEST["filter_history"] == 'N')
		{
			?>
			<a class="" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
				<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
			</a>
			<?
		}
		if ($_REQUEST["filter_history"] == 'Y')
		{
			?>
			<div class="">
				<a class="" href="<?=$APPLICATION->GetCurPageParam("", $clearFromLink, false)?>">
					<?echo Loc::getMessage("SPOL_TPL_CUR_ORDERS")?>
				</a>
			</div>
			<?
			if ($_REQUEST["show_canceled"] == 'Y')
			{
				?>
				<div class="">
					<a class="" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", $clearFromLink, false)?>">
						<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
					</a>
				</div>
				<?
			}
			else
			{
				?>
				<div class="">
					<a class="" href="<?=$APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", $clearFromLink, false)?>">
						<?echo Loc::getMessage("SPOL_TPL_VIEW_ORDERS_CANCELED")?>
					</a>
				</div>
				<?
			}
		}
		?>
	</div>

	<?
	if (!count($arResult['ORDERS']))
	{
		?>
		<div class="">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="">
				<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
			</a>
		</div>
		<?
	}?>
	</div>




	<div class="order-table">

		<div class="order-table__header">
			<div class="order-table__row">
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_ORDER_NUMBER')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_STATUS')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_DELIVERY')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_ORDER_WEIGHT')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_SUM')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_ALL_SUMM')?></div>
				<div class="order-table__cell u-none--s"><?=Loc::getMessage('SPOL_TPL_ACTIONS_LABEL')?></div>
				<div class="order-table__cell">
					<?/*
					<form action="/" method="post" class="nowrap">
						<span class="label">По дате: от</span>
						<input type="text" placeholder="21.06.17"
							   class="form-control form-control--inline form-control--light">

						<span class="label">до</span>
						<input type="text" placeholder="29.06.17"
							   class="form-control form-control--inline form-control--light">
						<button class="btn u-offset-left-15">Найти</button>
					</form>
					*/?>
				</div>
			</div>
		</div>

		<div class="order-table__body">

			<?foreach ($arResult['ORDERS'] as $key => $order){?>
                <?
					if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'])
					{
					$orderHeaderStatus = $order['ORDER']['STATUS_ID'];
					/*?>
						<h1 class="sale-order-title">
							<?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?> &laquo;<?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>&raquo;
						</h1>
					<?*/
					}

				?>
				<div class="order-table__item">
					<div class="order-table__row">
						<div class="order-table__cell">
							<div>
                                <?=$order['ORDER']['ACCOUNT_NUMBER']?>
                            </div>
                            <div>
                                <?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?>
                            </div>
						</div>
						<div class="order-table__cell">
							<div>
                                <?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?>
                            </div>
						</div>
						<div class="order-table__cell">
                            <div>
                                <?foreach ($order["SHIPMENT"] as $keyShip => $shipment) {?>
                                    <?=$shipment["DELIVERY_NAME"]?>
                                <?}?>
                            </div>
                            <div>
                                <?foreach ($order['SHIPMENT'] as $shipment) {
                                    if (empty($shipment)) {
                                        continue;
                                    }

                                    if ($shipment['FORMATED_DELIVERY_PRICE'])
                                    {
                                        $shipment['FORMATED_DELIVERY_PRICE'];
                                    }
                                    echo $shipmentSubTitle;
                                }
                                ?>
                            </div>
						</div>
                        <div class="order-table__cell">
                            <?= $order['RES_TOTAL_WEIGHT']?>
                        </div>
						<div class="order-table__cell">
							<?=$order['ORDER']['FORMATED_PRICE']?>
						</div>
                        <div class="order-table__cell">
                            <?=$order['ORDER']['FORMATED_PRICE']?>
                        </div>
						<div class="order-table__cell">
							<div>
                                <a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"])?>" class="btn-order-retry"><?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?></a>
                            </div>
							<div>
                                <a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>" class="btn-order-cancel"><?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?></a>
                            </div>
                            <div><a href="/ajax/print/order.php?SHOW_ALL=Y&doc=invoice&ORDER_ID=<?=$order['ORDER']['ID']?>" target="_blank"><?=Loc::getMessage('SPOL_ORDER_PRINT_INVOICE')?></a></div>
                            <div><a href="/ajax/print/order.php?SHOW_ALL=Y&doc=order_form&ORDER_ID=<?=$order['ORDER']['ID']?>" target="_blank"><?=Loc::getMessage('SPOL_ORDER_PRINT_ORDER_FORM')?></a></div>
                            <div><a href="/ajax/print/order.php?SHOW_ALL=Y&doc=waybill&ORDER_ID=<?=$order['ORDER']['ID']?>" target="_blank"><?=Loc::getMessage('SPOL_ORDER_PRINT_WAYBILL')?></a></div>
                            <div><a href="/ajax/print/order.php?SHOW_ALL=Y&doc=factura&ORDER_ID=<?=$order['ORDER']['ID']?>" target="_blank"><?=Loc::getMessage('SPOL_ORDER_PRINT_FACTURA')?></a></div>
						</div>
                        <div class="order-table__cell">
							<div>
                                <button class="btn-collapse"></button>
                            </div>
						</div>
					</div>
                    <div class="order-table__row order-products order-details">
                        <div class="order-table__cell">
                            <div>
                                <h5 class="sm-title">Состав заказа</h5>
                                <ol>
                                    <?foreach ($order["BASKET_ITEMS"] as $keyBasket => $basketItem) {?>
                                        <li><a href="<?=$basketItem["DETAIL_PAGE_URL"]?>"><?=$basketItem["NAME"]?></a> - <?=$basketItem["QUANTITY"]?>шт.</li>
                                    <?}?>
                                </ol>
                            </div>
                        </div>
                    </div>
				</div>
			<?}?>
		</div>

	</div>






	<div class="clearfix"></div>
	<?
	echo $arResult["NAV_STRING"];

	if ($_REQUEST["filter_history"] !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"paymentList" => $paymentChangeData
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}


?>






