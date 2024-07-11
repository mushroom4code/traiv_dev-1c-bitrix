<?php
/**
 * ���� SDK(CLI).
 * ��������! � ������ �������� ����������� ��������� ������ �� ������� CMS. ��� ������� �������� �������� � ������
 * ������������. �� ������ ������ �.�., ������ �� ������� ������������� SDK(CLI) �������� �� ������.
 * SDK ������������� ��������� ������:
 * -  ��������� ��������� � ������ (CalculateShippingCostAndPeriod);
 * -  �������� ������ � ���������� � ���� ������ ���������� (getTrackingNumberOfApi).
 * ��������� ������ - ��������� � ������������ ��� ���������� ���������� � BitrixCMS. �� ���� ��������� ������
 * ������ ���������  � ���� Tools, �� � ������  �������� ��� ������������� ����������� ��������� ������� �����.
 * @author Vadim Lazev
 * @year 2021
 * @company BIA-Technologies
 * @version 1.0.0alfa
 */


namespace DellinShipping;


use BiaTech\Base\Log\LoggerInterface;
use Bitrix\Crm\Activity\Provider\Request;
use CPHPCache;
use CSaleOrderProps;
use CSalePersonType;
use DellinShipping\Entity\Config;
use DellinShipping\Entity\Order\Order;
use DellinShipping\Entity\Order\Person;
use DellinShipping\Entity\Order\Product;
use DellinShipping\NetworkService;
use DellinShipping\Requests\RequestHandler;
use Sale\Handlers\Delivery\DellinBlockAdmin;
use Bitrix\Main\Localization\Loc;


class Kernel {

    protected $sessionID;
    protected $resetSession;


    public Config $config;
    public Order $order;
    public LoggerInterface $logger;

    public NetworkService $networkservice;
    public RequestHandler $requestHandler;
    public $arrivalKLADR;
    

    public $resultValidationEntities;


    /**
     * Kernel constructor.
     * @param Config $config
     * @param Order $order
     * @param LoggerInterface $logger
     * @param bool $resetSession
     * @throws \Exception
     */
    public function __construct(Config $config, Order $order, LoggerInterface $logger, $resetSession = false)
    {

        $this->setConfigData($config);

        $this->setOrderData($order);
        $this->logger = $logger;
        $this->setResetSession($resetSession);
        $this->setSessionID($this->GetDellinSessionId());
        $this->validateEntity();

    }


    public function validateEntity(){

        $result = [];

        $this->order->validate();
        $this->config->validation();

        if(!$this->config->isErrors() && !$this->order->isErrors()){
            $result['entityIsValid'] = true;
        }

        if($this->order->isErrors()){

            $result['entityIsValid'] = false;
            $result['order']['isErrors'] = true;


            $errors = $this->order->getErrors();
            $result['order']['errors'] = $errors;

            // TODO ���������� ������������ ������ ��� SDK.

            // $fnName = 'validation order';

            $message = Loc::getMessage("DELLINDEV_MESSAGE_ORDER_LOGGER").PHP_EOL.
                Loc::getMessage("DELLINDEV_MESSAGE_ORDER_LOGGER_NEXT").PHP_EOL.'{errors}'.PHP_EOL;
            $context = ['errors' => json_encode($errors, JSON_UNESCAPED_UNICODE)];

            $this->logger->error($message, $context);

            $result['order']['message'] = [Loc::getMessage("DELLINDEV_PARAM_ORDER_IS_NOT_VALID")];

           // return new \Exception('��������� ������ �� ������ ���������');
        }

        if($this->config->isErrors()){

            $result['entityIsValid'] = false;
            $result['config']['isErrors'] = true;
            $errors = $this->config->getErrors();
            $result['config']['errors'] = $errors;

            $message = Loc::getMessage("DELLINDEV_MESSAGE_LOGGER_CONFIG").PHP_EOL.
                Loc::getMessage("DELLINDEV_MESSAGE_LOGGER_CONFIG_NEXT").PHP_EOL.'{errors}'.PHP_EOL;

            $context = ['errors' => json_encode($errors, JSON_UNESCAPED_UNICODE)];

            $this->logger->error($message, $context);
            $result['order']['message'] = [Loc::getMessage("DELLINDEV_PARAM_CONFIG_IS_NOT_VALID")];
        //    throw new \Exception('��������� �� ������ ���������.');

        }


        $this->resultValidationEntities = $result;
    }
    /**
     * ����� ��� ������� �������� ������
     * @param $arConfig
     * @throws \Exception
     */
    public function setConfigData($arConfig)
    {
        $this->config = $arConfig;

    }

