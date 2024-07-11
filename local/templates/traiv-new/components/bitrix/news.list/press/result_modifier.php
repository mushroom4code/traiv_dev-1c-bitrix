<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$i = 1;
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $arResult["ITEMS"][$key]["I"] = $i;
    
    if ($arResult["ITEMS"][$key]["PROPERTIES"]["TYPE_TEXT"]["VALUE"] == "СМИ о нас"){
        $year = date('Y', strtotime($arResult["ITEMS"][$key]["ACTIVE_FROM"]));
        $arResult["ITEMS"][$key]["YEAR"] = $year;
        if (strlen($year) == 4){
            $arResult["YEAR_LIST"][] = $year;
        }
    }
    
    $i++;
}

$arResult["YEAR_LIST"] = array_unique($arResult["YEAR_LIST"]);
