<?
//die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788') {
        
        $catQuery = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 54, 'DEPTH_LEVEL'=>'1', 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array(/*'UF_*'*/));
        echo "<table cellpadding='3' cellspacing='3' border='1'>";
        $i=1;
        while($ar_result_cat = $catQuery->GetNext())
        {
            echo "<tr>";
            echo "<td align='left'>";
            //echo "<div>".$ar_result_cat['ID']."</div>";
            echo "<div>".$ar_result_cat['NAME']."</div>";
             ?>
             <a href="<? echo $ar_result_cat['SECTION_PAGE_URL'];?>" target="_blank"><? echo $ar_result_cat['SECTION_PAGE_URL'];?></a>
             <?php
            echo "</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td align='left'>";
            //echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
            $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat['ID'],  'ACTIVE'=>'Y'], false,Array());
            $catCountEl = intval($db_list_in->SelectedRowsCount());
            if ($catCountEl == 0){
                $catQuery1 = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat['ID'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array(/*'UF_*'*/));
                $catCountCat = intval($catQuery1->SelectedRowsCount());
                
                while($ar_result_cat1 = $catQuery1->GetNext())
                {
                    echo "<tr>";
                    echo "<td align='left'></td>";
                    echo "<td align='left'>";
                    
                    //echo "<div>".$ar_result_cat1['ID']."</div>";
                    echo "<div style='padding-left:30px;'>".$ar_result_cat1['NAME']."</div>";
                    ?>
             <a href="<? echo $ar_result_cat1['SECTION_PAGE_URL'];?>" target="_blank"><? echo $ar_result_cat1['SECTION_PAGE_URL'];?></a>
             <?php
                    //echo "<b>";
                    $db_list_in1 = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat1['ID'],  'ACTIVE'=>'Y'], false,Array());
                    $catCountE2 = intval($db_list_in1->SelectedRowsCount());
                    
                    /*if ($catCountE2 > 0){
                        while($ob = $db_list_in1->GetNextElement()){
                            $arFields = $ob->GetFields();
                            $arProps = $ob->GetProperties();
                            
                            echo "<tr>";
                            echo "<td style='background-color:yellow;'>";
                            echo "<pre>";
                            print_r($arFields['NAME']);
                            echo "</pre>";
                            echo "</td>";
                            echo "<td style='background-color:yellow;'>";
                            echo "<pre>";
                            print_r($arProps['ARTIKUL_WALTER']['VALUE']);
                            echo "</pre>";
                            echo "</td>";
                            echo "</tr>";
                            
                            foreach($arProps as $keyProp => $valProp){
                                
                                if (!empty($valProp['VALUE'])){
                                    echo "<tr>";
                                    echo "<td>".$valProp['NAME']."</td><td>".$valProp['VALUE']."</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                    }*/
                    
                    if ($catCountE2 == 0){
                        $catQuery2 = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat1['ID'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array(/*'UF_*'*/));
                        $catCountCat1 = intval($catQuery1->SelectedRowsCount());
                        if ($catCountCat1 > 0){
                           // echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                            while($ar_result_cat2 = $catQuery2->GetNext())
                            {
                                echo "<tr>";
                                echo "<td align='left'></td>";
                                echo "<td align='left'></td>";
                                echo "<td align='left'>";
                                
                                //echo "<div>".$ar_result_cat2['ID']."</div>";
                                echo "<div style='padding-left:60px;'>".$ar_result_cat2['NAME']."</div>";
                                ?>
             <a href="<? echo $ar_result_cat2['SECTION_PAGE_URL'];?>" target="_blank"><? echo $ar_result_cat2['SECTION_PAGE_URL'];?></a>
             <?php
                                $db_list_in2 = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat2['ID'],  'ACTIVE'=>'Y'], false,Array());
                                //echo "<i>";
                                $catCountE3 = intval($db_list_in2->SelectedRowsCount());
                                //echo "</i>";
                                
                                if ($catCountE3 == 0){
                                    $catQuery3 = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat2['ID'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array(/*'UF_*'*/));
                                    $catCountCat2 = intval($catQuery3->SelectedRowsCount());
                                    if ($catCountCat2 > 0){
                                        //echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                                        while($ar_result_cat3 = $catQuery3->GetNext())
                                        {
                                            echo "<tr>";
                                            echo "<td align='left'></td>";
                                            echo "<td align='left'></td>";
                                            echo "<td align='left'></td>";
                                            echo "<td align='left'>";
                                            
                                            //echo "<div>".$ar_result_cat3['ID']."</div>";
                                            echo "<div style='padding-left:90px;'>".$ar_result_cat3['NAME']."</div>";
                                            ?>
             <a href="<? echo $ar_result_cat3['SECTION_PAGE_URL'];?>" target="_blank"><? echo $ar_result_cat3['SECTION_PAGE_URL'];?></a>
             <?php
                                            $db_list_in3 = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat3['ID'],  'ACTIVE'=>'Y'], false,Array());
                                            //echo "<h2>";
                                            $catCountE4 = intval($db_list_in3->SelectedRowsCount());
                                            //echo "</h2>";
                                            
                                            /*if ($catCountE4 > 0){
                                                echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                                                while($ob = $db_list_in3->GetNextElement()){
                                                    $arFields = $ob->GetFields();
                                                    $arProps = $ob->GetProperties();
                                                    
                                                    echo "<tr>";
                                                    echo "<td style='background-color:yellow;'>";
                                                    echo "<pre>";
                                                    print_r($arFields['NAME']);
                                                    echo "</pre>";
                                                    echo "</td>";
                                                    echo "<td style='background-color:yellow;'>";
                                                    echo "<pre>";
                                                    print_r($arProps['ARTIKUL_WALTER']['VALUE']);
                                                    echo "</pre>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                    
                                                    foreach($arProps as $keyProp => $valProp){
                                                        
                                                        if (!empty($valProp['VALUE'])){
                                                            echo "<tr>";
                                                            echo "<td>".$valProp['NAME']."</td><td>".$valProp['VALUE']."</td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                }
                                                echo "</table>";
                                            }*/
                                            
                                            if ($catCountE4 == 0){
                                                $catQuery4 = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat3['ID'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array(/*'UF_*'*/));
                                                $catCountCat3 = intval($catQuery4->SelectedRowsCount());
                                                
                                                if ($catCountCat3 > 0){
                                                    //echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                                                    while($ar_result_cat4 = $catQuery4->GetNext())
                                                    {
                                                        echo "<tr>";
                                                        echo "<td align='left'></td>";
                                                        echo "<td align='left'></td>";
                                                        echo "<td align='left'></td>";
                                                        echo "<td align='left'></td>";
                                                        echo "<td align='left'>";
                                                        
                                                        //echo "<div>".$ar_result_cat4['ID']."</div>";
                                                        echo "<div style='padding-left:120px;'>".$ar_result_cat4['NAME']."</div>";
                                                        ?>
             <a href="<? echo $ar_result_cat4['SECTION_PAGE_URL'];?>" target="_blank"><? echo $ar_result_cat4['SECTION_PAGE_URL'];?></a>
             <?php
                                                        $db_list_in4 = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 54, 'SECTION_ID' => $ar_result_cat4['ID'],  'ACTIVE'=>'Y'], false,Array());
                                                        //echo "<h1>";
                                                        $catCountE5 = intval($db_list_in4->SelectedRowsCount());
                                                        //echo "</h1>";
                                                        
                                                       /* if ($catCountE5 > 0){
                                                            echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                                                            while($ob = $db_list_in4->GetNextElement()){
                                                                $arFields = $ob->GetFields();
                                                                $arProps = $ob->GetProperties();
                                                                
                                                                echo "<tr>";
                                                                echo "<td style='background-color:yellow;'>";
                                                                echo "<pre>";
                                                                print_r($arFields['NAME']);
                                                                echo "</pre>";
                                                                echo "</td>";
                                                                echo "<td style='background-color:yellow;'>";
                                                                echo "<pre>";
                                                                print_r($arProps['ARTIKUL_WALTER']['VALUE']);
                                                                echo "</pre>";
                                                                echo "</td>";
                                                                echo "</tr>";
                                                                
                                                                foreach($arProps as $keyProp => $valProp){
                                                                    
                                                                    if (!empty($valProp['VALUE'])){
                                                                        echo "<tr>";
                                                                        echo "<td>".$valProp['NAME']."</td><td>".$valProp['VALUE']."</td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                            }
                                                            echo "</table>";
                                                        }*/
                                                        
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                    //echo "</table>";
                                                }
                                                
                                            }
                                            
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        //echo "</table>";
                                    }
                                }
                                
                                /*if ($catCountE3 > 0){
                                    echo "<table cellpadding='3' cellspacing='3' border='1' style='width:100%;'>";
                                    while($ob = $db_list_in2->GetNextElement()){
                                        $arFields = $ob->GetFields();
                                        $arProps = $ob->GetProperties();
                                        
                                        echo "<tr>";
                                        echo "<td style='background-color:yellow;'>";
                                        echo "<pre>";
                                        print_r($arFields['NAME']);
                                        echo "</pre>";
                                        echo "</td>";
                                        echo "<td style='background-color:yellow;'>";
                                        echo "<pre>";
                                        print_r($arProps['ARTIKUL_WALTER']['VALUE']);
                                        echo "</pre>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                        foreach($arProps as $keyProp => $valProp){
                                            
                                            if (!empty($valProp['VALUE'])){
                                                echo "<tr>";
                                                echo "<td>".$valProp['NAME']."</td><td>".$valProp['VALUE']."</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    echo "</table>";
                                }*/
                                
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                            //echo "</table>";
                    }
                    
                    //echo "</b>";
                    echo "</td>";
                    echo "</tr>";
                }
                
            }
            //echo "</table>";
            echo "</td>";
            echo "</tr>";
            
           /* while($ar_result_in = $db_list_in->GetNext())
            {
                
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
                echo "</td>";
                
                if (!empty($ar_result_in['CATALOG_PRICE_2']) && empty($ar_result['UF_FROM_PRICE'])){
                    echo "<td>";
                    echo "Записываем";
                    echo "</td>";
                }
                echo "</tr>";
                
            }*/
            
        }
        echo "</table>";
        
    }
}

?>