    public function setOrderData($arOrder)
    {
        $this->order = $arOrder;

    }

    //TODO: переделать ввод контекста для объектов 

    // private function initServices()
    // {
    //     $this->networkservice = new NetworkService();
    //     $this->networkservice->setConfig($this->config);
    //     $this->networkservice->setOrder($this->order);
    //     $this->networkservice->setLogger($this->logger);
    //     $this->requestHandler = new RequestHandler($this->order, $this->config, $this->config, false, false);
        
    // }

    /**
     * @param mixed $sessionID
     */
    public function setSessionID($sessionID): void
    {
        $this->sessionID = $sessionID;
    }

    /**
     * @param mixed $resetSession
     */
    public function setResetSession($resetSession): void
    {
        $this->resetSession = $resetSession;
    }

    /**
     * ��������� ����� ������������ ���������� ���� � ��������� ��������.
     * @return array|mixed
     */

    public function CalculateShippingCostAndPeriod()
    {

        try {

            $this->setKLADRToArrival();
            $networkService = new NetworkService();
            $networkService->setOrder($this->order);
            $networkService->setConfig($this->config);
            $networkService->setLogger($this->logger);
            $networkService->setSessionID($this->sessionID);
            
            $result = $networkService->sendQueryForCalculator();


            return $result;

        } catch (\Exception $exception){

            return ['status' => 'error',
                    'body' =>  [
                        'message'=> $exception->getMessage(),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTrace()
                        ]
                    ];


        }



    }

    private static function checkerParam($param){
        return (isset($param) && !empty($param));
    }

    /**
     * �������� sessionId �� ���� ��� ������������.
     * TODO ����������� ������ Kernel.php
     *
     * */
    public function GetDellinSessionId(){
        try{

            $appkey = $this->config->getAppkey();
            $login = $this->config->getLogin();
            $password = $this->config->getPassword();

            if( self::checkerParam($appkey) &&
                self::checkerParam($login)  &&
                self::checkerParam($password)){

                $life_time = 30*24*60*60;
                $cache_id = hash('md5',$login.$password);
                $cache_path = 'dellinSessionId';
                $cache = new CPHPCache();

                if( $cache->initCache($life_time, $cache_id,$cache_path) && !$this->resetSession){

                    $dellinSessionId = $cache->getVars()[$cache_id];

                }else{

                        $dellinSession = NetworkService::authInDellinSystem($this->config->getAppkey(),
                                                                            $this->config->getLogin(),
                                                                            $this->config->getPassword());
                        if( $dellinSession->sessionID !== Null &&  $dellinSession->sessionID !== false){
                            $cache->startDataCache($life_time,$cache_id,$cache_path);
                            $cache->EndDataCache(
                                array(
                                    $cache_id =>  $dellinSession->sessionID
                                )
                            );
                            $dellinSessionId =  $dellinSession->sessionID;
                        }else{
                            return $dellinSession;
                        }


                }
                return $dellinSessionId;
            }else{
                $cache = new CPHPCache();
                $cache->CleanDir('dellinSessionId');
             //   $this->setSessionID(false);
                return false;
            }
        }catch( Exception $exception ){

            ShowError( $exception->getMessage() );

        }

    }


    /**
     * ��������� ����� �������� ������.
     * @param $is_order - ���� ������������ "��������" (���� is_order := false - ������ ������ ���������� ��� "��������".)
     * @param $produce_date - �������������� ���� ��������
     * @param $price_change - ���� �������� �� ��������� ����.
     * @return array
     */

