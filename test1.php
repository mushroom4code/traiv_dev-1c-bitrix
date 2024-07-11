<?
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("test");


$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_CML2_ARTICLE");
$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => 4720], false, false, $arSelect);
echo "<table border='1'>";

while($ar_result_in = $db_list_in->GetNext())
{
    echo "<tr>";
    echo "<td>";
    echo $ar_result_in['NAME'];
    echo "</td>";
    
    echo "<td>";
    echo $ar_result_in['PROPERTY_CML2_ARTICLE_VALUE'];
    echo "</td>";
    
    echo "</tr>";
    /*echo "<pre>";
    print_r($ar_result_in);
    echo "</pre>";*/
    
    
}
echo "</table>";
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => 4720/*, 'ID' => 106048*/], false, false);
        if ($db_list_in->SelectedRowsCount()>0){
            while($ar_result_in = $db_list_in->GetNext()){
                $db_old_groups = CIBlockElement::GetElementGroups($ar_result_in['ID'], false);
                $newArr = array();
                while($ar_group = $db_old_groups->Fetch()){
                    echo "<pre>";
                    print_r($ar_group);
                    echo "</pre>";
                    //echo "<pre>";
                    if ($ar_group['ID'] != 4720){
                        $newArr[] = $ar_group['ID'];
                    }
                    //echo "</pre>";
                }
                echo "<pre>";
                print_r($newArr);
                echo "</pre>";
                
                if (isset($newArr) && count($newArr) > 0){
                    /*echo CIBlockElement::SetElementSection($ar_result_in['ID'], $newArr);
                     \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex('18', $ar_result_in['ID']);*/
                }
            }
        }
    }
}
die;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
 

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "CATALOG_QUANTITY", "CATALOG_PRICE_2");
$db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_TRAITS" => '00-00095025','CATALOG_GROUP_ID' => 2], false, false, $arSelect);

while($ar_result_in = $db_list_in->GetNext())
{
    echo "<pre>";
    print_r($ar_result_in);
    echo "</pre>";
    
}

    }
}

die;
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(10)->fetch();
        
        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        
        $data = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC")
        ));
        echo "<table>";
        if (intval($data->getSelectedRowsCount()) > 0){
            while($arData = $data->Fetch()){
                //$b_item_name = $arData['UF_BONUS_ITEM_NAME'];
                //$b_item_img = CFile::GetPath($arData['UF_BONUS_ITEM_IMG']);
                echo "<tr>";
                echo "<td>";
                echo $b_item_num = $arData['UF_UTP_TITLE'];
                echo "</td>";
                echo "<td>";
                echo $b_item_num = $arData['UF_UTP'];
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        
    }
}

die;

die;
?>

