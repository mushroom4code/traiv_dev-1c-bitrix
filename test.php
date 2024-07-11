<?php
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('sale');
use Bitrix\Sale;
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
       /* echo $pseudoId = rand(10000000000, 11000000000);
        $arFields = array(
            "PRODUCT_ID" => $pseudoId,
            "PRODUCT_PRICE_ID" => '2',
            "PRICE" =>  '100',
            "CURRENCY" => "RUB",
            "WEIGHT" => '',
            "QUANTITY" => 1,
            "DELAY" => "N",
            "CAN_BUY" => "Y",
            "NAME" => 'fff'. $pseudoId,
            "CALLBACK_FUNC" => "",
            "MODULE" => "",
            "NOTES" => "",
            "ORDER_CALLBACK_FUNC" => "",
            "DETAIL_PAGE_URL" => ""
        );
        $arProps = array();
        echo "<pre>";
            print_r($arProps);
        echo "</pre>";
        $arFields["PROPS"] = $arProps;
        echo "<pre>";
            print_r($arFields);
        echo "</pre>";
        CSaleBasket::Add($arFields);*/
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $item = $basket->createItem('catalog', rand(10000000000, 11000000000));
        $item->setFields([
            'QUANTITY' => 1,
            'CURRENCY' => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID' => Bitrix\Main\Context::getCurrent()->getSite(),
            'NAME' => 'Абракадабра',
            'PRICE' => '1',
            'CUSTOM_PRICE' => 'Y',
            'BASE_PRICE' => '1',
            'CAN_BUY' => 'Y',
            'WEIGHT' => 7.40
        ]);
        $basket->save();
        
        echo "<pre>";
            print_r($basket);
        echo "</pre>";
        
        
        if (CModule::IncludeModule("sale"))
        {
            CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
        }
        die;
   
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => '385408', 'ACTIVE'=>'Y' ,  array(), 'CATALOG_GROUP_ID' => 2], false, false, Array("*","CATALOG_PRICE_2","PROPERTY_624","PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "PROPERTY_417"));
        
        echo $db_list_in->SelectedRowsCount();
        
        if ( $db_list_in->SelectedRowsCount() > 0 ){
            while($item = $db_list_in->GetNext())
            {
                echo "<pre>";
                    print_r($item);
                echo "</pre>";
            }
        }
        
        die;
        
        $arSelect = Array("ID", "NAME", "XML_ID", "PROPERTY_1081");
        $arSort = array('NAME'=>'ASC');
        
        $arFilter = array('IBLOCK_ID' => 22, 'ACTIVE'=>'Y', "!PROPERTY_1081_VALUE"=>false);
        
        $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
        
        if ( $res->SelectedRowsCount() > 0 ){
        echo "<table border='1'>";
        $i=1;
        while($ar_result_in = $res->GetNext())
        {
            $rsFile = CFile::GetPath($ar_result_in['PROPERTY_1081_VALUE']);
            echo "<tr>";
            echo "<td>".$ar_result_in['ID']."</td>";
            echo "<td>".$ar_result_in['NAME']."</td>";
            echo "<td>".$ar_result_in['PROPERTY_1081_VALUE']."</td>";
            echo "<td>".$rsFile."</td>";
            echo "</tr>";
            /*echo "<pre>";
                print_r($ar_result_in);
            echo "</pre>";
            
            
            echo "<pre>";
            print_r($rsFile);
            echo "</pre>";*/
            
        }
        }
        echo "</table>";
        die;
        
        
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, /*'SECTION_ID' => '955','ID' => '271296','PROPERTY_YMARKET' => '16991',,*/ 'ACTIVE'=>'Y'/*,  array(
            "LOGIC" => "AND",
            ">CATALOG_QUANTITY" => 0, ">CATALOG_PRICE_2" => 0 ), 'CATALOG_GROUP_ID' => 2*/], false);
        echo "<table border='1'>";
        $i=1;
        while($ar_result_in = $db_list_in->GetNext())
        {
            
            $db_groups = CIBlockElement::GetElementGroups($ar_result_in['ID'], true);
            $res_rows = intval($db_groups->SelectedRowsCount());
            
            if ($res_rows == 0) {
                echo "<tr>";
                echo "<td align='left'>";
                echo $i;
                echo "</td>";
                
                echo "<td align='left'>";
                echo $ar_result_in['ID'];
                /*$db_groups = CIBlockElement::GetElementGroups($ar_result_in['ID'], true);
                 echo $res_rows = intval($db_groups->SelectedRowsCount());*/
                echo "</td>";
                echo "<td align='left'>";
                //echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
                echo $ar_result_in['DETAIL_PAGE_URL'];
                echo "</td>";
                echo "</tr>";
                
                /* echo "<pre>";
                 print_r($ar_result_in['DETAIL_PAGE_URL']);
                 echo "</pre>";*/
                
                // $obEl = new CIBlockElement();
                // $boolResult = $obEl->Update($ar_result_in['ID'],array('ACTIVE' => 'N'));
                
                //die;
                $i++;
            }
            
            /* while($ar_group = $db_groups->Fetch()) {
             echo "<pre>";
             print_r($ar_group['NAME']);
             echo "</pre>";
             }*/
            
            // die;
            /*echo "<pre>";
             print_r($ar_result_in['NAME']);
             echo "</pre>";*/
            
            
        }
        
        echo "</table>";
        
    }
}