    public function getTrackingNumberOfApi($is_order, $produce_date, $price_change){

        try {
            // ���������� ��������� ��� ������ ��������� �� �������
            // ������ �������� ��  ���������:
            // 1. error - ��������� ������ � ���� ������ ����� ������ �������� � ������������.
            // 2. price_changed - ���������� ��������� � ���������� ������������� �� ������������ �� ��������� ����.
            // 3. price_update - ��������� � �������� ��������.
            // 4. success - �� ������ �������, ���������� ���� � ��������� ��������.


            //��� ������ ������� ��������� �������� �� ������ �������� ������ ��� ��������

            $price_shipment = $this->order->orderData->order_shipping_cost;

            $calculateResult = $this->CalculateShippingCostAndPeriod();


            if($price_change){


                $state = ['status' => 'price_update',
                          'message'=>'BASE_PRICE_DELIVERY - is changed'

                ];

                $changeBasePriceDelivery = DellinBlockAdmin::setFieldInShipment($this->order->orderData->order_id,
                    $this->order->orderData->shipment_id,
                    'BASE_PRICE_DELIVERY', $calculateResult['price']);

                return $state;
            }

            //���� ��������� �� ����� ���������� � ������� ������ �������, � ���� ��������.
            // ���������� ����� � ������� ������� � ��� �� ����� ������������� ���������
            if($calculateResult['price'] >  $price_shipment){

                $state = ['status' => 'price_changed',
                          'message'=>Loc::getMessage("DELLINDEV_PHRASE_CHANGE_PRICE_PART_ONE").$price_shipment.
                              Loc::getMessage("DELLINDEV_PHRASE_CHANGE_PRICE_PART_TWO").$calculateResult['price'].
                        Loc::getMessage("DELLINDEV_PHRASE_CHANGE_PRICE_PART_THREE").$this->order->orderData->shipment_id.
                              Loc::getMessage("DELLINDEV_PHRASE_CHANGE_PRICE_PART_FOUR")

                ];

                return $state;
            }

            //���������� � �������� ������ ����� ������� ����.

            $networkService = new NetworkService();
            $networkService->setConfig($this->config);
            $networkService->setOrder($this->order);
            $networkService->setLogger($this->logger);

            $networkResponse = $networkService->sendQueryForRequest($is_order, $produce_date);


            if($networkResponse['state'] == 'success'){

                $trackingID = $networkResponse['data']['trackingID'];

                $dateCreateOrder = $networkResponse['data']['dateCreateDocument'];

                $settingTrackingAndDate = DellinBlockAdmin::setFieldInShipment($this->order->orderData->order_id,
                                                                          $this->order->orderData->shipment_id,
                                                                          'TRACKING_NUMBER', $trackingID);

                if($settingTrackingAndDate){
                    $result = ['status' => 'success',
                               'message' => Loc::getMessage("DELLINDEV_PHRASE_SUCCESS_PART_ONE").
                                   $this->order->orderData->shipment_id.Loc::getMessage("DELLINDEV_PHRASE_SUCCESS_PART_TWO").
                                   $networkResponse['data']['trackingID'].Loc::getMessage("DELLINDEV_PHRASE_SUCCESS_PART_THREE"),
                        ];
                } else {
                    $result = ['status' => 'error',
                               'message' => Loc::getMessage("DELLINDEV_ERROR_WRITE_TRACKING_NUMBER"),
                               'data' => ['errors' => $settingTrackingAndDate->getErrorMessages()]];

                }



            }

            return $result;


        } catch (\Exception $exception){
            return ['status' => 'error',
                'message'=> $exception->getMessage(),
                'typeErrors' => 'network',
                'errors' => $networkService->getErrors(),
//                'file' => $exception->getFile(),
//                'line' => $exception->getLine(),
//                'trace' => $exception->getTrace(),
                ];
        }

    }


     public static function getTerminalProps($person_type_id){

         $additionalProps= CSaleOrderProps::GetList(array(),array('PERSON_TYPE_ID'=>$person_type_id,
                                                                  'CODE'=>array('TERMINAL_ID',
                                                                                'DELLIN_DELIVERYTIME_START',
                                                                                'DELLIN_DELIVERYTIME_END')),
                                                   false,false,array());

         while($prop = $additionalProps->fetch()){
             $additionalPropIds[] = [
                            'CODE'=> $prop['CODE'],
                            'ID' => $prop['ID']
             ];
         }
         return $additionalPropIds;
     }


    public static function validPhone($phone){

        $phone = (int)$phone;

        $isPhoneFormat =  (preg_match("/^[0-9]{10,12}+$/", $phone) == 1);
        $firstNumber = substr($phone, "0",1);
        $isPhoneFistNumberEqual7 = ($firstNumber == 7);

        if($isPhoneFormat && $isPhoneFistNumberEqual7){
            return true;
        }

        return false;
    }


    public static function validEmail($email){

        $email = trim($email);

        return (preg_match(Loc::getMessage("pregmatch_email"), $email) == 1);


    }

    public function setKLADRToArrival()
    {
       $city = $this->order->person->getCity();
       $regionName = $this->order->person->getState();
       $zip = $this->order->person->getZip();

       $networkService = new NetworkService();
       $networkService->setOrder($this->order);
       $networkService->setConfig($this->config);
       $networkService->setLogger($this->logger);
       
       $obj = $networkService->findKLADR($city, $regionName, $zip);

       $this->arrivalKLADR = $obj->code;
       $this->order->person->setKLADRToArrival($obj->code);
    }
}

