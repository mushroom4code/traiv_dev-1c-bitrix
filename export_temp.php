<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("export_test");
?>
<?
die;
 if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        die;
        echo "<table border='1' aling='left'>";
        
        $row = 1;
        if (($handle = fopen("latun2.csv", "r")) !== FALSE) {
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
                    elseif ($c == 1)
                    {
                        $kolvo = $data[$c];
                        $kolvo = iconv('windows-1251','utf-8',$kolvo);
                        $kolvo = str_replace(" ", "", $kolvo);
                        //$kolvo = (int)str_replace("'", "", $kolvo);
                    }
                    elseif ($c == 2)
                    {
                        $price = $data[$c];
                    }
                }
                $i++;
                
                
                
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td style='text-align:left;'>".$name."</td>";
                echo "<td>";
                $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_YMARKET");
                $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'NAME' => $name, 'ACTIVE'=>'Y'], false, $arSelect);
                
                while($ar_result_in = $db_list_in->GetNext())
                {
                    
                /*    $arFields = $ar_result_in->GetFields();
                    print_r($arFields);
                    $arProps = $ar_result_in->GetProperties();
                    print_r($arProps);
                  */  
                    
                    /*if ($ar_result_in['ID'] == '249033') {*/
                      /*для распродажи*/
                      //  CIblockElement::SetPropertyValuesEx($ar_result_in["ID"], 18, ["ACTION" => '15231']);
                    //}
                    
                    /*для маркета*/
                    if ($kolvo > 4500)
                    {
                        echo "this";
                        //CIblockElement::SetPropertyValuesEx($ar_result_in["ID"], 18, ["YMARKET" => 16991]);
                    }
                    /*для маркета*/
                    
                    
                    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array('IBLOCK_ID' => 18, "CODE"=>"ACTION"));
                    while($enum_fields = $property_enums->GetNext())
                    {
                        echo $enum_fields["ID"]." - ".$enum_fields["VALUE"]."<br>";
                        
                    }
                    
                }
                echo "</td>";
                echo "<td>".$kolvo."</td>";
                echo "<td>".$price."</td>";
                echo "</tr>";
  
                unset($name);
                unset($kolvo);
                unset($price);
                //die;
            }
            fclose($handle);
        }
        
        echo "</table>";
        
        /*$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'NAME' => 'DIN 933 Болт с шестигранной головкой полная резьба, полиамид M 10 x 30 PU=S (200 шт.) Европа', 'ACTIVE'=>'Y'], false);
        
        while($ar_result_in = $db_list_in->GetNext())
        {
            echo "<pre>";
                print_r($ar_result_in);
            echo "</pre>";
            
            $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array('IBLOCK_ID' => 18, "CODE"=>"YMARKET"));
            while($enum_fields = $property_enums->GetNext())
            {
                echo $enum_fields["ID"]." - ".$enum_fields["VALUE"]."<br>";
            }
            
        }*/
        
        
    }
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>