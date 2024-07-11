<?php
namespace Ipol\Aliexpress\Api\Model;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Ipol\Aliexpress\DB\PalletEntity;
use Ipol\Aliexpress\Api\Client;

class Pallet
{
    protected $pallet;

    public function __construct(PalletEntity $pallet)
    {
        $this->pallet = $pallet;
    }

    /**
     * Проверяет был ли отправлен лист передачи в ALI
     *
     * @return boolean
     */
    public function isCreated()
    {
        return !empty($this->pallet['ORDER_ID']);
    }

    /**
     * Создает лист передачи в API
     *
     * @return Bitrix\Main\Result
     */
    public function create()
    {
        $ret = new Result();

        if (!$this->isCreated()) {
            try {
                $parcelIds = [];
                foreach ($this->pallet['ORDERS'] as $order) {
                    $order->fill();

                    $parcelIds[] = $order['ALI_PARCEL_ID'];
                }
                
                $result = Client::getInstance()->getService('logistic')->createTransferSheet($parcelIds, $this->pallet['ORDER_DATE'], false);
                if (!$result) throw new SystemException('Failed to create object');

            } catch (\Exception $e) {
                return $ret->addError(new Error($e->getMessage(), $e->getCode()));
            }

            $this->pallet['ORDER_ID'] = $result;
            $this->pallet->save();
        }

        return $ret->setData([
            'order_id' => $this->pallet['ORDER_ID'],
        ]);
    }

    /**
     * Получает и сохраняет печатную версию этикетки листа передачи
     *
     * @return Bitrix\Main\Result
     */
    public function getPrintLabel()
    {
        $result = $this->getPrintFile('labels.pdf', 1);

        if (!$result->isSuccess()) {
            return $result;
        }

        $data = $result->getData();

        $this->pallet['FILE_LABEL'] = $data['file'];
        $this->pallet->save();

        return $result;
    }

    /**
     * Получает и сохраняет файл на диске
     *
     * @param string $fileName
     * @param int    $type
     * 
     * @return Bitrix\Main\Result
     */
    protected function getPrintFile($fileName, $type)
    {
        $ret = new Result();

        try {
            if (!$this->isCreated()) {
                throw new SystemException('handover is not committed');
            }

            $fileUrl = Client::getInstance()->getService('logistic')->getTransferSheetPrint($this->pallet['ORDER_ID'], false);
            if (!$fileUrl) throw new SystemException('Failed to get file');

            $filePath = '/upload/ipol.aliexpress/pallet/'. $this->pallet['ID'] .'/'. $fileName;

            if (!is_dir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath))
                && !@mkdir($_SERVER['DOCUMENT_ROOT'] . dirname($filePath), BX_DIR_PERMISSIONS, true)
            ) {
                throw new SystemException('Cannot create save folder');
            }

            file_put_contents($_SERVER['DOCUMENT_ROOT'] . $filePath, file_get_contents($fileUrl));

            $ret->setData(['file' => $filePath]);

        } catch (\Exception $e) {
            $ret->addError(new Error($e->getMessage()));
        }

        return $ret;
    }
}