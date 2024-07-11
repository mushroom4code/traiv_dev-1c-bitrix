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
	<div class="row lk_right_menu h-100 g-0">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
		<div class="row row d-flex align-items-center lk-item-block g-0">
	
	<div class="island">
	<div class="d-none">
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
		<div class="row g-0 d-flex align-items-center h-100"><div class="col-12 text-center"><span class="lk-cart-list-count">У вас нет текущих заказов</span></div><div class="col-12 pt-3 pb-3 text-center"><div class="btn-group-blue"><a href="/catalog/" class="btn-404" rel="1"><span>Перейти в каталог</span></a></div></div></div>
		
		<div class="d-none">
			<a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="">
				<?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
			</a>
		</div>
		<?
	}?>
	</div>


	<?
	if (count($arResult['ORDERS']) > 0)
	{
		?>
<div class="row g-0 pb-3" id="orders-list-line-res">

<div class="col-12 d-none d-lg-block" id="catalog-list-line-th">
    	<div class="row g-0">
            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center"><?=Loc::getMessage('SPOL_TPL_ORDER_NUMBER')?></div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1">Дата</div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1"><?=Loc::getMessage('SPOL_TPL_STATUS')?></div>
            <div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center"><?=Loc::getMessage('SPOL_TPL_DELIVERY')?></div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center"><?=Loc::getMessage('SPOL_ORDER_WEIGHT')?></div>
            <!-- <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center"><?=Loc::getMessage('SPOL_TPL_SUM')?></div>-->
            <div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center"><?=Loc::getMessage('SPOL_TPL_ALL_SUMM')?></div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center"><?/*=Loc::getMessage('SPOL_TPL_ACTIONS_LABEL')*/?></div>
        </div>
    </div>

		<!-- <div class="order-table__body"> -->
<div class="row traiv-catalog-line-default g-0">
			<?foreach ($arResult['ORDERS'] as $key => $order){?>
			
			        <div class="col-12 orders-list-line pt-1 pb-1 order-table__item">
        
        <div class="row g-0">
			
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
				
				<div class="col-3 col-xl-1 col-lg-1 col-md-1 pl-1 text-center"><b>№<?=$order['ORDER']['ACCOUNT_NUMBER']?></b></div>
				<div class="col-3 col-xl-1 col-lg-1 col-md-1"><?=$order['ORDER']['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT'])?></div>
				<div class="col-3 col-xl-1 col-lg-1 col-md-1 d-none d-lg-block text-center"><?=htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME'])?></div>
				<div class="col-4 col-xl-1 col-lg-1 col-md-1 d-none d-lg-block text-center">
				 <?foreach ($order["SHIPMENT"] as $keyShip => $shipment) {?>
                                    <?=$shipment["DELIVERY_NAME"]?>
                                <?}?>
				</div>
				
				<div class="col-3 col-xl-1 col-lg-1 col-md-1 d-none d-lg-block text-center">
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
				
				<div class="col-1 col-xl-1 col-lg-1 col-md-1 d-none d-lg-block text-center">
				<?= $order['RES_TOTAL_WEIGHT']?>
				</div>
				
				<div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center d-none"><?=$order['ORDER']['FORMATED_PRICE']?></div>
				<div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center"><?=$order['ORDER']['FORMATED_PRICE']?></div>
				<div class="col-4 col-xl-2 col-lg-2 col-md-2 d-none d-lg-block text-center">
				
				<!-- <div class="btn-group-blue">
                    <a href="#" class="btn-blue">
                        <span>Повторить заказ</span>
                    </a>
                </div>-->
                            <div class="btn-group-blue" style="margin-left:5px;">
                                <a href="/personal/orderview/<?php echo $order['ORDER']['ID'];?>" class="btn-blue" alt="Подробнее о заказе" title="Подробнее о заказе">
                                    <span><i class="fa fa-eye"></i></span>
                                </a>
                            </div>        
				</div>
				
				<div class="col-2 col-xl-1 col-lg-1 col-md-1 text-center" style="position:relative;">
				<button class="btn-collapse">
				<i class="fa fa-chevron-up"></i>
				</button>
				</div>
				
</div>

<div class="row order-products order-details g-0">
<div class="order-table__cell">
<div class="sm-title order-list-title">Состав заказа</div>
<ol>
            <?foreach ($order["BASKET_ITEMS"] as $keyBasket => $basketItem) {
                $origname = $basketItem["NAME"];
                $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|РОМЕК|Северсталь|Европа|Ев|РФ|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);
                ?>
                <li><a href="<?=$basketItem["DETAIL_PAGE_URL"]?>"><?=$formatedname?></a> - <?=$basketItem["QUANTITY"]?>шт.</li>
            <?}?>
</ol>
    </div>
</div>
</div>
			<?}?>
		</div>
		</div>
		<?php 
	}
		?>
<!-- </div> -->
	<!-- </div> -->
			</div>
		</div>
		</div>
		
	

	<div class="clearfix"></div>
	<div class="col-12 mt-3 text-center">
	<?
	echo $arResult["NAV_STRING"];
	?>
	</div>
	<?php 

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






