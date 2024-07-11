<?
die;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
$target_dir = $_SERVER["DOCUMENT_ROOT"]."/upload/decodefile/";
$uploadfile  = $target_dir . 'dnoemn.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($uploadfile);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();
if (is_countable($rows) && count($rows) > 0) {
    echo $rowsCount = count($rows);
}

if ($rowsCount >= 50){
    echo '{"error": "Количество строк в файле больше 50!"}';
    exit;
}

die;
$db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'SECTION_ID' => ['111','56','123','4786'],/* 'ID' => 519,'ID'=>'5271',*/ 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array());
//echo $db_list->SelectedRowsCount();
echo "<table cellpadding='3' cellspacing='3' style='border:1px green solid;' border='1'>";
$i=1;
while($ar_result = $db_list->GetNext())
{
    echo "<tr>";
    echo "<td align='left'>";
    //echo "<div>".$ar_result['ID']."</div>";
    echo "<div>".$ar_result['NAME']."</div>";
    echo "</td>";
    //echo "</tr>";
    
    $db_list_in = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18, 'ID' => $ar_result['ID'],/* 'ID' => 519,'ID'=>'5271',*/ 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,array('UF_*'));
    //echo $db_list->SelectedRowsCount();
    //echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
    while($ar_result_in = $db_list_in->GetNext())
    {
        //echo "<tr>";
        echo "<td align='left'>";

        echo "<div>";
            echo $rsFile = "https://traiv-komplekt.ru".CFile::GetPath($ar_result_in['PICTURE']);
        echo "</div>";
        echo "</td>";
        echo "<td align='left'>";
        echo "<div>".$ar_result_in['SECTION_PAGE_URL']."</div>";
        echo "</td>";
        echo "<td align='left'>";
        echo "<div>".$ar_result_in['UF_PREVIEW_TEXT']."</div>";
        
        /*echo "<pre>";
            print_r($ar_result_in['PICTURE']);
        echo "</pre>";*/
        
        echo "</td>";
        //echo "</tr>";
    }
    echo "</tr>";
    //echo "</table>";
    
}
echo "</table>";

?>

<?
die;
echo "<table border='1' aling='left'>";

$row = 1;
if (($handle = fopen("empty_category_item.csv", "r")) !== FALSE) {
    $i = 1;
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        $row++;
        
        
        for ($c=0; $c < $num; $c++) {
            if ($c == 0)
            {
                $code = $data[$c];
                $code = iconv('windows-1251','utf-8',$code);
            }
        }
        $i++;
        
        if (!empty($code)){
        
        echo "<tr>";
        //echo "<td>".$i."</td>";
        echo "<td style='text-align:left;width:300px;'>".$code."</td>";
        //echo "<td>";
        $arr = explode("/", $code);
        //echo "<pre>";
        $truecode = array_pop(array_filter($arr));
        //echo "</pre>";
        
        $db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 18,'=CODE' => $truecode], false);
        //echo "<table cellpadding='3' cellspacing='3' border:1px green solid;>";
        $i=1;
        while($ar_result = $db_list->GetNext())
        {
             //echo "<tr>";
             //echo "<td>".$i."</td>";
             echo "<td align='left'>";
             /*echo "<div>".$ar_result['ID']."</div>";*/
             echo "<div>".$ar_result['NAME']."</div>";
             /*$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(18, $ar_result['ID']);
             $arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
             echo "<div>".$arResult["IPROPERTY_VALUES"]['SECTION_META_TITLE']."</div>";*/
             echo "</td>";
             
             echo "<td>";
             $pos = strpos($ar_result['NAME'], "DIN");
             if( $pos !== false ) {
                 
                 $truecode = array_filter(explode(" ", substr($ar_result['NAME'],$pos)));
                 echo $truecode[0]." ".$truecode[1];
                 
             }
             
             $pos1 = strpos($ar_result['NAME'], "ISO");
             if( $pos1 !== false ) {
                 
                 $truecode_iso = array_filter(explode(" ", substr($ar_result['NAME'],$pos1)));
                 echo $truecode_iso[0]." ".$truecode_iso[1];
                 
             }
             
             $pos2 = strpos($ar_result['NAME'], "ГОСТ");
             if( $pos2 !== false ) {
                 
                 $truecode_gost = array_filter(explode(" ", substr($ar_result['NAME'],$pos2)));
                 echo $truecode_gost[0]." ".$truecode_gost[1];
                 
             }
             echo "</td>";
             
            // echo "</tr>";
             $i++;

        }
        //echo "</table>";
        
        
        //echo "</td>";
        echo "</tr>";
        
        unset($code);
        //die;
        }
    }
    fclose($handle);
}

echo "</table>";

        

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");