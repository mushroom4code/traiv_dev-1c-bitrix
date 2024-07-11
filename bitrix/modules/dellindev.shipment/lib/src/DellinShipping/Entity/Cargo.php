<?php

/**
 * ���������������� �������� Cargo. ���������� ��������� ��� ��������.
 * ��������-��������������� ������������� ��� ������ � ��������� ���������� ��� �������� ��������.
 * �������� Cargo ������������ � ������� ��������� produceDate, CalculatorV2, RequestV2.
 * ������� �������� ����� �������� �������� deliveryType ������ ������� �� �����������(��� ���������� ���������).
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */


namespace DellinShipping\Entity;


use Bitrix\Main\DB\Exception;
use DellinShipping\Entity\Config;
use DellinShipping\Entity\Order\Order as Order;
use DellinShipping\NetworkService;


class Cargo
{
    /**
     * ����������
     * @var $quantity
     */
    public $quantity;
    /**
     * ������������ �����
     * @var $maxProductLength
     */
    public $maxProductLength = 0;
    /**
     * ������������ ������
     * @var $maxProductHeight
     */
    public $maxProductHeight = 0;
    /**
     * ������������ ������
     * @var $maxProductWidth
     */
    public $maxProductWidth = 0;
    /**
     * ���������� �����
     * @var $weight
     */
    public $weight = 0;
    /**
     * ������������ ������. ���������� ��� �������� ����� ����� ������.
     * @var $maxSide
     */
    public $maxSide = 0;
    /**
     * ����� ����������� �����.
     * @var $totalWeight
     */
    public $totalWeight = 0;
    /**
     * ����� ����������� �����.
     * @var $totalVolume
     */
    public $totalVolume = 0;
    /**
     * �������� ������ ���������� ��������� � ������������ �����.
     * ������������ �� �������� placeStricts.
     * @var $oversizedVolume
     */
    public $oversizedVolume = 0;
    /**
     * �������� ����� ���������� ��������� � ������������ �����.
     * ������������ �� �������� placeStricts.
     * @var $oversizedWeight
     */
    public $oversizedWeight = 0;
    /**
     * �������� ������������ ������.
     * ��������� 255 ���������.
     * @var $freightName
     */
    public $freightName='';


    /**
     * �������� ����������� ��� ��������� ����������� ��������.
     * ����� � ������. ����� � ��. ����� ������� ��������� ����.
     * @var array
     */

    private $globalStricts = [
        'length'=>13.6,
        'width_height'=>2.4,
        'totalVolume' => 80,
        'totalWeight' => 20000
    ];

    /**
     * �������� ����������� ��� ��������� ��������� ����� �������� ��� �� ��������.
     * ����� � ������. ����� � ��. ����� ������� ��������� ����������� �����.
     * ���� ���� - ��� �� ������� � �� ������ �������� � ������ ��������� oversizedWeight � oversizedVolume.
     * @var array
     */
    private $placeStricts = [
        'length' => 3,
        'width_height'=>3,
        'totalVolume'=>27,
        'totalWeight' => 100
        ];

    /**
     * �������� ����������� ��� ��������� ��������������� �����.
     * ����� � ������. ����� � ��. ����� ������� ��������� ����������� �����.
     * ������ �� �������� deliveryType ��������� ����� �������� ��� � ������.
     * @var array
     */

    private $smallStricts = [
        'length' => 0.54,
        'width_height'=>0.39,
        'totalVolume'=>0.1,
        'totalWeight' => 30
        ];


    /**
     * ������ �������� ���������.
     * @var Order  - �������� ������
     * @var Config - �������� �������.
     */
    private Order $order;
    private Config $config;

    public $deliveryType = 'auto';


    function __construct(Order $order, Config $config)
    {
        $this->config = $config;
        $this->order = $order;

        $this->changeProductsWithEmptyDemensionsAndWieght($this->order->products);
        $this->setMaxDemensions();
        $this->changeDeliveryType();
    }

    function changeProductsWithEmptyDemensionsAndWieght(&$products){

        foreach ($products as $product){
            if(empty($product->length) && $this->config->isUseDefaultDemension()){
                $product->setLength($this->config->getDefaultLenght(), $product->getUnitDemensions());
            }

            if(empty($product->width) && $this->config->isUseDefaultDemension()){
                $product->setWidth($this->config->getDefaultWidth(), $product->getUnitDemensions());
            }

            if(empty($product->height) && $this->config->isUseDefaultDemension()){
                $product->setHeight($this->config->getDefaultHeight(), $product->getUnitDemensions());
            }

            if(empty($product->weight) && $this->config->isUseDefaultDemension()){
                $product->setWeight($this->config->getDefaultWeight(), $product->getUnitWeight());
            }
        }

    }

