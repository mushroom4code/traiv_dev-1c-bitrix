<?php

namespace Sale\Handlers\Delivery\Dellin;

use Bitrix\Tasks\Util\Type\DateTime;
use DellinShipping\Kernel;
use DellinShipping\NetworkService;
use Bitrix\Main\Localization\Loc;
use BiaTech\Base\Log\Logger;
use Exception;
use Sale\Handlers\Delivery\DellinBlockAdmin;
use Bitrix\Main\Loader;


Loader::registerAutoLoadClasses(
    'dellindev.shipment',
    array(
        'Sale\Handlers\Delivery\DellinTracking' =>
            'classes/general/tracking.php',
        'Sale\Handlers\Delivery\DellinBlockAdmin' =>
            'classes/general/dellinblockadmin.php',
        'DellinShipping\Entity\Packages' =>
            'lib/src/DellinShipping/Entity/Packages.php',
        'DellinShipping\Kernel' =>
            'lib/src/DellinShipping/Kernel.php',
    )
);



class AjaxService {


    public static function getTerminalsForAjax($kladr, $appkey){

        try {
            //�������������� ��������� ���� ���������
         //   $arTerminalIdValues[''] = Loc::getMessage('TERMINAL_NOT_SELECTED');

            if(!empty($kladr)){
                $dataForNetworkService = [
                    'appkey' => $appkey,
                    'code' => $kladr,
                    'direction' => 'derival'
                ];

                if(LANG_CHARSET == 'windows-1251'){
                    Kernel::iconvArray($dataForNetworkService,
                        'windows-1251', 'utf-8');
                }

                $terminalsObj = NetworkService::getAllTerminalsList($dataForNetworkService);


                $terminalsInfo = NetworkService::GetTerminals($appkey);


                if(isset($terminalsInfo) && !empty($terminalsInfo)){
                    foreach ($terminalsObj->terminals as $terminal){

                        if($terminalsInfo[$terminal->city_code]['terminals'][$terminal->id]->receiveCargo){
                            $arTerminalIdValues[]= ['id' => $terminal->id,
                                                    'address'=> $terminal->address];
                        }
                    }
                }

            } else {
                //TODO �������� ����� �������� ��� ������������� ������

            }


            $result['TERMINALS'] = $arTerminalIdValues;

            return $result;

        } catch (Exception $exception){

            $result["ERRORS"] = $exception->getMessage();

            return $result;

        }

    }

    public static function getTerminalsForAjaxOfSession(){

        try {

            $result = [];

            $dataManager = \Bitrix\Sale\Delivery\Services\Manager::getActive();
            foreach ($dataManager as $key => $value){
                if($value['CLASS_NAME'] == '\Sale\Handlers\Delivery\DellinHandler' &&
                   $value['CONFIG']['ARRIVAL']['GOODSLOADING'] == '0' ){
                        $result['terminals_method_id'][] = $key;
                        $result['terminals'] = self::getTerminalList($_SESSION['current_terminals']);
                      //$result['propsData'] = Kernel::getTerminalProps($person_type_id);
                }
            }


            return $result;
        } catch (Exception $exception){
            return ['RESULT' => false,
                    'message' => $exception->getMessage()];
        }

    }




    protected static function getTerminalList($session_storage)
    {

        $result = [];
        if (isset($session_storage) && !empty($session_storage)) {
            foreach ($session_storage as $terminal) {

                $result[] = ['terminal_id' => $terminal->id, 'address' => $terminal->address];


            }


            return $result;
        } else {

            return null;
        }

    }

    public static function searchCityForAjax( $q ){
        try {
            //����������� � � �;
            $q = str_replace(Loc::getMessage('YO'), Loc::getMessage('YE'), $q);


            if(mb_strtolower(SITE_CHARSET) != 'utf-8')
                $q = \Bitrix\Main\Text\Encoding::convertEncoding($q, SITE_CHARSET, 'utf-8');

            $response = NetworkService::SearchCity($q);

            return $response;

        } catch (Exception $exception){



        }


    }

    public static function createOrder($order_id, $shipment_id, $produce_date, $is_order, $price_change = false)
    {
        try{

            $produce_date = date('Y-m-d',strtotime($produce_date));
            $price_change = ($price_change == 'true');
            $is_order = ($is_order == 'true');


            $order = DellinBlockAdmin::buildOrderDellinByShipmentId($order_id, $shipment_id);
            $config = DellinBlockAdmin::buildConfig($order->orderData->shipping_method_id);
            $logger = new Logger($config);

            $kernel = new Kernel($config, $order, $logger);


            if($kernel->resultValidationEntities['entityIsValid'] === true){

                return $kernel->getTrackingNumberOfApi($is_order, $produce_date, $price_change);

            } else {

                $dataWithErrorsValidation = self::handleResponseForValidationInfo($kernel->resultValidationEntities);
                $result = ['status' => 'error',
                    'message' => $dataWithErrorsValidation['message'],
                    'typeErrors' => 'validation',
                    'errors' => $dataWithErrorsValidation['errors']
                ];

               return $result;

            }
        } catch (Exception $exception){


            return $exception->getMessage();

        }

    }

    private static function handleResponseForValidationInfo($dataWithErrosValidation)
    {
        if(!$dataWithErrosValidation['entityIsValid']){

            $result = [];
            $result['message'] = Loc::getMessage("DELLINDEV_VALIDATION_ERROR");

            if(isset($dataWithErrosValidation['order'])){
                $result['message'] = Loc::getMessage("DELLINDEV_NO_VALID_ORDER");

                $result['errors']= $dataWithErrosValidation['order']['errors'];

//                foreach ($dataWithErrosValidation['order']['errors'] as $idx => $error){
//
//                    $result['errors']= [$error];
//
//                }

            }

            if(isset($dataWithErrosValidation['config'])){
                $result['message'] = Loc::getMessage("");
                $result['errors'] = $dataWithErrosValidation['order']['errors'];
            }

            return $result;

        } else {
            throw new Exception(Loc::getMessage("DELLINDEV_EXCEPTION"));
        }

    }


    public static function  getCounterAgentForAjax( $appkey, $login, $password, $flag = false ){

        //TODO ��������� ������� ��������� sessionID �� ����������� ����
        // ����� ����������� ���������� ������.
        try {
            return NetworkService::getCounteragents($appkey, $login, $password, $flag);
        }  catch (Exception $exception) {

            return ['ERRORS' => $exception->getMessage(),
                    'ExceptionTrace' => $exception->getTrace()];

        }
    }

    public static function getOpfDataForAjax ($apikey){

        try {

        return NetworkService::getOpfAndCounty($apikey);

        } catch (Exception $exception){

        return ['ERRORS' => $exception->getMessage(),
                'ExceptionTrace' => $exception->getTrace()];

        }
    }




}
