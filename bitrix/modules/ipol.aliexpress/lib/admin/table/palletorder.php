<?php
namespace Ipol\Aliexpress\Admin\Table;

use Ipol\Aliexpress\DB\OrderTable;

OrderTable::loadLocMessages();

class PalletOrder extends Order
{
    protected $pallet = null;

    public function __construct($pallet)
    {
        $this->pallet = $pallet;
    }

    /**
     * @inheritDoc
     * 
     * @return array
     */
    public function getDefaultButtons()
    {
        if ($this->pallet->isCreated()) {
            return [
                [
                    'CAPTION' => 'TABLE_PALLET_BUTTON_MARK_SENDED',
                    'TYPE'    => 'button',
                    'ONCLICK' => '
                        document.location.href = \'ipol.aliexpress_transfer_sheet_edit.php?ID='. $values['ID'] .'&action=mark-sended\'
    
                        return false;
                    ',
                ]
            ];
        }

        return [
            [
                'CAPTION' => 'TABLE_ORDER_BUTTON_ADD',
                'TYPE'    => 'button',
                'ONCLICK' => '
                    // var serviceVariant = BX(\'IPOL_ALI_PALLET_SERVICE_VARIANT\').value; 
                    // var dropPoint = BX(\'IPOL_ALI_PALLET_DROP_POINT\') ? BX(\'IPOL_ALI_PALLET_DROP_POINT\').value : \'\';

                    var popup = new BX.CAdminDialog({
                        \'content_url\':\'ipol.aliexpress_pallet_order_find.php?bxpublic=Y\',
                        \'width\':\'800\',
                        \'height\':\'400\'
                    });

                    BX.addCustomEvent(popup, \'onWindowClose\',function(){  
                        BX(\'IPOL_ALI_PALLET\').submit();
                    });

                    popup.Show();

                    return false;
                ',
            ],
        ];
    }

    /**
     * @inheritDoc
     *
     * @return []
     */
    public function getDefaultFilterValues()
    {
        return [
            'ID' => array_merge([0], $this->pallet['ORDER_IDS']),
        ];
    }

    /**
     * Форматирует одну строку результата в формат пригодный для компонента таблицы
     * 
     * @param array $item
     * 
     * @return array
     */
    protected function getRow($item)
    {
        $ret = parent::getRow($item);

        return array_replace_recursive($ret, [
            'columns' => [
                'SERVICE_VARIANT' => static::getLocMessage('TABLE_PALLET_SERVICE_VARIANT_'. $item['SERVICE_VARIANT']),
            ],
        ]);
    }

    protected function getDefaultRowActions()
    {   
        $ret = parent::getDefaultRowActions();

        if (!$this->pallet->aliexpress()->isCreated()) {
            $ret = array_merge($ret, [
                [
                    'ICONCLASS' => 'delete',
                    'TEXT'      => 'TABLE_ORDER_BUTTON_DELETE',
                    'ONCLICK'   => '
                        var ids    = BX(\'IPOL_ALI_PALLET_ORDER_IDS\').value.split(\',\');
                        var newIds = [];

                        for (var i in ids) {
                            if (ids[i] != \'#ID#\') {
                                newIds.push(ids[i]);
                            }
                        }

                        BX(\'IPOL_ALI_PALLET_ORDER_IDS\').value = newIds.join(\',\');
                        BX(\'IPOL_ALI_PALLET\').submit();
                    ',
                ]
            ]);
        }

        return $ret;
    }
}