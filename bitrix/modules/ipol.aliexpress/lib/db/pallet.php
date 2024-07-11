<?php
namespace Ipol\Aliexpress\DB;

use Bitrix\Main\Error;
use Bitrix\Main\Result;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\EventResult;
use Bitrix\Main\ORM\EntityError;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Ipol\Aliexpress\Api\Model\Pallet as ApiModel;

class PalletTable extends Base
{
    /**
     * @inheritDoc
     *
     * @return string
     */
    public static function getTableName()
	{
		return 'b_ipol_aliexpress_pallet';
    }
    
    /**
     * @inheritDoc
     *
     * @return array
     */
    public static function getMap()
	{
        return [
            'ID'         => new IntegerField('ID', ['primary'        => true, 'autocomplete' => true]),
            'ORDER_DATE' => new DatetimeField('ORDER_DATE', ['title' => static::getLocMessage('TABLE_PALLET_ORDER_DATE'), 'validation' => [__CLASS__, 'validateOrderDate']]),
            'ORDER_ID'   => new StringField('ORDER_ID', ['title'     => static::getLocMessage('TABLE_PALLET_ORDER_ID')]),
            'ORDER_IDS'  => new StringField('ORDER_IDS', ['required' => true, 'serialized' => true]),
            'ORDERS'     => new OneToMany('ORDERS', OrderTable::class, 'PALLET'),
            'FILE_LABEL' => new StringField('FILE_LABEL', ['title'   => static::getLocMessage('TABLE_PALLET_FILE_LABEL')]),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getObjectClass()
    {
        return PalletEntity::class;
    }

    public static function validateOrderDate()
	{
		return array(
			new \Bitrix\Main\Entity\Validator\Length(null, 20),
		);
    }
    
    public static function validateServiceVariant()
	{
		return array(
			new \Bitrix\Main\Entity\Validator\Length(null, 20),
		);
    }

    /**
     * Событие перед сохранением сущности
     * 
     * @param  Bitrix\Main\ORM\Event
     * @return Bitrix\Main\ORM\EventResult
     */
    public static function OnBeforeSave(Event $event)
    {
        $result = new EventResult();
        $fields = $event->getParameter("fields");
        $orders = OrderTable::getList([
            'select' => ['SERVICE_VARIANT', 'SENDER_SOLUTION', 'SENDER_ADDRESS_ID'],
            'filter' => ['ID' => array_merge([-1], $fields['ORDER_IDS'])]
        ])->fetchAll();

        $serviceVariant = array_unique(array_column($orders, 'SERVICE_VARIANT'));
        $senderAddress  = array_unique(array_column($orders, 'SENDER_ADDRESS_ID'));
        $senderSolution = array_unique(array_column($orders, 'SENDER_SOLUTION'));

        if (count($serviceVariant) > 1) {
            $result->addError(new EntityError(static::getLocMessage('TABLE_PALLET_ERROR_MULTIPLE_SERVICE_VARIANT')));

            return $result;
        }

        if (reset($serviceVariant) == 'DOOR_PICKUP'
            && count($senderAddress) > 1
        ) {
            $result->addError(new EntityError(static::getLocMessage('TABLE_PALLET_ERROR_MULTIPLE_SENDER_ADDRESS')));
            
            return $result;
        }

        if (reset($serviceVariant) == 'SELF_SEND'
            && count($senderSolution) > 1
        ) {
            $result->addError(new EntityError(static::getLocMessage('TABLE_PALLET_ERROR_MULTIPLE_SENDER_SOLUTION')));
            
            return $result;
        }
 
        return $result;
    }
}

class PalletEntity extends EO_Pallet
{
    /**
     * Проверяет была ли отправленная заявка через API
     *
     * @return boolean
     */
    public function isCreated()
    {
        return $this->aliexpress()->isCreated();
    }

    /**
     * Привязывает заказы к листу передачи по их ID
     *
     * @param array|string $ids
     * 
     * @return self
     */
    public function setOrderIds($ids)
    {
        $orders = [];

        $ids = is_array($ids) ? $ids : explode(',', $ids);

        if (!empty($ids)) {
            $items  = OrderTable::getList([
                'select' => ['ID'],
                'filter' => ['ID' => $ids]
            ]);

            while($item = $items->fetchObject()) {
                $orders[] = $item;
            }
        }
        
        return $this->setOrders($orders);
    }

    /**
     * Возвращает ID посылок входящих в лист
     *
     * @return array
     */
    public function getOrderIds()
    {
        $ret    = [];
        $orders = $this->get('orders');

        if (!$orders) {
            return $ret;
        }
        
        foreach ($orders as $order) {
            $ret[] = $order->getId();
        }

        return $ret;
    }

    /**
     * Привязывает заказы к листу передачи
     *
     * @return self
     */
    public function setOrders(array $orders)
    {
        if ($this->getId()) {
            $this->fillOrders();
            $this->removeAll('orders');
        }

        $ids = [];

        foreach ($orders as $order) {
            $ids[] = $order->getId();

            $this->addTo('orders', $order);
        }

        $this->sysSetValue('ORDER_IDS', $ids);

        return $this;
    }

    /**
     * Отмечает заказы отправленными
     *
     * @return Bitrix\Main\Result
     */
    public function markSended()
    {
        if (!$this->aliexpress()->isCreated()) {
            throw new \LogicException('handover is not created');
        }

        $result = new Result();

        foreach ($this->getOrders() as $order) {
            $sendResult = $order->markSended();

            if (!$sendResult->isSuccess()) {
                $result->addErrors( $sendResult->getErrors() );
            }
        }

        return $result;
    }

    /**
     * Возвращает модель для работы с внешним API
     * 
     * @return Ipol\Aliexpress\Api\Model\Pallet
     */
    public function aliexpress()
    {
        return new ApiModel($this);
    }

    /**
     * Заполняет сущность данными из настроек
     *
     * @return self
     */
    public function fillFromConfig()
    {
        // $this->set('SERVICE_VARIANT', $serviceVariant = Option::get(IPOL_ALI_MODULE, 'SERVICE_VARIANT'));
        // $this->set('ADDRESS_ID', Option::get(IPOL_ALI_MODULE, $serviceVariant == 'DOOR_PICKUP' ? 'SENDER_ADDRESS_ID' : 'PICKUP_ADDRESS_ID'));
        // $this->set('TOP_USER_KEY', Option::get(IPOL_ALI_MODULE, 'TOP_USER_KEY'));
        // $this->set('CLIENT', Option::get(IPOL_ALI_MODULE, 'CLIENT'));

        return $this;
    }
}