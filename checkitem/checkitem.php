<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '7174' || $USER->GetID() == '2938' ) {
     
     if (!empty($_FILES["file_price"]["name"])) {
        
         $temp = explode(".", $_FILES["file_price"]["name"]);
         $newfilename = round(microtime(true)) . '.' . end($temp);
         $target_dir = $_SERVER["DOCUMENT_ROOT"]."/upload_filex/";
         $uploadfile  = $target_dir . $newfilename;
         if (move_uploaded_file($_FILES['file_price']['tmp_name'], $uploadfile) === false) {
             echo "Не загружено!";
         }
         else {
             
             $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($uploadfile);
             
             $worksheet = $spreadsheet->getActiveSheet();
             $rows = $worksheet->toArray();
             
             
             $arr_new = [];
             
             foreach($rows as $key=>$val)
             {
                 if (!empty($val[3]) && !empty($val[16]) && strlen($val[16]) == 7){
                     $name = $val[3];
                     $code = $val[16];
                     $arr_new[$key]['name'] = $name;
                     $arr_new[$key]['art'] = str_replace(",","",$code);
                 }
                 
             }

             $spreadsheet = new Spreadsheet();
             $sheet = $spreadsheet->getActiveSheet();
             $i = 2;
             
             $sheet->setCellValue('A1', 'Наименование из загружаемого файла');
             $sheet->setCellValue('B1', 'Артикул');
             $sheet->setCellValue('C1', 'Результат');
             $sheet->setCellValue('D1', 'Ссылка');
             
             foreach($arr_new as $key=>$code) {
                 
                 $arSelect = Array("ID", "NAME","DETAIL_PAGE_URL");
                 $arSort = array('NAME'=>'ASC');
                 
                 $arFilter = array('IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $code['art'], 'ACTIVE'=>'Y');
                 
                 $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
                 if ( $res->SelectedRowsCount() > 0 ){
                     $result = "есть";
                     
                     while($ar_result_in = $res->GetNext()) {
                         $detail_url = $ar_result_in['DETAIL_PAGE_URL'];
                     }
                     
                 } else {
                     $result = "нет";
                     $detail_url = "-";
                 }
                 
                 $sheet->setCellValue('A'.$i, $code['name']);
                 $sheet->setCellValue('B'.$i, $code['art']);
                 $sheet->setCellValue('C'.$i, $result);
                 $sheet->setCellValue('D'.$i, $detail_url);

                 $i++;
             }

             
         }
         
     }
     
    }
}

$writer = new Xlsx($spreadsheet);

$file = 'checkitem_result.xls';
$writer->save($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file);

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file));
    readfile($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file);
    unlink($_SERVER["DOCUMENT_ROOT"]."/upload_filex/".$file);
    unlink($uploadfile);
    exit;
}


?>

