<?php
namespace Ipol\Aliexpress\Admin\Form\Pallet;

use Bitrix\Main\Application;
use Ipol\Aliexpress\Api\Client;
use Ipol\Aliexpress\Admin\Form\Base;
use Ipol\Aliexpress\DB\PalletTable;

PalletTable::loadLocMessages();

class Edit extends Base
{
    /**
	 * @var string
	 */
    protected $name = 'IPOL_ALI_PALLET';
    
    /**
	 * Возвращает имена опций
	 * 
	 * @return array
	 */
	public function getFieldNames($items = null)
	{
        $ret = [];

        foreach (PalletTable::getMap() as $field) {
            $ret[] = $field->getName();
        }

        return array_unique(array_merge($ret, ['ORDER_IDS']));
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
				'DIV'      => static::getLocMessage('FORM_PALLET_TAB_COMMON'),
				'TAB'      => static::getLocMessage('FORM_PALLET_TAB_COMMON'),
				'ICON'     => 'support_settings',
				'TITLE'    => static::getLocMessage('FORM_PALLET_TAB_COMMON_TITLE'),
				'HELP'     => static::getLocMessage('FORM_PALLET_TAB_COMMON_HELP'),
				'OPTIONS'  => [],
                'CONTROLS' => function() {
                    $values = $this->getEntity();

                    return array_merge(
                        [
                            'ID' => [
                                'TYPE' => 'HIDDEN',
                            ],
        
                            'ORDER_DATE' => [
                                'TITLE' => static::getLocMessage('TABLE_PALLET_ORDER_DATE'),
                                'TYPE'  => 'DATE',
                                'HELP'  => static::getLocMessage('TABLE_PALLET_ORDER_DATE_HELP'),
                                'ATTRS' => [
                                    'disabled' => $values->isCreated(),
                                ],
                            ],
                        ],

                        []
                    );
                }
            ],

            // [
            //     'DIV'      => static::getLocMessage('FORM_PALLET_TAB_SENDER'),
			// 	'TAB'      => static::getLocMessage('FORM_PALLET_TAB_SENDER'),
			// 	'ICON'     => 'support_settings',
			// 	'TITLE'    => static::getLocMessage('FORM_PALLET_TAB_SENDER_TITLE'),
			// 	'HELP'     => static::getLocMessage('FORM_PALLET_TAB_SENDER_HELP'),
			// 	'OPTIONS'  => [],
            //     'CONTROLS' => function() {
            //         $values = $this->getEntity();

            //         return [
            //             'TOP_USER_KEY' => [
            //                 'TITLE'      => static::getLocMessage('TABLE_PALLET_TOP_USER_KEY'),
            //                 'TYPE'       => 'HIDDEN',
            //                 'HELP'       => static::getLocMessage('TABLE_PALLET_TOP_USER_KEY_HELP'),
            //                 'ATTRS'      => [
            //                     'disabled' => $values->isCreated(),
            //                 ],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_PALLET_TOP_USER_KEY_ERROR_EMPTY')
            //                 ]
            //             ],
                        
            //             'CLIENT' => [
            //                 'TITLE'      => static::getLocMessage('TABLE_PALLET_CLIENT'),
            //                 'TYPE'       => 'HIDDEN',
            //                 'HELP'       => static::getLocMessage('TABLE_PALLET_CLIENT_HELP'),
            //                 'ATTRS'      => [
            //                     'disabled' => $values->isCreated(),
            //                 ],
            //                 'VALIDATORS' => [
            //                     'required' => static::getLocMessage('TABLE_PALLET_CLIENT_ERROR_EMPTY')
            //                 ]
            //             ],
                        
            //             'PERSON_NAME' => [
            //                 'TITLE'      => static::getLocMessage('TABLE_PALLET_PERSON_NAME'),
            //                 'TYPE'       => 'STRING',
            //                 'HELP'       => static::getLocMessage('TABLE_PALLET_PERSON_NAME_HELP'),
            //                 'ATTRS'      => [
            //                     'disabled' => $values->isCreated(),
            //                 ]
            //             ],
                        
