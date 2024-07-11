<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$i = 0;
    foreach($arResult["SEARCH"] as $cell=>$arElement){
        $res = CIBlockElement::GetProperty(7, $arElement["ITEM_ID"], array("sort" => "asc"), Array("CODE"=>"TYPE_ARTICLES"));
        
        if($ar_props = $res->GetNext())
           $FORUM_TOPIC_ID = $ar_props["VALUE_ENUM"];
            else
                $FORUM_TOPIC_ID = false;
        
        $arResult["SEARCH"][$i]["TYPE_ARTICLES"] = $FORUM_TOPIC_ID;
        $i++;
    }
?>