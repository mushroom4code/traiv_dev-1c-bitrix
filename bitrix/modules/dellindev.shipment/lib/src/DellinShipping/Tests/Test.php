<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 29.03.21
 * Time: 12:56
 */

namespace DellinShipping\Tests;



use PHPUnit\Framework\TestCase;

class Test extends TestCase
{

    public function testGetValidCity()
    {
        //todo написать метод который проверит корректноть поведения кейса
        // с получением КЛАДР с городом "Бор, Нижегородская область"
    }

    public function testFullRequestBodyForCalculateV2WithDeliveryToTerminal()
    {
        //TODO написать метод который проверит корректность сборки тела запроса для калькулятора до терминала

    $jsonstr = '{"appkey":"111","delivery":{"deliveryType":{"type":"auto"},"arrival":{"variant":"terminal",
    "city":"2300000100000000000000000"},"derival":{"produceDate":"2021-03-05","variant":"address",
    "address":{"search":"Россия, Москва, Кутузовский проспект, д. 18"},"time":{"worktimeStart":"00:00","worktimeEnd":"23:59",
    "breakStart":"12:00","breakEnd":"14:00"}},"packages":[]},"members":{"requester":{"role":"sender"}},
    "cargo":{"quantity":1,"length":0.3,"width":0.1,"height":0.1,"weight":3,"totalVolume":0.003,"totalWeight":3,
    "oversizedWeight":0,"oversizedVolume":0,"freightName":"тестовый товар","deliveryType":"auto",
    "insurance":{"statedValue":119,"payer":"receiver","term":false}},
    "payment":{"paymentCity":"7800000000000000000000000","type":"noncash"},"productInfo":{"type":4,"productType":5,
    "info":[{"param":"module version","value":"beta"}]}}';
    $array = json_decode($jsonstr);

    var_dump($array);

    }

    public function testFullRequestBodyForCalculateV2WithDeliveryToAddress()
    {
        //TODO написать метод который проверит корректность сборки тела запроса до адреса
    }

    public function testFullRequestBodyForCalculateV2WithDeliveryToTerminalAndPackages()
    {
        //TODO написать метод который проверит корректность сборки тела запроса до терминала и упаковок
    }

    public function testFullRequestBodyForCalculateV2WithDeliveryToAddressAndPackages()
    {
        //TODO написать метод который проверит корректность сборки тела запроса до адреса и упаковок
    }

    public function testFullRequestBodyForRequestV2WithDeliveryToAddress()
    {

    }

    public function testFullRequestBodyForRequestV2WithDeliveryToTerminal()
    {

    }


    public function testFullRequestBodyForRequestV2WithCashOnDelivery()
    {
        //TODO описать метод, который проверит поведение кейса с получением "Наложного платежа"
        // для информации

    }

    public function testFullRequestBodyForRequestV2NonCashOnDelivery()
    {

    }

    public function testFullRequestBodyForRequestV2WithOversizeCase()
    {

    }

    public function testFullRequestBodyForCalculateV2WithOversizeCase()
    {

    }






}
