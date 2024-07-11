<?php
namespace Ipol\Aliexpress\Admin\Table;

use Ipol\Aliexpress\DB\OrderTable;

OrderTable::loadLocMessages();

class OrderProducts extends Type\Raw
{
    /**
     * @var array
     */
    protected $defaultColumns = [
        [
            'id'         => 'ID_TXT',
            'name'       => 'TABLE_ORDER_PRODUCT_ID',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],

        [
            'id'         => 'NAME',
            'name'       => 'TABLE_ORDER_PRODUCT_NAME',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],

        [
            'id'         => 'QUANTITY',
            'name'       => 'TABLE_ORDER_PRODUCT_QUANTITY',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],
        
        [
            'id'         => 'PRICE',
            'name'       => 'TABLE_ORDER_PRODUCT_PRICE_UNIT',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],
        
        [
            'id'         => 'PRICE_ALL',
            'name'       => 'TABLE_ORDER_PRODUCT_PRICE_ALL',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],
        
        [
            'id'         => 'CURRENCY',
            'name'       => 'TABLE_ORDER_PRODUCT_CURRENCY',
            'sort'       => false,
            'default'    => true,
            'editable'   => false,
            'filterable' => false,
        ],
    ];
}