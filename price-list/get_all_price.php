<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

/*if ($USER->IsAuthorized())
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '1788'){*/
                
            /*$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE","PROPERTY_CML2_ARTICLE","PROPERTY_EUROPE_STORAGE");
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
                die;
            }*/

            
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $i = 3;
                
                $img_head = "/upload/header_xsl_price.jpg";
                
                $sheet->getRowDimension('1')->setRowHeight(180);
                //$sheet->getColumnDimension('A')->setWidth(100);
                
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setPath($_SERVER["DOCUMENT_ROOT"].$img_head);
                $drawing->setCoordinates('A1');
                $drawing->setResizeProportional(false);
                $drawing->setWidth(525);
                $drawing->setHeight(220);
                //$drawing->setOffsetX(25);
                //$drawing->setOffsetY(15);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());
                
                //$sheet->setCellValue('A2', 'Фото');
                $sheet->setCellValue('A2', 'Артикул');
                //$sheet->setCellValue('B2', 'Наименование');
                $sheet->setCellValue('B2', 'Стандарт');
                $sheet->setCellValue('C2', 'Диаметр');
                $sheet->setCellValue('D2', 'Длина');
                $sheet->setCellValue('E2', 'Материал');
                $sheet->setCellValue('F2', 'Покрытие');
                //$sheet->setCellValue('H2', 'Металл');
                $sheet->setCellValue('G2', 'Кратность');
                $sheet->setCellValue('H2', 'Цена (руб.)');
                $sheet->setCellValue('I2', 'Товар на сайте');
                
                $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_YELLOW);
                $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
                //$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                //$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
                //$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
                //$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
                
                $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE","PROPERTY_CML2_ARTICLE","PROPERTY_EUROPE_STORAGE");
                $arSort = array('NAME'=>'ASC');
                
                $arFilter = array('IBLOCK_ID'=>"18",
                    'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y', ">CATALOG_PRICE_2" => 0);
                $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
                if ( $res->SelectedRowsCount() > 0 ){
                    while($ar_result_in = $res->GetNext()) {

                        
                        
                        if (empty($ar_result_in['CATALOG_PRICE_2']) || $ar_result_in['CATALOG_PRICE_2'] == 0) {
                            $price_value = "По запросу";
                        } else {
                            $price_value = $ar_result_in['CATALOG_PRICE_2'];
                        }
                        
                        if ($price_value != "По запросу" && !empty($ar_result_in['PROPERTY_CML2_ARTICLE_VALUE']) && !empty($ar_result_in['PROPERTY_606_VALUE']) && !empty($ar_result_in['PROPERTY_613_VALUE']) && !empty($ar_result_in['PROPERTY_610_VALUE']) && !empty($ar_result_in['PROPERTY_611_VALUE'])) {
                        
                        $sheet->setCellValue('A'.$i, $ar_result_in['PROPERTY_CML2_ARTICLE_VALUE']);
                        $sheet->setCellValue('B'.$i, $ar_result_in['PROPERTY_606_VALUE']);
                        $sheet->setCellValue('C'.$i, $ar_result_in['PROPERTY_613_VALUE']);
                        $sheet->setCellValue('D'.$i, $ar_result_in['PROPERTY_612_VALUE']);
                        $sheet->setCellValue('E'.$i, $ar_result_in['PROPERTY_610_VALUE']);
                        $sheet->setCellValue('F'.$i, $ar_result_in['PROPERTY_611_VALUE']);
                        //$sheet->setCellValue('H'.$i, $ar_result_in['PROPERTY_453_VALUE']);
                        $sheet->setCellValue('G'.$i, $ar_result_in['PROPERTY_604_VALUE'] = $ar_result_in['PROPERTY_604_VALUE'] ?? "1");
                        $sheet->setCellValue('H'.$i, $price_value);
                        
                        $styleArray = array(
                            'font'  => array(
                                'color' => array('rgb' => '024dbc'),
                            ));
                        
                        $sheet->setCellValue('I'.$i, 'https://traiv-komplekt.ru'.$ar_result_in['DETAIL_PAGE_URL']);
                        
                        $sheet->getCell('I'.$i)
                        ->getHyperlink()
                        ->setUrl('https://traiv-komplekt.ru'.$ar_result_in['DETAIL_PAGE_URL'])
                        ->setTooltip('Посмотреть товар на сайте');
                        
                        $sheet->getStyle('I'.$i)->applyFromArray($styleArray);
                        /*Остатки*/
                       /* if ($ar_result_in['CATALOG_QUANTITY'] < 0){
                            $quantity = "0";
                        } else {
                            $quantity = $ar_result_in['CATALOG_QUANTITY'];
                        }
                        $sheet->setCellValue('K'.$i, $quantity);*/
                        /*Остатки end*/
                        //$sheet->setCellValue('L'.$i, $ar_result_in['PROPERTY_EUROPE_STORAGE_VALUE']);
                        
                        $i++;
                        }
                  }
                }
                
                $writer = new Xls($spreadsheet);
                
                $file = 'traiv-komplekt.ru'.date('d.m.Y-H:i').'.xls';
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
            

            
   /*     }
    }*/


?>