die;

$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'PROPERTY_YMARKET' => '16991', 'ACTIVE'=>'Y'], false,Array("nTopCount" => 1));

echo intval($db_list_in->SelectedRowsCount());
//die;
while($ar_result_in = $db_list_in->GetNext())
{
    
    echo "<pre>";
        print_r($ar_result_in);
    echo "</pre>";
    
    /*echo "<tr>";
    echo "<td align='left'>";
    echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
    echo "</td>";
    echo "</tr>";*/
}

die;
$idIBlock = 54;

$arFilter = array(
    'IBLOCK_ID' => $idIBlock
);

$rsProperty = CIBlockProperty::GetList(
    array(),
    $arFilter
    );

while($element = $rsProperty->Fetch())
{
    echo "<pre>";
    print_r($element['NAME']);
    echo "</pre>";
}

die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/phpmailer/class.phpmailer.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

die;
$body = '<div class="MessageBody_body_pmf3j react-message-wrapper__body"><div>&nbsp;</div><div style="font-size:18px;">Добрый день.<br></div><div><div><div style="font-size:18px;">Дублируем в Ваш адрес, ранее запрошенные документы.</div></div><div>&nbsp;</div><div>&nbsp;</div><div><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">С уважением,</span></p><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">Юлия Комкина</span></p><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">Менеджер по закупкам бюро НХП, РВС и комплектации</span></p><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">Коммерческая дирекция</span></p><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">АО «Рузхиммаш»</span></p><table border="0" cellpadding="0" cellspacing="0" style="background-color:rgb( 255 , 255 , 255 );border-collapse:collapse;color:rgb( 26 , 26 , 26 );font-family:"ys text" , "arial" , sans-serif;font-size:16px;font-style:normal;font-weight:400;margin-left:-7.35pt;text-decoration-color:initial;text-decoration-style:initial;text-transform:none;white-space:normal;word-break:normal;word-spacing:0px"><tbody><tr><td width="142" style="border-right-color:windowtext;border-style:none solid none none;border-width:medium 1pt medium medium;padding:0cm 5.4pt 0cm 5.4pt;width:106.35pt"><p align="center" style="font-family:"calibri" , sans-serif;font-size:11pt;margin:0cm;text-align:center"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt"><img alt="РМ Рейл Рузхиммаш" height="29" src="https://traiv-komplekt.ru//img/image001.png" width="130" style="height:0.302in;width:1.3541in"></span></p></td><td valign="top" width="246" style="padding:0cm 5.4pt 0cm 5.4pt;width:184.25pt"><p style="font-family:"calibri" , sans-serif;font-size:11pt;margin:0cm"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">Тел. IP 633</span></p><p style="font-family:"calibri" , sans-serif;font-size:11pt;margin:0cm"><span style="color:black;font-family:"arial" , sans-serif;font-size:10pt">Сот.&nbsp; 8&nbsp;987&nbsp;<span class="wmi-callto">682 3777</span></span></p><p style="font-family:"calibri" , sans-serif;font-size:11pt;margin:0cm"><span lang="EN-US"><a href="mailto:yuliya.komkina@rmrail.ru" rel="noopener noreferrer" target="_blank">yuliya<span lang="RU">.</span>komkina<span lang="RU">@</span>rmrail<span lang="RU">.</span>ru</a></span></p><p style="font-family:"calibri" , sans-serif;font-size:11pt;margin:0cm"><span style="font-family:"consolas";font-size:10.5pt"><a href="http://www.rmrail.ru/" rel="noopener noreferrer" target="_blank" data-link-id="7"><span style="color:#0563c1;font-family:"arial" , sans-serif;font-size:10pt">www.rmrail.ru</span></a></span></p></td></tr></tbody></table><p style="background-color:rgb( 255 , 255 , 255 );color:rgb( 26 , 26 , 26 );font-family:"calibri" , sans-serif;font-size:11pt;font-style:normal;font-weight:400;margin:0cm;text-decoration-color:initial;text-decoration-style:initial;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px">&nbsp;</p></div></div><div>&nbsp;</div><div>&nbsp;</div></div>';

