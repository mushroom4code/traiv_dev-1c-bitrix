<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$header = htmlspecialchars($_POST['header']);
$data = $_POST['data'];
file_put_contents('post.txt', var_export($data));
echo $header;
//$header = [1,2,3];
//$data = [[45,4,4]];
$path = 'downloads/';
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

$cache = new MyCustomPsr16Implementation();
\PhpOffice\PhpSpreadsheet\Settings::setCache($cache);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

foreach ($header as $key=>$val){
    $sheet->setCellValue($chars[$key].'1', $val);

    $sheet->getColumnDimension($chars[$key])->setWidth(20);
    $sheet->getStyle($chars[$key].'1')->getFont()->setBold(true);
}
foreach ($data as $i=>$item){
    foreach ($item as $key2=>$val){
        $row = $i+2;
        $sheet->setCellValue($chars[$key2].$row, $val);
    }
}
$writer = new Xls($spreadsheet);
$full_path = $path.'download'.uniqid('',true).'.xls';
$writer->save($full_path);
echo json_encode([
    'result'=>1,
    'link'=>$full_path
]);