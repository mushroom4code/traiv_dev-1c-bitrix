<?php
\Bitrix\Main\Loader::includeModule('dev2fun.opengraph');
\Dev2fun\Module\OpenGraph::Show($arResult['ID'],'section');

$this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys,
    array('TIMESTAMP_X', 'UF_CANONICAL')
);

?>
<?php
/*
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        echo "<pre>";
        echo "PAGE_CURRENT";
        echo count($arResult['ITEMS']);
        $arParams['PAGE_ELEMENT_COUNT'] = '25';
        print_r($arParams['PAGE_CURRENT']." // ".$arParams['PAGE_ELEMENT_COUNT']);
        
        echo "</pre>";
        foreach ($arResult['ITEMS'] as $key => $item){
            print_r($item['PRICES']['BASE']['VALUE']);
            echo $key;
            if ($item['PRICES']['BASE']['VALUE'] == '0' && empty($arParams['PAGE_CURRENT'])){
                unset($arResult['ITEMS'][$key]);
                echo "sadf";
            }
            echo "<br>";
        }
        
        usort($arResult['ITEMS'], function($a, $b) {
            $a = $a['PRICES']['BASE']['VALUE'];
            $b = $b['PRICES']['BASE']['VALUE'];
        
        
            if ($a == $b) {
                return 0;
            } elseif (($a < $b)) {
                return empty($a) ? 1 : -1;
            } else {
                return empty($b) ? -1 : 1;
            }
        });
        
            foreach ($arResult['ITEMS'] as &$item){
                print_r($item['PRICES']['BASE']['VALUE']);
                echo "<br>";
            }
        
    }
}*/

//usort($arResult['ITEMS'], function($a, $b) {
//    $a = $a['PRICES']['BASE']['VALUE'];
//    $b = $b['PRICES']['BASE']['VALUE'];
//
//
//    if ($a == $b) {
//        return 0;
//    } elseif (($a < $b)) {
//        return empty($a) ? 1 : -1;
//    } else {
//        return empty($b) ? -1 : 1;
//    }
//});
foreach ($arResult['ITEMS'] as &$item){
    $dbSection = CIBlockElement::GetList(Array(), array("ID" => $item["ID"], "IBLOCK_ID" => $item["IBLOCK_ID"]), false ,Array("UF_CANONICAL"));
    
    if($arSection = $dbSection->GetNext()){
        $item['CANONICAL_PAGE_URL'] = $arSection['CANONICAL_PAGE_URL'];
    }
}
$arResult["ITEMS"] = rewriteUrl($arResult["ITEMS"]);