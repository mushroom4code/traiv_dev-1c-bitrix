<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
die;
?>

<?
/*установка галки Выгружать на yandex маркет*/

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {

        $array_cat = [
            /*'52',
            '53',
            '54',*/
            '58',
            '68',
            '69',
            '74',
            '75',
            '76',
            '77',
            '994',
            '78',
            '1334'
        ];
        
        $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $array_cat,/* 'ID' => 519,*/ 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false);
        echo "<table cellpadding='3' cellspacing='3' border='1'>";
        $i=1;
        while($ar_result = $db_list->GetNext())
        {
            
           /* echo "<pre>";
            print_r($ar_result);
            echo "</pre>";*/
            
             /*echo "<tr>";
             echo "<td align='left'>";
             echo "<div>".$ar_result['ID']."</div>";
             echo "<div>".$ar_result['NAME']."</div>";
             echo "</td>";
             echo "</tr>";*/
            
             $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], /*'ID' => '126804',*/'ACTIVE'=>'Y'/*,  array(
                 "LOGIC" => "AND",
                 ">CATALOG_QUANTITY" => 500, ">CATALOG_PRICE_2" => 0 )*/, 'CATALOG_GROUP_ID' => 2], false);
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                /*echo "<pre>";
                print_r($ar_result_in);
                echo "</pre>";*/
                
                $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"TIP_TOVARA"));
                while ($ob = $res->GetNext()) {
                    if (!empty($ob['VALUE_ENUM'])){
                    //echo "<div>".$ob['VALUE_ENUM']."</div>";
                    }
                    else {
                        
                        //echo "<div>Пусто</div>";
                        $VALUES = array();
                        
                        $db_list_in_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'ID' => $ar_result_in['ID'],'ACTIVE'=>'Y'], Array("ID", "NAME", "PROPERTY_CML2_TRAITS"));
                        
                        while($ar_result_in_in = $db_list_in_in->GetNext())
                        {
                            $VALUES[] = $ar_result_in_in['PROPERTY_CML2_TRAITS_VALUE']; // наполняем массив    
                        }
                        
                       //echo "<div>".$VALUES["3"]."</div>";
                        $r = 0;
                       $r_text = "";
                       foreach ($VALUES as $key=>$val)
                       {
                           $r_text .=  "<td>".$val."</td>";
                           
                           $property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>18, "CODE"=>"TIP_TOVARA", "VALUE"=>$val));
                           $r = $r + intval($property_enums->SelectedRowsCount());
                           
                           while($enum_fields = $property_enums->GetNext())
                           {
                               //echo "<div>".$enum_fields["ID"]." - ".$enum_fields["VALUE"]."</div>";
                               if (!empty($enum_fields["ID"])) {
                                   // CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("TIP_TOVARA" => $enum_fields["ID"]));
                               }
                           }
                           
                       }
                       
                       if ($r == 0){
                           echo "<tr>";
                           echo "<td align='left'>";
                           echo $i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME'];
                           //echo "Пусто";
                           echo "</td>";
                           //echo "<td>".$r_text."</td>";
                           echo $r_text;
                           echo "</tr>";
                       }
                       
                        
                        
                       /* echo "<pre>";
                        print_r($VALUES);
                        echo "</pre>";*/
                        
                        
                        
                    }
                }
                
                
                
                $i++;
            }
        }
        echo "</table>";
        
    }
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
	?>

