<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$obCache = new CPHPCache();
$cacheLifetime = 86400; $cacheID = 'traiv_filter_form'; $cachePath = '/'.$cacheID;
if( $obCache->InitCache($cacheLifetime, $cacheID, $cachePath) )
{
    $vars = $obCache->GetVars();
    $arResult = $vars['result'];
}
elseif( $obCache->StartDataCache()  )
{
    CModule::IncludeModule("iblock");

    // Получим вид крепежа
    $arResult["VID_KREPEWA"] = array();
    $arFilter = array("SECTION_ID" => 106, "ACTIVE" => "Y");
    $db_list = CIBlockSection::GetList(array("NAME"=>"ASC"), $arFilter);
    while($arRes = $db_list->GetNext())
    {
        $arResult["VID_KREPEWA"][$arRes["ID"]] = $arRes["NAME"];
    }

    // Получим госты
    function getPropGost() {
        $arRes = array();
        $propMaterial = array("STANDART_BOLTY", "STANDART_VINTI");
        foreach ($propMaterial as $code) {
            $propEnums = CIBlockPropertyEnum::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID" => 18, "CODE" => $code));
            while($enumFields = $propEnums->GetNext())
            {
                $arRes[$enumFields["ID"]] = $enumFields["VALUE"];
            }
        }
        return $arRes;
    }
    $arResult["GOST"] = array_unique(getPropGost());
    asort($arResult["GOST"]);

    // Получим материал
    function getPropMaterial() {
        $arRes = array();
        $propMaterial = array("MATERIAL", "MATERIAL_VINTI", "MATERIAL_BOLTY");
        foreach ($propMaterial as $code) {
            $propEnums = CIBlockPropertyEnum::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID" => 18, "CODE" => $code));
            while($enumFields = $propEnums->GetNext())
            {
                $arRes[$enumFields["ID"]] = $enumFields["VALUE"];
            }
        }
        return $arRes;
    }
    $arResult["MATERIAL"] = array_unique(getPropMaterial());
    asort($arResult["MATERIAL"]);

    // Получим покрытие
    function getPropPokrytie() {
        $arRes = array();
        $propMaterial = array("POKRITIE_VINTI", "POKRYTIE_BOLTY", "POKRYTIE");
        foreach ($propMaterial as $code) {
            $propEnums = CIBlockPropertyEnum::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID" => 18, "CODE" => $code));
            while($enumFields = $propEnums->GetNext())
            {
                $arRes[$enumFields["ID"]] = $enumFields["VALUE"];
            }
        }
        return $arRes;
    }
    $arResult["POKRYTIE"] = array_unique(getPropPokrytie());
    asort($arResult["POKRYTIE"]);
    
    $obCache->EndDataCache(array('result' => $arResult));
}





$arResult["SELECT"]["VID"] = intval($_REQUEST["vid"]);
$arResult["SELECT"]["GOST"] = intval($_REQUEST["gost"]);
$arResult["SELECT"]["MATERIAL"] = intval($_REQUEST["material"]);
$arResult["SELECT"]["POKRYTIE"] = intval($_REQUEST["pokrytie"]);
$arResult["SELECT"]["DIAMETR"] = htmlspecialchars($_REQUEST["diametr"]);
$arResult["SELECT"]["DLINA"] = htmlspecialchars($_REQUEST["dlina"]);

$this->IncludeComponentTemplate();