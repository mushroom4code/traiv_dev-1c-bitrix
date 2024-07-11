<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');
if ($this->StartResultCache())
{
    $arResult["ENGINE"] = $arParams["ENGINE"];
    $iblock_id = $arParams['IBLOCK_ID'];
    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_606", "PROPERTY_624", "PROPERTY_642", "PROPERTY_610", "PROPERTY_611", "PROPERTY_612", "PROPERTY_613", "IBLOCK_SECTION_ID");
    $present_id = $arParams['PRESENT_ID'];
    $arSort = array('NAME'=>'ASC');
    $arFilter = array('IBLOCK_ID'=>$iblock_id, 'ID'=> $present_id);
    $db_list = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

    $arSimilarsID =[];
    $i = 0;
    $k = 0;

/* layout by item property
       while ( $res = $db_list->GetNext()){

           $arSimilarsID[$i] = $res['PROPERTY_642_VALUE'];

        $i++;
       }
*/
    $res = $db_list->GetNext();

    $currentID = $res["ID"];

    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");

    $arSort = ['propertysort_STANDART' => 'asc'];


 /////////

$rel_iblock_id = 41;
$rel_arSelect = Array("ID", "NAME", "PROPERTY_643");
$rel_present_id = $arParams['PRESENT_ID'];
$rel_arSort = array('NAME'=>'ASC');
$rel_arFilter = array('IBLOCK_ID'=>$rel_iblock_id, 'NAME'=> $res["PROPERTY_606_VALUE"]);

$rel_db_list = CIBlockElement::GetList($rel_arSort, $rel_arFilter, false, false, $rel_arSelect);

$rel_res = $rel_db_list->GetNext();

    switch ($res["PROPERTY_624_VALUE"]) {

        case 'Болт':

            if (isset($res["PROPERTY_612_VALUE"]) && isset($res["PROPERTY_613_VALUE"])) {


                if ($rel_res["PROPERTY_643_VALUE"]) {

                    $r = '';
                    $arFilter = array();
                    $relArray = array();

                    foreach ($rel_res["PROPERTY_643_VALUE"] as $r => $rel_name):

                        $relArray[$r] =
                            array("PROPERTY_606_VALUE" => $rel_name);

                    endforeach;

                    $temp_relArray = array(
                        "LOGIC" => "OR",
                    );

                    $temp_relArray = array_merge($temp_relArray, $relArray);

                    $fin_relArray = array(
                        0 => $temp_relArray
                    );

/*                    if ($res["PROPERTY_610_VALUE"] == 'полиамид' || $res["PROPERTY_610_VALUE"] == 'латунь' || $res["PROPERTY_610_VALUE"] == 'медь') {
                        $orig_arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                        );
                    } else {*/
                        $orig_arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                        );
                    /*}*/



                    /*                    $orig_arFilter_2 = array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Гайка"),
                                        array("PROPERTY_624_VALUE" => "Шайба"),
                                        array("PROPERTY_624_VALUE" => "Шпилька")
                                    );

                                        $fin_orig_arFilter_2 = array (
                                            1 => $orig_arFilter_2
                                        );*/



                    $arFilter = array_merge($orig_arFilter, $fin_relArray/*, $fin_orig_arFilter_2*/);

                   /**/?><!--<pre><?/*print_r($arFilter)*/?></pre>--><?

                    $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                    while ($arrProps = $db_property->GetNext()) {

                        $arSimilarsID[$i] = $arrProps['ID'];

                        $i++;

                    }
/**/?><!--<pre><?/*print_r($arSimilarsID)*/?></pre>--><?

                } /*else {*/

                    switch ($res["PROPERTY_610_VALUE"]) {

                        case "3.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;


                        case "4.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;


                        case "4.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "5.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "5.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "6.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "6"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "6"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "8.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "8"),
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "8"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "9.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "10.9":
                            
                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => "10"),
                                        //array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => "8"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => "10"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "12.9":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Винт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => "12"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => "12"),
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        default:

                            $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
                            $arSort = array('NAME' => 'ASC');
                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,
                                //   "ID"=> $similarID,
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),
                                "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Гайка"),
                                    array("PROPERTY_624_VALUE" => "Шайба"),
                                    array("PROPERTY_624_VALUE" => "Шпилька")
                                ),

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }


                    }
                /*}*/

            /*} else {
                break;*/
            }

        case 'Гайка':

            if ($rel_res["PROPERTY_643_VALUE"]) {

                $r = '';
                $arFilter = array();
                $relArray = array();

                foreach ($rel_res["PROPERTY_643_VALUE"] as $r => $rel_name):

                    $relArray[$r] =
                        array("PROPERTY_606_VALUE" => $rel_name);

                endforeach;

                $temp_relArray = array(
                    "LOGIC" => "OR",
                );

                $temp_relArray = array_merge($temp_relArray, $relArray);

                $fin_relArray = array(
                    0 => $temp_relArray
                );

/*                if ($res["PROPERTY_610_VALUE"] == 'полиамид' || $res["PROPERTY_610_VALUE"] == 'латунь' || $res["PROPERTY_610_VALUE"] == 'медь') {
                    $orig_arFilter = array(
                        "IBLOCK_ID" => $iblock_id,

                        "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                        "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                    );
                } else {*/
                    $orig_arFilter = array(
                        "IBLOCK_ID" => $iblock_id,

                        "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                        "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                    );
                /*}*/

                $orig_arFilter_2 = array(
                    "LOGIC" => "OR",
                    array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                    array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                    array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                    array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                    array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                    array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                    array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                    array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                    array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                    array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                    array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                    array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                    array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                    array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                    array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                    array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                    array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                    array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                    array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                    array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                    array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                    array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                    array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                    array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                );

                $fin_orig_arFilter_2 = array(
                    1 => $orig_arFilter_2
                );

                $arFilter = array_merge($orig_arFilter, $fin_relArray, $fin_orig_arFilter_2);

                $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                while ($arrProps = $db_property->GetNext()) {

                    $arSimilarsID[$i] = $arrProps['ID'];

                    $i++;

                }

            } /*else {*/


                switch ($res["PROPERTY_610_VALUE"]) {

                    case "4":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "5":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "5.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "5.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "5.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "5.8"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "6":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "6.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "6.8"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "8":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "9":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "9.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "9.8"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "10":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "10.9"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "10.9"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "12":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Шайба" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "12.9"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "12.9"),
                                    array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    default:

                        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
                        $arSort = array('NAME' => 'ASC');
                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,
                            //   "ID"=> $similarID,
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),
                            /*"PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],*/
                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_624_VALUE" => "Болт"),
                                array("PROPERTY_624_VALUE" => "Шайба"),
                                array("PROPERTY_624_VALUE" => "Винт"),
                                array("PROPERTY_624_VALUE" => "Шпилька")
                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),
                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                /*}*/
            }

        case 'Винт':

            if (isset($res["PROPERTY_612_VALUE"]) && isset($res["PROPERTY_613_VALUE"])){

                if ($rel_res["PROPERTY_643_VALUE"]) {

                    $r = '';
                    $arFilter = array();
                    $relArray = array();

                    foreach ($rel_res["PROPERTY_643_VALUE"] as $r => $rel_name):

                        $relArray[$r] =
                            array("PROPERTY_606_VALUE" => $rel_name);

                    endforeach;

                    $temp_relArray = array(
                        "LOGIC" => "OR",
                    );

                    $temp_relArray = array_merge($temp_relArray, $relArray);

                    $fin_relArray = array(
                        0 => $temp_relArray
                    );

                   /* if ($res["PROPERTY_610_VALUE"] == 'полиамид' || $res["PROPERTY_610_VALUE"] == 'латунь' || $res["PROPERTY_610_VALUE"] == 'медь') {
                        $orig_arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                        );
                    } else {*/
                        $orig_arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                        );
                    /*}*/

                    /*                    $orig_arFilter_2 = array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Гайка"),
                                        array("PROPERTY_624_VALUE" => "Шайба"),
                                        array("PROPERTY_624_VALUE" => "Шпилька")
                                    );

                                        $fin_orig_arFilter_2 = array (
                                            1 => $orig_arFilter_2
                                        );*/


                    $arFilter = array_merge($orig_arFilter, $fin_relArray/*, $fin_orig_arFilter_2*/);


                    $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                    while ($arrProps = $db_property->GetNext()) {

                        $arSimilarsID[$i] = $arrProps['ID'];

                        $i++;
                    }

                } /*else {*/

                    switch ($res["PROPERTY_610_VALUE"]) {

                        case "3.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;


                        case "4.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;


                        case "4.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "4"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "5.6":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "5.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "5"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "6.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "6"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "6"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "8.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "8"),
                                        array("PROPERTY_624_VALUE" => "Гайка", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "48", "PROPERTY_610_VALUE" => "8"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "<PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "9.8":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Шайба", ">=PROPERTY_613_VALUE" => "16", "PROPERTY_610_VALUE" => "9"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "10.9":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => "10"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => "10"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        case "12.9":

                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,

                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),

                                array(
                                    "LOGIC" => "OR",
                                    array(
                                        "LOGIC" => "AND",
                                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                        array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Шайба" || "Шпилька"),
                                    ),
                                    array(
                                        "LOGIC" => "OR",
                                        array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => "12"),
                                        array("PROPERTY_624_VALUE" => "Шайба", "PROPERTY_610_VALUE" => "12"),
                                        array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"], "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                        array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    ),
                                )

                            );

                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;


                            }

                            break;

                        default:

                            $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
                            $arSort = array('NAME' => 'ASC');
                            $arFilter = array(
                                "IBLOCK_ID" => $iblock_id,
                                //   "ID"=> $similarID,
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_606_VALUE" => "DIN 934"),
                                    array("PROPERTY_606_VALUE" => "DIN 125"),
                                    array("PROPERTY_606_VALUE" => "DIN 127"),
                                    array("PROPERTY_606_VALUE" => "DIN 912"),
                                    array("PROPERTY_606_VALUE" => "DIN 975"),
                                ),
                                /*"PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],*/
                                "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                                //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                                "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Гайка"),
                                    array("PROPERTY_624_VALUE" => "Шайба"),
                                    array("PROPERTY_624_VALUE" => "Шпилька")
                                ),
                                /*                        array(
                                                            "LOGIC" => "OR",
                                                            array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                                            array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                                            array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                                            array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                                            array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                                            array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                                            array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                                            array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                                            array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                                            array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                                            array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                                            array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                                            array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                                            array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                                            array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                                            array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                                            array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                                            array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                                            array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                                            array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                                            array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                                            array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                                            array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                                            array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                                                        ),*/

                            );



                            $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                            while ($arrProps = $db_property->GetNext()) {

                                $arSimilarsID[$i] = $arrProps['ID'];

                                $i++;

                            }
                    }
                /*}*/

            }


        case 'Шайба':

            if ($rel_res["PROPERTY_643_VALUE"]) {

                $r = '';
                $arFilter = array();
                $relArray = array();

                foreach ($rel_res["PROPERTY_643_VALUE"] as $r => $rel_name):

                    $relArray[$r] =
                        array("PROPERTY_606_VALUE" => $rel_name);

                endforeach;

                $temp_relArray = array(
                    "LOGIC" => "OR",
                );

                $temp_relArray = array_merge($temp_relArray, $relArray);

                $fin_relArray = array(
                    0 => $temp_relArray
                );

               /* if ($res["PROPERTY_610_VALUE"] == 'полиамид' || $res["PROPERTY_610_VALUE"] == 'латунь' || $res["PROPERTY_610_VALUE"] == 'медь') {
                    $orig_arFilter = array(
                        "IBLOCK_ID" => $iblock_id,

                        "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                        "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                    );
                } else {*/
                    $orig_arFilter = array(
                        "IBLOCK_ID" => $iblock_id,

                        "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                        "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                        "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                    );
                /*}*/

                $orig_arFilter_2 = array(
                    "LOGIC" => "OR",
                    array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                    array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                    array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                    array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                    array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                    array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                    array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                    array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                    array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                    array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                    array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                    array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                    array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                    array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                    array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                    array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                    array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                    array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                    array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                    array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                    array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                    array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                    array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                    array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                );

                $fin_orig_arFilter_2 = array(
                    1 => $orig_arFilter_2
                );

                $arFilter = array_merge($orig_arFilter, $fin_relArray, $fin_orig_arFilter_2);

                $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                while ($arrProps = $db_property->GetNext()) {

                    $arSimilarsID[$i] = $arrProps['ID'];

                    $i++;
                }

            } /*else {*/

                switch ($res["PROPERTY_610_VALUE"]) {

                    case "4":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "5":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "5.6"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "5.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "3.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "4.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "5.6"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "5.8"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "6":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "6.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "6.8"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "8":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    case "9":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "9.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "8.8"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "9.8"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "10":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "10.9"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "10.9"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;

                    case "12":

                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),

                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                            array(
                                "LOGIC" => "OR",
                                array(
                                    "LOGIC" => "AND",
                                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                                    array("PROPERTY_624_VALUE" => "Болт" || "Гайка" || "Винт" || "Шпилька"),
                                ),
                                array(
                                    "LOGIC" => "OR",
                                    array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_610_VALUE" => "12.9"),
                                    array("PROPERTY_624_VALUE" => "Винт", "PROPERTY_610_VALUE" => "12.9"),
                                    array("PROPERTY_624_VALUE" => "Гайка", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                    array("PROPERTY_624_VALUE" => "Шпилька", "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"]),
                                ),

                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;


                        }

                        break;


                    default:

                        $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
                        $arSort = array('NAME' => 'ASC');
                        $arFilter = array(
                            "IBLOCK_ID" => $iblock_id,
                            //   "ID"=> $similarID,
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_606_VALUE" => "DIN 934"),
                                array("PROPERTY_606_VALUE" => "DIN 125"),
                                array("PROPERTY_606_VALUE" => "DIN 127"),
                                array("PROPERTY_606_VALUE" => "DIN 912"),
                                array("PROPERTY_606_VALUE" => "DIN 975"),
                            ),
                            /*"PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],*/
                            "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                            //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                            "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_624_VALUE" => "Болт", "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"]),
                                array("PROPERTY_624_VALUE" => "Гайка"),
                                array("PROPERTY_624_VALUE" => "Шайба"),
                                array("PROPERTY_624_VALUE" => "Шпилька")
                            ),
                            array(
                                "LOGIC" => "OR",
                                array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                                array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                                array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                                array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                                array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                                array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                                array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                                array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                                array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                                array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                                array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                                array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                                array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                                array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                                array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                                array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                                array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                                array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                                array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                                array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                                array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                                array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                                array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                                array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                            ),

                        );

                        $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                        while ($arrProps = $db_property->GetNext()) {

                            $arSimilarsID[$i] = $arrProps['ID'];

                            $i++;

                        }
                /*}*/
            }


        case 'Шпилька':

            if ($rel_res["PROPERTY_643_VALUE"]) {

                $r = '';
                $arFilter = array();
                $relArray = array();

                foreach ($rel_res["PROPERTY_643_VALUE"] as $r => $rel_name):

                    $relArray[$r] =
                        array("PROPERTY_606_VALUE" => $rel_name);

                endforeach;

                $temp_relArray = array(
                    "LOGIC" => "OR",
                );

                $temp_relArray = array_merge($temp_relArray, $relArray);

                $fin_relArray = array(
                    0 => $temp_relArray
                );

                $orig_arFilter = array(
                    "IBLOCK_ID" => $iblock_id,

                    "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                    /*"PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],*/
                    "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],

                );

                $orig_arFilter_2 = array(
                    "LOGIC" => "OR",
                    array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                    array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                    array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                    array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                    array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                    array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                    array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                    array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                    array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                    array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                    array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                    array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                    array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                    array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                    array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                    array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                    array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                    array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                    array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                    array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                    array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                    array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                    array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                    array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                );

                $fin_orig_arFilter_2 = array(
                    1 => $orig_arFilter_2
                );

                $arFilter = array_merge($orig_arFilter, $fin_relArray, $fin_orig_arFilter_2);

                $db_property = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

                while ($arrProps = $db_property->GetNext()) {

                    $arSimilarsID[$i] = $arrProps['ID'];

                    $i++;

                }

            } else {

                $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID");
                $arSort = array('NAME' => 'ASC');
                $arFilter = array(
                    "IBLOCK_ID" => $iblock_id,
                    //   "ID"=> $similarID,
                    array(
                        "LOGIC" => "OR",
                        array("PROPERTY_606_VALUE" => "DIN 934"),
                        array("PROPERTY_606_VALUE" => "DIN 125"),
                        array("PROPERTY_606_VALUE" => "DIN 127"),
                        array("PROPERTY_606_VALUE" => "DIN 912"),
                        array("PROPERTY_606_VALUE" => "DIN 975"),
                    ),
                    "PROPERTY_610_VALUE" => $res["PROPERTY_610_VALUE"],
                    "PROPERTY_611_VALUE" => $res["PROPERTY_611_VALUE"],
                    //   "PROPERTY_612_VALUE" => $res["PROPERTY_612_VALUE"],
                    "PROPERTY_613_VALUE" => $res["PROPERTY_613_VALUE"],
                    array(
                        "LOGIC" => "OR",
                        array("PROPERTY_624_VALUE" => "Болт",),
                        array("PROPERTY_624_VALUE" => "Винт"),
                        array("PROPERTY_624_VALUE" => "Гайка"),
                        array("PROPERTY_624_VALUE" => "Шайба")
                    ),
                    array(
                        "LOGIC" => "OR",
                        array("PROPERTY_613_VALUE" => "1.6", "PROPERTY_612_VALUE" => "6"),
                        array("PROPERTY_613_VALUE" => "2", "PROPERTY_612_VALUE" => "8"),
                        array("PROPERTY_613_VALUE" => "3", "PROPERTY_612_VALUE" => "10"),
                        array("PROPERTY_613_VALUE" => "4", "PROPERTY_612_VALUE" => "20"),
                        array("PROPERTY_613_VALUE" => "5", "PROPERTY_612_VALUE" => "25"),
                        array("PROPERTY_613_VALUE" => "6", "PROPERTY_612_VALUE" => "30"),
                        array("PROPERTY_613_VALUE" => "8", "PROPERTY_612_VALUE" => "40"),
                        array("PROPERTY_613_VALUE" => "10", "PROPERTY_612_VALUE" => "50"),
                        array("PROPERTY_613_VALUE" => "12", "PROPERTY_612_VALUE" => "60"),
                        array("PROPERTY_613_VALUE" => "14", "PROPERTY_612_VALUE" => "70"),
                        array("PROPERTY_613_VALUE" => "16", "PROPERTY_612_VALUE" => "80"),
                        array("PROPERTY_613_VALUE" => "18", "PROPERTY_612_VALUE" => "90"),
                        array("PROPERTY_613_VALUE" => "20", "PROPERTY_612_VALUE" => "100"),
                        array("PROPERTY_613_VALUE" => "22", "PROPERTY_612_VALUE" => "120"),
                        array("PROPERTY_613_VALUE" => "24", "PROPERTY_612_VALUE" => "140"),
                        array("PROPERTY_613_VALUE" => "27", "PROPERTY_612_VALUE" => "150"),
                        array("PROPERTY_613_VALUE" => "30", "PROPERTY_612_VALUE" => "200"),
                        array("PROPERTY_613_VALUE" => "33", "PROPERTY_612_VALUE" => "220"),
                        array("PROPERTY_613_VALUE" => "36", "PROPERTY_612_VALUE" => "250"),
                        array("PROPERTY_613_VALUE" => "39", "PROPERTY_612_VALUE" => "280"),
                        array("PROPERTY_613_VALUE" => "42", "PROPERTY_612_VALUE" => "300"),
                        array("PROPERTY_613_VALUE" => "48", "PROPERTY_612_VALUE" => "320"),
                        array("PROPERTY_613_VALUE" => "52", "PROPERTY_612_VALUE" => "340"),
                        array("PROPERTY_613_VALUE" => "56", "PROPERTY_612_VALUE" => "360"),
                    ),
                );

                break;


            }
    }

    if (!empty($arSimilarsID[0]) && $arSimilarsID[0] !== $currentID):

        $arSimilarsID = array_unique($arSimilarsID);

        foreach ($arSimilarsID as $similarID):

            $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_604",  "PROPERTY_606", "PROPERTY_610", "PROPERTY_611", "PROPERTY_612", "PROPERTY_613", "PROPERTY_619");
            $arSort = array('NAME'=>'ASC');
            $arFilter = array('IBLOCK_ID'=>$iblock_id, 'ID'=> $similarID);
            $db_list = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

            $temp = array();

        $arSimilars = $db_list->GetNext();

            $arPrice = CPrice::GetBasePrice($arSimilars["ID"]);

        $price = $arPrice["price"];


            if (!strpos($arSimilars ["NAME"], '-LH') && !strpos($arSimilars ["NAME"], ' x 1,5') && !strpos($arSimilars ["NAME"], ' x 1,25')):

            if(
                $arSimilars["PROPERTY_606_VALUE"] === $last614
                && $arSimilars["PROPERTY_610_VALUE"] === $last615
                && $arSimilars["PROPERTY_611_VALUE"] === $last616
                && $arSimilars["PROPERTY_612_VALUE"] === $last617
                && $arSimilars["PROPERTY_613_VALUE"] === $last618
                && $lastprice <= $price
            ) {
             //   echo 'ДУБЛЬ';
                continue;
            }else{
                $arResult["SIMILARS"][$k] = $arSimilars;

                $k++;
            }

            $last614 = $arSimilars ["PROPERTY_606_VALUE"];
            $last615 = $arSimilars ["PROPERTY_610_VALUE"];
            $last616 = $arSimilars ["PROPERTY_611_VALUE"];
            $last617 = $arSimilars ["PROPERTY_612_VALUE"];
            $last618 = $arSimilars ["PROPERTY_613_VALUE"];
            $last619 = $arSimilars ["PROPERTY_619_VALUE"];

                $lastprice = $arPrice["price"];

            endif;

        endforeach;
    endif;

    $this->IncludeComponentTemplate();
}
?>