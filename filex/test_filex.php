<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '3443') {
        
        if (!empty($_FILES["file_price"]["name"])) {
            
            $temp = explode(".", $_FILES["file_price"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_dir = $_SERVER["DOCUMENT_ROOT"]."/upload_filex/";
            $uploadfile  = $target_dir . $newfilename;
            if (move_uploaded_file($_FILES['file_price']['tmp_name'], $uploadfile) === false) {
                echo "Не загружено!";
            } else {
                
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($uploadfile);
                
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                
                $arr_new = [];
                
                foreach($rows as $key=>$val)
                {
                    $code = $val[0];
                    $arr_new[] = $code;
                }
                
                
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $i = 2;
                
                $sheet->setCellValue('A1', 'Фото');
                $sheet->setCellValue('B1', 'Код');
                $sheet->setCellValue('C1', 'Наименование');
                $sheet->setCellValue('D1', 'Артикул сайт');
                $sheet->setCellValue('E1', 'Стандарт');
                $sheet->setCellValue('F1', 'Диаметр');
                $sheet->setCellValue('G1', 'Длина');
                $sheet->setCellValue('H1', 'Материал');
                $sheet->setCellValue('I1', 'Покрытие');
                $sheet->setCellValue('J1', 'Металл');
                $sheet->setCellValue('K1', 'Цена');
                $sheet->setCellValue('L1', 'Склад Кудрово');
                $sheet->setCellValue('M1', 'Склад Европа');
                
                foreach($arr_new as $key=>$code) {
                    
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "CATALOG_QUANTITY");
                    $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_TRAITS" => $code,'CATALOG_GROUP_ID' => 2], false, false, $arSelect);
                    
                    while($ar_result_in = $db_list_in->GetNext())
                    {
                        /*echo "<pre>";
                         print_r($ar_result_in);
                         echo "</pre>";*/
                        
                        $arFile = CFile::GetFileArray($ar_result_in['DETAIL_PICTURE']);
                        if (!empty($arFile['SRC'])){
                            $img = $arFile['SRC'];
                        } else {
                            
                            $rsElement = CIBlockElement::GetList(array(), array('ID' => $ar_result_in['ID']), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PICTURE'));
                            if($arElement = $rsElement->Fetch())
                                
                                
                                $rsElement = CIBlockSection::GetList(array(), array('ID' => $arElement['IBLOCK_SECTION_ID']), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));
                                if($arElement = $rsElement->Fetch())
                                    $img = CFile::GetPath($arElement['PICTURE']);
                        }
                        
                        if (empty($img)){
                            $img = $_SERVER["DOCUMENT_ROOT"]."/upload/nfuni.jpg";
                        }
                        
                        
                        if (file_exists($_SERVER["DOCUMENT_ROOT"].$img))
                        {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setPath($_SERVER["DOCUMENT_ROOT"].$img);
                            $drawing->setCoordinates('A'.$i);
                            $drawing->setResizeProportional(false);
                            $drawing->setWidth(80);
                            $drawing->setHeight(80);
                            $drawing->setOffsetX(25);
                            $drawing->setOffsetY(15);
                            $drawing->setWorksheet($spreadsheet->getActiveSheet());
                        }
                        else
                        {
                            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                            $drawing->setPath($_SERVER["DOCUMENT_ROOT"].'/upload/nfuni.jpg');
                            $drawing->setCoordinates('A'.$i);
                            $drawing->setResizeProportional(false);
                            $drawing->setWidth(80);
                            $drawing->setHeight(80);
                            $drawing->setOffsetX(25);
                            $drawing->setOffsetY(15);
                            $drawing->setWorksheet($spreadsheet->getActiveSheet());
                        }
                        $sheet->getRowDimension($i)->setRowHeight(80);
                        $sheet->getColumnDimension('A')->setWidth(20);
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"CML2_ARTICLE"));
                        while ($ob = $res->GetNext()) {
                            $art = $ob['VALUE'];
                        }
                        
                        //получаем значение справочника
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"STANDART"));
                        while ($ob = $res->GetNext()) {
                            
                            $standart_name = $ob['VALUE_ENUM'];
                            
                            /*$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>18, "ID" => $ob['VALUE'],  "CODE"=>"STANDART"));
                             while($enum_fields = $property_enums->GetNext())
                             {
                             echo $standart_name = $enum_fields["VALUE"]."<br>";
                             }*/
                            
                        }
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"DIAMETR_1"));
                        while ($ob = $res->GetNext()) {
                            
                            $diametr_name = $ob['VALUE_ENUM'];
                        }
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"DLINA_1"));
                        while ($ob = $res->GetNext()) {
                            
                            $dlina_name = $ob['VALUE_ENUM'];
                        }
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"MATERIAL_1"));
                        while ($ob = $res->GetNext()) {
                            
                            $material_name = $ob['VALUE_ENUM'];
                        }
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"POKRYTIE_1"));
                        while ($ob = $res->GetNext()) {
                            
                            $pokrytie_name = $ob['VALUE_ENUM'];
                        }
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"METALL"));
                        while ($ob = $res->GetNext()) {
                            
                            $metall_name = $ob['VALUE_ENUM'];
                        }
                        
                        $db_res = CPrice::GetList(
                            array(),
                            array(
                                "PRODUCT_ID" => $ar_result_in['ID'],
                                "CATALOG_GROUP_ID" => 2
                            )
                            );
                        if ($ar_res = $db_res->Fetch())
                        {
                            $price = CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);
                        }
                        
                        $quontity = $ar_result_in['CATALOG_QUANTITY'];
                        
                        $res = CIBlockElement::GetProperty(18, $ar_result_in['ID'], array("sort" => "asc"), Array("CODE"=>"EUROPE_STORAGE"));
                        while ($ob = $res->GetNext()) {
                            
                            if (!empty($ob['VALUE'])) {
                                $europe = $ob['VALUE'];
                            } else {
                                $europe = '0';
                            }
                        }
                        
                        $sheet->setCellValue('B'.$i, $code);
                        $sheet->setCellValue('C'.$i, $ar_result_in['NAME']);
                        $sheet->setCellValue('D'.$i, $art);
                        $sheet->setCellValue('E'.$i, $standart_name);
                        $sheet->setCellValue('F'.$i, $diametr_name);
                        $sheet->setCellValue('G'.$i, $dlina_name);
                        $sheet->setCellValue('H'.$i, $material_name);
                        $sheet->setCellValue('I'.$i, $pokrytie_name);
                        $sheet->setCellValue('J'.$i, $metall_name);
                        $sheet->setCellValue('K'.$i, $price);
                        $sheet->setCellValue('L'.$i, $quontity);
                        $sheet->setCellValue('M'.$i, $europe);
                        
                    }
                    $i++;
                }
                
                
            }
            
        }
        
    }
}

$writer = new Xls($spreadsheet);

$file = 'price.xls';
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

