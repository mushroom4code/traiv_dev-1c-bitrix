<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

if ($USER->IsAuthorized())
{
    if ($USER->GetID() == '3092'){
        if (!empty($_POST['standart']) || !empty($_POST['diametr']) || !empty($_POST['material']) || !empty($_POST['pokritie'])) {
                
            $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE","PROPERTY_CML2_ARTICLE","PROPERTY_EUROPE_STORAGE");
            $arSort = array('NAME'=>'ASC');
            
            $arFilter = array('IBLOCK_ID'=>"18",
                'PROPERTY_606_VALUE'=>$_POST['standart'],
                'PROPERTY_613_VALUE'=>$_POST['diametr'],
                'PROPERTY_610_VALUE'=>$_POST['material'],
                'PROPERTY_611_VALUE'=>$_POST['pokritie'],
                'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y');
            $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
            if ($res->SelectedRowsCount() == 0){
                echo "<script>alert('В соответствии с условиями выборки товары не найдены. Попробуйте поменять условия!');window.history.back();</script>";
                //header("Location: https://traiv-komplekt.ru/filex_list/");
                die;
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
                
                $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE","PROPERTY_CML2_ARTICLE","PROPERTY_EUROPE_STORAGE");
                $arSort = array('NAME'=>'ASC');
                
                $arFilter = array('IBLOCK_ID'=>"18",
                    'PROPERTY_606_VALUE'=>$_POST['standart'],
                    'PROPERTY_613_VALUE'=>$_POST['diametr'],
                    'PROPERTY_610_VALUE'=>$_POST['material'],
                    'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y');
                $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
                if ( $res->SelectedRowsCount() > 0 ){
                    while($ar_result_in = $res->GetNext()) {
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
                        
                        $sheet->setCellValue('B'.$i, $ar_result_in['PROPERTY_CML2_ARTICLE_VALUE']);
                        $sheet->setCellValue('C'.$i, $ar_result_in['NAME']);
                        $sheet->setCellValue('D'.$i, $ar_result_in['PROPERTY_CML2_ARTICLE_VALUE']);
                        $sheet->setCellValue('E'.$i, $ar_result_in['PROPERTY_606_VALUE']);
                        $sheet->setCellValue('F'.$i, $ar_result_in['PROPERTY_613_VALUE']);
                        $sheet->setCellValue('G'.$i, $ar_result_in['PROPERTY_612_VALUE']);
                        $sheet->setCellValue('H'.$i, $ar_result_in['PROPERTY_610_VALUE']);
                        $sheet->setCellValue('I'.$i, $ar_result_in['PROPERTY_611_VALUE']);
                        $sheet->setCellValue('J'.$i, $ar_result_in['PROPERTY_453_VALUE']);
                        $sheet->setCellValue('K'.$i, $ar_result_in['CATALOG_PRICE_2']);
                        $sheet->setCellValue('L'.$i, $ar_result_in['CATALOG_QUANTITY']);
                        $sheet->setCellValue('M'.$i, $ar_result_in['PROPERTY_EUROPE_STORAGE_VALUE']);
                        
                        $i++;
                    }
                }
            }
        }
    }

$writer = new Xls($spreadsheet);

$file = 'price_list.xls';
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
    exit;
}
?>

