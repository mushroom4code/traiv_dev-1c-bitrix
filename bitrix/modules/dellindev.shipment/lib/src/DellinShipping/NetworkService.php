<?php

/**
 * ������� ���� �������������� � API.
 * �������� �������� ������ �������� ������ �� ���������������, �.�. ��������� ������������� �������� ��������������
 * �������� �������������.
 * � ���������� ��� �������� ������� SDK, �������� ���������� � ������������ ���������� ������ �������������.
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */


namespace DellinShipping;

use BiaTech\Base\Composite\Container;
use BiaTech\Base\Composite\Field;
use BiaTech\Base\Log\Logger;
use BiaTech\Base\Log\LoggerInterface;
use Bitrix\Main\Localization\Loc;
use DellinShipping\Entity\Config;
use DellinShipping\Entity\Order\Order;
use DellinShipping\Entity\Cargo;
use DellinShipping\Requests\RequestHandler;
use Exception;
use DateTime;
use DellinShipping\Kernel;
use DellinShipping\ExclusionList;


class NetworkService 
{

    /**
     * ���� ���
     * @var string
     */
    protected static $api_key;

    /**
     * ������������ �� ������ ������ �� �������.
     * @var boolean $isError
     */
    public $isError = false;

    /**
     * ���������� ������ ��� ������ � ��� ��� ��� ������ ������������. � ����������� �� �������������.
     * @var array $errors
     */
    public $errors = [];

    public $message;
    public $context;


    /**
     * �������� ������� ��������.
     * @var \DellinShipping\Config
     */

   public Config $config;
   public Order $order;
   public  \BiaTech\Base\Log\LoggerInterface $logger;
   public $sessionID;


    /**
     * ������ ������� API (���� - �������� ������ ��� ������)
     * @var array
     */
    public static $apiUrls = array(
        'calculator' => 'https://api.dellin.ru/v2/calculator.json',
        'citySearch' => 'https://www.dellin.ru/api/cities/search.json',//��������! ���������� �����. ������������ locationKLADR
        'locationKLADR' => 'https://api.dellin.ru/v2/public/kladr.json',
        'login' => 'https://api.dellin.ru/v1/customers/login.json',
        'request' => 'https://api.dellin.ru/v2/request',
        'tracker' => 'https://api.dellin.ru/v2/public/tracker.json',
        // 'produceDate' => 'https://api.dellin.ru/v1/public/produce_date.json',// ���������� ����� ������
        'produceDateForAddress' => 'https://api.dellin.ru/v2/request/address/dates', //TODO ����� ������� ���������������
        'produceDateForTerminal' => 'https://api.dellin.ru/v2/request/terminal/dates',//
        'requestTerminal' => 'https://api.dellin.ru/v1/public/request_terminals.json',
        'terminals' => 'https://api.dellin.ru/v3/public/terminals.json',
        'requestCounteragents' => 'https://api.dellin.ru/v1/customers/counteragents.json',
        'streetKladr' => 'https://api.dellin.ru/v1/public/kladr_street.json',
        'cityInfo' => 'https://api.dellin.ru/v2/public/kladr.json',
        'opfList' => 'https://api.dellin.ru/v1/public/opf_list.json',
        'countriesList' => 'https://api.dellin.ru/v1/public/countries.json',
        'terminalsList' => 'https://api.dellin.ru/v3/public/terminals.json',
        'cities' => 'https://api.dellin.ru/v1/public/cities.json',
    );


