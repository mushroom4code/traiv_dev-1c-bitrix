<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<?
//die;

$arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE","PROPERTY_417");
$db_list = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false, false, $arSelectRs);
        echo "<table cellpadding='3' cellspacing='3' border='1'>";
        ?>
        <tr>
        <td>ID</td>
        <td>Наименование</td>
        <td>Ссылка</td>
        <td>Количество разделов</td>
        </tr>
        <?php 
        $i=1;
        while($ar_result = $db_list->GetNext())
        {
            $db_groups = CIBlockElement::GetElementGroups($ar_result['ID'], true);
            $nums = intval($db_groups->SelectedRowsCount());
            if ($nums == 0){
            
            
            /*echo "<tr>";
            echo "<td>".$ar_result['ID']."</td>";
            echo "<td>".$ar_result['NAME']."</td>";
            echo "<td><a href='https://traiv-komplekt.ru".$ar_result['DETAIL_PAGE_URL']."'>https://traiv-komplekt.ru".$ar_result['DETAIL_PAGE_URL']."</td>";
            echo "<td>".$nums."</td>";*/
            
            /*while($ar_group = $db_groups->Fetch()) {
                
                $getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18, "ACTIVE" => "Y"), false, Array());
                if($getGroupItem = $getGroup->GetNext()) {
                    echo "<pre>";
                    print_r($getGroupItem);
                    echo "</pre>";
                }
            }*/
            
            /*if (!empty($ar_result['DETAIL_PICTURE'])){
                echo "<pre>";
                    print_r($ar_result);
                echo "</pre>";
                
                
                
                $rsFile = CFile::GetFileArray($ar_result['DETAIL_PICTURE']);
                
                echo "<td>".$rsFile['WIDTH']."</td>";
                echo "<td>".$rsFile['HEIGHT']."</td>";
                echo "<td><a href='https://traiv-komplekt.ru".$rsFile['SRC']."'>https://traiv-komplekt.ru".$rsFile['SRC']."</td>";
                
            }  else {
                echo "<pre>";
                print_r($ar_result);
                echo "</pre>";
            }*/
            
           // echo "</tr>";
            } else {
                echo "<tr>";
                echo "<td>".$ar_result['ID']."</td>";
                echo "<td>".$ar_result['NAME']."</td>";
                echo "<td><a href='https://traiv-komplekt.ru".$ar_result['DETAIL_PAGE_URL']."'>https://traiv-komplekt.ru".$ar_result['DETAIL_PAGE_URL']."</td>";
                echo "<td>".$nums."</td>";
                
                
                if (!empty($ar_result['DETAIL_PICTURE'])){
                   
                    $rsFile = CFile::GetFileArray($ar_result['DETAIL_PICTURE']);
                    
                    echo "<td>".$rsFile['WIDTH']."</td>";
                    echo "<td>".$rsFile['HEIGHT']."</td>";
                    echo "<td><a href='https://traiv-komplekt.ru".$rsFile['SRC']."'>https://traiv-komplekt.ru".$rsFile['SRC']."</td>";
                    
                }  else {
echo "<td>";                    
                    while($ar_group = $db_groups->Fetch()) {
                        
                        $getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18, "ACTIVE" => "Y"), false, Array('UF_*'));
                        echo "<table border='1'>";
                        if($getGroupItem = $getGroup->GetNext()) {
                        
                            
                            $rsFile = CFile::GetFileArray($getGroupItem['PICTURE']);
                     
                            
                            echo "<td>".$rsFile['WIDTH']."</td>";
                            echo "<td>".$rsFile['HEIGHT']."</td>";
                            echo "<td><a href='https://traiv-komplekt.ru".$rsFile['SRC']."'>https://traiv-komplekt.ru".$rsFile['SRC']."</td>";
                            
                            
                        }
                        echo "</table>";
                    }
                    //die;
                    echo "</td>";
                    
                }
                
            }
            
            //echo var_dump($ar_result['IBLOCK_SECTION_ID']);
            /*if (!($ar_result['IBLOCK_SECTION_ID'])){
             echo "<tr>";
             echo "<td>".$i."</td>";
             echo "<td align='left'>";
             echo "<div>".$ar_result['ID']."</div>";
             echo "<div>".$ar_result['NAME']."</div>";
             echo "</td>";
             echo "</tr>";
             */
            /* if(CIBlock::GetPermission(18)>='W')
             {
                 $DB->StartTransaction();
                 if(!CIBlockElement::Delete($ar_result['ID']))
                 {
                     $strWarning .= 'Error!';
                     $DB->Rollback();
                 }
                 else
                     $DB->Commit();
             }*/
             
             /*$i++;
            }*/
            /*
             $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'PROPERTY_YMARKET' => '16991', 'ACTIVE'=>'Y',  array(
                 "LOGIC" => "AND",
                 ">CATALOG_QUANTITY" => 500, ">CATALOG_PRICE_2" => 0 ), 'CATALOG_GROUP_ID' => 2], false);
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";             
                echo "</td>";
                echo "</tr>";
                $i++;
            }*/
            
           /* if ($i == 10000){
                die;
            }*/
            
            $i++;
        }
        echo "</table>";
