<?php
namespace Ipol\AliExpress;

use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Event;
use Bitrix\Sale\Order;
use Bitrix\Main\Localization\Loc;

use Ipol\AliExpress\Debug\Log;
use Ipol\AliExpress\Api\Client;
use Ipol\AliExpress\Api\Service\Logistic;

Loc::loadMessages(__FILE__);

class EventListener
{
    static $MODULE_ID = 'ipol.aliexpress';

    public static function OrderBeforeSavedHandler(Event $event)
    {
    //     $order = $event->getParameter("ENTITY");

    //     if (!($orderID = $order->getId())) {
    //         return;
    //     }

    //     /**
    //      * Получаем предыдущую версию заказа
    //      * т.к в values нет достаточных данных
    //      */
    //     $oldOrder = \Bitrix\Sale\Order::load($orderID);

    //     /**
    //      * Формируем данные для отправки
    //      */
    //     $arSendOld = static::makeSendData($oldOrder);
    //     $arSendNew = static::makeSendData($order);

    //     /**
    //      * Указываем был ли ранее заполнен трек код
    //      * Если код ранее был указан и он не равен текущему
    //      */
    //     $order->ipolAliexpressPreviousTrackFill = !empty($arSendOld['logistics_no']) && $arSendOld['logistics_no'] == $arSendNew['logistics_no'];
    }

    /**
     * Обработчик события сохранения заказа
     * 
     * @param Bitrix\Sale\Order $order
     */
    public static function OrderAddHandlerOrder(Event $event)
    {
    //     try {
    //         $order   =  $event->getParameter("ENTITY");
    //         $service = Client::getInstance()->getService('logistic');
    //         $data    = static::makeSendData($order);

    //         if ($order->ipolAliexpressPreviousTrackFill
    //             || empty($data['out_ref'])
    //             || empty($data['service_name'])
    //             || empty($data['logistics_no'])
    //             || !Client::getInstance()->isAuthorized()
    //         ) {
    //             return ;
    //         }

    //         $service->fulfillOrder($data);
    //     } catch (\Exception $e) {
    //         Log::getInstance()->write('Fulfull order: ' . $e->getMessage() .'('. $e->getCode() .')', Log::LEVEL_ERROR);   
    //     }
    }

    /**
     * Подготавливает данные для отправки
     * 
     * @param  Bitrix\Sale\Order $order
     * @return array
     */
    public static function makeSendData(Order $order)
    {
        $ret = [];
        
        $deliveries = Option::get(IPOLH_ALI_MODULE, 'ORDER_DELIVERY_LIST', 'a:0:{}');
        $deliveries = unserialize($deliveries) ?: [];

        $shipmentCollection = $order->getShipmentCollection();
        
        foreach ($shipmentCollection as $shipment) {
            if($shipment->isSystem()) {
                continue;
            }

            foreach ($deliveries as $code => $deliveryIds) {
                if (in_array($shipment->getDeliveryId(), $deliveryIds)) {
                    $xmlId   = $order->getField('XML_ID');
                    $pattern = '~IPOL_ALI_(.+)~';

                    return [
                        'out_ref'      => preg_match($pattern, $xmlId) ? preg_replace($pattern, '$1', $xmlId) : false,
                        'send_type'    => Logistic::TYPE_ALL,
                        'service_name' => $code,
                        'logistics_no' => $shipment->getField('TRACKING_NUMBER'),
                    ]; 
                }
            }
        }

        return $ret;
    }

    /**
     * Событие по отрисовке эпилога страницы заказа в админ панели. Выводит кнопку и попап создания логистического заказа
     * AliExpress
     *
     * @return void
     */
    public static function OnAdminEpilog() {
        $uri = ($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['REQUEST_URI'];

        if (strpos($uri, "/bitrix/admin/sale_order_detail.php") !== false ||
            strpos($uri, "/bitrix/admin/sale_order_view.php")   !== false 
        ) {
            require_once $_SERVER['DOCUMENT_ROOT'] .'/bitrix/modules/ipol.aliexpress/admin/order_button.php';
        }
    }

    /**
     * Добавляет пункты меню
     *
     * @param array $aGlobalMenu
     * @param array $aModuleMenu
     * @return void
     */
    public static function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        $aModuleMenu[] = [
            'parent_menu' => 'global_menu_store',
            'section'     => static::$MODULE_ID,
            'sort'        => 1050,
            'text'        => Loc::getMessage(static::$MODULE_ID .'_MENU_GROUP_TITLE'),
            'title'       => '',
            'module_id'   => $MODULE_ID,
            'url'         => '',
            'more_url'    => [],
            'items'       => [
                [
                    'text'      => Loc::getMessage(static::$MODULE_ID .'_MENU_ORDER_LIST_TITLE'),
                    'title'     => '',
                    'url'       => static::$MODULE_ID .'_order_list.php',
                    'module_id' => $MODULE_ID,
                ],

                [
                    'text'      => Loc::getMessage(static::$MODULE_ID .'_MENU_TRANSFER_SHEET_TITLE'),
                    'title'     => '',
                    'url'       => static::$MODULE_ID .'_transfer_sheet.php',
                    'module_id' => $MODULE_ID,
                ],
            ],
        ];
    }

    /**
     * Проверяет авторизацию
     */
    public static function checkAliToken()
    {
        // if (!defined('ADMIN_SECTION') || !ADMIN_SECTION) {
        //     return false;
        // }

        // $error  = '';
        // $client = \Ipol\AliExpress\Api\Client::getInstance();

        // $expTime = $client->getExpireTimeAuthorize(); 

        // if (!$client->isAuthorized()) {
        //     $error = Loc::getMessage('ipol.aliexpress_AUTH_NOTIFY');
        // } elseif ($expTime < time() + (14 * 86400)) {
        //     $error = Loc::getMessage('ipol.aliexpress_AUTH_NOTIFY_WARN', [
        //         '#DAYS#' => \FormatDate('Q', time(), $expTime)
        //     ]);
        // }

        // if ($error) {
        //     \CAdminNotify::Add([
        //         'MESSAGE'      => $error,
        //         'TAG'          => 'ali_logout_ntf',
        //         'MODULE_ID'    => 'ipol.aliexpress',
        //         'ENABLE_CLOSE' => 'N',
        //         'NOTIFY_TYPE'  => 'E',
        //     ]);
        // } else {
        //     \CAdminNotify::DeleteByTag("ali_logout_ntf");
        // }
    }
}