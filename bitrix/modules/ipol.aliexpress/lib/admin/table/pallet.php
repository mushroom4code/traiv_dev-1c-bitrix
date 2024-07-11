<?php
namespace Ipol\Aliexpress\Admin\Table;

use Bitrix\Main\Localization\Loc;
use Ipol\Aliexpress\DB\PalletTable;

PalletTable::loadLocMessages();

class Pallet extends Type\DB
{
    protected $textTableName  = 'TABLE_PALLET_NAME';

    /**
     * @var string
     */
    protected $fetchMode = 'object';

    /**
     * @var array
     */
    protected $select = [
        '*', 'ORDERS'
    ];

    /**
     * @var array
     */
    protected $defaultButtons = [
        [
            'CAPTION' => 'TABLE_PALLET_BUTTON_CREATE',
            'TYPE'    => 'button',
            'ONCLICK' => 'document.location.href = "ipol.aliexpress_transfer_sheet_edit.php";',
        ]
    ];

    /**
     * @var array
     */
    protected $defaultColumns = [
        [
            'id'         => 'ID',
            'name'       => 'TABLE_PALLET_ID',
            'sort'       => 'ID',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],

        [
            'id'         => 'ORDER_DATE',
            'name'       => 'TABLE_PALLET_ORDER_DATE',
            'sort'       => 'ORDER_DATE',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],

        // [
        //     'id'         => 'SERVICE_VARIANT',
        //     'name'       => 'TABLE_PALLET_SERVICE_VARIANT',
        //     'sort'       => 'SERVICE_VARIANT',
        //     'default'    => true,
        //     'editable'   => false,
        //     'filterable' => true,
        // ],
        
        [
            'id'         => 'ORDERS',
            'name'       => 'TABLE_PALLET_ORDERS',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],
    ];

    /**
     * @var array
     */
    protected $defaultRowActions = [
        'EDIT' => [
            'ICONCLASS' => 'edit',
            'TEXT'      => 'TABLE_PALLET_BUTTON_EDIT',
            'ONCLICK'   => 'document.location.href="ipol.aliexpress_transfer_sheet_edit.php?ID=#ID#"',
        ],
        
        'MARK_SENDED' => [
            'ICONCLASS' => 'edit',
            'TEXT'      => 'TABLE_PALLET_BUTTON_MARK_SENDED',
            'ONCLICK'   => 'document.location.href="ipol.aliexpress_transfer_sheet_edit.php?ID=#ID#&action=mark-sended"',
        ],
    ];
    
    /**
     * Возвращает название ORM маппера для выборки данных
     *
     * @return Bitrix\Main\ORM\Data\DataManager
     */
    public function getDataMapper()
    {
        return PalletTable::class;
    }

    /**
     * @inheritDoc
     *
     * @param ArrayAccess $item
     * @return array
     */
    protected function getRow($item)
    {
        $data = parent::getRow($item);
        $data['columns']['ORDERS'] = implode('<br>', array_map(function($order) {
            return $order['XML_ID'] .'Заказ #'. $order['ORDER_ID'];
        }, iterator_to_array($item['ORDERS'])));

        return $data;
    }

    /**
     * @inheritDoc
     * 
     * @param ArrayAccess $item
     * @return array
     */
    protected function getRowActions($item)
    {
        $actions = parent::getRowActions($item);

        if (empty($item->isCreated())) {
            unset($actions['MARK_SENDED']);
        }

        return array_values($actions);
    }
}