    /**
     * ���������� ��������� ����� ������� � ���������� ����� ��������������.
     */

    public function setMaxDemensions(){


        $products = $this->order->products;

        /**
         * ���������� ����� ������� �������� ��� ��������� ����������� ��������.
         *
         */

        foreach($products as $index=>$product){


            if($product->length > $this->maxProductLength) $this->maxProductLength = $product->length;
            if($product->height > $this->maxProductHeight) $this->maxProductHeight = $product->height;
            if($product->width  > $this->maxProductWidth) $this->maxProductWidth = $product->width;
            if($product->weight > $this->weight) $this->weight = $product->weight;
            // ---Start---
            // ������� �� �������� �.�. �� ������������ ���� ��� ������������� ���������.
            $this->totalWeight += $product->weight*$product->quantity;
            $this->totalVolume += $product->length * $product->height * $product->width * $product->quantity;


            // ---END---
            $this->freightName .= (($index != 0) ? ',' : '') . $product->name;
        }

    }

    /*
     * ������ ����������� ����������.
     */
    public function buildOversize($product){

        $stricts = $this->placeStricts;
        $volume = $product->length * $product->height * $product->width;
        if($product->length >= $stricts['length'] || $product->width >= $stricts['width_height']
            || $product->height >= $stricts['width_height']  || $product->weight >= $stricts['totalWeight']
            || $volume >= $stricts['totalVolume']) {
            $this->oversizedWeight += $product->weight*$product->quantity ;
            $this->oversizedVolume += $volume * $product->quantity;
        }

    }



    /**
     * ����� ����� ��� ��������� ������.
     * ��������� ��� ��������� ��������� � stricts �������� ������.
     * @param $stricts
     * @return bool
     */
    public function productOversizeValidation($stricts){
        //�����: ����� � STRICTS ������ ���� ��������� ����� ������� ��������� ������� (13.6� ��� ����, � �������).
        //������� �� ������ ����� � ���������, ����� �� ������� ��� � ���� ��� ���� � � ���������.
        // ���� ���, ������ ������ �� �������
        $length = $this->maxProductLength;
        $width = $this->maxProductWidth;
        $height = $this->maxProductHeight;
        $totalWeight = $this->totalWeight;
        $totalVolume = $this->totalVolume;
        if($totalWeight >= $stricts['totalWeight']) return false;
        if($totalVolume >= $stricts['totalVolume']) return false;

        //���� ����� ������ �� ����/���������� �� ����� ������� ������� ('length'), �� ���� � ��������� ���� �� �������
        if($length > $stricts['length'] || $width > $stricts['length']
            || $height > $stricts['length']){
            return false;
        }
        $isOversized = true;
        //���� ��� ������� ������ ������������ �������� ����� �������, �� ����� ����������.
        // ���� ���� ������� ������ ������������ �������� (�� ������ stricts['length']),
        // �� 2 ��������� �� ����� ���� ������ ������������ ��������, ������� ������ ����� �� ���� ���� ����������.
        // ���� ������� ����� ���������, ��� ����� �� �������� �� ���������, ������ ����� ����������.
        if(
            ($length <= $stricts['width_height'] && $length <= $stricts['width_height'] && $height<= $stricts['width_height'])||
            ($length > $stricts['width_height'] && $width <= $stricts['width_height'] && $height <= $stricts['width_height']) ||
            ($width > $stricts['width_height'] && $length <= $stricts['width_height'] && $height <= $stricts['width_height']) ||
            ($height > $stricts['width_height'] && $length <= $stricts['width_height'] && $width <= $stricts['width_height'])
        ){
            $isOversized = false;
        }
        if($isOversized) return false;

        //�� ����� ���� ��������, ���� ����� ���/����� ������� ����������� � ����/����������
        // � ����� ����� �������� ���, ����� �� �� ������� �� ����/����������,
        // ������ �� ����������
        return true;
    }


    /**
     * �������������� ������ ��� �������� �������� Cargo
     */
    protected function prepareCargoData()
    {

        $products = $this->order->products;
        //���������� ��������� �� ���������� ���������� ���.

        /*
         * ������������ ��������� ����� ������ �� ���������� ��������� �����.
         */
        switch ($this->config->getCargoParams()->loadingGroupingOfGoods) {
            //���� ���� ����� � ���� ����������
            case 'ONE_CARGO_SPACE':
                $this->quantity  = 1;
                foreach($products as $product){
                    $this->buildOversize($product);
                }
                break;
            // ���� ���������� ������ ��� ������, ��� ��������� ����������.
            case 'SEPARATED_CARGO_SPACE':
                $this->quantity = count($products);

                foreach($products as $product){
                    $this->buildOversize($product);
                }

                break;
            // ���� ������ ������� ������ - ��������� ����������.
            case 'SINGLE_ITEM_SINGLE_SPACE':

                foreach ($products as $product) {
                    $this->buildOversize($product);
                    $this->quantity += $product->quantity;
                }

                break;
            default :
                throw new \Exception(Loc::getMessage("METHOD_GROUPING_IS_UNDEF"));
                break;
        }
    }