            //             'PERSON_PHONE' => [
            //                 'TITLE'      => static::getLocMessage('TABLE_PALLET_PERSON_PHONE'),
            //                 'TYPE'       => 'STRING',
            //                 'HELP'       => static::getLocMessage('TABLE_PALLET_PERSON_PHONE_HELP'),
            //                 'ATTRS'      => [
            //                     'disabled' => $values->isCreated(),
            //                 ]
            //             ],
    
            //             'PERSON_MOBILE' => [
            //                 'TITLE'      => static::getLocMessage('TABLE_PALLET_PERSON_MOBILE'),
            //                 'TYPE'       => 'STRING',
            //                 'HELP'       => static::getLocMessage('TABLE_PALLET_PERSON_MOBILE_HELP'),
            //                 'ATTRS'      => [
            //                     'disabled' => $values->isCreated(),
            //                 ]
            //             ],
            //         ];
            //     }
            // ],

            [
                'DIV'      => static::getLocMessage('FORM_PALLET_TAB_ORDERS'),
                'TAB'      => static::getLocMessage('FORM_PALLET_TAB_ORDERS'),
                'ICON'     => 'support_settings',
                'TITLE'    => static::getLocMessage('FORM_PALLET_TAB_ORDERS_TITLE'),
                'HELP'     => static::getLocMessage('FORM_PALLET_TAB_ORDERS_HELP'),
                'OPTIONS'  => [],
                'CONTROLS' => [
                    'ORDER_IDS' => [
                        'SHOW_CAPTION' => 'N',
                        'TYPE'         => 'HIDDEN',
                        'VALIDATORS'   => [
                            'required' => static::getLocMessage('TABLE_PALLET_ORDER_ID_ERROR_EMPTY'),
                        ],
                    ],

                    'ORDERS_TABLE' => [
                        'SHOW_CAPTION' => 'N',
                        'TYPE'         => function() {
                            $values = $this->getEntity();

                            if (empty($values['SERVICE_VARIANT'])) {
                                return '<div class="adm-info-message" style="width: 100%; box-sizing: border-box;">'. static::getLocMessage('FORM_PALLET_TAB_ORDERS_SERVICE_VARIANT_ERROR') .'</div>';
                            }

                            if ($values['SERVICE_VARIANT'] == 'SELF_SEND' && empty($values['SENDER_SOLUTION'])) {
                                return '<div class="adm-info-message" style="width: 100%; box-sizing: border-box;">'. static::getLocMessage('FORM_PALLET_TAB_ORDERS_DROP_POINT_ERROR') .'</div>';
                            }

                            $table = new \Ipol\Aliexpress\Admin\Table\PalletOrder($values);

                            return $table->render([
                                'SHOW_TITLE'  => 'N',
                                'SHOW_FILTER' => 'N',
                            ])->render();
                        }
                    ],
                ]
            ],

