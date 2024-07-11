<?php

use Bitrix\Main,
    Bitrix\Sale,
    Bitrix\Main\Loader,
    Eshoplogistic\Delivery\Event\Unloading,
    Eshoplogistic\Delivery\Helpers\Table,
    Eshoplogistic\Delivery\Config,
    Eshoplogistic\Delivery\Helpers\ShippingHelper;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php"); // ������ ����� ������
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/include.php"); // ������������� ������
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/subscribe/prolog.php"); // ������ ������


Loader::includeModule("sale");
Loader::includeModule("eshoplogistic.delivery");
IncludeModuleLangFile(__FILE__);

$POST_RIGHT = $APPLICATION->GetGroupRight("subscribe");
if ($POST_RIGHT == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));


$ID = intval($_REQUEST['elementId']);
$message = null;
$bVarsFromForm = false; // ���� "������ �������� � �����", ������������, ��� ��������� ������ �������� � �����, � �� �� ��.

$order = Sale\Order::load($ID);
$basket = $order->getBasket();
$basketItems = $basket->getBasketItems();
$orderItems = array();
$orderData = CSaleOrder::GetByID($ID);
$propertyCollection = $order->getPropertyCollection();
$shipmentCollection = $order->getShipmentCollection()->getNotSystemItems();

$APPLICATION->SetTitle(($ID > 0 ? GetMessage("UNLOADING_TITLE_EDIT") . $ID : ''));

$unloading = new Unloading();

$status = $unloading->infoOrder($ID);
if (isset($status['success']) && $status['success'] === false) {
    $result = $status['data']['messages'] ?? Loc::GetMessage("ESHOP_LOGISTIC_VIEW_UPDATESTATUS_ERROR");;
} else {
    $result = $unloading->updateStatusById($status['data'], $ID);
}

echo $result;
?>