    /**
     * �����, ������� �������� �� �������� ����� ������ ������������ �����.
     *
     */
    public function switchToValidLWH()
    {
       // �.�. ����� - ��� �������� �������� ����� ������, ��������� ��� �� ���c��������.

        $this->maxSide = $this->maxProductLength;
        if($this->maxProductWidth > $this->maxProductLength){
            $this->maxSide = $this->maxProductWidth;
            $this->maxProductWidth = $this->maxProductLength;
            $this->maxProductLength = $this->maxSide;
        }

        if($this->maxProductHeight > $this->maxProductLength){
            $this->maxSide = $this->maxProductHeight;
            $this->maxProductHeight = $this->maxProductLength;
            $this->maxProductLength = $this->maxSide;
        }
    }



    public function changeDeliveryType(){

        if($this->config->isSmallGoods()){
            return ;
        }

        $terminalsInDerivalPoint = NetworkService::GetTerminals($this->config->getAppkey(),
                                                            $this->config->getKladrCodeDeliveryFrom(), false)['terminals'];
        $terminalsInArrivalPoint = NetworkService::GetTerminals($this->config->getAppkey(),
                                                            $this->order->person->getKLADRToArrival(), false)['terminals'];

        $isTerminalsInCityDerival = (is_array($terminalsInDerivalPoint))? (count($terminalsInDerivalPoint) > 0) : false;

        $isTerminalsInCityArival = (is_array($terminalsInArrivalPoint)) ? (count($terminalsInArrivalPoint) > 0) : false;

        $isTerminalsInCities = $isTerminalsInCityDerival && $isTerminalsInCityArival;


        if(self::productOversizeValidation($this->smallStricts) && $this->config->isSmallGoods()
            && $this->config->isGoodsUnloading() && $this->config->isGoodsLoading() && $isTerminalsInCities){

            $this->deliveryType = 'small';

        }
    }

    /**
     * ����� ����������� ��������� ����������� ������ ��� ��������.
     * ������������ ��� �������� ��������� ��� ����������� ���������� ��� �������� �������� Cargo.
     * @return array
     * @throws \Exception
     */
    public function buildFullCargoInfo()
    {

        if(self::productOversizeValidation($this->globalStricts)){

            $this->prepareCargoData();
            $this->switchToValidLWH();

            if(empty($this->weight) || empty($this->totalVolume) || empty($this->totalWeight)
                || empty($this->maxProductLength) || empty($this->maxProductWidth) || empty($this->maxProductHeight)){
                throw new \Exception('Cargo is not valid');
            }

            $result = [
                'quantity'          =>$this->quantity,
                'length'            =>(floatval($this->maxProductLength) < 0.01)?
                                       0.01 : round($this->maxProductLength,2),
                'width'             =>(floatval($this->maxProductWidth) < 0.01)?
                                       0.01 : round($this->maxProductWidth,2),
                'height'            =>(floatval($this->maxProductHeight) < 0.01)?
                                       0.01 : round($this->maxProductHeight,2),
                'weight'            =>(floatval($this->weight) < 0.01)?
                                       0.01 : round($this->weight, 2),
                'totalVolume'       =>(floatval($this->totalVolume) < 0.01)?
                                       0.01 : round(floatval($this->totalVolume),2),
                'totalWeight'       =>(floatval($this->totalWeight) < 0.01)?
                                       0.01 : round(floatval($this->totalWeight),2),
                'insurance'         => [
                    'statedValue'   => ($this->config->isInsuranceGoodsWithDeclarePrice())?
                              $this->order->orderData->order_total_price - $this->order->orderData->order_shipping_cost : 0,
                    'payer'         => ($this->order->orderData->isCashOnDelivery)? 'receiver' : 'sender',
                    'term'          => false
                ],
                'freightUID'    => '0xa4a904cf9927043442973c854c077430'
            ];

            $oversizedWeight = ['oversizedWeight' =>($this->oversizedWeight < 0.01)?
                                0.01:round(floatval($this->oversizedWeight), 2)];
            $oversizedVolume = ['oversizedVolume' => ($this->oversizedVolume < 0.01)?
                                0.01:round(floatval($this->oversizedVolume), 2)];

            if(!empty($this->oversizedVolume) || !empty($this->oversizedWeight)){
               $result =  array_merge($result, $oversizedWeight, $oversizedVolume);
            }


            return $result;
        } else {
            throw new \Exception(Loc::getMessage("CARGO_IS_NOT_VALID"));
        }
    }




}