            [
                'DIV'      => static::getLocMessage('FORM_PALLET_TAB_DOCUMENTS'),
                'TAB'      => static::getLocMessage('FORM_PALLET_TAB_DOCUMENTS'),
                'ICON'     => 'support_settings',
                'TITLE'    => static::getLocMessage('FORM_PALLET_TAB_DOCUMENTS_TITLE'),
                'HELP'     => '',
                'OPTIONS'  => [],
                'CONTROLS' => function() {
                    $values = $this->getEntity();

                    if (!$values->isCreated()) {
                        return [
                            'FILE_NOTICE' => [
                                'SHOW_CAPTION' => 'N',
                                'HELP'         => static::getLocMessage('FORM_PALLET_TAB_DOCUMENTS_HELP'),
                                'TYPE'         => 'COMMENT',
                            ]
                        ];
                    }

                    return [
                        // 'FILE_DOC' => [
                        //     'TITLE' => static::getLocMessage('TABLE_PALLET_FILE_DOC'),
                        //     'TYPE'  => function() use ($values) {
                        //         if (!empty($values['FILE_DOC'])) {
                        //             return '<a href="'. $values['FILE_DOC'] .'" target="_blank">'. static::getLocMessage('TABLE_PALLET_DOWNLOAD_FILE') .'</a>';
                        //         }

                        //         return '<button name="action" value="print-doc" type="submit">'. static::getLocMessage('TABLE_PALLET_GET_FILE') .'</button>';
                        //     },
                        // ],

                        'FILE_LABEL' => [
                            'TITLE' => static::getLocMessage('TABLE_PALLET_FILE_LABEL'),
                            'TYPE'  => function() use ($values) {
                                if (!empty($values['FILE_LABEL'])) {
                                    return '<a href="'. $values['FILE_LABEL'] .'" target="_blank">'. static::getLocMessage('TABLE_PALLET_DOWNLOAD_FILE') .'</a>';
                                }

                                return '<button name="action" value="print-label" type="submit">'. static::getLocMessage('TABLE_PALLET_GET_FILE') .'</button>';
                            },
                        ]
                    ];
                }
            ],
        ];
    }

    /**
     * Возвращает список адресов отправки
     *
     * @return array
     */
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

    /**
     * Возвращает адрес отправки
     * 
     * @return array|false
     */
    // public function getSenderAddress()
    // {
    //     $values    = $this->getEntity();
    //     $addresses = $this->getSenderAddressList();
    //     $address   = false;

    //     if (!$addresses) {
    //         return $address;
    //     }

    //     if ($values['ADDRESS_ID']) {
    //         $address = reset($f = array_filter($addresses, function($item) use ($values) {
    //             return $item['ID'] == $values['ADDRESS_ID'];
    //         }));
    //     } 
        
    //     if (empty($address)) {
    //         $address = reset($addresses);
    //     }

    //     return $address['DATA'];
    // }

    /**
     * Возвращает услуги отправки
     *
     * @return array
     */
    // public function getSenderSolutionList()
    // {
    //     $values           = $this->getEntity();
    //     $senderAddress    = $this->getSenderAddress();
    //     $serviceVariant   = $values['SERVICE_VARIANT'] ?: 'DOOR_PICKUP';

    //     if (empty($senderAddress) || empty($serviceVariant)) {
    //         return [];
    //     }

    //     $items = Client::getInstance()->getService('logistic')->getSenderSolutions(
    //         $serviceVariant, 
    //         $senderAddress['address_id']
    //     );

    //     return array_map(function($item) {
    //         return [
    //             'TITLE' => $item['name'],
    //             'ID'    => $item['code'],
    //             'DATA'  => $item,
    //         ];
    //     }, $items);
    // }

    /**
	 * Выполняет сохранение данных формы
	 *
	 * @param mixed              $entity
	 * @param Bitrix\Main\Result $result
	 * 
	 * @return Bitrix\Main\Result
	 */
	protected function save($pallet, $result)
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
                $saveResult = $pallet->save();
                
                if (!$saveResult->isSuccess()) {
                    $result->addErrors( $saveResult->getErrors() );    
                    break;
                }

                $sendResult = $pallet->aliexpress()->create();

                if (!$sendResult->isSuccess()) {
                    $result->addErrors( $sendResult->getErrors() );
                    break;
                }

            break;

            // case 'print-doc':
            //     $getFileResult = $pallet->aliexpress()->getPrintDoc();

            //     if (!$getFileResult->isSuccess()) {
            //         $result->addErrors( $getFileResult->getErrors() );
            //     }

            // break;

            case 'print-label':
                $getFileResult = $pallet->aliexpress()->getPrintLabel();

                if (!$getFileResult->isSuccess()) {
                    $result->addErrors( $getFileResult->getErrors() );
                }

            break;

            case 'mark-sended':
                $sendResult = $pallet->markSended();

                if ($sendResult->isSuccess()) {
                    $data = $result->getData();
                    $data['message'] = static::getLocMessage('TABLE_PALLET_MARK_SENDED_SUCCESS');
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