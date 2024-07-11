<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");

require_once("UnisenderApi.php");
$apikey="611jc8dyyia1eyuncxdgww6mtsoiswg878hhpgxa";
$uni=new Unisender\ApiWrapper\UnisenderApi($apikey);

$dataStr = "";
$arOrder = array(
    "NAME" => "ASC",
    "ID" => "ASC"
);
$arFilter = array(
    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
    "LID" => SITE_ID,
    "ORDER_ID" => "NULL"
);
$bres = CSaleBasket::GetList($arOrder, $arFilter, false, false, array('*'));
while ($arItem = $bres->Fetch()) {
    $dataStr .= $arItem["PRODUCT_ID"] . "|" . $arItem["QUANTITY"] . "|" . $arItem["PRICE"] . ";";
}

$res = CIBlock::GetList(
    Array(),
    Array(
        'TYPE' => 'newit_abandonedcarts',
        "CODE" => "newit_abandonedcarts",
        'SITE_ID' => SITE_ID,
    ), false
);
while ($ar_res = $res->Fetch()) {
    $IBLOCK_ID = $ar_res["ID"];
}

$exists = false;
$el = new CIBlockElement;
$PROP = array();
$PROP["DATA"] = $dataStr;

$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "NAME" => $_POST["email"]);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while ($ob = $res->GetNext()) {
    $exists = true;
}

if (stripos($_POST["email"], ".co") > -1 && !stripos($_POST["email"], ".com")) {
    $_POST["email"] = str_replace(".co", ".com", $_POST["email"]);
}

if ($exists == false) {
    $arLoadProductArray = Array(
        "IBLOCK_ID" => $IBLOCK_ID,
        "NAME" => $_POST["email"],
        "PROPERTY_VALUES" => $PROP,
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);
}

$email = $_POST["email"];
//$email = 'dmitrii.kozlov@traiv.ru';

?><table class = "cart_table">
    <td>№</td>
    <td>Наименование</td>
    <td>Количество</td>
    <td>Цена</td>
    <td>Сумма</td>
<?
$arItems = explode(";", $PROP["DATA"]);

/**/?><!--<pre><?/*print_r($arItems) */?></pre>--><?

$arItems = array_diff($arItems, array(''));

foreach ($arItems as $xyndex => $item){

    $arItemsExploded[$xyndex] = explode("|", $item);

}

/**/?><!--<pre><?/*print_r($arItemsExploded) */?></pre>--><?


foreach ($arItemsExploded as $index => $arItem) {

    /**/?><!--<pre><?/*print_r($arItem) */?></pre>--><?

    $position = $index+1;
    if (!empty($arItem[0])) {
        $resItem = CIBlockElement::GetByID($arItem[0]);
        if ($ar_res = $resItem->GetNext()) {
            $data = $ar_res;
            /* CAbandon::Log(print_r($ar_res, true));*/
        }
        $origname = $data["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Европа|Ев|PU=S|PU=K|RU=S|RU=K|PU=К/","",$formatedPACKname);

        $arItem[2] = substr($arItem[2],0,-2);

        $quantity = $arItem[1];
        $price = $arItem[2] == '0' ? 'Запросить цену' : $arItem[2].' руб.';
        $summ = $arItem[2] == '0' ? 'Запросить цену' : ($arItem[1] * $arItem[2]).' руб.';





        $names .= htmlspecialchars_decode('<tr><td>' . $position . '.</td><td><a href="' . 'https://traiv-komplekt.ru'.$data["DETAIL_PAGE_URL"] . '">' . $formatedname . '</a></td><td>'.$quantity .' шт. </td><td> '  .$summ . '</td></tr> ');

    }
}
$table = '<table style="margin: 0 auto; margin: 2px 8px; font-size: 12px; border: 1px solid #69a9d6;" width="97%">'
    .'<tbody>'
    .'<tr>'
    .'<td style="text-align: center; border: 1px solid #69a9d6;">№</td>'
    .'<td style="text-align: center; border: 1px solid #69a9d6;">Наименование</td>'
    .'<td style="border: 1px solid #69a9d6;">Количество</td>'
    .'<td style="border: 1px solid #69a9d6;">Сумма</td>'
    .'</tr>'
    .$names
    .'</tbody>'
    .'</table>';

echo $table;
/*echo '88888888888';*/
?></table><?



$result=$uni->createList(Array("title"=>"Забытая корзина - ".$email));

$answer = json_decode($result);

echo '<pre>'.print_r($answer).'</pre>';

$list_id = $answer->result->id;

$result2=$uni->getLists ();
$answer2 = json_decode($result2);

$new_emails = array ($email);

$template_id = '3663661';

$request = array (
    'api_key' => $apikey,
    'field_names[0]' => 'email',
    'field_names[1]' => 'items_data',
    'field_names[2]' => 'email_list_ids'
);
for ($i=0;$i<1;$i++){
    $request['data[' . $i .'][0]'] = $new_emails[$i];
    $request['data[' . $i .'][1]'] = $table;
    $request['data[' . $i .'][2]'] = $list_id;
}

$answer5 = $uni->importContacts($request);

echo '<pre>'.print_r($answer5).'</pre>';



$EmailMessage = [
    'sender_name' => 'Трайв-Комплект',
    'sender_email' => 'info@traiv-komplekt.ru',
    'list_id' => $list_id,
    'template_id' => $template_id
];

$createEmail = $uni->createEmailMessage($EmailMessage);

$answer6 = json_decode($createEmail);

echo '<pre>'.print_r($answer6).'</pre>';



$message_id = $answer6->result->message_id;

$SendMessage = [
    'message_id' => $message_id
];

$createCampaign = $uni->createCampaign($SendMessage);

echo '<pre>'.print_r($createCampaign).'</pre>';

























