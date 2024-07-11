<?php
namespace Ipol\Aliexpress\Admin\Table;

use Ipol\Aliexpress\DB\OrderTable;

OrderTable::loadLocMessages();

class Order extends Type\DB
{
    protected $textTableName  = 'TABLE_ORDER_NAME';

    /**
     * @var string
     */
    protected $fetchMode = 'object';


    /**
     * @var array
     */
    protected $defaultColumns = [
        [
            'id'         => 'ID',
            'name'       => 'TABLE_ORDER_ID',
            'sort'       => 'ID',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],

        [
            'id'         => 'ORDER_ID',
            'name'       => 'TABLE_ORDER_ORDER_ID',
            'sort'       => 'ORDER_DATE',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],
        
        [
            'id'         => 'ALI_LP_NUMBER',
            'name'       => 'TABLE_ORDER_ORDER_NUM',
            'sort'       => 'ORDER_DATE',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],

        [
            'id'         => 'SERVICE_VARIANT',
            'name'       => 'TABLE_ORDER_SERVICE_VARIANT',
            'sort'       => 'SERVICE_VARIANT',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],
        
        [
            'id'         => 'SENDER_SOLUTION',
            'name'       => 'TABLE_ORDER_SENDER_SOLUTION',
            'sort'       => 'SENDER_SOLUTION',
            'default'    => true,
            'editable'   => false,
            'filterable' => true,
        ],
    ];

    /**
     * @var array
     */
    protected $defaultRowActions = [
        'EDIT' => [
            'ICONCLASS' => 'edit',
            'TEXT'      => 'TABLE_ORDER_BUTTON_EDIT',
            'ONCLICK'   => 'window.open("ipol.aliexpress_order_edit.php?ID=#ID#", "_blank")',
        ],

        'DOWNLOAD_LABEL' => [
            'ICONCLASS' => 'download',
            'TEXT'      => 'TABLE_ORDER_BUTTON_DOWNLOAD_LABELS',
            'ONCLICK'   => 'window.open("ipol.aliexpress_order_edit.php?ID=#ID#&action=print-label&download=Y", "_blank")',
        ],
        
        'MARK_SENDED' => [
            'ICONCLASS' => 'edit',
            'TEXT'      => 'TABLE_ORDER_BUTTON_MARK_SENDED',
            'ONCLICK'   => 'window.open("ipol.aliexpress_order_edit.php?ID=#ID#&action=mark-sended", "_blank")',
        ],
    ];

    /**
     * Возвращает список контролов таблицы
     *
     * @return []
     */
    public function getControls()
    {
        return [
            [
                'ID'   => 'download-labels',
                'TYPE' => 'BUTTON',
                'NAME' => 'download-labels',
                'TEXT' => 'Скачать этикетки',
                'ONCHANGE' => [
                    [
                        'ACTION' => 'CALLBACK',
                        'DATA'   => [
                            [
                                'JS' => '
                                    var grid = BX.Main.gridManager.getInstanceById("'. $this->getId() .'");
                                    var ids  = grid.getRows().getSelectedIds();

                                    if (ids.length > 0) {
                                        window.open("ipol.aliexpress_download.php?IDS="+ ids.join(",") +"&TYPES=label", "_blank");
                                    }
                                ',
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
    
    /**
     * Возвращает название ORM маппера для выборки данных
     *
     * @return Bitrix\Main\ORM\Data\DataManager
     */
    public function getDataMapper()
    {
        return OrderTable::class;
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
                'SERVICE_VARIANT' => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT_'. $item['SERVICE_VARIANT']),
            ],
        ]);
    }

    /**
     * Возвращает список действия для строки
     *
     * @param array $item
     * 
     * @return array
     */
    protected function getRowActions($item)
    {
        $ret = parent::getRowActions($item);

        if (!$item->isCreated()) {
            unset($ret['DOWNLOAD_LABEL']);
        }

        if (!$item->isMarkable()) {
            unset($ret['MARK_SENDED']);
        }

        return array_values($ret);
    }
}