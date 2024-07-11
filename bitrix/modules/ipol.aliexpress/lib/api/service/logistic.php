<?php
namespace Ipol\AliExpress\Api\Service;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use http\Env\Request;
use Ipol\AliExpress\Api\Client;
use Ipol\AliExpress\Utils;
use Ipol\AliExpress\Debug\Log;

class Logistic
{
    const JSON_BASE_URL = 'https://openapi.aliexpress.ru/';

    /**
     * @var int
     */
    public $cacheTTL;

    /**
     * @var object
     */
    protected $client;

    /**
     * Конструктор класса
     *
     * @param Client $client
     */
    public function __construct(Client $client, $cacheTTL = 86400)
    {
        $this->client   = $client;
        $this->cacheTTL = $cacheTTL;
    }

    // /**
    //  * Отправляет заказ
    //  *
    //  * @param array $data
    //  * 
    //  * @return boolean
    //  */
    // public function fulfillOrder($data)
    // {
    //     $request = new \AliexpressSolutionOrderFulfillRequest;
    //     $request->setServiceName($data['service_name']);
    //     $request->setOutRef($data['out_ref']);
    //     $request->setSendType($data['send_type']);
    //     $request->setLogisticsNo($data['logistics_no']);

    //     $response = $this->client->execute($request, $this->cacheTTL);

    //     return (bool) $response->result_success;
    // }

    /**
     * Создает лист передачи
     *
     * @param array $params
     * @param boolean $silent
     * @return array|false
     */
    public function createTransferSheet(array $parcelIds, \Bitrix\Main\Type\DateTime $arivalDate, $silent = true)
    {
        try {
            $ret = $this->client->executeJson([
                'url'   => 'https://openapi.aliexpress.ru/seller-api/v1/handover-list/create',
                'type'  => 'post',
                'query' => [
                    'logistic_order_ids' => $parcelIds,
                    'arrival_date'       => $arivalDate->format('Y-m-d\TH:i:s\Z'),
                ],
            ]);

            if (isset($ret['error']) && is_array($ret['error'])) {
                throw new SystemException($ret['error']['message'], $ret['error']['code']);
            }

            return $ret['data']['handover_list_id'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Create transfer sheet error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) throw $e;
        }

        return false;
    }

    /**
     * Возвращает PDF листа передачи
     *
     * @param int    $transferSheetId
     * @param boolean $silent
     * @return string|false
     */
    public function getTransferSheetPrint($transferSheetId, $silent = true)
    {
        try {
            $response = $this->client->executeJson([
                'url'   => 'https: //openapi.aliexpress.ru/seller-api/v1/labels/handover-lists/get',
                'type'  => 'post',
                'query' => [
                    'handover_list_id' => $transferSheetId,
                ],
            ], $this->cacheTTL);

            if (isset($ret['error']) && is_array($ret['error'])) {
                throw new SystemException($ret['error']['message'], $ret['error']['code']);
            }

            return $response['data']['label_url'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Create transfer sheet error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) throw $e;
        }

        return false;
    }

    /**
     * Создает посылку в системе
     *
     * @param array $params
     * @param boolean $silent
     * @return int|false
     */
    public function createParcel(\ArrayAccess $params, $silent = true)
    {
        try {
            $response = $this->client->executeJson([
                'method' => 'https://openapi.aliexpress.ru/seller-api/v1/logistic-order/create',
                'type'   => 'post',
                'query'  => [
                    'orders' => [
                        [
                            'trade_order_id' => $params['ALI_ORDER_ID'],
                            'total_length'   => (int) ($params['DIMENSION_LENGTH'] / 10),
                            'total_width'    => (int) ($params['DIMENSION_WIDTH'] / 10),
                            'total_height'   => (int) ($params['DIMENSION_HEIGHT'] / 10),
                            'total_weight'   => (float) ($params['DIMENSION_WEIGHT'] / 1000),
                            'items'          => array_map(function($item) {
                                return [
                                    'quantity' => $item['QUANTITY'],
                                    'sku'      => $item['XML_ID'],
                                ];
                            }, $params['PRODUCTS'])
                        ]
                    ]
                ],
            ], false);

            if (isset($response['error']) && is_array($response['error'])) {
                throw new SystemException($response['error']['message'], $response['error']['code']);
            }

            $items = array_column($response['data']['orders'], 'logistic_orders', 'trade_order_id');
            $order = reset($items);

            return $order['id'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Create parcel error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) throw $e;
        }

        return false;
    }

    /**
     * Возвращает информацию о посылке
     *
     * @param int $orderId
     * @param boolean $silent
     * @return array
     */
    public function getParcelInfo($parcelId, $silent = true)
    {
        try {
            $response = $this->client->executeJson([
                'method' => 'https://openapi.aliexpress.ru/seller-api/v1/logistic-order/get',
                'type'   => 'POST',
                'query'  => ['logistic_order_ids' => [ $parcelId ]],
            ], false);

            if (isset($response['error']) && is_array($response['error'])) {
                throw new SystemException($response['error']['message'], $response['error']['code']);
            }

            $items = array_column($response['data']['logistic_orders'], null, 'logistic_order_id');

            return $items[ $parcelId ] ?? false;

        } catch (\Exception $e) {
            Log::getInstance()->write('Get parcel info error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) throw $e;
        }

        return false;
    }

    /**
     * Запрашивает печатную форму посылки
     *
     * @param int     $orderId
     * @param boolean $printDetail
     * @param boolean $silent
     * @return string|boolean
     */
    public function getParcelPrint($parcelId, $silent = true)
    {
        try {
            $response = $this->client->executeJson([
                'url'   => 'https://openapi.aliexpress.ru/seller-api/v1/labels/orders/get',
                'type'  => 'post',
                'query' => ['logistic_order_ids' => [ $parcelId ]]
            ], $this->cacheTTL);

            if (isset($response['error']) && is_array($response['error'])) {
                throw new SystemException($response['error']['message'], $response['error']['code']);
            }
            
            return $response['data']['label_url'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Get parcel print error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
        }

        return false;
    }

    /**
     * Помечает заказ отправленным
     *
     * @param array $params
     * @param boolean $silent
     * @return boolean
     */
    public function markParcelSended(array $params, $silent = true)
    {
        try {
            $response = $this->client->executeJson([
                'url'   => 'https: //openapi.aliexpress.ru/api/v1/offline-ship/to-in-transit',
                'type'  => 'post',
                'query' => [
                    'trade_order_id'  => $params['ALI_ORDER_ID'],
                    'tracking_number' => $params['ALI_TRACK_NUMBER'],
                    'provider_name'   => $params['RECEIVER_SOLUTION'],
                    // 'tracking_url'    => $params['TRACKING_URL'],
                    // 'markings'        => [],
                ],
            ], false);

            if (isset($response['error']) && is_array($response['error'])) {
                throw new SystemException($response['error']['message'], $response['error']['code']);
            }

            $items = array_column($response['data']['created_orders'], null, 'trade_order_id');

            return $items[ $params['ORDER_ID'] ] ?? false;

        } catch (\Exception $e) {
            Log::getInstance()->write('Mark parcel sended error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) throw $e;
        }

        return false;
    }
}