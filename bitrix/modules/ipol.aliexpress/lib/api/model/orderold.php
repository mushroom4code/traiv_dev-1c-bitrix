<?php
namespace Ipol\Aliexpress\Api\Model;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\SystemException;
use Ipol\Aliexpress\DB\OrderEntity;
use Ipol\Aliexpress\Api\Client;

class Order
{
    protected $order;

    public function __construct(OrderEntity $order)
    {
        $this->order = $order;
    }

    /**
     * Проверяет был ли отправлен лист передачи в ALI
     *
     * @return boolean
     */
    public function isCreated()
    {
        return !empty($this->order['ALI_PARCEL_ID']);
    }

    /**
     * Создает лист передачи в API
     *
     * @return Bitrix\Main\Result
     */
    public function create()
    {
        $ret = new Result();

        try {
            if ($this->isCreated()) {
                $logisticOrderId = $this->order['ALI_PARCEL_ID'];
            } else {
                $request = $this->getApiCreateRequest();
                $logisticOrderId = Client::getInstance()->getService('logistic')->createParcel($request, false);
            } 

            if (!$logisticOrderId) {
                throw new SystemException('failed to create object');
            }
        
            $data = Client::getInstance()->getService('logistic')->getParcelInfo($logisticOrderId);
            
            if (!$data) {
                throw new SystemException('Failed get order info');
            }
        } catch (\Exception $e) {
            return $ret->addError(new Error($e->getMessage(), $e->getCode()));
        }

        $this->order['ALI_PARCEL_ID']    = $logisticOrderId;
        $this->order['ALI_LP_NUMBER']    = $data['lp_number'];
        $this->order['ALI_TRACK_NUMBER'] = $data['internationallogistics_id'];
        $this->order->save();

        return $ret->setData([
            'logistic_order_id' => $logisticOrderId,
            'lp_number'         => $data['lp_number'],
            'track_number'      => $data['internationallogistics_id'],
        ]);
    }

    /**
     * Получает и сохраняет печатную версию посылки
     *
     * @return Bitrix\Main\Result
     */
    public function getPrintDoc()
    {
        $result = $this->getPrintFile('doc.pdf', true);

        if (!$result->isSuccess()) {
            return $result;
        }

        $data = $result->getData();

        $this->order['FILE_DOC'] = $data['file'];
        $this->order->save();

        return $result;
    }

    /**
     * Получает и сохраняет печатную версию этикетки посылки
     *
     * @return Bitrix\Main\Result
     */
    public function getPrintLabel()
    {
        $result = $this->getPrintFile('labels.pdf', false);

        if (!$result->isSuccess()) {
            return $result;
        }

        $data = $result->getData();

        $this->order['FILE_LABEL'] = $data['file'];
        $this->order->save();

        return $result;
    }

    public function markSended()
    {
        $ret = new Result();

        try {
            $result = Client::getInstance()->getService('logistic')->markParcelSended([
                'logistics_no'     => $this->order['ALI_TRACK_NUMBER'],
                'send_type'        => 'all',
                'out_ref'          => (string) $this->order['ALI_ORDER_ID'],
                'tracking_website' => 'global.cainiao.com',
                'service_name'     => $this->order['RECEIVER_SOLUTION'],
            ], false);

            return $ret;

        } catch (\Exception $e) {
            $ret->addError(new Error($e->getMessage()));
        }

        return $ret;
    }

    /**
     * Возвращает параметры запроса создания листа передачи
     * 
     * @return array
     */
    protected function getApiCreateRequest()
    {
        return [
            'trade_order_id' => $this->order['ALI_ORDER_ID'],
            'total_width'    => (int) ($this->order['DIMENSION_WIDTH'] / 10),
            'total_heigh'    => (int) ($this->order['DIMENSION_HEIGHT'] / 10),
            'total_height'   => (int) ($this->order['DIMENSION_HEIGHT'] / 10),
            'total_length'   => (int) ($this->order['DIMENSION_LENGTH'] / 10),
            'total_weight'   => (float) $this->order['DIMENSION_WEIGHT'],
            'items'          => array_map(function($item) {
                return [
                    'quantity' => (int) $item['QUANTITY'],
                    'sku_id'   => (int) $item['XML_ID'], // $item['SKU']
                ];
            }, $this->order['PRODUCTS'])
        ];
    }

    /**
     * Получает и сохраняет файл на диске
     *
     * @param string $fileName
     * @param int    $type
     * 
     * @return Bitrix\Main\Result
     */
    protected function getPrintFile($fileName, $printDetail)
    {
        $ret = new Result();

        try {
            if (!$this->isCreated()) {
                throw new SystemException('Order is not created');
            }

            $result = Client::getInstance()->getService('logistic')->getParcelPrint(
                $this->order['ALI_TRACK_NUMBER'],
                $printDetail,
                false
            );

            if (!$result) {
                throw new SystemException('Failed to load file');
            }

            $filePath = '/upload/ipol.aliexpress/parcel/'. $this->order['ID'] .'/'. $fileName;

            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath))
                && !@mkdir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath), BX_DIR_PERMISSIONS, true)
            ) {
                throw new SystemException('Cannot create save folder');
            }

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . $filePath, base64_decode($result['body']));

            $ret->setData(['file' => $filePath]);

        } catch (\Exception $e) {
            $ret->addError(new Error($e->getMessage()));
        }

        return $ret;
    }
}