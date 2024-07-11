<?
define('STOP_STATISTICS', true);
define('NOT_CHECK_PERMISSIONS', true);
$_POST['AJAX'] = 'Y';
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Web\Json;
$token = $_POST['token'];
$action = $_POST['action'];

// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

// verify the response
if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
$APPLICATION->RestartBuffer();

if (!\Bitrix\Main\Application::isUtfMode()) {
    $context = \Bitrix\Main\Application::getInstance()->getContext();
    $_POST['arParams']['templateName'] = \Bitrix\Main\Text\Encoding::convertEncoding($_POST['arParams']['templateName'], 'UTF-8', $context->getCulture()->getCharset());
    $_POST['arParams'] = \Bitrix\Main\Text\Encoding::convertEncoding($_POST['arParams'], 'UTF-8', $context->getCulture()->getCharset());
}

header('Content-Type: text/html; charset='.LANG_CHARSET);

foreach ($_POST['arParams'] as $key => $val){
    if(strpos($val, '-array-') !== false){
        $_POST['arParams'][$key] = explode('-array-', $val);
        TrimArr($_POST['arParams'][$key]);
    }
}


$APPLICATION->IncludeComponent('slam:easyform', $_POST['arParams']['templateName'], $_POST['arParams']);
} else {
    $result = array(
        'result' => 'error',
        'message' => implode("</br>", 'Ошибка при проверке капчи'),
    );
    echo Json::encode($result);
}
?>