<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("title_check");
?>
<?
die;
 if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
       // die;
        echo "<table border='1' aling='left'>";
        
        $row = 1;
        if (($handle = fopen("title1.csv", "r")) !== FALSE) {
            $i = 1;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                $row++;
                
                
                for ($c=0; $c < $num; $c++) {
                    if ($c == 0)
                    {
                        $name = $data[$c];
                        $name = iconv('windows-1251','utf-8',$name);
                        $name = str_replace("'", "", $name);
                    }
                }
                $i++;
                
                
                
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='text-align:left;'>".$name."</td>";
                
                echo "<td>";
                //$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
                $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 31, 'CODE' => $name, 'ACTIVE'=>'Y'/*, 'ID' => '139300'*/], false, false);
                
                while($ar_result_in = $db_list_in->GetNext())
                {
                    echo "<div>".$ar_result_in['ID']." // ".$ar_result_in['NAME']."</div>";
                    
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(23, $ar_result_in["ID"]);
                    $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
                    ?><pre><?var_dump($arResult["IPROPERTY_VALUES"]);?></pre><?
                    
                    
                    /*обновление мета полей*/
                    /*$bs = new CIBlockElement();
                    $arFields = [];
                    $arFields["IPROPERTY_TEMPLATES"] = array(
                        "ELEMENT_META_TITLE" => $ar_result_in['NAME']
                    );
                    
                    
                    $bs->Update($ar_result_in['ID'], $arFields);*/
                    /*end обновление мета полей*/
                    
                }
                echo "</td>";
                
                echo "</tr>";
  
                unset($name);
                //die;
            }
            fclose($handle);
        }
        
        echo "</table>";        
    }
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>