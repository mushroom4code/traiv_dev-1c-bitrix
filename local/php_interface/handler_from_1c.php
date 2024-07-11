<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_POST) {
    $file_name = $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/data_to_1c.txt";
    $file = file_get_contents($file_name);

    $file .= print_r($_POST, true) . "\n";
    $file .= "------------\n";

    /*
    if($_POST["ДанныеОт1С"]){
        $file .= "JSON:\n";
        $file .= print_r($_POST["ДанныеОт1С"], true) . "\n";
        $file .= "------------\n";
    }
    */

    $data = json_decode($_POST["ДанныеОт1С"]);
    $file .= print_r($data, true) . "\n";
    $file .= date("Y-m-d H:i:s") . "\n=====================\n";
    file_put_contents("data_from_1c.txt", $file."\n");

    $status = $_POST["Статус"];
    $orderID = $_POST["НомерЗаявки"];

    if (empty($orderID) || empty($status)) {
        $status = $data["Статус"];
        $orderID = $data["НомерЗаявки"];
    }

    if (!empty($orderID) && !empty($status)) {
        if (CModule::IncludeModule("sale")) {
            CSaleOrder::StatusOrder($orderID, $status);
        }
    }
}