<?php require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?php
die;
global $USER;
use Bitrix\Main\Application;
$order_id = $request->getPost("ORDER_ID");

use Bitrix\Main,
    Bitrix\Sale\Basket,
    Bitrix\Sale;

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");


$arResult = array('status' => false);
// проверяем параметр ORDER_ID
if (isset($order_id) && $order_id > 0){

    $ORDER_ID = intval($order_id); // ID текущего заказа

    $order = \Bitrix\Sale\Order::load($ORDER_ID); // объект заказа

    if ($order){

        // методы оплаты
        $paymentCollection = $order->getPaymentCollection();
        foreach ($paymentCollection as $payment) {
            $paySysID = $payment->getPaymentSystemId(); // ID метода оплаты
            $paySysName = $payment->getPaymentSystemName(); // Название метода оплаты
        }

        // службы доставки
        $shipmentCollection = $order->getShipmentCollection();
        foreach ($shipmentCollection as $shipment) {
            if($shipment->isSystem()) continue;
            $shipID = $shipment->getField('DELIVERY_ID'); // ID службы доставки
            $shipName = $shipment->getField('DELIVERY_NAME'); // Название службы доставки
        }


        // объект нового заказа
        $orderNew = \Bitrix\Sale\Order::create(SITE_ID, $USER->GetID());

        // код валюты
        $orderNew->setField('CURRENCY', $order->getCurrency());

        // задаём тип плательщика
        $orderNew->setPersonTypeId( $order->getPersonTypeId() );

        // создание корзины
        $basketNew = Basket::create(SITE_ID);

        // дублируем корзину заказа
        $basket = $order->getBasket();

        foreach ($basket as $key => $basketItem){
            $item = $basketNew->createItem('catalog', $basketItem->getProductId());
            $item->setFields(
                array(
                    'QUANTITY' => $basketItem->getQuantity(),
                    'CURRENCY' => $order->getCurrency(),
                    'LID' => SITE_ID,
                    'PRODUCT_PROVIDER_CLASS'=>'\CCatalogProductProvider',
                )
            );
        }

        // привязываем корзину к заказу
        $orderNew->setBasket($basketNew);

        // задаём службу доставки
        $shipmentCollectionNew = $orderNew->getShipmentCollection();
        $shipmentNew = $shipmentCollectionNew->createItem();
        $shipmentNew->setFields(
            array(
                'DELIVERY_ID' => $shipID,
                'DELIVERY_NAME' => $shipName,
                'CURRENCY' => $order->getCurrency()
            )
        );

        // пересчёт стоимости доставки
        $shipmentCollectionNew->calculateDelivery();

        // задаём метод оплаты
        $paymentCollectionNew = $orderNew->getPaymentCollection();
        $paymentNew = $paymentCollectionNew->createItem();
        $paymentNew->setFields(
            array(
                'PAY_SYSTEM_ID' => $paySysID,
                'PAY_SYSTEM_NAME' => $paySysName
            )
        );

        // задаём свойства заказа
        $propertyCollection = $order->getPropertyCollection();
        $propertyCollectionNew = $orderNew->getPropertyCollection();

        foreach ($propertyCollection as $property){

            // получаем свойство в коллекции нового заказа
            $somePropValue = $propertyCollectionNew->getItemByOrderPropertyId( $property->getPropertyId() );

            // задаём значение свойства
            $somePropValue->setValue( $property->getField('VALUE') );
        }


        // сохраняем новый заказ
        $orderNew->doFinalAction(true);
        $rs = $orderNew->save();

        // проверяем результат, присваивает статус ответа
        if ($rs->isSuccess()){
            $arResult['status'] = true;
            $arResult['msg'][] = array('type' => true, 'text' => 'Успешно создан новый заказ, №'.$orderNew->getId());
        } else {
            $arResult['msg'][] = array('type' => false, 'text' => $rs->getErrorMessages());
        }

    } else {
        $arResult['msg'][] = array('type' => false, 'text' => 'Не удалось получить заказ №'.$ORDER_ID);
    }

} else {
    $arResult['msg'][] = array('type' => false, 'text' => 'Не передан параметр ORDER_ID');
}

if($arResult["status"] == true)
{
    echo "Копия заказа создана";
}

?>
