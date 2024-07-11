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
        public static function syncOrderList()
        {
            $startTime = Option::get(IPOLH_ALI_MODULE, 'LAST_SYNC_ORDER_EXEC_TIME', time());
            $endTime   = time();

            $myOffset = date('Z', time());
            $dateTimeZoneUsa = new \DateTimeZone("Europe/London");
            // $dateTimeUsa = new \DateTime("now", $dateTimeZoneUsa);
            // $usaOffset = $dateTimeZoneUsa->getOffset($dateTimeUsa);
            $usaOffset  = 0;
            $diffOffset = $myOffset - $usaOffset;

            $orders = Client::getInstance()->getService('order');
            $filter = array(
                'date_start'       => date('Y-m-d\TH:i:s\Z', $startTime - $diffOffset),
                'date_end'         => date('Y-m-d\TH:i:s\Z', $endTime - $diffOffset),
                'page_size'        => $limit = 20,
                'page'             => 1,
                'trade_order_info' => 'LogisticInfo',
            );

			try {
                if (Client::getInstance()->isAuthorized()) {
                    do {
                        $response = $orders->getList($filter);
                        $response = self::convertCharset($response, 'UTF-8', SITE_CHARSET);

                        foreach ($response['data']['orders'] as $item) {
                            static::syncOrder($item);
                        }

                        $total_page = ceil($response['data']['total_count'] / $limit);

                    } while ($filter['page']++ < $total_page);

                    Option::set(IPOLH_ALI_MODULE, 'LAST_SYNC_ORDER_EXEC_TIME', $endTime);
                }

            } catch (\Exception $e) {
                Log::getInstance()->write('Sync Order: ' . $e->getMessage() . '(' . $e->getCode() . ')', Log::LEVEL_ERROR);
            }

            return __METHOD__ . '();';
        }

        public static function syncOrderStatus()
        {
            $startTime = Option::get(IPOLH_ALI_MODULE, 'LAST_SYNC_STATUS_EXEC_TIME', time());
            $endTime   = time();

            $myOffset = date('Z', time());
            $dateTimeZoneUsa = new \DateTimeZone("Europe/London");
            // $dateTimeUsa = new \DateTime("now", $dateTimeZoneUsa);
            // $usaOffset = $dateTimeZoneUsa->getOffset($dateTimeUsa);
            $usaOffset  = 0;
            $diffOffset = $myOffset - $usaOffset;

            $orders = Client::getInstance()->getService('order');
            $filter = array(
                'update_at_from' => date('Y-m-d\TH: i: s\Z', $startTime - $diffOffset),
                'updated_at_to'  => date('Y-m-d\TH: i: s\Z', $endTime - $diffOffset),
                'page_size'      => $limit        = 20,
                'page'           => 1,
            );

            try {
                if (Client::getInstance()->isAuthorized()) {
                    do {
                        $response = $orders->getList($filter);
                        $response = self::convertCharset($response, 'UTF-8', SITE_CHARSET);

                        foreach ($response['data']['orders'] as $item) {
                            static::syncOrder($item, false);
                        }

                        $total_page = ceil($response['data']['total_count'] / $limit);

                    } while ($filter['page']++ < $total_page);

                    Option::set(IPOLH_ALI_MODULE, 'LAST_SYNC_STATUS_EXEC_TIME', $endTime);
                }
            } catch (\Exception $e) {
                Log::getInstance()->write('Sync Status: ' . $e->getMessage() . '(' . $e->getCode() . ')', Log::LEVEL_ERROR);
            }

            return __METHOD__ . '();';
        }

        public static function syncOrder($data, $autoCreate = true)
        {
            try {
                $statusMap = [
                    'PLACE_ORDER_SUCCESS'       => 'PlaceOrderSuccess',
                    'IN_CANCEL'                 => 'InCancel',
                    'WAIT_SELLER_SEND_GOODS'    => 'WaitSendGood',
                    'SELLER_PART_SEND_GOODS'    => 'PartialSendGoods',
                    'WAIT_BUYER_ACCEPT_GOODS'   => 'WaitAcceptGoods',
                    'FUND_PROCESSING'           => '',
                    'IN_ISSUE'                  => 'InIssue',
                    'IN_FROZEN'                 => 'InFrozen',
                    'WAIT_SELLER_EXAMINE_MONEY' => 'WaitExamineMoney',
                    'RISK_CONTROL'              => '',
                    'CANCELLED'                 => 'Close',
                    'FINISH'                    => 'Complete',
                ];

                $status = in_array($data['order_display_status'], $statusMap)
                    ? array_search($data['order_display_status'], $statusMap)
                    : $data['order_display_status'];

                $order = static::getOrder($data, $autoCreate);
                $status = Option::get(IPOLH_ALI_MODULE, 'STATUS_ORDER_' . $status);

                if ($status) {
                    $setStatus = true;

                    $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderStatus", array(
                        'ENTITY' => $order,
                        'STATUS' => $status,
                        'ALI_STATUS' => $data->order_status,
                        'ALI_DATA' => $data,
                    ));

                    $event->send();

                    foreach ($event->getResults() as $eventResult) {
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

                if (!$order->isPaid() && ($data['payment_status'] == 'Paid' || $data['payment_status'] == 'Hold')) {
                    $isPaid = true;
                    $date = \Bitrix\Main\Type\DateTime::createFromTimestamp(strtotime($data['paid_at']));

                    $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderPayment", array(
                        'ENTITY' => $order,
                        'IS_PAID' => 'Y',
                        'DATE' => $date,
                        'ALI_DATA' => $data,
                    ));

                    $event->send();

                    foreach ($event->getResults() as $eventResult) {
                        if ($eventResult->getType() != EventResult::SUCCESS) {
                            $isPaid = false;
                            break;
                        }

                        $params = $eventResult->getParameters();
                        $isPaid = isset($params['IS_PAID']) ? $params['IS_PAID'] == 'Y' : $isPaid;
                        $date = isset($params['DATE']) ? $params['DATE'] : $date;
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
                Log::getInstance()->write('Sync Order: ' . $e->getMessage() . '(' . $e->getCode() . ')',
                    Log::LEVEL_ERROR);

                return false;
            }

        }

        public static function getOrder($data, $autoCreate = true, $debug = false)
        {
            $xmlId = 'IPOL_ALI_' . $data['id'];
            $orders = \Bitrix\Sale\Order::loadByFilter([
                'filter' => [
                    '=XML_ID' => $xmlId,
                ]
            ]);

            $order = $orders ? reset($orders) : false;

            if ($order && !$debug) {
                return $order;
            } elseif (!$autoCreate) {
                throw new \Exception('Auto create order is disabled');
            }

            // $data = Client::getInstance()->getService('order')->getById($data->order_id);

            // if (!$data) {
            //     throw new SystemException('Failed load order data' . $data->order_id);
            // }

            $userId          = Option::get(IPOLH_ALI_MODULE, 'ORDER_USER_ID', 1);
            $siteId          = Option::get(IPOLH_ALI_MODULE, 'ORDER_SITE_ID', 's1');
            $personTypeId    = Option::get(IPOLH_ALI_MODULE, 'ORDER_PERSON_TYPE_ID', 1);
            $paymentSystemId = Option::get(IPOLH_ALI_MODULE, 'ORDER_PAYMENT_SYSTEM_ID', 1);

            $order = \Bitrix\Sale\Order::create($siteId, $userId, $data->order_amount->currency_code);
            $order->setField('XML_ID', $xmlId);
            $order->setField('BASE_PRICE_DELIVERY', $data->logistics_amount->amount);
            $order->setPersonTypeId($personTypeId);

            /*****************************************************************/

            $basket = \Bitrix\Sale\Basket::create($siteId);
            $offersInfoList = [];

            foreach ($data['order_lines'] as $product) {
                $fields = [
                    'MODULE'          => IPOLH_ALI_MODULE,
                    'LID'             => $siteId,
                    'PRODUCT_ID'      => $product['sku_code'],
                    'NAME'            => $product['name'],
                    'DETAIL_PAGE_URL' => $product['img_url'],
                    'QUANTITY'        => $product['quantity'],
                    'PRICE'           => $product['item_price'] / 100,
                    'CURRENCY'        => 'RUB',
                    'DISCOUNT_PRICE'  => 0,
                    'CUSTOM_PRICE'    => 'Y',
                    'PROPS'           => array_merge([
                        [
                            'CODE' => 'ALI_ID',
                            'NAME' => 'ALI_ID',
                            'VALUE' => $product['sku_id'],
                        ],

                        [
                            'CODE' => 'ALI_NAME',
                            'NAME' => 'ALI_NAME',
                            'VALUE' => $product['name'],
                        ],

                        [
                            'CODE' => 'ALI_SKU',
                            'NAME' => 'ALI_SKU',
                            'VALUE' => $product['sku_code'],
                        ],
                    ], array_map(function ($key, $value) {
                        return [
                            'CODE'  => $key,
                            'NAME'  => $key,
                            'VALUE' => $value,
                        ];
                    }, array_keys($product['properties_map']), array_values($product['properties_map']))),
                ];

                if (!empty($product['sku_code'])) {
                    $element = \CIBlockElement::GetByID($product['sku_code'])->GetNext();

                    if (!$element) {
                        $ARTICUL_CODE = \Bitrix\Main\Config\Option::get('ipol.aliexpress', 'ARTICUL');

                        if (!empty($ARTICUL_CODE)) {
                            $element = \CIBlockElement::GetList(
                                $sort   = [],
                                $filter = ['=PROPERTY_'. $ARTICUL_CODE => $product['sku_code']],
                                $group  = false, $nav = false,
                                $select = ['ID', 'NAME', 'DETAIL_PAGE_URL']
                            )->GetNext();
                        }
                    }

                    if ($element) {
                        $fields = array_merge($fields, [
                            'MODULE'                 => 'catalog',
                            'PRODUCT_ID'             => $element['ID'],
                            'NAME'                   => $element['NAME'],
                            'DETAIL_PAGE_URL'        => $element['DETAIL_PAGE_URL'],
                            'PRODUCT_PROVIDER_CLASS' => \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
                        ]);
                    }
                }

                $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderBasketItem",
                    array('FIELDS' => $fields, 'ALI_PRODUCT' => $product, 'ALI_DATA' => $data));
                $event->send();

                foreach ($event->getResults() as $eventResult) {
                    if ($eventResult->getType() != EventResult::SUCCESS) {
                        continue 2;
                    }

                    $params = $eventResult->getParameters();

                    if (isset($params['FIELDS'])) {
                        $fields = $params['FIELDS'];
                    }
                }

                $res = \Bitrix\Catalog\Product\Basket::addProductToBasket(
                    $basket,
                    $fields,
                    ['USER_ID' => $userId]
                );

                if (!$res->isSuccess()) {
                    throw new SystemException('Failed add to basket product');
                }
            }

            $order->setBasket($basket);

            /*****************************************************************/

            $shipment = false;
            $deliveryList = Option::get(IPOLH_ALI_MODULE, 'ORDER_DELIVERY_LIST', 'a:0:{}');
            $deliveryList = unserialize($deliveryList) ?: [];

            $deliveryName = $data['pre_split_postings'][0]['logistics_type'];
            $deliveryType = $data['pre_split_postings'][0]['logistic_method'];
            $deliveryId = is_array($deliveryList[$deliveryType]) ? reset($deliveryList[$deliveryType]) : false;

            if (!$deliveryId && is_array($deliveryList['OTHER'])) {
                $deliveryId = reset($deliveryList['OTHER']);
            }

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
                // $shipment->setField('ALLOW_DELIVERY', 'N');
                $shipment->setField('PRICE_DELIVERY', $data['pre_split_postings'][0]['delivery_fee']);
                $shipment->setField('CUSTOM_PRICE_DELIVERY', 'Y');

                $shipmentItemCollection = $shipment->getShipmentItemCollection();

                foreach ($order->getBasket() as $item) {
                    $shipmentItem = $shipmentItemCollection->createItem($item);
                    $shipmentItem->setQuantity($item->getQuantity());

                    if (is_string($shipmentItem->getField("DIMENSIONS"))) {
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

            $props  = [];
            $fields = [
                'ID'         => $data['id'],
                'LAST_NAME'  => '',
                'FIRST_NAME' => $data['buyer_name'],
                'PHONE'      => $data['buyer_phone'],
                'MOBILE'     => $data['buyer_phone'],
                'PERSONE'    => $data['buyer_name'],
                'ZIP'        => end(explode(',', $data['delivery_address'])),
                'CITY'       => '',
                'ADDRESS1'   => $data['delivery_address'],
                'ADDRESS2'   => '',
            ];

            foreach ($fields as $key => $value) {
                $propId = Option::get(IPOLH_ALI_MODULE, 'ORDER_FIELD_' . $key, '');

                if (empty($propId)) {
                    continue;
                }

                $props[$propId] = (isset($props[$propId]) ? $props[$propId] . ', ' : '') . $value;
                $props[$propId] = trim($props[$propId], ', ');
            }

            foreach ($order->getPropertyCollection() as $property) {
                $id = $property->getField('ORDER_PROPS_ID');

                if (array_key_exists($id, $props)) {
                    $property->setValue($props[$id]);
                }
            }

            /*****************************************************************/

            $event = new Event(IPOLH_ALI_MODULE, "onSyncOrderCreate", array('ENTITY' => $order, 'ALI_DATA' => $data));
            $event->send();

            foreach ($event->getResults() as $eventResult) {
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

        protected static function convertCharset($data)
        {
            if (is_array($data)) {
                foreach($data as $k => $v) {
                    $k = self::convertCharset($k);
                    $v = self::convertCharset($v);

                    $data[ $k ] = $v;
                }
            } else {
                $data = $GLOBALS['APPLICATION']->ConvertCharset($data, 'UTF-8', SITE_CHARSET);
            }

            return $data;
        }
    }