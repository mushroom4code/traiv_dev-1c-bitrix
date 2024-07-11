<?php
namespace Ipol\AliExpress\Agent;

use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use \Bitrix\Main\Event;
use \Bitrix\Main\EventResult;
use Bitrix\Sale\Delivery\Services\Manager;
use Ipol\AliExpress\Debug\Log;
use Ipol\AliExpress\Api\Client;

class Order
{
    /**
     * Выполняет периодическую синхронизацию заказов с AliExpress
     *
     * @return string
     */
    public static function syncOrderList()
    {
        $startTime = Option::get(IPOLH_ALI_MODULE, 'LAST_SYNC_ORDER_EXEC_TIME', time());
        $endTime   = time();

        $myOffset=date('Z', time());
        $dateTimeZoneUsa = new \DateTimeZone("America/Los_Angeles");
        $dateTimeUsa = new \DateTime("now", $dateTimeZoneUsa);
        $usaOffset = $dateTimeZoneUsa->getOffset($dateTimeUsa);
        $diffOffset = $myOffset - $usaOffset;

        $orders = Client::getInstance()->getService('order');
        $filter = array(
            'CREATE_DATE_START' => date('Y-m-d H:i:s', $startTime - $diffOffset),
            'CREATE_DATE_END'   => date('Y-m-d H:i:s', $endTime - $diffOffset),
            'PAGE_SIZE'         => 20,
            'CURRENT_PAGE'      => 1,
        );

        try {
            if (Client::getInstance()->isAuthorized()) {
                do {
                    $response = $orders->getList($filter);

                    foreach ((array) $response->target_list->order_dto as $item) {
                        static::syncOrder($item);
                    }

                } while ($filter['CURRENT_PAGE']++ < $response->total_page);


                Option::set(IPOLH_ALI_MODULE, 'LAST_SYNC_ORDER_EXEC_TIME', $endTime);
            }

        } catch (\Exception $e) {
            Log::getInstance()->write('Sync Order: ' . $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);
        }

        return __METHOD__ .'();'; 
    }

    /**
     * Выполняет периодическую синхронизацию статусов с AliExpress
     *
     * @return string
     */
    public static function syncOrderStatus()
    {
        $startTime = Option::get(IPOLH_ALI_MODULE, 'LAST_SYNC_STATUS_EXEC_TIME', time());
        $endTime   = time();
        
        $myOffset=date('Z', time());
        $dateTimeZoneUsa = new \DateTimeZone("America/Los_Angeles");
        $dateTimeUsa = new \DateTime("now", $dateTimeZoneUsa);
        $usaOffset = $dateTimeZoneUsa->getOffset($dateTimeUsa);
        $diffOffset = $myOffset - $usaOffset;

        $orders = Client::getInstance()->getService('order');
        $filter = array(
            'MODIFIED_DATE_START' => date('Y-m-d H:i:s', $startTime - $diffOffset),
            'MODIFIED_DATE_END'   => date('Y-m-d H:i:s', $endTime - $diffOffset),
            'PAGE_SIZE'           => 20,
            'CURRENT_PAGE'        => 1,
        );

        try {
            if (Client::getInstance()->isAuthorized()) {
                do {
                    $response = $orders->getList($filter);

                    foreach ((array) $response->target_list->order_dto as $item) {
                        static::syncOrder($item, false);
                    }

                } while ($filter['CURRENT_PAGE']++ < $response->total_page);

                Option::set(IPOLH_ALI_MODULE, 'LAST_SYNC_STATUS_EXEC_TIME', $endTime);
            }
        } catch (\Exception $e) {
            Log::getInstance()->write('Sync Status: ' . $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);
        }

        return __METHOD__ .'();';
    }

    public static function syncOrder($data, $autoCreate = true)
    {
        try {
            $order  = static::getOrder($data, $autoCreate);

            $status = Option::get(IPOLH_ALI_MODULE, 'STATUS_ORDER_'. strtoupper($data->order_status));
            
            if ($status) {
                $setStatus = true;

                $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderStatus", array(
                    'ENTITY'     => $order, 
                    'STATUS'     => $status, 
                    'ALI_STATUS' => $data->order_status,
                    'ALI_DATA'   => $data,
                ));
                
                $event->send();

                foreach($event->getResults() as $eventResult) {
                    if ($eventResult->getType() != EventResult::SUCCESS) {
                        $setStatus = false;
                        break;
                    }

                    $params = $eventResult->getParameters();
                    $status = isset($params['STATUS']) ? $params['STATUS'] : (sizeof($params) == 1 ? reset($params) : $status);
                }

                if ($status && $setStatus) {
                    $order->setField('STATUS_ID', $status);
                }
            }

