<?php
namespace Ipol\Aliexpress\Admin\Form\Order;

use Bitrix\Main\Application;
use Ipol\Aliexpress\Api\Client;
use Ipol\Aliexpress\Admin\Form\Base;
use Ipol\Aliexpress\DB\OrderTable;

OrderTable::loadLocMessages();

class Edit extends Base
{
    /**
	 * @var string
	 */
    protected $name = 'IPOL_ALI_ORDER';
    
    /**
	 * Возвращает имена опций
	 * 
	 * @return array
	 */
	public function getFieldNames($items = null)
	{
        $ret = [];

        foreach (OrderTable::getMap() as $field) {
            $ret[] = $field->getName();
        }

        return $ret;
    }

    /**
     * @inheritDoc
     * 
     * @return array
     */
    public function getFields()
    {
        return $this->fields = $this->fields ?: [
            [
                'DIV'      => 'FORM_ORDER_TAB_COMMON',
                'TAB'      => static::getLocMessage('FORM_ORDER_TAB_COMMON'),
                'ICON'     => 'support_settings',
                'TITLE'    => static::getLocMessage('FORM_ORDER_TAB_COMMON_TITLE'),
                'HELP'     => static::getLocMessage('FORM_ORDER_TAB_COMMON_HELP'),
                'OPTIONS'  => [],
                'CONTROLS' => function() {
                    $values = $this->getEntity();

                    return [
                        'DIMENSION_INFO' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_DIMENSION_INFO'),
                            'TYPE'  => 'HEADER',
                        ],
    
                        'DIMENSION_WIDTH' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_DIMENSION_WIDTH'),
                            'HELP'  => static::getLocMessage('TABLE_ORDER_DIMENSION_WIDTH_HELP'),
                            'TYPE'  => 'STRING',
                            'ATTRS' => [
                                'onchange' => '$(this.form).submit()',
                                'disabled' => !empty($values['ALI_PARCEL_ID']),
                            ],
                        ],
    
                        'DIMENSION_HEIGHT' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_DIMENSION_HEIGHT'),
                            'HELP'  => static::getLocMessage('TABLE_ORDER_DIMENSION_HEIGHT_HELP'),
                            'TYPE'  => 'STRING',
                            'ATTRS' => [
                                'onchange' => '$(this.form).submit()',
                                'disabled' => !empty($values['ALI_PARCEL_ID']),
                            ],
                        ],
    
                        'DIMENSION_LENGTH' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_DIMENSION_LENGTH'),
                            'HELP'  => static::getLocMessage('TABLE_ORDER_DIMENSION_LENGTH_HELP'),
                            'TYPE'  => 'STRING',
                            'ATTRS' => [
                                'onchange' => '$(this.form).submit()',
                                'disabled' => !empty($values['ALI_PARCEL_ID']),
                            ],
                        ],
    
                        'DIMENSION_WEIGHT' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_DIMENSION_WEIGHT'),
                            'HELP'  => static::getLocMessage('TABLE_ORDER_DIMENSION_WEIGHT_HELP'),
                            'TYPE'  => 'STRING',
                            'ATTRS' => [
                                'onchange' => '$(this.form).submit()',
                                'disabled' => !empty($values['ALI_PARCEL_ID']),
                            ],
                        ],
                    ];
                },
            ],
            
            // [
            //     'DIV'      => 'FORM_ORDER_TAB_RECEIVER',
            //     'TAB'      => static::getLocMessage('FORM_ORDER_TAB_RECEIVER'),
            //     'ICON'     => 'support_settings',
            //     'TITLE'    => static::getLocMessage('FORM_ORDER_TAB_RECEIVER_TITLE'),
            //     'HELP'     => static::getLocMessage('FORM_ORDER_TAB_RECEIVER_HELP'),
            //     'OPTIONS'  => [],
            //     'CONTROLS' => function() {
            //         $values = $this->getEntity();

            //         return [
            //             'RECEIVER_SOLUTION' => [
            //                 'TITLE' => static::getLocMessage('TABLE_ORDER_RECEIVER_SOLUTION'),
            //                 'HELP'  => static::getLocMessage('TABLE_ORDER_RECEIVER_SOLUTION_HELP'),
            //                 'TYPE'  => 'SELECT',
            //                 'ITEMS' => [$this, 'getReceiverSolutionList'],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_ORDER_SOLUTION_ERROR_EMPTY'),
            //                 ],
            //                 'ATTRS' => [
            //                     'onchange' => '$(this.form).submit();',
            //                     'disabled' => !empty($values['ALI_PARCEL_ID']),
            //                 ]
            //             ],
    
            //             // 'RECEIVER_NAME' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_NAME'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_NAME_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
                        
            //             // 'RECEIVER_PHONE' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_PHONE'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_PHONE_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
                        
            //             // 'ADDRESS_INFO' => [
            //             //     'TITLE' => static::getLocMessage('TABLE_ORDER_RECEIVER_ADDRESS_INFO'),
            //             //     'TYPE'  => 'HEADER',
            //             // ],
    
            //             // 'RECEIVER_COUNTRY_CODE' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY_CODE'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY_CODE_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_COUNTRY' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_COUNTRY_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_PROVINCE' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_PROVINCE'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_PROVINCE_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_CITY' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_CITY'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_CITY_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_DISTRICT' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_DISTRICT'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_DISTRICT_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_STREET' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_STREET'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_STREET_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_DETAIL_ADDRESS' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_DETAIL_ADDRESS'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_DETAIL_ADDRESS_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
    
            //             // 'RECEIVER_ZIP_CODE' => [
            //             //     'TITLE'      => static::getLocMessage('TABLE_ORDER_RECEIVER_ZIP_CODE'),
            //             //     'TYPE'       => 'STRING',
            //             //     'HELP'       => static::getLocMessage('TABLE_ORDER_RECEIVER_ZIP_CODE_HELP'),
            //             //     'ATTRS'      => [
            //             //         'disabled' => !empty($values['ALI_PARCEL_ID']),
            //             //     ]
            //             // ],
            //         ];
            //     },
            // ],
            
            // [
			// 	'DIV'      => 'FORM_ORDER_TAB_SENDER',
			// 	'TAB'      => static::getLocMessage('FORM_ORDER_TAB_SENDER'),
			// 	'ICON'     => 'support_settings',
			// 	'TITLE'    => static::getLocMessage('FORM_ORDER_TAB_SENDER_TITLE'),
			// 	'HELP'     => static::getLocMessage('FORM_ORDER_TAB_SENDER_HELP'),
			// 	'OPTIONS'  => [],
            //     'CONTROLS' => function() {
            //         $values = $this->getEntity();
                    
            //         return [
            //             'SERVICE_VARIANT' => [
            //                 'TITLE' => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT'),
            //                 'HELP'  => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT_HELP'),
            //                 'TYPE'  => 'SELECT',
            //                 'ITEMS' => [
            //                     'DOOR_PICKUP' => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT_DOOR_PICKUP'),
            //                     'SELF_SEND'   => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT_SELF_SEND'),
            //                 ],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_ORDER_SERVICE_VARIANT_ERROR_EMPTY'),
            //                 ],
            //                 'ATTRS' => [
            //                     'onchange' => '$(this.form).submit()',
            //                     'disabled' => !empty($values['ALI_PARCEL_ID']),
            //                 ],
            //             ],
    
            //             'SENDER_ADDRESS_ID' => [
            //                 'TITLE' => static::getLocMessage('TABLE_ORDER_SENDER_ADDRESS_ID'),
            //                 'HELP'  => static::getLocMessage('TABLE_ORDER_SENDER_ADDRESS_ID_HELP'),
            //                 'TYPE'  => 'SELECT',
            //                 'ITEMS' => [$this, 'getSenderAddressList'],   
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_ORDER_SENDER_ADDRESS_ID_ERROR_EMPTY')
            //                 ],
            //                 'ATTRS' => [
            //                     'onchange' => '$(this.form).submit()',
            //                     'disabled' => !empty($values['ALI_PARCEL_ID']),
            //                 ],
            //             ],
    
            //             'SENDER_ADDRESS_TEXT' => [
            //                 'TITLE' => '',
            //                 'TYPE'  => function() {
            //                     $address = $this->getSenderAddress();
    
            //                     if (!$address) {
            //                         return '';
            //                     }
    
            //                     return sprintf(
            //                         '%s, %s. Тел.: %. Email: %s',
            //                         $address['country'],
            //                         $address['street_address'],
            //                         $address['phone'] ?: 'не указан',
            //                         $address['email'] ?: 'не указан'
            //                     );
            //                 }
            //             ],
    
            //             'REFUND_ADDRESS_ID' => [
            //                 'TITLE' => static::getLocMessage('TABLE_ORDER_REFUND_ADDRESS_ID'),
            //                 'HELP'  => static::getLocMessage('TABLE_ORDER_REFUND_ADDRESS_ID_HELP'),
            //                 'TYPE'  => 'SELECT',
            //                 'ITEMS' => [$this, 'getRefundAddressList'],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_ORDER_REFUND_ADDRESS_ID_ERROR_EMPTY')
            //                 ],
            //                 'ATTRS' => [
            //                     'onchange' => '$(this.form).submit()',
            //                     'disabled' => !empty($values['ALI_PARCEL_ID']),
            //                 ],
            //             ],
    
            //             'REFUND_ADDRESS_TEXT' => [
            //                 'TITLE' => '',
            //                 'TYPE'  => function() {
            //                     $address = $this->getRefundAddress();
    
            //                     if (!$address) {
            //                         return '';
            //                     }
    
            //                     return sprintf(
            //                         '%s, %s. Тел.: %. Email: %s',
            //                         $address['country'],
            //                         $address['street_address'],
            //                         $address['phone'] ?: 'не указан',
            //                         $address['email'] ?: 'не указан'
            //                     );
            //                 }
            //             ],
    
            //             'SENDER_SOLUTION' => [
            //                 'TITLE' => static::getLocMessage('TABLE_ORDER_SENDER_SOLUTION'),
            //                 'HELP'  => static::getLocMessage('TABLE_ORDER_SENDER_SOLUTION_HELP'),
            //                 'TYPE'  => 'SELECT',
            //                 'ITEMS' => [$this, 'getSenderSolutionList'],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_ORDER_SENDER_SOLUTION_ERROR_EMPTY'),
            //                 ],
            //                 'ATTRS' => [
            //                     'onchange' => '$(this.form).submit()',
            //                     'disabled' => !empty($values['ALI_PARCEL_ID']),
            //                 ]
            //             ],
    
            //             'SENDER_SOLUTION_INFO' => [
            //                 'TITLE' => '',
            //                 'TYPE'  => function() {
            //                     $solution = $this->getSenderSolution();
    
            //                     if (!$solution) {
            //                         return '';
            //                     }
    
            //                     return '<span style="font-size: 10px; color: #2e2e2e">'. sprintf(
            //                         '%s<br>тел.: %s (%s)<br>%s',
            //                         $solution['address'],
            //                         $solution['contact_telephone'],
            //                         $solution['contact_name'],
            //                         '' // $solution['features']['appointment_process']
            //                     ) .'</span>';
            //                 }
            //             ],
            //         ];
            //     },
            // ],       

            [
                'DIV'      => 'FORM_ORDER_TAB_PRODUCTS',
                'TAB'      => static::getLocMessage('FORM_ORDER_TAB_PRODUCTS'),
                'ICON'     => 'support_settings',
                'TITLE'    => static::getLocMessage('FORM_ORDER_TAB_PRODUCTS_TITLE'),
                'HELP'     => static::getLocMessage('FORM_ORDER_TAB_PRODUCTS_HELP'),
                'OPTIONS'  => [],
                'CONTROLS' => [
                    'PRODUCTS' => [
                        'SHOW_CAPTION' => 'N',
                        'TYPE'         => function() {
                            $values = $this->getEntity();
                            $items  = [];

                            foreach ($values['PRODUCTS'] as $index => $product) {
                                $items[] = array_merge($product, [
                                    'ID'     => $product['ID'],
                                    'ID_TXT' => ''
                                        . $product['ID'] .'<br>'
                                        . '('. $product['XML_ID'] .')'

                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][ID]" value="'. $product['ID'] .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][XML_ID]" value="'. $product['XML_ID'] .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][SKU]" value="'. htmlspecialchars($product['SKU']) .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][DIMENSIONS][WIDTH]" value="'. $product['DIMENSIONS']['WIDTH'] .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][DIMENSIONS][HEIGHT]" value="'. $product['DIMENSIONS']['HEIGHT'] .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][DIMENSIONS][LENGTH]" value="'. $product['DIMENSIONS']['LENGTH'] .'">'
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][WEIGHT]" value="'. $product['WEIGHT'] .'">'
                                    ,
                                    'NAME' => ''
                                        .'<input type="text" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][NAME]" value="'. $product['NAME'] .'" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_NAME') .'" '. ($values['ALI_PARCEL_ID'] ? 'disabled="disabled"' : '') .'>'
                                        .'<br>'
                                        .'<input type="text" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][NAME_EN]" value="'. $product['NAME_EN'] .'" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_NAME_EN') .'" '. ($values['ALI_PARCEL_ID'] ? 'disabled="disabled"' : '') .'>',
                                    'QUANTITY'  => ''
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][QUANTITY]" value="'. $product['QUANTITY'] .'" size="2" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_QUANTITY') .'">'
                                        . $product['QUANTITY']
                                    ,
                                    'PRICE'     => ''
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][PRICE]" value="'. $product['PRICE'] .'" size="5" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_PRICE') .'">'
                                        . $product['PRICE']
                                    ,
                                    'PRICE_ALL' => ''
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][PRICE_ALL]" value="'. $product['PRICE_ALL'] .'" size="5" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_PRICE_ALL') .'">'
                                        . $product['PRICE_ALL']
                                    ,
                                    'CURRENCY' => ''
                                        . '<input type="hidden" name="IPOL_ALI_ORDER[PRODUCTS]['. $index .'][CURRENCY]" value="'. $product['CURRENCY'] .'" size="5" placeholder="'. static::getLocMessage('TABLE_ORDER_PRODUCT_CURRENCY') .'">'
                                        . $product['CURRENCY']
                                    ,
                                ]);
                            }

                            $table = new \Ipol\Aliexpress\Admin\Table\OrderProducts($items);

                            return $table->render([
                                'SHOW_TITLE'   => 'N',
                                'SHOW_FILTER'  => 'N',
                                'SHOW_BUTTONS' => 'N',
                                'TABLE'        => [
                                    'SHOW_SELECTED_COUNTER' => false,
                                    'SHOW_PAGINATION'       => false,
                                    'SHOW_PAGESIZE'         => false,
                                    'SHOW_ACTION_PANEL'     => false,
                                ]
                            ]);
                        }
                    ]
                ],
            ],

            [
                'DIV'      => 'FORM_ORDER_TAB_DOCUMENTS',
                'TAB'      => static::getLocMessage('FORM_ORDER_TAB_DOCUMENTS'),
                'ICON'     => 'support_settings',
                'TITLE'    => static::getLocMessage('FORM_ORDER_TAB_DOCUMENTS_TITLE'),
                'HELP'     => '',
                'OPTIONS'  => [],
                'CONTROLS' => function() {
                    $values = $this->getEntity();

                    if (empty($values['ALI_PARCEL_ID'])) {
                        return [
                            'FILE_NOTICE' => [
                                'SHOW_CAPTION' => 'N',
                                'HELP'         => static::getLocMessage('FORM_ORDER_TAB_DOCUMENTS_HELP'),
                                'TYPE'         => 'COMMENT',
                            ]
                        ];
                    }

                    return [
                        // 'FILE_DOC' => [
                        //     'TITLE' => static::getLocMessage('TABLE_ORDER_FILE_DOC'),
                        //     'TYPE'  => function() use ($values) {
                        //         if (!empty($values['FILE_DOC'])) {
                        //             return '<a href="'. $values['FILE_DOC'] .'" target="_blank">'. static::getLocMessage('TABLE_ORDER_DOWNLOAD_FILE') .'</a>';
                        //         }

                        //         return '<button name="print-doc" type="submit">'. static::getLocMessage('TABLE_ORDER_GET_FILE') .'</button>';
                        //     },
                        // ],

                        'FILE_LABEL' => [
                            'TITLE' => static::getLocMessage('TABLE_ORDER_FILE_LABEL'),
                            'TYPE'  => function() use ($values) {
                                if (!empty($values['FILE_LABEL'])) {
                                    return '<a href="'. $values['FILE_LABEL'] .'" target="_blank">'. static::getLocMessage('TABLE_ORDER_DOWNLOAD_FILE') .'</a>';
                                }

                                return '<button name="print-label" type="submit">'. static::getLocMessage('TABLE_ORDER_GET_FILE') .'</button>';
                            },
                        ]
                    ];
                }
            ],
        ];
    }

    /**
     * @inheritDoc
     *
     * @return array
     */
    public function getButtons()
    {
        $values = $this->getEntity();

        if (empty($values['ALI_PARCEL_ID'])) {
            return [
                'buttons' => [
                    '.btnSave',
                    '.btnClose'
                ]
            ];
        }

        $ret = [
            'buttons' => [
                '.btnClose'
            ]
        ];

        if ($values->getPallet() 
            && $values->getPallet()->aliexpress()->isCreated()
        ) {
            array_unshift($ret['buttons'], \CUtil::PhpToJsObject([
                'title'   => 'Отметить отправленным',
                'id'      => 'mark-sended',
                'name'    => 'mark-sended',
                'onclick' => 'aliMarkSended'
            ]));
            
        }

        return $ret;
    }

    // /**
    //  * Возвращает список адресов отправки
    //  *
    //  * @return array
    //  */
    // public function getSenderAddressList()
    // {
    //     $values         = $this->getEntity();
    //     $serviceVariant = $values['SERVICE_VARIANT'] ?: 'DOOR_PICKUP';
    //     $items          = [];

    //     if ($serviceVariant == 'SELF_SEND') {
    //         $items = Client::getInstance()->getService('logistic')->getPickUpSellerAddresses();
    //     }

    //     if (empty($items)) {
    //         $items = Client::getInstance()->getService('logistic')->getSenderSellerAddresses();
    //     }

    //     return array_map(function($item) {
    //         return [
    //             'ID'   => $item['address_id'],
    //             'NAME' => $item['name'],
    //             'DATA' => $item,
    //         ];
    //     }, $items);
    // }

    // /**
    //  * Возвращает адрес отправки
    //  * 
    //  * @return array|false
    //  */
    // public function getSenderAddress()
    // {
    //     $values    = $this->getEntity();
    //     $addresses = $this->getSenderAddressList();
    //     $address   = false;

    //     if (!$addresses) {
    //         return $address;
    //     }

    //     if ($values['SENDER_ADDRESS_ID']) {
    //         $f = array_filter($addresses, function($item) use ($values) {
    //             return $item['ID'] == $values['SENDER_ADDRESS_ID'];
    //         });

    //         $address = reset($f);
    //     } 
        
    //     if (empty($address)) {
    //         $address = reset($addresses);
    //     }

    //     return $address['DATA'];
    // }

    // /**
    //  * Возвращает адреса возврата
    //  *
    //  * @return array
    //  */
    // public function getRefundAddressList()
    // {
    //     $items = Client::getInstance()->getService('logistic')->getRefundSellerAddresses();

    //     return array_map(function($item) {
    //         return [
    //             'ID'   => $item['address_id'],
    //             'NAME' => $item['name'],
    //             'DATA' => $item,
    //         ];
    //     }, $items);
    // }
    
    // /**
    //  * Возвращает адрес возврата
    //  * 
    //  * @return array|false
    //  */
    // public function getRefundAddress()
    // {
    //     $values    = $this->getEntity();
    //     $addresses = $this->getRefundAddressList();
    //     $address   = false;

    //     if (empty($addresses)) {
    //         return false;
    //     }

    //     if ($values['REFUND_ADDRESS_ID']) {
    //         $f = array_filter($addresses, function($item) use ($values) {
    //             return $item['ID'] == $values['REFUND_ADDRESS_ID'];
    //         });

    //         $address = reset($f);
    //     }
        
    //     if (empty($address)) {
    //         $address = reset($addresses);
    //     }

    //     return $address['DATA'];
    // }

    // /**
    //  * Возвращает услуги отправки
    //  *
    //  * @return array
    //  */
    // public function getSenderSolutionList()
    // {
    //     $values           = $this->getEntity();
    //     $senderAddress    = $this->getSenderAddress();
    //     $serviceVariant   = $values['SERVICE_VARIANT'] ?: 'DOOR_PICKUP';
    //     $receiverSolution = $this->getReceiverSolution();

    //     if (empty($senderAddress) || empty($serviceVariant)) {
    //         return [];
    //     }

    //     $items = Client::getInstance()->getService('logistic')->getSenderSolutions(
    //         $serviceVariant, 
    //         $senderAddress['address_id'],
    //         $receiverSolution['code']
    //     );

    //     return array_map(function($item) {
    //         return [
    //             'TITLE' => $item['name'],
    //             'ID'    => $item['code'],
    //             'DATA'  => $item,
    //         ];
    //     }, $items);
    // }

    // /**
    //  * Возвращает логистическое решение первой мили
    //  *
    //  * @return array|false
    //  */
    // public function getSenderSolution()
    // {
    //     $values    = $this->getEntity();
    //     $solutions = $this->getSenderSolutionList();

    //     if (!empty($values['SENDER_SOLUTION'])) {
    //         $f = array_filter($solutions, function($item) use ($values) {
    //             return $item['ID'] == $values['SENDER_SOLUTION'];
    //         });
            
    //         $solution = reset($f);
    //     }

    //     if (empty($solution)) {
    //         $solution = reset($solutions);
    //     }

    //     return $solution['DATA'];
    // }

    // /**
    //  * Возвращает услуги последней мили
    //  *
    //  * @return array
    //  */
    // public function getReceiverSolutionList()
    // {
    //     $values = $this->getEntity();
    //     $items  = Client::getInstance()->getService('logistic')->getSolutions(
    //         $values['ALI_ORDER_ID'],
            
    //         [
    //             'width'  => $values['DIMENSION_WIDTH'],
    //             'height' => $values['DIMENSION_HEIGHT'],
    //             'length' => $values['DIMENSION_LENGTH'],
    //             'weight' => $values['DIMENSION_WEIGHT'],
    //         ]
    //     );

    //     return array_map(function($item) {
    //         return [
    //             'ID'    => $item['code'],
    //             'TITLE' => $item['name'],
    //             'DATA'  => $item,
    //         ];
    //     }, $items);
    // }

    /**
     * Возвращает логистическое решение последней мили
     *
     * @return array|false
     */
    public function getReceiverSolution()
    {
        return [];

        // $values    = $this->getEntity();
        // $solutions = $this->getReceiverSolutionList();
        // $solution  = false;

        // if (!empty($values['RECEIVER_SOLUTION'])) {
        //     $f = array_filter($solutions, function($item) use ($values) {
        //         return $item['ID'] = $values['RECEIVER_SOLUTION'];
        //     });
            
        //     $solution = reset($f);
        // }

        // if (empty($solution)) {
        //     $solution = reset($solutions);
        // }

        // return $solution['DATA'];
    }

    /**
	 * Выполняет сохранение данных формы
	 *
	 * @param mixed              $entity
	 * @param Bitrix\Main\Result $result
	 * 
	 * @return Bitrix\Main\Result
	 */
	protected function save($entity, $result)
	{
        if (!$result->isSuccess()) {
            return $result;
        }

        $data = $result->getData();

        $connection = Application::getInstance()->getConnection();
        $connection->startTransaction();

        switch($data['action'])
        {
            case 'save':
                if ($entity->aliexpress()->isCreated()) {
                    $sendResult = $entity->aliexpress()->markSended();

                    if (!$sendResult->isSuccess()) {
                        $result->addErrors( $sendResult->getErrors() );
                        break;
                    }
                    
                } else {
                    $saveResult = $entity->save();
                                    
                    if (!$saveResult->isSuccess()) {
                        $result->addErrors( $saveResult->getErrors() );    
                        break;
                    }

                    $sendResult = $entity->aliexpress()->create();

                    if (!$sendResult->isSuccess()) {
                        $result->addErrors( $sendResult->getErrors() );
                        break;
                    }
                }
                
            break;

            case 'print-doc':
            case 'print-label':
                if ($data['action'] == 'print-doc') {
                    $getFileResult = $entity->aliexpress()->getPrintDoc();
                } else {
                    $getFileResult = $entity->aliexpress()->getPrintLabel();
                }

                if (!$getFileResult->isSuccess()) {
                    $result->addErrors( $getFileResult->getErrors() );
                }

                if (isset($_REQUEST['download']) && $_REQUEST['download'] == 'Y') {
                    $GLOBALS['APPLICATION']->RestartBuffer();
                    
                    header("Content-type:application/pdf");
                    header("Content-Disposition:attachment;filename={$entity['ALI_LP_NUMBER']}.pdf");

                    readfile($_SERVER['DOCUMENT_ROOT'] . $entity['FILE_LABEL']);
                    exit;
                }

            break;

            case 'mark-sended':
                $sendResult = $entity->markSended();

                if ($sendResult->isSuccess()) {
                    $data = $result->getData();
                    $data['message'] = static::getLocMessage('TABLE_ORDER_MARK_SENDED_SUCCESS');

                    $result->setData($data);

                } else {
                    $result->addErrors( $sendResult->getErrors() );
                }
            break;
        }

        if ($result->isSuccess()) {
            $connection->commitTransaction();
        } else {
            $connection->rollbackTransaction();
        }

        return parent::save($entity, $result);
    }
}     