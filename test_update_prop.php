<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>
<?
die;
 if ( $USER->IsAuthorized() )
{
    $new_array = array();
    //echo var_dump($new_array);
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"DIAMETR_1"));
    while($enum_fields = $property_enums->GetNext())
    {
        //if ($enum_fields['ID'] == '15851') {
        if ($enum_fields['VALUE'] != '0'){
            //echo $enum_fields["ID"]." - ".$enum_fields["VALUE"]."<br>";
            
            /*echo "<pre>";
            print_r($enum_fields);
            echo "</pre>";*/
            
            $new_array[] = array (
            'ID' => $enum_fields['ID'],
            'VALUE' => str_replace(",",".",$enum_fields['VALUE']),
                'SORT' => $enum_fields['SORT']);
            
        }
        //}
        //die;
    }
    
    
   /* echo "<pre>";
    print_r($new_array);
    echo "</pre>";*/
    
    usort($new_array, function($a, $b) {
        $a = $a['VALUE'];
        $b = $b['VALUE'];
    
    
        if ($a == $b) {
            return 0;
        } elseif (($a < $b)) {
            return empty($a) ? 1 : -1;
        } else {
            return empty($b) ? -1 : 1;
        }
    });
$i = 10;   
        foreach($new_array as $k => $v)
        {
            //echo $v['ID'];
            echo $v['VALUE'];
            //echo $v['SORT'];
            echo "<br>";
            echo $i;
            
            if (!empty($v['ID'])) {
                /*$ibpenum = new CIBlockPropertyEnum;
                $ibpenum->Update($v['ID'], Array('SORT'=>$i));*/
                $i+=10;
            }
            
            
            echo "<br>";
        }
    
        echo "<pre>";
        print_r($new_array);
        echo "</pre>";
    
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>