<?
/*установка галки Выгружать на yandex маркет*/
//die;
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, /*'ID' => '5094', 'ID' => 519,'ID'=>'5271',*/ 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array('UF_*'));
        echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
        $i=1;
        while($ar_result = $db_list->GetNext())
        {
            echo "<tr>";
            echo "<td align='left'>";
            echo "<div>".$ar_result['ID']."</div>";
            echo "<div>".$ar_result['NAME']."</div>";
            echo "<div><b>".$ar_result['UF_FROM_PRICE']."</b></div>";
            echo "<div><b>".var_dump($ar_result['UF_FROM_PRICE'])."</b></div>";
            echo "</td>";
            echo "</tr>";
            
            $db_list_in = CIBlockElement::GetList(array("CATALOG_PRICE_2"=>"ASC"), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], /*'ID' => '246401',*/ 'ACTIVE'=>'Y', ">CATALOG_PRICE_2" => 0], false,Array("nTopCount" => 1));
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
                echo "</td>";
                
                if (!empty($ar_result_in['CATALOG_PRICE_2'])/* && empty($ar_result['UF_FROM_PRICE'])*/){
                    echo "<td>";
                    echo "Записываем";
                    echo "</td>";
                     $bs = new CIBlockSection;
                     $bs->Update($ar_result['ID'], array('UF_FROM_PRICE' => 'от '.$ar_result_in['CATALOG_PRICE_2'].' руб.'));
                }
                echo "</tr>";
                
            }
            
        }
        echo "</table>";
        
  die;
        $array_cat = [
            '52'/*,
            '53',
            '54',
            '58',
            '68',
            '69',
            '74',
            '75',
            '76',
            '77',
            '994',
            '78',
            '1334'*/
        ];
        
        $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, /*'SECTION_ID' => $array_cat, 'ID' => 519,*/ 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false);
        echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
        $i=1;
        while($ar_result = $db_list->GetNext())
        {
            
           /* echo "<pre>";
            print_r($ar_result);
            echo "</pre>";*/
            
             echo "<tr>";
             echo "<td align='left'>";
             echo "<div>".$ar_result['ID']."</div>";
             echo "<div>".$ar_result['NAME']."</div>";
             echo "</td>";
             echo "</tr>";
            
             $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], /*'ID' => '246401',*/'PROPERTY_YMARKET' => '16991', 'ACTIVE'=>'Y',  array(
                 "LOGIC" => "AND",
                 ">CATALOG_QUANTITY" => 500, ">CATALOG_PRICE_2" => 0 ), 'CATALOG_GROUP_ID' => 2], false);
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                
                /*echo "<pre>";
                print_r($ar_result_in);
                echo "</pre>";*/
                
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$i." // ".$ar_result_in['ID']." // ".$ar_result_in['NAME']." // ".$ar_result_in['CATALOG_PRICE_2']." // ".$ar_result_in['CATALOG_QUANTITY']."</div>";
                
                
                /*обновляем галку Ymarket*/
                $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"YMARKET"));
                while ($ob = $res->GetNext()) {
                    echo "<div>";
                    if (!$ob['VALUE']){
                        echo "Обновляем!";
                        //CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("YMARKET" => '16991'));
                    }
                    else {
                        echo "Не обновляем!";
                    }
                    echo "</div>";
                }
                /*end обновляем галку Ymarket*/
                
                /*обновляем детальную картинку*/
                
                if (!$ar_result_in['DETAIL_PICTURE'] && !empty($ar_result['DETAIL_PICTURE'])){
                    echo "_Фото Обновляем!";
                    
                    $rsFile = CFile::GetPath($ar_result['DETAIL_PICTURE']);
                    
                    if (!empty($rsFile)) {
                    /*$el = new CIBlockElement;
                    $arDetailPic = Array(
                        "DETAIL_PICTURE" => CFile::MakeFileArray($rsFile)
                    );
                    echo $res = $el->Update($ar_result_in['ID'], $arDetailPic);
                    echo $el->LAST_ERROR;*/
                    }
                   
                }
                else {
                    echo "Не обновляем фото!";
                }
                
                /*end обновляем детальную картинку*/
                
                /*обновляем отформатированное имя*/
                echo "<br>";
                $res_name = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"FORMATED_NAME"));
                while ($ob_name = $res_name->GetNext()) {
                    if (!$ob_name['VALUE']){
                        echo "_Имя Обновляем!";
                        echo $ar_result_in['NAME'];
                        
                        
                        $origname = $ar_result_in["NAME"];
                        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                        echo $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Евр|Ев|PU=.*|RU=.*/","",$formatedPACKname);
                       // CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("FORMATED_NAME" => $formatedname));
                    }
                    else {
                        echo "Не обновляем имя!";
                    }
                }
                
                /*end обновляем отформатированное имя*/
                
                
                
                echo "</td>";
                echo "</tr>";
                $i++;
            }
        }
        echo "</table>";
        
    }
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
die;
/*установка баннера*/
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {

        
        $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'ACTIVE'=>'Y'], false);
        echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
        while($ar_result = $db_list->GetNext())
        {
            /*if ($ar_result['ID'] == '3734')
            {*/
           /* echo "<tr>";
            echo "<td align='left'>";
            echo "<div>".$ar_result['ID']."</div>";
            echo "</td>";
            echo "</tr>";*/
            /*если латунь*/
            $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => $ar_result['ID'], 'ACTIVE'=>'Y', "PROPERTY_MATERIAL_1" => 15149], false);
            
            while($ar_result_in = $db_list_in->GetNext())
            {
                echo "<tr>";
                echo "<td align='left'>";
                echo "<div>".$ar_result_in['ID']." // ".$ar_result_in['NAME']."</div>";
                
                /*if ($ar_result_in['ID'] == '134849')
                {*/
                $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"SALE_BANNER"));
                while ($ob = $res->GetNext()) {
                    
                    if (!$ob['VALUE']){
                        echo "Обновляем!";
                        //CIBlockElement::SetPropertyValuesEx($ar_result_in['ID'], 18, array("SALE_BANNER" => '248315'));
                    }   
                    else {
                        echo "Не обновляем!";
                    }
                }
                //}
                
                echo "</td>";
                echo "</tr>";
            }
            //}
        }
            echo "</table>";
        
    }
}

/*
if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092') {
        
        $resItem = CIBlockElement::GetByID('104577');
        if ($ar_res = $resItem->GetNext()) {
            $data = $ar_res;
            echo "<pre>";
            print_r($data['DETAIL_PICTURE']);
            echo "</pre>";
            
            echo "<pre>";
            $arFile = CFile::GetFileArray($data['DETAIL_PICTURE']);
            print_r($arFile);
            echo "</pre>";
            
        }
    }
}
*/

/*
ERROR_REPORTING(E_ALL);
if ( $USER->IsAuthorized() )
	{
	    if ($USER->GetID() == '3092') {
	        
	        
	        
	        $legtest = @file_get_contents(
	            'http://new.m-analytics.ru/getstmtext/4377287_15?url=https%3A%2F%2Ftraiv-komplekt.ru%2Fcatalog%2Fcategories%2Fankery%2F_izm_10_120_1000%2F'
	            );
	        if($legtest != "" && $legtest != "n"){
	            echo $legtest;
	            
	            $el_id = 105698;

	            
	            $el = new CIBlockElement;
	            $arLoadProductArray = Array(
	                "DETAIL_TEXT_TYPE" => "html",
	                "DETAIL_TEXT" => $legtest,
	            );
	            $res = $el->Update($el_id, $arLoadProductArray);
	        }
	        
	        
	    }
	}*/
	?>