            if (!$order->isPaid() && $data->fund_status == 'PAY_SUCCESS') {
                $isPaid = true;
                $date   = new \Bitrix\Main\Type\DateTime($data->gmt_pay_time, 'Y-m-d H:i:s');

                $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderPayment", array(
                    'ENTITY'   => $order, 
                    'IS_PAID'  => 'Y', 
                    'DATE'     => $date,
                    'ALI_DATA' => $data,
                ));

                $event->send();

                foreach($event->getResults() as $eventResult) {
                    if ($eventResult->getType() != EventResult::SUCCESS) {
                        $isPaid = false;
                        break;
                    }

                    $params = $eventResult->getParameters();
                    $isPaid = isset($params['IS_PAID']) ? $params['IS_PAID'] == 'Y' : $isPaid;
                    $date   = isset($params['DATE'])    ? $params['DATE'] : $date;
                }

                if ($isPaid) {
                    $payment = $order->getPaymentCollection()[0];

                    if ($payment) {
                        $payment->setPaid('Y');
                        $payment->setField('DATE_PAID', $date);
                    }
                }
            }

            $order->save();

        } catch (\Exception $e) {
            Log::getInstance()->write('Sync Order: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            return false;
        }

    }

    protected static function getOrder($data, $autoCreate = true)
    {
        $xmlId  = 'IPOL_ALI_'. $data->order_id;
        $orders = \Bitrix\Sale\Order::loadByFilter([
            'filter' => [
                '=XML_ID' => $xmlId,
            ]
        ]);

        $order = $orders ? reset($orders) : false;

        if ($order) {
            return $order;
        } elseif (!$autoCreate) {
            throw new \Exception('Auto create order is disabled');
        }

        $data = Client::getInstance()->getService('order')->getById($data->order_id);

        if (!$data) {
            throw new SystemException('Failed load order data'. $data->order_id);
        }

        $userId          = Option::get(IPOLH_ALI_MODULE, 'ORDER_USER_ID', 1);
        $siteId          = Option::get(IPOLH_ALI_MODULE, 'ORDER_SITE_ID', 's1');
        $personTypeId    = Option::get(IPOLH_ALI_MODULE, 'ORDER_PERSON_TYPE_ID', 1);
        $paymentSystemId = Option::get(IPOLH_ALI_MODULE, 'ORDER_PAYMENT_SYSTEM_ID', 1);

        $props        = [];
        $fields       = [
            'ID'         => $data->id,
            'LAST_NAME'  => $data->buyer_info->last_name,
            'FIRST_NAME' => $data->buyer_info->first_name,
            'PHONE'      => $data->receipt_address->phone_number ? ($data->receipt_address->phone_country . $data->receipt_address->phone_area . $data->receipt_address->phone_number) : '',
            'MOBILE'     => $data->receipt_address->phone_country . $data->receipt_address->mobile_no,
            'PERSONE'    => $data->receipt_address->contact_person,
            'ZIP'        => $data->receipt_address->zip,
            'CITY'       => trim($data->receipt_address->country .', '. $data->receipt_address->city, ', '),
            'ADDRESS1'   => trim($data->receipt_address->address .', '. $data->receipt_address->detail_address, ', '),
            'ADDRESS2'   => $data->receipt_address->address2,
        ];

        foreach ($fields as $key => $value) {
            $propId = Option::get(IPOLH_ALI_MODULE, 'ORDER_FIELD_'. $key, '');

            
            if (empty($propId)) {
                continue;
            }

            $props[$propId] = (isset($props[$propId]) ? $props[$propId] .', ' : '') . $value;
            $props[$propId] = trim($props[$propId], ', ');
        }

        $order = \Bitrix\Sale\Order::create($siteId, $userId, $data->order_amount->currency_code);
        $order->setField('XML_ID', $xmlId);
        $order->setField('BASE_PRICE_DELIVERY', $data->logistics_amount->amount);
        $order->setPersonTypeId($personTypeId);

        foreach ($order->getPropertyCollection() as $property) {
            $id = $property->getField('ORDER_PROPS_ID');

            if (array_key_exists($id, $props)) {
                $property->setValue($props[$id]);
            }
        }
        

        /*****************************************************************/
        
        $basket = \Bitrix\Sale\Basket::create($siteId);
        
        foreach ($data->child_order_list->global_aeop_tp_child_order_dto as $product) {
            if (!empty($product->sku_code)
                && ($element = \CIBlockElement::GetByID($product->sku_code)->GetNext())
            ) {
                $bxProduct = \CCatalogProduct::GetByID($element['ID']);

                $item   = $basket->createItem('catalog', $element['ID']);
                $fields = [
                    'CATALOG_XML_ID'  => $element['IBLOCK_EXTERNAL_ID'],
                    'PRODUCT_XML_ID'  => $element['XML_ID'],
                    'NAME'            => $element['NAME'],
                    'DETAIL_PAGE_URL' => $element['DETAIL_PAGE_URL'],
                    'WEIGHT'          => $bxProduct['WEIGHT'],
                    'DIMENSIONS'      => [
                        'WIDTH'  => $bxProduct['WIDTH'],
                        'HEIGHT' => $bxProduct['HEIGHT'],
                        'LENGTH' => $bxProduct['LENGTH'],
                    ],
                ];

            } else {
                $item   = $basket->createItem(IPOLH_ALI_MODULE, 'ALI_'. $product->product_id);
                $fields = [
                    'NAME'            => $product->product_name,
                    'DETAIL_PAGE_URL' => $product->product_snap_url,
                ];
            }
            
            $item->setFieldsNoDemand(array_merge($fields, [
                'QUANTITY'       => $product->product_count,
                'PRICE'          => $product->product_price->amount,
                'CURRENCY'       => $product->product_price->currency_code,
                'DISCOUNT_PRICE' => 0,
                'CUSTOM_PRICE'   => 'Y',
            ]));

            $item->getPropertyCollection()->setProperty(array_map(function($item) {
                return [
                    'CODE'  => $item->pName,
                    'NAME'  => $item->pName,
                    'VALUE' => $item->pValue,
                ];
            },  json_decode($product->product_attributes)->sku ?: []));
        }

        $order->setBasket($basket);

        /*****************************************************************/

        $shipment     = false;
        $deliveryList = Option::get(IPOLH_ALI_MODULE, 'ORDER_DELIVERY_LIST', 'a:0:{}');
        $deliveryList = unserialize($deliveryList) ?: [];

        $deliveryName = $data->child_order_list->global_aeop_tp_child_order_dto[0]->logistics_service_name;
        $deliveryType = $data->child_order_list->global_aeop_tp_child_order_dto[0]->logistics_type;
        $deliveryId   = reset($deliveryList[$deliveryType]);

        if ($deliveryId) {
            if ($deliveryService = Manager::getObjectById($deliveryId)) {
                if ($deliveryService->isProfile()) {
                    $deliveryName = $deliveryService->getNameWithParent();
                } else {
                    $deliveryName = $deliveryService->getName();
                }
            }

            $shipmentCollection = $order->getShipmentCollection();
            
            $shipment = $shipmentCollection->createItem();
            $shipment->setField('CURRENCY', $order->getCurrency());
            $shipment->setField('ALLOW_DELIVERY', 'Y');
            $shipment->setField('CUSTOM_PRICE_DELIVERY', 'Y');
            $shipment->setField('PRICE_DELIVERY', $data->logistics_amount->amount);

            $shipmentItemCollection = $shipment->getShipmentItemCollection();

            foreach($order->getBasket() as $item)
            {
                $shipmentItem = $shipmentItemCollection->createItem($item);
                $shipmentItem->setQuantity($item->getQuantity());

                if(strlen($shipmentItem->getField("DIMENSIONS"))) {
                    $shipmentItem->setField("DIMENSIONS", unserialize($shipmentItem->getField("DIMENSIONS")));
                }
            }

            $shipment->setField('DELIVERY_ID', $deliveryId);
            $shipment->setField('DELIVERY_NAME', $deliveryName);
        }

        /*****************************************************************/

        $service = \Bitrix\Sale\PaySystem\Manager::getObjectById($paymentSystemId);
        $payment = $order->getPaymentCollection()->createItem($service);
        $payment->setField('SUM', $order->getPrice());

        /*****************************************************************/

        $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderCreate", array('ENTITY' => $order, 'ALI_DATA' => $data));
		$event->send();

		foreach($event->getResults() as $eventResult) {
			if ($eventResult->getType() != EventResult::SUCCESS) {
				throw new SystemException('Received a negative response in the event onSyncOrderCreate');
			}
        }
        
        /*****************************************************************/

        $result = $order->save();

        if (!$result->isSuccess()) {
            throw new SystemException('Failed save order');
        }

        if ($shipment) {
            $result = $shipment->save();
            
            if (!$result->isSuccess()) {
                throw new SystemException('Failed save order shipment');
            }
        }

        return $order;
    }
}