$email = new PHPMailer();
$email->SetFrom('yuliya.komkina@rmrail.ru', ''); //Name is optional
$email->Subject   = 'Сканы документов';
$email->isHTML();
$email->Body      = $body;
$email->AddAddress( 'nechaeva@traiv.ru' );
$email->AddAddress( 'shulkin@traiv.ru' );

$file_to_attach = $_SERVER['DOCUMENT_ROOT'] . "/img/scan/";

$email->AddAttachment( $file_to_attach , 'Scan_20230523_122203-1.pdf' );
$email->AddAttachment( $file_to_attach , 'Scan_20230523_122203-2.pdf' );
$email->AddAttachment( $file_to_attach , 'Scan_ РХМ КА1122.pdf' );
$email->AddAttachment( $file_to_attach , 'Рузхиммаш 1126.pdf' );


return $email->Send();

die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        /*echo date('Y.m.d', '1262055681');
        echo "<br>";
        echo date('Y.m.d', '1462055681');
        die;*/
        //$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => '56', /*'ID' => array('108365','139529'),*/ 'ACTIVE'=>'Y'/*, 'CATALOG_GROUP_ID' => 2, 'CATALOG_PRICE_2'*/], Array());
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => '55', 'ACTIVE'=>'Y'], false/*, $arSelect = array("UF_COUNTER")*/);
        echo $res_rows = intval($db_list_in->SelectedRowsCount());
        while($item = $db_list_in->GetNext())
        {
            echo "<pre>";
                print_r($item);
            echo "</pre>";
            
            if (isset($item['ID']) && intval($item['ID'])){
                $t = mt_rand(1462055681,time());
                $newDate =ConvertTimeStamp($t, "FULL");
                $elProps = array(
                    "MODIFIED_BY"       => $USER->GetID(),
                    "IBLOCK_ID"         => 55,
                    "ACTIVE_FROM"       => $newDate,
                    "ACTIVE"            => "Y",
                );
                $newEl = new CIBlockElement;
                $res = $newEl->Update($item['ID'], $elProps);
                echo $newDate;
            }
            
            
            /*echo $arPrice = CPrice::GetBasePrice($item['ID']);
            echo "<pre>";
            print_r($arPrice);
            echo "</pre>";*/
            //die;
        }
        
    /*    $db_list_sert = CIBlockSection::GetList(array(), array('IBLOCK_ID'=> 18, 'ID' => 5078), false, array('PROPERTY_SERTIFICAT' => true));
        while($res = $db_list_sert->GetNext())
        {
            echo "<pre>";
            print_r($res);
            echo "</pre>";
        }
      */  
/*
        $db_props = CIBlockElement::GetProperty('7', '299253', "sort", "asc", Array("CODE"=>"GOODS_BLOCK"));
        
        echo $res_rows = intval($db_props->SelectedRowsCount());
        $i = 1;
        while ($ob = $db_props->GetNext()) {
            $arrayItemList .= $ob['VALUE'];
            if ($i != $res_rows){
                $arrayItemList .= ",";
            }
            $i++;
        }
        
        if (!empty($arrayItemList)){
            $arParams['ARRITEMS'] = array_filter(explode(",", $arrayItemList));
        }
        
        print_r($arParams['ARRITEMS']);
*/        
    }
}

?>