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
            $parcelId = $this->isCreated()
                ? $this->order['ALI_PARCEL_ID']
                : Client::getInstance()->getService('logistic')->createParcel($this->order, false)
            ;

            if (!$parcelId) throw new SystemException('failed to create object');
        
            $data = Client::getInstance()->getService('logistic')->getParcelInfo($parcelId);
            if (!$data) throw new SystemException('Failed get order info');

        } catch (\Exception $e) {
            return $ret->addError(new Error($e->getMessage(), $e->getCode()));
        }

        $this->order['ALI_PARCEL_ID']    = $parcelId;
        $this->order['ALI_LP_NUMBER']    = $data['handover_list_id'];
        $this->order['ALI_TRACK_NUMBER'] = $data['platform_tracking_code'];
        $this->order->save();

        return $ret->setData([
            'logistic_order_id' => $parcelId,
            'lp_number'         => $data['handover_list_id'],
            'track_number'      => $data['platform_tracking_code'],
        ]);
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
            $result = Client::getInstance()->getService('logistic')->markParcelSended($this->order, false);

        } catch (\Exception $e) {
            $ret->addError(new Error($e->getMessage()));
        }

        return $ret;
    }

    /**
     * Получает и сохраняет файл на диске
     *
     * @param string $fileName
     * @param int    $type
     * 
     * @return Bitrix\Main\Result
     */
    protected function getPrintFile($fileName)
    {
        $ret = new Result();

        try {
            if (!$this->isCreated()) throw new SystemException('Order is not created');

            $fileUrl = Client::getInstance()->getService('logistic')->getParcelPrint($this->order['ALI_PARCEL_ID']);
            if (!$fileUrl) throw new SystemException('Failed to load file');

            $filePath = '/upload/ipol.aliexpress/parcel/'. $this->order['ID'] .'/'. $fileName;

            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath))
                && !@mkdir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath), BX_DIR_PERMISSIONS, true)
            ) {
                throw new SystemException('Cannot create save folder');
            }

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . $filePath,  file_get_contents($fileUrl));

            $ret->setData(['file' => $filePath]);

        } catch (\Exception $e) {
            $ret->addError(new Error($e->getMessage()));
        }

        return $ret;
    }
}