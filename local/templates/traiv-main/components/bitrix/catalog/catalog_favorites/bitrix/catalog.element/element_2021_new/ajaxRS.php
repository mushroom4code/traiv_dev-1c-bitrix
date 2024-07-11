<?php 
//if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_CHECK", true);
define('PUBLIC_AJAX_MODE', true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$_SESSION["SESS_SHOW_INCLUDE_TIME_EXEC"]="N";
$APPLICATION->ShowIncludeStat = false;
$sectionID = htmlspecialchars(strip_tags($_REQUEST['sectionID']));
$materialID = htmlspecialchars(strip_tags($_REQUEST['materialID']));

if (!empty($sectionID) && !empty($materialID) && is_numeric($sectionID) == true && is_numeric($materialID) == true) {

$arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_613", "PROPERTY_612");
$arSortRs = array('PROPERTY_613_VALUE'=>'DESC');

$arFilterRs = array('IBLOCK_ID'=>"18",'SECTION_ID'=>$sectionID, 'ACTIVE'=>'Y', 'PROPERTY_MATERIAL_1'=>$materialID/*, ">CATALOG_QUANTITY" => "0"*/);
$db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, false, $arSelectRs);

$res_rows = intval($db_list_inRs->SelectedRowsCount());

if ($res_rows > 0) {
    $arrRS = array();
    $arrRSdiametr = array();
    $arrRSdlina = array();
    while($ar_result_inRs = $db_list_inRs->GetNext()){
        
        if (!empty($ar_result_inRs['PROPERTY_613_VALUE']) && !empty($ar_result_inRs['PROPERTY_612_VALUE'])){
            $arrRS[intval($ar_result_inRs['PROPERTY_613_VALUE'])][] = intval($ar_result_inRs['PROPERTY_612_VALUE']);
        }
        
        if (!empty($ar_result_inRs['PROPERTY_613_VALUE'])){
            $arrRSdiametr[] = intval($ar_result_inRs['PROPERTY_613_VALUE']);
        }
        if (!empty($ar_result_inRs['PROPERTY_612_VALUE'])){
            $arrRSdlina[] = intval($ar_result_inRs['PROPERTY_612_VALUE']);
        }
       // echo "<br>";
    }
}

$arrRSall = array_unique($arrRS);
$arrRSall = asort($arrRSall);

if (!empty($arrRS)){
    foreach($arrRS as $key => $val) {
        $arrRS[$key] = array_unique($val);
    }
}


$arrRSdiametr = array_unique($arrRSdiametr);
$arrRSdiametrSort = asort($arrRSdiametr);
$arrRSdiametrRes = array_values($arrRSdiametr);

$arrRSdlina = array_unique($arrRSdlina);
$arrRSdlinaSort = asort($arrRSdlina);
$arrRSdlinaRes = array_values($arrRSdlina);

echo "<table cellpadding='3' cellspacing='3' border='1' style='font-size:11px;' id='table_size_list'>";
echo "<tr>";
echo "<td>-</td>";
    foreach($arrRSdiametrRes as $i => $j) {        
            echo "<td data-check-d='$j'><nobr><b>М ".$j."</b></nobr></td>";
    }
    
    foreach($arrRSdlinaRes as $d => $l) {
        echo "<tr rel=".$l.">";
        echo "<td data-check-l='$l'><nobr><b>".$l." мм</b></nobr></td>";
        foreach($arrRSdiametrRes as $i2 => $j2) {
            ?>
            <td class="thisitem" data-check-d="<?php echo $j2;?>" data-check-l="<?php echo $l;?>"><?php 
            
            
            if (array_key_exists($j2, $arrRS)) {
                //print_r($arrRS[$j2]);
                if (in_array($l,$arrRS[$j2])) {
                    //echo "М".$j2."x".$l;
                    //echo "<div data-check-len='1'>2</div>";

                    $arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_613", "PROPERTY_612", "CATALOG_QUANTITY");
                    $arSortRs = array();
                    
                    $arFilterRs = array('IBLOCK_ID'=>"18",'SECTION_ID'=>$sectionID, 'ACTIVE'=>'Y',
                        array("LOGIC"=> "AND",
                            'PROPERTY_612_VALUE'=>$l,
                            'PROPERTY_613_VALUE'=>$j2));
                        $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array("nTopCount"=>1), $arSelectRs);
                        $res_rows = intval($db_list_inRs->SelectedRowsCount());
                        
                        if ($res_rows > 0) {
                            while($ar_result_inRs = $db_list_inRs->GetNext()){
                                ?>
                                <a class="item-rs-reslink" href="<?php echo $ar_result_inRs['DETAIL_PAGE_URL'];?>"><?php echo "М".$j2."x".$l;?></a>
                                <?php 
                            }
                        }
                    
                    /*$arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_613", "PROPERTY_612", "CATALOG_QUANTITY");
                    $arSortRs = array();
                    
                    $arFilterRs = array('IBLOCK_ID'=>"18",'SECTION_ID'=>$sectionID, 'ACTIVE'=>'Y',
                        array("LOGIC"=> "AND",
                            'PROPERTY_612_VALUE'=>$l,
                            'PROPERTY_613_VALUE'=>$j2,
                            ">CATALOG_QUANTITY" => "0"));
                        $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array("nTopCount"=>1), $arSelectRs);

                        $res_rows = intval($db_list_inRs->SelectedRowsCount());
                        
                        if ($res_rows > 0) {
                            while($ar_result_inRs = $db_list_inRs->GetNext()){
                                ?>
                                <a class="item-rs-reslink" href="<?php echo $ar_result_inRs['DETAIL_PAGE_URL'];?>"><?php echo "М".$j2."x".$l;?></a>
                                <?php 
                            }
                        }
                        else {
                            
                            $arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_613", "PROPERTY_612", "CATALOG_QUANTITY");
                            $arSortRs = array();
                            
                            $arFilterRs = array('IBLOCK_ID'=>"18",'SECTION_ID'=>$sectionID, 'ACTIVE'=>'Y',
                                array("LOGIC"=> "AND",
                                    'PROPERTY_612_VALUE'=>$l,
                                    'PROPERTY_613_VALUE'=>$j2));
                                $db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array("nTopCount"=>1), $arSelectRs);
                                $res_rows = intval($db_list_inRs->SelectedRowsCount());
                                
                                if ($res_rows > 0) {
                                    while($ar_result_inRs = $db_list_inRs->GetNext()){
                                        ?>
                                <a class="item-rs-reslink" href="<?php echo $ar_result_inRs['DETAIL_PAGE_URL'];?>"><?php echo "М".$j2."x".$l;?></a>
                                <?php 
                            }
                        }
                        }*/
                        
                    
                }
                else {
                    echo "-";
                }
            }
            
            
            
            ?></td>
        <?php
        }
        echo "<tr>";
    }
    
    
echo "</tr>";
echo "</table>";
}
?>