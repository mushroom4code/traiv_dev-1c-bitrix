<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//$i=0;

/*echo "<pre>";
print_r($arResult["ITEMS"]);
echo "</pre>";*/
$arrCheck = [];
$i = 0;
foreach($arResult["ITEMS"] as $cell=>$arElement)
{
   /* echo "<br>";
    echo $arElement["ID"];
    echo $arElement["PROPERTIES"]["ART_JOIN"]["VALUE_ENUM_ID"];*/
    
    $arrCheck[$i]['id'] = $arElement["ID"];
    $arrCheck[$i]['aj'] = $arElement["PROPERTIES"]["ART_JOIN"]["VALUE_ENUM_ID"];
    $i++;
}
/*echo "<pre>";
print_r($arrCheck);
echo "</pre>";*/

$j = 0;
$numArray = count($arResult["ITEMS"]);
foreach($arResult["ITEMS"] as $cell=>$arElement)
{
    /*echo "<pre>";
    print_r($arElement["PROPERTIES"]["TYPE_GRID"]["VALUE"]);
    echo "</pre>";*/
    if ($j != 0 && $j != $numArray){
        
        $prev = $arrCheck[$j-1]['aj'];
        $next = $arrCheck[$j+1]['aj'];
        //echo "prev ".$prev." next ".$next." ID ".$arElement["ID"];
    }
    
    if (empty($prev) && !empty($next) && $next == '17822'){
        //добавляем, если блок с Объединением с следующей идет следом на текущей
        $arResult["ITEMS"][$j]["H_CHECK"] = ['CHECK'=>'1'];
    }
    
    if (empty($next) && !empty($prev) && $prev == '17821'){
        //добавляем, если блок с Объединением с следующей идет следом на текущей
        $arResult["ITEMS"][$j]["H_CHECK"] = ['CHECK'=>'1'];
    }
    
    
    
   /* 
    $res = CIBlockElement::GetByID($arElement["ID"]);
    if($ar_res = $res->GetNext())
        $ar_res_hundred = $ar_res['SHOW_COUNTER'] + 100 + $_SESSION['counter']++;
        //["SHOW_COUNTER"] = $ar_res_hundred;
        $arResult["ITEMS"][$i] = array("SHOW_COUNTER" => $ar_res_hundred);
        echo $arResult["ITEMS"][$arElement["ID"]];
        echo $ar_res["ID"];
        
        echo "<pre>";
        print_r($ar_res);
        echo "</pre>";
        
        echo "<br>";
        $i++;*/
    $j++;
}



?>