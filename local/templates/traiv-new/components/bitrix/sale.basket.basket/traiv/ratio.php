<?
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');

$GetImg = '';
$arResponce = array();

$arSelect = Array("ID", "NAME", "DETAIL_PICTURE", "IBLOCK_SECTION_ID","PROPERTY_CML2_ARTICLE");
$arSort = array('NAME'=>'ASC');
$arFilter = array('IBLOCK_ID' => "18", 'ID' => $_POST['id']);
$res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
if (!empty($res)) {
    while ($ar_fields = $res->GetNext()) {
        
        if (!empty($ar_fields['PROPERTY_CML2_ARTICLE_VALUE'])){
            $art = $ar_fields['PROPERTY_CML2_ARTICLE_VALUE'];
        }
        
        if (!empty($ar_fields['DETAIL_PICTURE'])){
            $GetImg  = $ar_fields['DETAIL_PICTURE'];
        }else{

            $foo = CIBlockSection::GetList(array('NAME' => 'ASC'), array('IBLOCK_ID' => "18", 'ID' => $ar_fields["IBLOCK_SECTION_ID"]), false, false, Array("ID", "NAME", "DETAIL_PICTURE", "PICTURE"));
            $bar = $foo -> GetNext();

            $GetImg = $bar['PICTURE'];

        }

        $ResizedImg = CFile::ResizeImageGet($GetImg,array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true);

    }

}

$db_props = CIBlockElement::GetProperty(18, $_POST['id'], array("sort" => "asc"), Array("CODE" => "KRATNOST_UPAKOVKI_DLYA_SAYTA"));
if ($ar_props = $db_props->Fetch())
    $Ratio = IntVal($ar_props["VALUE"]);
else
    $Ratio = 1;

IF ($Ratio = 1 || $Ratio = 0) {


    $db_measure = CCatalogMeasureRatio::getList(array(), $arFilter = array('PRODUCT_ID' => $_POST['id']), false, false);  // получим единицу измерения только что созданного товара

    $ar_measure = $db_measure->fetch();

    $Ratio = $ar_measure['RATIO'];

}

echo json_encode
([
    'ratio' => $Ratio,
    'img' => $ResizedImg['src'],
    'art' => $art
]);