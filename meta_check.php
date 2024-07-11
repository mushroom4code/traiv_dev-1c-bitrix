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
                
                echo "<tr>";
                
                echo "<td>";
                //$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
                $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 23, /*'CODE' => $name,*/ 'ACTIVE'=>'Y'/*, 'ID' => '139300'*/], false, false);
                
                while($ar_result_in = $db_list_in->GetNext())
                {
                    echo "<div>".$ar_result_in['ID']." // ".$ar_result_in['NAME']."</div>";
                    
                    $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(23, $ar_result_in["ID"]);
                    $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
                    ?><pre><?
                    
                    if (empty($arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"])){
                    echo "<div style='font-weight:bold;border:1px green solid;'>Не заполнено</div>";
                        var_dump($arResult["IPROPERTY_VALUES"]);
                        
                        /*обновление мета полей*/
                        /*$bs = new CIBlockElement();
                         $arFields = [];
                         $arFields["IPROPERTY_TEMPLATES"] = array(
                         "ELEMENT_META_TITLE" => $ar_result_in['NAME']
                         );
                         
                         
                         $bs->Update($ar_result_in['ID'], $arFields);*/
                        /*end обновление мета полей*/
                        
                        die;
                    }
                    else {
                        var_dump($arResult["IPROPERTY_VALUES"]);
                        echo "<div style='font-weight:bold;border:1px green solid;'>Заполнено</div>";
                    }?></pre><?
                    
                    
                    
                    
                }
                echo "</td>";
                
                echo "</tr>";

        
        echo "</table>";        
    }
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>