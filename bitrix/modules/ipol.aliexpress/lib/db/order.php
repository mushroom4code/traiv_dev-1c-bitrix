<?php
namespace Ipol\Aliexpress\DB;

use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\FloatField;
use Bitrix\Main\ORM\Fields\EnumField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use Bitrix\Main\ArgumentException;
use Bitrix\Sale\Order as BxOrder;
use Bitrix\Sale\PropertyValueCollection;
use Ipol\Aliexpress\Utils;
use Ipol\Aliexpress\Api\Model\Order as ApiModel;

Loc::loadMessages(__FILE__);

class OrderTable extends Base
{
    /**
     * @inheritDoc
     *
     * @return string
     */
    public static function getTableName()
	{
		return 'b_ipol_aliexpress_order';
    }
    
    /**
     * @inheritDoc
     *
     * @return array
     */
    public static function getMap()
	{
        return [
            new IntegerField('ID', [
				'primary'      => true,
				'autocomplete' => true,
            ]),

            new IntegerField('ORDER_ID', [
                'title' => static::getLocMessage('TABLE_ORDER_ORDER_ID'),
                'required' => true,
            ]),

            new FloatField('ORDER_PRICE', [
                'title'    => static::getLocMessage('TABLE_ORDER_ORDER_PRICE'),
                'required' => true,
            ]),

            new StringField('ORDER_CURRENCY', [
                'title'    => static::getLocMessage('TABLE_ORDER_ORDER_PRICE'),
                'required' => true,
            ]),

            new IntegerField('ALI_ORDER_ID', [
                'title'    => static::getLocMessage('TABLE_ORDER_ALI_ORDER_ID'),
                'required' => true,
            ]),

            new IntegerField('ALI_PARCEL_ID', [
                'title' => static::getLocMessage('TABLE_ORDER_ALI_PARCEL_ID'),
            ]),
            
            new StringField('ALI_LP_NUMBER', [
                'title' => static::getLocMessage('TABLE_ORDER_ALI_LP_NUMBER'),
            ]),

            new StringField('ALI_TRACK_NUMBER', [
                'title' => static::getLocMessage('TABLE_ORDER_ALI_TRACK_NUMBER'),
            ]),

            new IntegerField('PALLET_ID'),

            new Reference(
                'PALLET',
                PalletTable::class,
                Join::on('this.PALLET_ID', 'ref.ID')
            ),

            new StringField('RECEIVER_SOLUTION', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_SOLUTION'),
            ]),

            new StringField('RECEIVER_NAME', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_NAME'),
            ]),

            new StringField('RECEIVER_PHONE', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_PHONE'),
            ]),

            new StringField('RECEIVER_COUNTRY_CODE', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY_CODE'),
            ]),

            new StringField('RECEIVER_COUNTRY', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY'),
            ]),

            new StringField('RECEIVER_PROVINCE', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_PROVINCE'),
            ]),

            new StringField('RECEIVER_CITY', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_CITY'),
            ]),

            new StringField('RECEIVER_DISTRICT', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_DISTRICT'),
            ]),

            new StringField('RECEIVER_STREET', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_STREET'),
            ]),

            new StringField('RECEIVER_DETAIL_ADDRESS', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_DETAIL_ADDRESS'),
            ]),

            new StringField('RECEIVER_ZIP_CODE', [
                'title' => static::getLocMessage('TABLE_ORDER_RECEIVER_ZIP_CODE'),
                ]),
                
            new IntegerField('SENDER_ADDRESS_ID', [
                'title'    => static::getLocMessage('TABLE_ORDER_SENDER_ADDRESS_ID'),
                'required' => true,
            ]),

            new IntegerField('REFUND_ADDRESS_ID', [
                'title'    => static::getLocMessage('TABLE_ORDER_REFUND_ADDRESS_ID'),
                'required' => true,
            ]),

            new EnumField('SERVICE_VARIANT', [
                'title'    => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT'),
                'required' => true,
                'values'   => ['DOOR_PICKUP', 'SELF_SEND']
            ]),

            new StringField('SENDER_SOLUTION', [
                'title'    => static::getLocMessage('TABLE_ORDER_SENDER_SOLUTION'),
                'required' => true,
            ]),

            new TextField('PRODUCTS', [
                'title'      => static::getLocMessage('TABLE_ORDER_PRODUCTS'),
                'required'   => true,
                'serialized' => true,
            ]),

            new FloatField('DIMENSION_WIDTH', [
                'title' => static::getLocMessage('TABLE_ORDER_DIMENSION_WIDTH'),
            ]),

            new FloatField('DIMENSION_HEIGHT', [
                'title' => static::getLocMessage('TABLE_ORDER_DIMENSION_HEIGHT'),
            ]),

            new FloatField('DIMENSION_LENGTH', [
                'title' => static::getLocMessage('TABLE_ORDER_DIMENSION_LENGTH'),
            ]),

            new FloatField('DIMENSION_WEIGHT', [
                'title' => static::getLocMessage('TABLE_ORDER_DIMENSION_WEIGHT'),
            ]),

            new StringField('FILE_DOC', [
                'title' => static::getLocMessage('TABLE_ORDER_FILE_DOC'),
            ]),

            new StringField('FILE_LABEL', [
                'title' => static::getLocMessage('TABLE_ORDER_FILE_LABEL'),
            ]),
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getObjectClass()
    {
        return OrderEntity::class;
    }

    public static function findByOrder($orderId, $autoCreate = false)
    {
        $order = static::getList([
            'select' => ['*'],
            'filter' => ['ORDER_ID' => $orderId],
        ])->fetchObject();

        if (($order && 1 != 1) || !$autoCreate) {
            return $order;
        }

        $bxOrder = BxOrder::load($orderId);

        if (!$bxOrder) {
            return false;
        }

        $order = $order ?: new OrderEntity();
        $order->fillFromConfig();
        $order->setOrder($bxOrder);

        return $order;
    }
}

