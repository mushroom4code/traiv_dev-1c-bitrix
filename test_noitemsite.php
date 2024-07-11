<?
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("test");
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        //die;
        //die;
        echo "<table border='1' aling='left'>";
        $row = 1;
        if (($handle = fopen("setAction.csv", "r")) !== FALSE) {
            $i = 1;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
                if (!empty($data['0'])){
                    $n = str_replace(' ','',$data['0']);
                    if (strlen($n) == 6){
                        preg_match('/\d+/i', $n, $matches);
                        if (count($matches) > 0){
                            echo $n;
                            
                            $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $n], false, false);
                            
                            if ( $db_list_in->SelectedRowsCount() > 0 ){
                                while($ar_result_in = $db_list_in->GetNext())
                                {
                                    echo "<pre>";
                                        print_r($ar_result_in['ID']);
                                    echo "</pre>";
                                    
                                    echo "<pre>";
                                        print_r($ar_result_in['NAME']);
                                    echo "</pre>";
                                    
                                    $db_old_groups = CIBlockElement::GetElementGroups($ar_result_in['ID'], false);
                                    $newArr = array();
                                    while($ar_group = $db_old_groups->Fetch()){
                                        echo "<pre>";
                                        print_r($ar_group['ID']);
                                        echo "</pre>";
                                        //echo "<pre>";
                                        $newArr[] = $ar_group['ID'];
                                        //echo "</pre>";
                                    }
                                    
                                    $newArr[] = '4720';
                                    
                                    /*echo CIBlockElement::SetElementSection($ar_result_in['ID'], $newArr);
                                    \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex('18', $ar_result_in['ID']);*/
                                    
                                    echo "<pre>";
                                    print_r($newArr);
                                    echo "</pre>";
                                    echo "<br>";
                                   die;
                                }
                            }
                            
                            echo "<br>";
                        }
                    }
                }
                
                /*for ($c=0; $c < $num; $c++) {
                    if ($c == 0)
                    {
                        $code = $data[$c];
                        $code = iconv('windows-1251','utf-8',$code);
                    }
                    elseif ($c == 1)
                    {
                        $name = $data[$c];
                        $name = iconv('windows-1251','utf-8',$name);
                    }
                    elseif ($c == 2)
                    {
                        $name1 = $data[$c];
                        $name1 = iconv('windows-1251','utf-8',$name1);
                    }
                    elseif ($c == 3)
                    {
                        $name2 = $data[$c];
                        $name2 = iconv('windows-1251','utf-8',$name2);
                    }
                    elseif ($c == 4)
                    {
                        $name3 = $data[$c];
                        $name3 = iconv('windows-1251','utf-8',$name3);
                    }
                    elseif ($c == 5)
                    {
                        $name4 = $data[$c];
                        $name4 = iconv('windows-1251','utf-8',$name4);
                    }
                }*/
             
                
                /*if ($pos === false) {
                    echo "Не найдено!";
                } else {
                    $n = str_replace(' ','',substr($code,$pos+1));
                    //echo "Последнее вхождение ($needle) найдено в ($haystack) в позиции ($pos)";
                    
                    if (!empty($n)) {
                
                        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $n], false, false);
                        
                        if ( $db_list_in->SelectedRowsCount() > 0 ){
                            while($ar_result_in = $db_list_in->GetNext())
                            {
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td style='text-align:left;'>".$code."</td>";
                                echo "<td>";
                                echo $ar_result_in['NAME'];
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        else {
                            echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td style='text-align:left;'>".$code."</td>";
                            echo "<td>";
                            echo $n;
                            echo $ar_result_in['NAME'];
                            echo "</td>";
                            echo "<td style='text-align:left;'>".$name."</td>";
                            echo "<td style='text-align:left;'>".$name1."</td>";
                            echo "<td style='text-align:left;'>".$name2."</td>";
                            echo "<td style='text-align:left;'>".$name3."</td>";
                            echo "<td style='text-align:left;'>".$name4."</td>";
                            echo "</tr>";
                            $i++;
                        }
                    }
                    
                    
                }*/
                //die;
                
                unset($code);
                unset($name);
                unset($art);
                //die;
            }
            fclose($handle);
        }
        
        echo "</table>";
        
    }
}

?>