    public function setOrder(Order $order)
    {
        $this->order = $order;
    }


    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
    }

    /**
     * �������� �������� API, �� ��������� �������������� ��������� � ����
     * @param $functionName �������� ������
     * @param $data ��������� ������
     * @param string $requestType ��� �������(��-��������� json, ��������� ����� ����������� � ������� �������)
     * @param string $method ����� �������
     * @param $customUrl ��� �������� �������� �� ������������ url
     * @return mixed
     */

    public static function sendApiRequest($functionName=false, $data, $requestType='json',$method='POST',$customUrl=false){
        if($requestType == 'json'){
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if($functionName){
            $url = self::$apiUrls[$functionName];
        }
        if($customUrl){
            $url = $customUrl;
        }
        $jsonstr = self::sendCurl($url, $data, $method);
        $response = json_decode($jsonstr);

        return $response;
    }

    /**
     * ����� ��������� ����� ���������� ������.
     * @param $locationName
     * @param $region
     * @return bool|string
     */

    public static function GetCityKLADRCode($locationName, $region, $zip)//TODO ��������� � ���������.
    {
        if (isset($locationName)) {
            $arName = explode(" ", trim($locationName));
            if ($arName > 2)    {
                usort($arName, array('self', 'sort_func'));
                $searchString = implode(" ", array_slice($arName, 0, 2));
                $locationName = $searchString;
            }


            $locationName = str_replace([ Loc::getMessage("PLACES_VARIANT_1"),
                Loc::getMessage("PLACES_VARIANT_2"),
                Loc::getMessage("PLACES_VARIANT_3"),
                Loc::getMessage("PLACES_VARIANT_4"),
                Loc::getMessage("PLACES_VARIANT_5"),
                Loc::getMessage("PLACES_VARIANT_6"),
                Loc::getMessage("PLACES_VARIANT_7") ], '', $locationName); ;

            $dl_locations = self::SearchCity($locationName);

            if(empty($dl_locations)) return false;
        }


        if (count($dl_locations) > 0) {
            $dl_city = self::SelectCityByRegion($dl_locations,$locationName, $region, $zip);
            $kladr_code = (string)$dl_city->code;
        } else {
            return $dl_locations->errors;
        }
        return $kladr_code;
    }




    /**
     * ����� ���������� �� ����� ������ � ������ �������.
     * @param $city_list
     * @param $param_city_name
     * @param string $param_region_name
     * @return mixed
     */

    public function SelectCityByRegion($city_list, $param_city_name, $param_region_name = '', $zip)//TODO ��������� � �������������
    {
        $dl_city = $city_list[0];

        //    $param_region_name = iconv('utf-8', 'cp1251', $param_region_name);
        $short_region_name = str_replace(Loc::getMessage("PLACES_VARIANT_8"),
            Loc::getMessage("PLACES_VARIANT_9"), $param_region_name);
        $short_region_name = mb_strtolower((string)$short_region_name);
        $param_city_name = mb_strtolower((string)$param_city_name);
//        $param_region_name = iconv('cp1251', 'utf-8', $param_region_name);
//        $short_region_name = iconv('cp1251', 'utf-8', $short_region_name);
//        $short_region_name = $param_region_name;


        foreach ($city_list as $item) {
            $item_city_name = mb_strtolower((string)$item->city);
            $item_region_name = mb_strtolower((string)$item->regionString);

            if($item->uString !== ''){

                $item_zip = preg_replace("/[^0-9]/", '', $item->uString);

                if ( self::checkParams($zip, $item_zip) ) {

                    $dl_city = $item;
                    break;
                }
            } else {
                if (
                    $item_city_name  == $param_city_name && (
                        $item_region_name == $short_region_name ||
                        $item_region_name == $param_region_name
                    )
                ) {

                    $dl_city = $item;
                    break;
                }
            }


        }

//        var_dump($city_list);
//        var_dump($param_city_name);
//        var_dump($short_region_name);
//        var_dump($dl_city);
//        die();



        return $dl_city;
    }

    private static function checkParams($param1, $param2){
        return ($param1 == $param2);
    }


    private static function sort_func($a,$b)
    {
        if (strlen($a) == strlen($b))
        {
            //  return 0;
        }

        return (strlen($a) > strlen( $b)) ? -1 : 1;
    }

    /**
     *
     * ����� ��������������� ������� ���� �����.
     * �������� ��������� ���������� ������ �� API
     *
     * @param $locationName
     * @param $regionName
     * @param $zip
     * @return mixed
     */

    public function findKLADR($locationName, $regionName, $zip)
    {
        //��������� ��� ��������� ��������� � ������ �������.

        $locationName = mb_strtolower($locationName);
        $regionName = mb_strtolower($regionName);

        //�������� ��� �������� � ���������
        $zip = (int)$zip;


        //��������� ������� ��������� ���������� ������.
        //������ ��� ���������� ����������� �������� ����� � �����
        $typesLocation = array(Loc::getMessage("PLACES_VARIANT_14"), Loc::getMessage("PLACES_VARIANT_10"), Loc::getMessage("PLACES_VARIANT_11"),
            Loc::getMessage("PLACES_VARIANT_12"), Loc::getMessage("PLACES_VARIANT_13"),//C ������ ������
             Loc::getMessage("PLACES_VARIANT_15"),
            Loc::getMessage("PLACES_VARIANT_16"), Loc::getMessage("PLACES_VARIANT_17"),
            Loc::getMessage("PLACES_VARIANT_18"), Loc::getMessage("PLACES_VARIANT_19"),
            Loc::getMessage("PLACES_VARIANT_20"), Loc::getMessage("PLACES_VARIANT_21"),
            Loc::getMessage("PLACES_VARIANT_22"), Loc::getMessage("PLACES_VARIANT_23"),
            Loc::getMessage("PLACES_VARIANT_24"), Loc::getMessage("PLACES_VARIANT_25"),
            Loc::getMessage("PLACES_VARIANT_26"), Loc::getMessage("PLACES_VARIANT_27"),
            Loc::getMessage("PLACES_VARIANT_28"), Loc::getMessage("PLACES_VARIANT_29"),//C ������ ������
            Loc::getMessage("PLACES_VARIANT_30"), Loc::getMessage("PLACES_VARIANT_31"),
            Loc::getMessage("PLACES_VARIANT_32"),
            Loc::getMessage("PLACES_VARIANT_33"), Loc::getMessage("PLACES_VARIANT_34"),
            Loc::getMessage("PLACES_VARIANT_35"), Loc::getMessage("PLACES_VARIANT_36"),
            Loc::getMessage("PLACES_VARIANT_37"), Loc::getMessage("PLACES_VARIANT_38"),
            Loc::getMessage("PLACES_VARIANT_39"), Loc::getMessage("PLACES_VARIANT_40"),
            Loc::getMessage("PLACES_VARIANT_41"), Loc::getMessage("PLACES_VARIANT_42"),
            Loc::getMessage("PLACES_VARIANT_43"), Loc::getMessage("PLACES_VARIANT_44"),
            Loc::getMessage("PLACES_VARIANT_45"),  Loc::getMessage("PLACES_VARIANT_46"),
            Loc::getMessage("PLACES_VARIANT_47"), Loc::getMessage("PLACES_VARIANT_48"),
            Loc::getMessage("PLACES_VARIANT_49"), Loc::getMessage("PLACES_VARIANT_50"),
            Loc::getMessage("PLACES_VARIANT_51"), Loc::getMessage("PLACES_VARIANT_52"),
            Loc::getMessage("PLACES_VARIANT_53"),//C ������ ������
            Loc::getMessage("PLACES_VARIANT_54"), Loc::getMessage("PLACES_VARIANT_55"),
            Loc::getMessage("PLACES_VARIANT_56"), Loc::getMessage("PLACES_VARIANT_57"),
            Loc::getMessage("PLACES_VARIANT_58"), Loc::getMessage("PLACES_VARIANT_59"),
            Loc::getMessage("PLACES_VARIANT_60"),//C ������ ������
            Loc::getMessage("PLACES_VARIANT_61"), Loc::getMessage("PLACES_VARIANT_62"),
            Loc::getMessage("PLACES_VARIANT_63"),//C ������ ������
            Loc::getMessage("PLACES_VARIANT_64"), Loc::getMessage("PLACES_VARIANT_65"),
            Loc::getMessage("PLACES_VARIANT_66"), Loc::getMessage("PLACES_VARIANT_67"),
            Loc::getMessage("PLACES_VARIANT_68"),//C ������ ������
            Loc::getMessage("PLACES_VARIANT_69"), Loc::getMessage("PLACES_VARIANT_70")
        );

        $typesSubjectFed = [Loc::getMessage("PLACES_VARIANT_71"), Loc::getMessage("PLACES_VARIAN_72"),
            Loc::getMessage("PLACES_VARIAN_73"), Loc::getMessage("PLACES_VARIAN_74"),
            Loc::getMessage("PLACES_VARIAN_75"), Loc::getMessage("PLACES_VARIAN_76"),
            Loc::getMessage("PLACES_VARIAN_77"),
            Loc::getMessage("PLACES_VARIAN_78"), Loc::getMessage("PLACES_VARIAN_79"),
            Loc::getMessage("PLACES_VARIAN_80"), Loc::getMessage("PLACES_VARIAN_81"),
            Loc::getMessage("PLACES_VARIAN_82"), Loc::getMessage("PLACES_VARIAN_83")];




        $shortLocationName = str_replace($typesLocation, '', $locationName);
        $shortRegionName = str_replace($typesSubjectFed, '', $regionName);



        //���������� ��� ��������� ������� ������������ ��������, ������, �����-���������, �����������

        if(array_key_exists($shortLocationName, ExclusionList::listForPlaces())) {
            foreach(ExclusionList::listForPlaces() as $place => $value){
                if($place == $shortLocationName){
                    $shortLocationName = $value['cityName'];
                    $shortRegionName = $value['regionName'];
                }
            }
        }

        //���������� ��� ������ ������������ �������


        if(array_key_exists($shortRegionName, ExclusionList::listForRegionName())){

            foreach (ExclusionList::listForRegionName() as $regionCandidat => $regionValue){
                if($shortRegionName == $regionCandidat){
                    $shortRegionName = $regionValue;
                }
            }
        }

        $q = $shortLocationName." ".$shortRegionName;


        if(array_key_exists($q, ExclusionList::listForQuery())){

            foreach (ExclusionList::listForQuery() as $regionCandidat => $values){
                if($regionCandidat == $q){
                    $q = $values['q'];
                    $shortRegionName = $values['regionName'];
                    $shortLocationName = $values['cityName'];
                }
            }
        }

        $locationList = $this->locationSearch($q);



        if(empty($locationList) || (count($locationList) < 1)){

            $fnName = 'locationKLADR';

            $message = Loc::getMessage("SPRINGF_MESSAGE_ERROR");

            $context = ['city_list' => json_encode($locationList, JSON_UNESCAPED_UNICODE),
                'fnName' => $fnName,
                'zip' => $zip,
                'param_city_name' => $locationName,
                'param_region_name' => $regionName,
                'short_region_name' => $shortRegionName,
                'short_location_name' => $shortLocationName,
            ];

            $this->logger->error($message, $context);

            throw new Exception(Loc::getMessage("LIST_CITIES_IS_EMPTY"));
        }

        //TODO �������� �������� � �������� � ������� ������

        if(count($locationList) == 1){

            $result = $locationList[0];

        } else {

            $result = $this->selectLocationIfPlacesMany($locationList, $shortLocationName, $shortRegionName, $zip);

        }


        $fnName = 'locationKLADR';


        $message = Loc::getMessage('SPRINTF_CITY_RESULT_IN_LOGGER');


        $context = ['city_list' => json_encode($locationList, JSON_UNESCAPED_UNICODE),
            'fnName' => $fnName,
            'zip' => $zip,
            'param_city_name' => $locationName,
            'param_region_name' => $regionName,
            'short_region_name' => $shortRegionName,
            'short_location_name' => $shortLocationName,
            'dl_city' => json_encode($result, JSON_UNESCAPED_UNICODE)
        ];


        $this->logger->debug($message, $context);

        return $result;

    }



    public function selectLocationIfPlacesMany($locationList, $shortLocationName, $shortRegionName, $zip = false){

        //������ �������� ������� �������� �� ������� ������ �������� ������ ������� �� api.
        //��������� ���������� ��������� �� ������.
        $poolPlaces = [];


        foreach ($locationList as $location){

            $itemLocationName = mb_strtolower($location->searchString);
            $isRegionEqual = $this->checkEqual(trim($shortRegionName), trim($location->region_name));
            $isLocationEqual = $this->checkEqual(trim($itemLocationName), trim($shortLocationName));

            if($isLocationEqual && $isRegionEqual){
                $poolPlaces[] = $location;
            }

        }


        if(count($poolPlaces) !== 1){

            foreach ($poolPlaces as $place){

                if($place->postalCode == $zip){
                    $result = $place;
                }

            }

        } else {
            $result = $poolPlaces[0];
        }

        if(empty($result)){


            $fnName = 'locationKLADR';

            $message = Loc::getMessage("ERROR_MESSAGE_MANY_PLACES");

            $context = ['city_list' => json_encode($locationList, JSON_UNESCAPED_UNICODE),
                        'fnName' => $fnName,
                        'zip' => $zip,
                        'short_region_name' => $shortRegionName,
                        'short_location_name' => $shortLocationName,
                        'poolPlaces' => json_encode($poolPlaces, JSON_UNESCAPED_UNICODE),
                        'result' => json_encode($poolPlaces[0], JSON_UNESCAPED_UNICODE)
            ];

            $this->logger->error($message, $context);


            //TODO ��������� �������, ���� � ������ API �� ������� ��� �������.
            // ������ ������� �� ����� ������
            $result = $poolPlaces[0];
        }

        return $result;

    }

    /**
     * ����� ��� ������ ���������� �� ���������
     * ������� ��������� � ���������� �� ���������.
     * @param $shortRegionName
     * @param $regionName
     * @return bool
     */

    public function checkEqual($needly, $haystack){

        //�������� � ������� �������� ������� ��������

        if(strpos(mb_strtolower($haystack), mb_strtolower($needly)) === false){
            return false;
        } else {
            return true;
        }

    }


    public function locationSearch($q){

        $appkey = $this->config->getAppkey();
        $q = str_replace(Loc::getMessage("YO"),Loc::getMessage("YE"), $q);

        //��-��������� ����� 35 ���������
        $bodyRequest = [
            'appkey' => $appkey,
            'q' => $q
        ];

        $response = self::sendCurl(self::$apiUrls['locationKLADR'], json_encode($bodyRequest));



        return json_decode($response)->cities;

    }


    /**
     * ����� ���������� � ������ ����� api ������� �����.
     * @param $query ������ ������� (����� �������� ������)
     * @return mixed
     */

    public static function SearchCity($query)
    {
        // ��������� ������ ������� � ����������.

        $query = str_replace(Loc::getMessage("YO"),Loc::getMessage("YE"),$query);
        $query = str_replace([Loc::getMessage("CITY_G."),Loc::getMessage("CITY_CITY"),
            Loc::getMessage("CITY_GOR.")],'',$query);
        $response = self::sendCurl(self::$apiUrls['citySearch']."?q=".urlencode($query),false,"GET");
        return json_decode($response);
    }


    /**
     * �������� HTTPS ������� � ��� � �������������� curl
     * @param $url URL ����� �������
     * @param $postData ������
     * @param string $method ����� ������� (post �� ���������)
     * @param string $type ��� ������ (json �� ���������)
     * @return mixed ������
     */
    protected static function sendCurl($url,$postData,$method="POST",$type="json"){

        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            if($type){
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/".$type.";"));
            }
            if($postData){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            }
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($curl, CURLOPT_ENCODING ,"");
            $result = curl_exec($curl);

            curl_close($curl);

            return $result;
        }
    }



    /**
     * ����������������� ����� ���������� �� ������������ ������� � ��������� ������ ��� �������.
     * @param $appkey -���� ��� �� ������� �������� �� dellin.ru
     * @param $login - ����� ������� �������� �� dellin.ru
     * @param $password - ������ ������� �������� �� dellin.ru
     * @return mixed
     * @throws Exception
     */
    static function authInDellinSystem($appkey, $login, $password)
    {
        if(isset($appkey)&&isset($login)&&isset($password)){
            $networkQuery = [
                'appkey'    =>  $appkey,
                'login'     =>  $login,
                'password'  =>  $password];
            return self::sendApiRequest('login', $networkQuery);
        } else {
            throw new Exception(Loc::getMessage("EXCEPTION_EMPTY_AUTH_INFO"));
        }
    }

    /**
     * ����� ��� ������� � �������������� ������ � ������ ������.
     * @param $errors - ������ �� API ��������� https://dev.dellin.ru/api/errors/.
     * @throws Exception
     */
    function setErrors($errors){



        if(isset($errors)){
            $this->isError = true;

            foreach ($errors as $error){

                $toStrFields = (isset($error->fields))?Loc::getMessage("FIELD") . json_encode($error->fields):'';
                $toStrValidValues = (isset($error->validValues))?'- validValues:'.json_encode($error->validValues):'';
                $toStrBadValues = (isset($error->badValues))?' - badValues:'.json_encode($error->badValues):'';

                $toStr = '['.$error->code.'] - ['.$error->title.'] - ['.$error->detail.
                    ']  -'.$toStrFields.' '.$toStrValidValues.' '.$toStrBadValues.' '.$error->link;

                $this->errors[] = $toStr;
            }

        } else {
            //TODO �������� ������ � ���. ���������� ������� ������.
            throw new Exception(Loc::getMessage("exception_obj_errors_is_null"));
        }

    }

    /**
     * �������� ��������� �� �������.
     * @return bool
     */
    public function isError(){
        return $this->isError;
    }

    /**
     * ����� ��� ��������� ������ �� �������.
     * @return array
     */
    function getErrors(){
        return $this->errors;
    }



    public function getProduceDatesList()
    {
        $isTerminal = !$this->config->getLoadingData()->isGoodsLoading;
        $prepareDate =($isTerminal)?$this->prepareProduceDateForTerminal():$this->prepareProduceDateForAddress();
        $fnName = ($isTerminal)?'produceDateForTerminal':'produceDateForAddress';

        if(isset($this->config->getLoginData()->appkey)){
            $produceDates = self::sendApiRequest($fnName, $prepareDate->toArray());

            if(isset($produceDates->data->dates) && !empty($produceDates->data->dates)){
                return $produceDates->data->dates;
            } else {

                $this->setErrors($produceDates->errors);
//                var_dump($this->errors);
//                var_dump($prepareDate->toArray());
                throw new Exception(Loc::getMessage("exception_produceDate_error"));
            }
        } else {
            throw new Exception(Loc::getMessage("exception-error-appkey-produceDate"));
        }

    }

    public function getProduceDate()
    {

        return $this->getProduceDatesList()[1];

    }

    /**
     * ����� ������������ ��� ���������� �������� delivery ����� ���������.
     * @return Container
     * @throws Exception
     */
    public function prepareProduceDateForTerminal()
    {

        $body = new Container();
        $appkey = new Field(['appkey', $this->config->getLoginData()->appkey]);
        $requestHandler = new RequestHandler($this->order, $this->config, $this->logger, false, true);
        $delivery = new Field(['delivery', $requestHandler->buildDeliveryData()]);
        $body->add($appkey);
        $body->add($delivery);

        return $body;

    }

    public function prepareProduceDateForAddress()
    {

//        $sessionID = self::authInDellinSystem($this->config->getLoginData()->appkey,
//                                              $this->config->getLoginData()->login,
//                                              $this->config->getLoginData()->password)->sessionID;

        $sessionID = $this->sessionID;

        $body = new Container();
        $appkey = new Field(['appkey', $this->config->getLoginData()->appkey]);
        $sessionIDfield= new Field(['sessionID', $sessionID]);
        $requestHandler = new RequestHandler($this->order, $this->config, $this->logger, false, true);
        $delivery = new Field(['delivery', $requestHandler->buildDeliveryData()]);

        $cargoEntity = new Cargo($this->order, $this->config);
        $cargo = new Field(['cargo',  $cargoEntity->buildFullCargoInfo()]);

        $body->add($appkey);
        $body->add($sessionIDfield);
        $body->add($delivery);
        $body->add($cargo);


        return $body;

    }

    public function sendQueryForCalculator()
    {


        $requestHandler = new RequestHandler($this->order, $this->config, $this->logger, false, false);

        $sessionID = $this->sessionID;

        $fnName = 'calculator';
        $requestHandler->setProduceDate($this->getProduceDate());
        $request = $requestHandler->getRequestData($this->sessionID)->toArray();
        $response = NetworkService::sendApiRequest($fnName, $request);



        if(!isset($response->errors) && $response->metadata->status == 200){

        //    ob_start();
            $currentDate = new DateTime(date('Y-m-d'));
            if($this->config->isGoodsUnloading() == false){
                $arrivalDate = new DateTime ($response->data->orderDates->arrivalToOspReceiver);
            }else{
                $arrivalDate = new DateTime ($response->data->orderDates->derivalFromOspReceiver);
            }

            $result = [
                'price' => $this->calculatePrice($response),
                'days' => $this->dateDifference($currentDate, $arrivalDate),
                'terminals' => (isset($response->data->arrival->terminals))? $response->data->arrival->terminals : null
            ];


            $this->getArrivalTerminals($response);
            $this->handlerLogsForMethods($request, $response, $fnName);

            //ob_end_clean();
            return $result;
        } else {
            $this->setErrors($response->errors);
            $this->handlerLogsForMethods($request, $response, $fnName);
            throw new Exception(Loc::getMessage("NOT_RESPONSE_CALC"));
        }

        return $response;


    }

    public function sendQueryForRequest($isOrder, $produceDate)
    {

        $requestHandler = new RequestHandler($this->order, $this->config, $this->logger, true, $isOrder);

        $requestHandler->setProduceDate($produceDate);

        $sessionID = $this->sessionID;

        $fnName = 'request';
        $request = $requestHandler->getRequestData($sessionID)->toArray();

        $response = NetworkService::sendApiRequest($fnName, $request);


        if(!isset($response->errors) && $response->metadata->status == 200){


            $result = [
                'state'=> $response->data->state,
                'data' => ['trackingID' => $response->data->requestID,
                    'dateCreateDocument' => $response->metadata->generated_at
                ]
            ];


            $this->getArrivalTerminals($response);
            $this->handlerLogsForMethods($request, $response, $fnName);


            return $result;
        } else {

            $this->setErrors($response->errors);
            $this->handlerLogsForMethods($request, $response, $fnName);

            throw new Exception(Loc::getMessage("exception-error-success-open-console"));
        }

        return $response;

    }


    public static function getShipmentStatus($appkey, $tracking_id){

        $query = ['appkey' => $appkey, 'docid'=>$tracking_id];

        $fnName = 'tracker';
        return self::sendApiRequest($fnName, $query);



    }


    public function getArrivalTerminals($response){
        if(!$this->config->isGoodsUnloading()){
            $_SESSION['terminals'] = $response->data->arrival->terminals;
        }
    }

    private function calculatePrice($data)
    {
        if ($data->data->price > 0) {
            $total_price = $data->data->price;
        }

        return $total_price;
    }


    /**
     * ������� ����� ������
     * @param $date_1
     * @param $date_2
     * @param string $differenceFormat
     * @return string
     */
    public function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $interval = date_diff($date_1, $date_2);

        return $interval->format($differenceFormat);

    }



    private function handlerLogsForMethods($request, $response, $fnName)
    {
        if($this->isError()){
            $message = Loc::getMessage("ERROR_METHOD_IS_NOT_RUN").PHP_EOL.
                Loc::getMessage("METHOD_IS").PHP_EOL.
                Loc::getMessage("ERRORS_IN_RESPONSE").PHP_EOL.'{errors}'.PHP_EOL;
            $context = ['errors' => json_encode($this->getErrors(), JSON_UNESCAPED_UNICODE),
                'fnName'=> $fnName];
            $this->logger->error($message, $context);
        }

        $message = Loc::getMessage("EXCECUTE_METHOD").PHP_EOL.
            Loc::getMessage("BODY_REQUEST").PHP_EOL.'{request}'.PHP_EOL.
            Loc::getMessage("BODY_RESPONSE").PHP_EOL.'{response}'.PHP_EOL;
        $context = ['request' => json_encode($request, JSON_UNESCAPED_UNICODE),
            'fnName' => $fnName,
            'response' => json_encode($response, JSON_UNESCAPED_UNICODE)];
        $this->logger->debug($message, $context);

    }


    public static function getAllTerminalsList($data){

        return self::sendApiRequest('requestTerminal', $data);

    }


    /**
     * ��������� ������ ���������� (������ ������ ���������, ���� ���� ID)
     * @param array $apiKey ���� API
     * @param bool|string $cityKladr ����� ������
     * @param bool|int $terminalId ID ���������
     * @return array
     */
    public static function GetTerminals($apiKey, $cityKladr=false, $terminalId=false){
        //$result = json_decode(self::sendCurl(self::$apiUrls['terminalsList'],json_encode(array('appkey'=>$apiKey))));
        $result = self::sendApiRequest('terminalsList',array('appkey'=>$apiKey));
        $url = $result->url;
        $hash = $result->hash;

        $obCities = self::getObCities($hash, $url);

            if(!$cityKladr){ //���� ������� ������� ��� ���������� - ������ ��� ��������� �� ���� �������
                $arTerminalsByCities = array();
                foreach($obCities->city as $city){
                    $terminalsObs = $city->terminals->terminal;
                    $arTerminals = array();
                    foreach($terminalsObs as $key=>$terminalOb){
                        $arTerminals[$terminalOb->id] = $terminalOb;
                    }
                    $cityData = array(
                        'cityName' => $city->name,
                        'cityID' => $city->cityID,
                        'terminals' => $arTerminals
                    );
                    $arTerminalsByCities[$city->code] = $cityData;
                }
                $arTerminalsList = $arTerminalsByCities;
            }elseif($cityKladr && !$terminalId){
                foreach($obCities->city as $city){
                    if($city->code == $cityKladr){
                        $cityData = array(
                            'cityName'  => $city->name,
                            'cityID'    => $city->cityID,
                            'cityKladr' => $city->code,
                            'terminals' => $city->terminals->terminal
                        );
                        $arCityTerminals = $cityData;
                        break 1;
                    }
                }
                $arTerminalsList = $arCityTerminals;
            }elseif($cityKladr && $terminalId){
                foreach($obCities->city as $city){
                    //if($city->code == $cityKladr){
                    foreach($city->terminals->terminal as $terminal){
                        if($terminal->id == $terminalId){

                            $terminal->cityName = $city->name;
                            $terminal->cityID = $city->cityID;
                            break 2;
                        }
                    }
                    //}
                }
                $arTerminalsList['terminal'] = $terminal;
            }
            $arTerminalsList['hash'] = $hash;




        return $arTerminalsList;
    }

    public static function getObCities($hash, $url){


        $cache = new \CPHPCache();
        $life_time = 86400*10;
        $cache_path = 'dellin_terminals';


        if($cache->initCache($life_time, $hash, $cache_path )){

            $obCities = $cache->getVars()[$hash];

        } else {

            $obCities = self::sendApiRequest(false,array(),'json','GET',$url);

            if(isset($obCities->city) && !empty($obCities->city)) {

                $cache->startDataCache($life_time, $hash, $cache_path);
                $cache->EndDataCache(
                    array(
                        $hash => $obCities
                    )
                );

            }  else {
                throw new Exception('List with terminals is empty or null.');
            }

        }

        return $obCities;

    }


    public static function getCounteragents($appkey, $login, $password, $flag = false){

        try {

            $sessionID = self::authInDellinSystem($appkey, $login, $password);

            $counteragentsList = [];

            if(isset($sessionID) && $sessionID !== null && !isset($sessionID->errors)){

                $dataForRequest = ['appkey'    =>$appkey ,
                    'sessionID' =>$sessionID->sessionID,
                    'full_info' => true ];



                $response = self::sendApiRequest('requestCounteragents', $dataForRequest);


                if(!$response->errors) {
                    $counterAgents = $response->counteragents;

                    foreach ($counterAgents as $counterAgent) {
                        if ($counterAgent->uid) {
                            $counteragentsList[] = ['uid' => $counterAgent->uid,
                                'name'=> $counterAgent->name
                            ];
                        }
                    }

                    $result = ['counteragents' => $counteragentsList,
                        'session_id'   => $sessionID];

                } else {

                    $result = ['ERRORS'=> $response->errors,
                        'session_id'=> $sessionID];
                }


                return $result;

            }

        } catch (Exception $exception){
            $result = ['ERRORS'=> $exception->getMessage(),
                'ExceptionTrace'=> $exception->getTraceAsString()];
            return $result;
        }


    }


    public static function getOpfData($apikey){

        //�������� ������������ CSV ����� � ����������� �������
        $bodyForRequest = ['appkey' => $apikey];
        $request = self::sendCurl(self::$apiUrls['opfList'],json_encode($bodyForRequest));
        $getUrlCSV = json_decode($request);

        if(isset($getUrlCSV->url)){
            $arrStorage = [];
            //�������� ����
            $opfDataInStringType = self::sendCurl($getUrlCSV->url, array(),"GET", "string");
            //���� ���������� ������ � ���������� � ������
            $rows = explode("\n", $opfDataInStringType);
            $keys = str_getcsv($rows[0]);
            //������������ ���������� ������
            foreach($rows as $num=>$row){
                if($num != 0){
                    $values = str_getcsv($row);
                    $arRow = [];
                    if($values[0]){

                        foreach ($values as $index => $value){
                            $arRow[$keys[$index]] = $value;
                        }
                        $arrStorage['list'][$arRow['uid']] = $arRow;
                    }
                }
            }

            return $arrStorage;

        } else {
            throw new Exception(Loc::getMessage("exception-url-data-is-empty"));
        }

    }

    public static function getCountries($apikey)
    {

        $bodyForRequest = ['appkey' => $apikey];

        $dataCountries = [];

        $getUrlCSV = self::sendApiRequest('countriesList', $bodyForRequest);
        if (!empty($getUrlCSV->url)) {

            $getCountriesDataInStringType = self::sendCurl($getUrlCSV->url, [], "GET", "string");

            $rows = explode("\n", $getCountriesDataInStringType);

            $keys = str_getcsv($rows[0]);

            foreach ($rows as $num => $row) {
                if ($num != 0) {
                    $values = str_getcsv($row);
                    $arRow = [];
                    if ($values[0]) {
                        foreach ($values as $index => $value) {
                            $arRow[$keys[$index]] = $value;
                        }

                        $dataCountries[$arRow['countryUID']] = $arRow;
                    }
                }
            }

            return $dataCountries;

        } else {

            throw new Exception(Loc::getMessage("network_data_is_null"));

        }
    }

    public static function getOpfAndCounty($apikey){


        if(isset($apikey) && !empty($apikey)){

            $getDataOpf = self::getOpfData($apikey);
            $countries = self::getCountries($apikey);

            if(!empty($getDataOpf['list']) && !empty($countries)){

                $dataCountries = [];
                $dataOpf = [];

                foreach ($countries as $country){
                    $dataCountries[] = [
                        'countryName' => $country['country'],
                        'countryUid'  => $country['countryUID']
                    ];
                }

                asort($dataCountries);

                foreach ($getDataOpf['list'] as $id => $opf){
                    $dataOpf[$opf['countryUID']][$opf['uid']] = $opf['name'];
                    asort( $dataOpf[$opf['countryUID']]);
                }

                return [ 'opf'=>$dataOpf,
                    'countries' => $countries];

            } else {

                throw new Exception('');

            }

        } else {

            throw new Exception(Loc::getMessage("network_apikey_undef"));

        }

    }





//    public function getProduceDateForAddress()
//    {
//
//        $prepareDate = $this->prepareProduceDateForAddress();
//        if(isset($this->config->getLoginData()->appkey)){
//            $produceDates = self::sendApiRequest('produceDateForAddress', $prepareDate->toArray());
//            var_dump( $produceDates );
//            die();
//            var_dump($produceDates->errors);
//            if(isset($produceDates->data->dates) && !empty($produceDates->data->dates)){
//                return $produceDates->data->dates;
//            } else {
//                //TODO ����������� ��������� ������ ��� ����� ������.
//                throw new \Exception('�� �������� �������� ������ ��� produceDate. ');
//            }
//        } else {
//            throw new \Exception('�� �������� �������� appkey ��� ��������� produceDate.
//                                    ����� NetworkService->getProduceDateForTerminal');
//        }
//
//
//    }


}