class OrderEntity extends EO_Order
{
    protected $pallet;

    /**
     * Undocumented function
     *
     * @return PalletEntity
     */
    public function getPallet()
    {
        if ($this['PALLET_ID']) {
            return $this->pallet = $this->pallet ?: PalletTable::getByPrimary($this['PALLET_ID'], ['select' => ['*']])->fetchObject();
        }

        return null;
    }

    /**
     * Undocumented function
     *
     * @param PalletEntity $pallet
     * @return self
     */
    public function setPallet(PalletEntity $pallet)
    {
        $this->pallet      = $pallet;
        $this['PALLET_ID'] = $pallet->getId();

        return $this;
    }

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
     * Проверяет можно ли выполнить отметку заказов
     *
     * @return boolean
     */
    public function isMarkable()
    {
        return $this->isCreated()
            && $this->getPallet() 
            && $this->getPallet()->isCreated()
        ;
    }


    /**
     * @param $orderId
     * @return self
     */
    public function setOrderId($orderId)
    {
        $order = BxOrder::load($orderId);

        if (!$order) {
            throw new ArgumentException('Order '. $orderId .' not found');
        }

        return $this->setOrder($order);
    }

    /**
     * Undocumented function
     *
     * @param [type] $order
     * @return void
     */
    public function setOrder(BxOrder $order)
    {
        $xmlId   = $order->getField('XML_ID');
        $matches = [];
        
        if (!preg_match_all('/^IPOL_ALI_([0-9]+)$/', $xmlId, $matches)) {
            throw new ArgumentException('Order '. $order->getId() .' doesn\'t is aliexpress order');
        }

        $this->sysSetValue('ORDER_ID', $order->getId());
        $this->sysSetValue('ALI_ORDER_ID', $matches[1][0]);
        $this->setOrderPrice( $order->getPrice() );
        $this->setOrderCurrency( $order->getCurrency() );

        return $this->fillFromOrder($order);
    }

    /**
     * Устаналивает список товаров
     *
     * @param \Bitrix\Sale\Basket|array $items
     * @return self
     */
    public function setProducts($items)
    {
        if ($items instanceof \Bitrix\Sale\Basket) {
            $values = $items;
            $items  = [];

            foreach($values as $item) {
                $props = $item->getPropertyCollection()->getPropertyValues();

                $items[] = [
                    'ID'               => $item->getField('ID'),
                    'XML_ID'           => isset($props['ALI_ID']) ? $props['ALI_ID']['VALUE'] : str_replace('IPOL_ALI_', '', $item->getField('PRODUCT_XML_ID')),
                    'SKU'              => isset($props['ALI_SKU']) ? $props['ALI_SKU']['VALUE'] : '',
                    'NAME'             => $item->getField('NAME'),
                    'NAME_EN'          => isset($props['ALI_NAME']) ? $props['ALI_NAME']['VALUE'] : '',
                    'QUANTITY'         => $item->getField('QUANTITY'),
                    'PRICE'            => $item->getField('PRICE'),
                    'PRICE_ALL'        => $item->getField('QUANTITY') * $item->getField('PRICE'),
                    'CURRENCY'         => $item->getField('CURRENCY'),
                    'CATEGORY'         => '',
                    'DIMENSIONS'       => $item->getField('DIMENSIONS'),
                    'WEIGHT'           => $item->getField('WEIGHT'),
                ];
            }
        }

        $dimensions = Utils::calcShipmentDimensions($items);

        $this->setDimensionWidth($dimensions['WIDTH']);
        $this->setDimensionHeight($dimensions['HEIGHT']);
        $this->setDimensionLength($dimensions['LENGTH']);
        $this->setDimensionWeight($dimensions['WEIGHT']);
        
        $this->sysSetValue('PRODUCTS', serialize($items));

        return $this;
    }

