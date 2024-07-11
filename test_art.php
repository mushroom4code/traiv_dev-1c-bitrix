<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        //die;
        echo "<table border='1' aling='left' cellpadding='3' cellspacing='3'>";
        
        $row = 1;
        if (($handle = fopen("photo_art.csv", "r")) !== FALSE) {
            $i = 1;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
                /*echo "<pre>";
                    print_r($data);
                echo "</pre>";*/
               // die;
                
                for ($c=0; $c < $num; $c++) {
                    
                    if ($c == 0)
                    {
                        $art = $data[$c];
                    }
                    
                }
                
                
                if (!empty($art)){
                
                    $arSelect = Array("ID", "XML_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE");
                    $arSort = array('NAME'=>'ASC');
                    
                    $arFilter = array('IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $art,  'ACTIVE'=>'Y');
                    
                    $res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nTopCount" => 1), $arSelect);
                    
                    if ( $res->SelectedRowsCount() > 0 ){
                        
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td style='text-align:left;'><nobr>".$art."</nobr></td>";
                        
                        while($ar_result_in = $res->GetNext()) {
                            /*echo "<pre>";
                                print_r($ar_result_in);
                            echo "</pre>";*/
                            
                            echo "<td>";
                            echo $ar_result_in['NAME'];
                            //echo "<a href='https://traiv-komplekt.ru".$ar_result_in['DETAIL_PAGE_URL']."'>https://traiv-komplekt.ru".$ar_result_in['DETAIL_PAGE_URL']."</a>";
                            echo "</td>";
                            
                            echo "<td>";
                            //echo $ar_result_in['DETAIL_PICTURE'];
                            
                            if (empty($ar_result_in['DETAIL_PICTURE'])){
                            $db_groups = CIBlockElement::GetElementGroups($ar_result_in['ID'], true);
                            $res_rows = intval($db_groups->SelectedRowsCount());
                            if ($res_rows > 0){
                                while($ar_group = $db_groups->Fetch()) {
                                    if (!empty($ar_group['PICTURE'])){
                                        /*echo "<pre>";
                                        print_r($ar_group['PICTURE']);
                                        echo "</pre>";*/
                                        $idPic = $ar_group['PICTURE'];
                                        break;
                                    }
                                    
                                }
                            }
                            } else {
                                $idPic = $ar_result_in['DETAIL_PICTURE'];
                            }
                            
                            //echo $idPic;
                            
                            /*$arr = CFile::MakeFileArray($idPic);
                            echo "<pre>";
                                print_r($arr);
                            echo "</pre>";
                            //echo SITE_DIR;
                            echo $pathfile = CFile::GetPath($idPic);*/
                            
                            $fileInfo = CFile::GetByID($idPic);
                            if($fileArr = $fileInfo->Fetch())
                            {
                                echo $fileArr['FILE_NAME'];
                                /*$newFilePath = 'for2fix/'.$fileArr['FILE_NAME'];
                                $fileCopy = CFile::CopyFile($idPic, true, $newFilePath);*/
                            }
                            
                            //die;
                            
                            echo "</td>";
                            
                        }
                    }
                    
                    /*if ( $res->SelectedRowsCount() > 0 ){
                        while($ar_result_in = $res->GetNext()) {
                            echo "<td>";
                            echo "<pre>";
                            print_r($ar_result_in);
                            echo "</pre>";
                            
                            echo "<br>";
                            $res_name = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"TRANSIT_NUM"));
                            while ($ob_name = $res_name->GetNext()) {
                                if (!$ob_name['VALUE'] || $ar_result_in['PROPERTY_TRANSIT_NUM_VALUE'] != $kolvo){
                                    echo "TRANSIT Обновляем!";
                                   // CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("TRANSIT_NUM" => $kolvo));
                                }
                                else {
                                    echo "Не обновляем!";
                                }
                            }
                            
                            echo "</td>";
                        }
                    }*/
                   // die;
                    
                   /* $arSelect = Array("DETAIL_PAGE_URL");
                    $arSort = array('NAME'=>'ASC');
                    
                    $arFilter = array('IBLOCK_ID' => 18, "ID" => $id,  'ACTIVE'=>'Y');
                    
                    $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
                    if ( $res->SelectedRowsCount() > 0 ){
                        
                        while($ar_result_in = $res->GetNext()) {
                            

                            echo "<td>";
                            echo "<pre>";
                            print_r($ar_result_in['DETAIL_PAGE_URL']);
                            echo "</pre>";
                        
                            echo "</td>";
                            
                            echo "<td>";
                            if (!empty($ar_result_in['IBLOCK_SECTION_ID'])) {
                            $rsElement = CIBlockSection::GetList(array(), array('ID' => $ar_result_in['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL'));
                            while($arElement = $rsElement->GetNext()){
                                echo "<pre>";
                                print_r($arElement['SECTION_PAGE_URL']);
                                echo "</pre>";
                            }
                            } else {
                                echo "Родитель не установлен!";
                            }
                            
                            echo "</td>";
                            
                        }
                        
                        
                    } else {
                        echo "<td>";
                        echo "Не активен";
                        echo "</td>";
                        echo "<td>";
                        echo "Не активен";
                        echo "</td>";
                    }
                    */
                
                echo "</tr>";
                $i++;
                }
                
                unset($art);
                //die;
            }
            fclose($handle);
        }
        
        echo "</table>";
        
    }
}

?>

