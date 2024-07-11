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
    const TYPE_ALL      = 'all';
    const TYPE_PART     = 'part';
    // const JSON_BASE_URL = 'https://stg.ae-rus.ru/logistic-platform-api-isv';
    const JSON_BASE_URL = 'https://api-dev.ae-rus.ru/logistic-platform/logistic-platform-api-isv/';


    /**
     * Список обязательных полей для создания логистического заказа
     *
     * @var array
     */
    protected $orderRequiredFields = [
        'ORDER_LOGISTIC_REFUND_STORE',
        'ORDER_LOGISTIC_SEND_STORE',
        'ORDER_LOGISTIC_DIMM_LEN',
        'ORDER_LOGISTIC_DIMM_WIDTH',
        'ORDER_LOGISTIC_DIMM_HEIGHT',
        'ORDER_LOGISTIC_DIMM_WEIGHT',
        'ORDER_LOGISTIC_FIRST_MILE',
        'ORDER_LOGISTIC_RESOURCE_STORE',

        'ORDER_LOGISTIC_RECEIVER_NAME',
        'ORDER_LOGISTIC_RECEIVER_PHONE',
        'ORDER_LOGISTIC_RECEIVER_COUNTRY_CODE',
        'ORDER_LOGISTIC_RECEIVER_PROVINCE',
        'ORDER_LOGISTIC_RECEIVER_CITY',
        'ORDER_LOGISTIC_RECEIVER_STREET',
        'ORDER_LOGISTIC_RECEIVER_DETAIL_ADDRESS',
        'ORDER_LOGISTIC_RECEIVER_DISTRICT',
        'ORDER_LOGISTIC_RECEIVER_COUNTRY_NAME',
        'ORDER_LOGISTIC_RECEIVER_ZIP_CODE',
    ];
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

    /**
     * Возвращает список поддерживаемых доставок
     *
     * @return array
     */
    public function getList()
    {
        $request = new \AliexpressLogisticsRedefiningListlogisticsserviceRequest();

        $response = $this->client->execute($request, $this->cacheTTL);

        if (!$response->result_success) {
            throw new SystemException($response->error_desc);
        }

        return $response->result_list->aeop_logistics_service_result;
    }

    /**
     * Отправляет заказ
     *
     * @param array $data
     * 
     * @return boolean
     */
    public function fulfillOrder($data)
    {
        $request = new \AliexpressSolutionOrderFulfillRequest;
        $request->setServiceName($data['service_name']);
        $request->setOutRef($data['out_ref']);
        $request->setSendType($data['send_type']);
        $request->setLogisticsNo($data['logistics_no']);

        $response = $this->client->execute($request, $this->cacheTTL);

        return (bool) $response->result_success;
    }

    /**
     * Возвращает адреса привязанные к клиенту
     *
     * @return []
     */
    public function getSellerAddresses()
    {
        try {
            $params['url']    = static::JSON_BASE_URL;
            $params['method'] = '/api/seller/logistics_addresses';
            $params['query']  = ['address_types'=>'sender,pickup,refund'];

            return $this->client->executeJson($params, $this->cacheTTL);
        }
        catch (\Exception $e) {
            Log::getInstance()->write('Logistic order: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);
            
            return false;
        }
    }

    /**
     * Возвращает список адресов продавца
     *
     * @return []
     */
    public function getSenderSellerAddresses()
    {
        $addresses = $this->getSellerAddresses();

        if (!$addresses) {
            return [];
        }

        return $addresses['aliexpress_logistics_redefining_getlogisticsselleraddresses_response']['sender_seller_address_list']['senderselleraddresslist'];
    }

    /**
     * Возвращает список адресов возврата
     *
     * @return []
     */
    public function getRefundSellerAddresses()
    {
        $addresses = $this->getSellerAddresses();

        if (!$addresses) {
            return [];
        }

        return $addresses['aliexpress_logistics_redefining_getlogisticsselleraddresses_response']['refund_seller_address_list']['refundselleraddresslist'];
    }
    
    /**
     * ВОзвращает список адресов отправителя
     *
     * @return []
     */
    public function getPickUpSellerAddresses()
    {
        $addresses = $this->getSellerAddresses();

        if (!$addresses) {
            return [];
        }

        return $addresses['aliexpress_logistics_redefining_getlogisticsselleraddresses_response']['pickup_seller_address_list']['pickupselleraddresslist'];
    }

    /**
     * Возвращает список логистических решений для отгрузки заказа
     * /api/logistics/order/solutions
     *
     * @param  $orderId
     * @return []|false
     */
    public function getSolutions($orderId, array $params = [])
    {
        try {
            $request = [
                'url'    => static::JSON_BASE_URL,
                'method' => '/api/logistics/order/solutions',
                'type'   => 'post',
                'query'  => [
                    'trade_order_id' => (int) $orderId,
                    // 'seller_info_param' => '',
                    'package_params'    => $params ? [array_filter([
                        'width'  => $params['width'],
                        'height' => $params['height'],
                        'length' => $params['length'],
                        'weight' => $params['weight'],
                    ])] : [],
                ]
            ];

            $result = $this->client->executeJson($request, $this->cacheTTL);
            $result = $result['cainiao_global_solution_inquiry_response'];

            // if (!$result['is_success']) {
            //     throw new SystemException($result['error_info']['error_msg'], $result['error_info']['error_code']);
            // }

            $result = $result['result']['usable_solution_list']['open_solution_dto'];

            usort($result, function($a, $b) {
                return $b['recommend_index'] - $a['recommend_index'];
            });

            return $result;

        } catch (\Exception $e) {
            Log::getInstance()->write('Get solutions request fail: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);
        }

        return false;
    }

    public function getSenderSolutions($serviceVariant, $addressId, $solutionCode = '')
    {
        try {
            $request = [
                'method' => '/api/firstmile/solutions',
                'type'   => 'get',
                'query'  => array_filter([
                    'address_id'    => (int) $addressId,
                    'code'          => $serviceVariant,
                    'solution_code' => $solutionCode,
                ])
            ];

            $result = $this->client->executeJson($request, $this->cacheTTL);
            $result = $result['cainiao_global_solution_service_resource_query_response']['result'];

            // if (!$result['is_success']) {
            //     throw new SystemException($result['error_info']['error_msg'], $result['error_info']['error_code']);
            // }

            return (array) $result['result']['solution_service_res_list']['solution_service_res_dto'];


        } catch (\Exception $e) {
            Log::getInstance()->write('Get sender solutions request fail: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);
        }

        return false;
    }

    /**
     * Создает лист передачи
     *
     * @param array $params
     * @param boolean $silent
     * @return array|false
     */
    public function createTransferSheet(array $params, $silent = true)
    {
        try {
            $request = [
                'url'    => static::JSON_BASE_URL,
                'method' => '/api/handover/commit',
                'type'   => 'post',
                'query'  => is_array($params) ? $params : [],
            ];

            // $result = $this->client->executeJson($request, false);
            $result = json_decode('{"cainiao_global_handover_commit_response":{"result":{"data":{"handover_order_id":1993605,"handover_content_code":"LP00410280183654","handover_content_id":1853583},"error_msg":"","error_code":"","success":true}}}', true);
            $result = $result['cainiao_global_handover_commit_response']['result'];

            if (!$result['success']) {
                throw new SystemException($result['error_msg'], $result['error_code']);
            }

            return $result['data'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Create transfer sheet error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
        }

        return false;
    }

    /**
     * Возвращает PDF листа передачи
     *
     * @param string $client
     * @param int    $transferSheetId
     * @param boolean $silent
     * @return string|false
     */
    public function getTransferSheetPrint($topUserKey, $client, $transferSheetId, $type = 2, $silent = true)
    {
        try {
            $request = [
                'url'    => static::JSON_BASE_URL,
                'method' => '/api/handover/pdf',
                'query'  => [
                    'top_user_key'        => $topUserKey,
                    'client'              => $client,
                    'handover_content_id' => $transferSheetId,
                    'type'                => $type,
                ],
            ];

            $result = $this->client->executeJson($request);
            $result = $result['cainiao_global_handover_pdf_get_response']['result'];

            if (!$result['success']) {
                throw new SystemException($result['error_msg'], $result['error_code']);
            }

            return json_decode($result['data'], true);

        } catch (\Exception $e) {
            Log::getInstance()->write('Create transfer sheet error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
        }

        return false;
    }

    /**
     * Возвращает PDF этикетки листа передачи
     *
     * @param string $client
     * @param int    $transferSheetId
     * @param boolean $silent
     * @return string|false
     */
    public function getTransferSheetLabel($topUserKey, $client, $transferSheetId, $silent = true)
    {
        return $this->getTransferSheetPrint($client, $transferSheetId, 1, $silent);
    }

    /**
     * Создает посылку в системе
     *
     * @param array $params
     * @param boolean $silent
     * @return int|false
     */
    public function createParcel(array $params, $silent = true)
    {
        try {
            $request = [
                'method' => '/api/logistics/order',
                'type'   => 'post',
                'query'  => $params,
            ];

            $result = $this->client->executeJson($request, false);
            // $result = json_decode('{"cainiao_global_logistic_order_create_response":{"need_retry":false,"result":{"logistics_order_id":20185524047},"is_success":"","error_info":{"error_code":"","error_msg":""}}}', true);
            $result = $result['cainiao_global_logistic_order_create_response'];

            if (empty($result['result']['logistics_order_id'])) {
                throw new \Exception($result['error_info']['error_msg']);
            }

            return $result['result']['logistics_order_id'];

        } catch (\Exception $e) {
            Log::getInstance()->write('Create parcel error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
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
    public function getParcelInfo($orderId, $silent = true)
    {
        try {
            $request = [
                'method' => '/api/orders/'. $orderId .'/logistics_info',
                'type'   => 'get',
                'query'  => [],
            ];

            $result = $this->client->executeJson($request, false);
            $result = $result['aliexpress_logistics_redefining_getonlinelogisticsinfo_response'];

            if (!empty($result['error_desc'])) {
                throw new SystemException($result['error_desc']);
            }

            return $result['result_list']['result'][0];

        } catch (\Exception $e) {
            Log::getInstance()->write('Get parcel info error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
        }
    }

    /**
     * Запрашивает печатную форму посылки
     *
     * @param int     $orderId
     * @param boolean $printDetail
     * @param boolean $silent
     * @return string|boolean
     */
    public function getParcelPrint($orderId, $printDetail = false, $silent = true)
    {
        try {
            $request = [
                'method' => '/api/orders/'. $orderId .'/logistics_print_info',
                'type'   => 'get',
                'query'  => array_filter([
                    'print_detail' => $printDetail,
                ])
            ];

            $result = $this->client->executeJson($request, $this->cacheTTL);
            $result = json_decode($result['result'], true);

            if (isset($result['errorDesc'])) {
                throw new SystemException($error['errorDesc']);
            }

            return $result;

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
            $request = [
                'method' => '/api/seller/shipment',
                'type'   => 'post',
                'query'  => $params,
            ];

            $result = $this->client->executeJson($request, false);
            $result = $result['aliexpress_logistics_sellershipmentfortop_response'];

            if (!$result['result_success']) {
                throw new SystemException($result['result_error_desc']);
            }

            return true;


        } catch (\Exception $e) {
            Log::getInstance()->write('Mark parcel sended error: '. $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);

            if (!$silent) {
                throw $e;
            }
        }

        return false;
    }
}