    /**
     * Возвращает список товаров
     *
     * @return array
     */
    public function getProducts()
    {
        return unserialize($this->sysGetValue('PRODUCTS')) ?: [];
    }

    /**
     * Заполняет поля на основе данных из настроек модуля
     *
     * @return self
     */
    public function fillFromConfig()
    {
        $this->set('SERVICE_VARIANT', $serviceVariant = Option::get(IPOL_ALI_MODULE, 'SERVICE_VARIANT'));
        $this->set('SENDER_ADDRESS_ID', Option::get(IPOL_ALI_MODULE, $serviceVariant == 'DOOR_PICKUP' ? 'SENDER_ADDRESS_ID' : 'PICKUP_ADDRESS_ID'));
        $this->set('REFUND_ADDRESS_ID', Option::get(IPOL_ALI_MODULE, 'REFUND_ADDRESS_ID'));

        return $this;
    }

    /**
     * Заполняет сущность на основе битриксового заказа
     *
     * @param [type] $order
     * @return self
     */
    public function fillFromOrder(BxOrder $order)
    {
        $this->setProps($order->getPropertyCollection());
        $this->setProducts($order->getBasket());

        return $this;
    }

    /**
     * Заполняет поля на основе свойств заказа
     *
     * @param PropertyValueCollection $props
     * @return void
     */
    public function setProps(PropertyValueCollection $props)
    {
        $values = array_column($props->getArray()['properties'], null, 'ID');
        $config = [
            'ORDER_FIELD_LAST_NAME'    => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_LAST_NAME'),
            'ORDER_FIELD_FIRST_NAME'   => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_FIRST_NAME'),
            'ORDER_FIELD_PHONE'        => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_PHONE'),
            'ORDER_FIELD_MOBILE'       => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_MOBILE'),
            'ORDER_FIELD_COUNTRY_CODE' => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_CITY'),
            'ORDER_FIELD_PROVINCE'     => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_CITY'),
            'ORDER_FIELD_CITY'         => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_CITY'),
            'ORDER_FIELD_ADDRESS1'     => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_ADDRESS1'),
            'ORDER_FIELD_ADDRESS2'     => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_ADDRESS2'),
            'ORDER_FIELD_ZIP'          => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_ZIP'),
        ];
        
        $params = [
            'RECEIVER_NAME'           => ['ORDER_FIELD_LAST_NAME', 'ORDER_FIELD_FIRST_NAME'],
            'RECEIVER_PHONE'          => ['ORDER_FIELD_PHONE', 'ORDER_FIELD_MOBILE'],
            // 'RECEIVER_MOBILE'         => Option::get(IPOL_ALI_MODULE, 'ORDER_FIELD_MOBILE')
            'RECEIVER_COUNTRY_CODE'   => ['ORDER_FIELD_COUNTRY_CODE'],
            'RECEIVER_COUNTRY'        => [],
            'RECEIVER_PROVINCE'       => ['ORDER_FIELD_PROVINCE'],
            'RECEIVER_CITY'           => ['ORDER_FIELD_CITY'],
            'RECEIVER_STREET'         => [],
            'RECEIVER_DETAIL_ADDRESS' => ['ORDER_FIELD_ADDRESS1', 'ORDER_FIELD_ADDRESS2'],
            'RECEIVER_ZIP_CODE'       => ['ORDER_FIELD_ZIP'],
        ];

        foreach($params as $field => $propCodes) {
            $value = [];

            foreach ($propCodes as $propCode) {
                $propId    = $config[$propCode];
                $propValue = $values[$propId] ? reset($values[$propId]['VALUE']) : '';

                
                if (count($f = array_intersect($config, [$propId])) > 1) {
                    $index     = array_search($propCode, array_keys(array_intersect($config, [$propId])));
                    $propValue = explode(',', $propValue);
                    $index     = isset($propValue[$index]) ? $index : end(array_keys($propValue));
                    $propValue = trim($propValue[ $index ]);
                }

                $value[] = $propValue;
            }

            $params[$field] = $value;
        }

        foreach ($params as $field => $value) {
            $this->set($field, implode(', ', array_filter($value)));
        }
    }

    /**
     * Возвращает модель для работы с API
     *
     * @return Ipol\Aliexpress\Api\Model\Order
     */
    public function aliexpress()
    {
        return new ApiModel($this);
    }

    /**
     * Отмечает заказ отправленным
     *
     * @return Bitrix\Main\Result
     */
    public function markSended()
    {
        if (!$this->aliexpress()->isCreated()) {
            throw new \LogicException('parcel is not created');
        }

        return $this->aliexpress()->markSended();
    }
}
