<?php
namespace Ipol\AliExpress\Api\Service;

use Bitrix\Main\SystemException;
use Ipol\AliExpress\Api\Client;
use Ipol\AliExpress\Utils;

class OrderOld
{
    public static $StatusList = [
        'PLACE_ORDER_SUCCESS',
        'IN_CANCEL',
        'WAIT_SELLER_SEND_GOODS',
        'SELLER_PART_SEND_GOODS',
        'WAIT_BUYER_ACCEPT_GOODS',
        'FUND_PROCESSING',
        'IN_ISSUE',
        'IN_FROZEN',
        'WAIT_SELLER_EXAMINE_MONEY',
        'RISK_CONTROL',
        'FINISH',
    ];

    /**
     * @var object
     */
    protected $client;

    /**
     * РљРѕРЅСЃС‚СЂСѓРєС‚РѕСЂ РєР»Р°СЃСЃР°
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Р’РѕР·РІСЂР°С‰РµС‚ СЃРїРёСЃРѕРє Р·Р°РєР°Р·РѕРІ РїРѕ С„РёР»СЊС‚СЂСѓ
     * 
     * @return array 
     */
    public function getList(array $params)
    {
        $param0 = new \OrderQuery();

        foreach ($params as $key => $value) {
            $key = strtolower($key);
            $param0->{$key} = $value;
        }

        $request = new \AliexpressSolutionOrderGetRequest();
        $request->setParam0(json_encode($param0));

        $response = $this->client->execute($request);
        $result   = $response->result;

        if (!$result->success) {
            throw new SystemException($result->error_message, $result->error_code);
        }

        return $result;
    }

    /**
     * Р’РѕР·РІСЂР°С‰Р°РµС‚ РёРЅС„РѕСЂРјР°С†РёСЋ РїРѕ Р·Р°РєР°Р·Сѓ РїРѕ ID
     *
     * @param string $id
     * @param string $infoFlag
     * 
     * @return array
     */
    public function getById($id, $infoFlag = '11111')
    {
        $param1 = new \OrderDetailQuery();
        $param1->order_id = $id;
        $param1->ext_info_bit_flag = $infoFlag;

        $request = new \AliexpressSolutionOrderInfoGetRequest();
        $request->setParam1(json_encode($param1));

        $response = $this->client->execute($request);
        $result   = $response->result;

        if ($result->error_code > 0) {
            throw new SystemException($result->error_message, $result->error_code);
        }

        return $result->data;
    }
}