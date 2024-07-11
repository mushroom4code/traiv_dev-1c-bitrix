<?php
namespace Ipol\AliExpress\Api\Service;

use Bitrix\Main\SystemException;
use Ipol\AliExpress\Api\Client;
use Ipol\AliExpress\Utils;

class Order
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
     * Конструктор класса
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Возвращет список заказов по фильтру
     * 
     * @return array 
     */
    public function getList(array $params)
    {
        return $this->client->executeJson([
            'url'   => 'https://openapi.aliexpress.ru/seller-api/v1/order/get-order-list',
            'type'  => 'post',
            'query' => $params,
        ]);
    }

    /**
     * Возвращает информацию по заказу по ID
     *
     * @param string $id
     * @param string $infoFlag
     * 
     * @return array
     */
    public function getById($id, $infoFlag = '11111')
    {
        return $this->getList([
            'order_ids'        => [$id],
            'trade_order_info' => 'Common',
        ]);
    }
}