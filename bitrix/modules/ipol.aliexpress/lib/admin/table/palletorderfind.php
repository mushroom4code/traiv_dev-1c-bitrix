<?php
namespace Ipol\Aliexpress\Admin\Table;

use Ipol\Aliexpress\DB\OrderTable;

OrderTable::loadLocMessages();

class PalletOrderFind extends Order
{
    /**
     * @var array
     */
    protected $defaultRowActions = [
        [
            'ICONCLASS' => 'add',
            'TEXT'      => 'TABLE_ORDER_BUTTON_SELECT',
            'ONCLICK'   => '
                var ids = BX(\'IPOL_ALI_PALLET_ORDER_IDS\').value.split(\',\'); 
                ids.push(\'#ID#\');
                BX(\'IPOL_ALI_PALLET_ORDER_IDS\').value = ids.join(\',\');
            ',
        ],
    ];

    /**
     * @var array
     */
    protected $defaultButtons = [];
}