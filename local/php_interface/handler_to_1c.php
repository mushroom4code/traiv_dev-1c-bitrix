<?
use Bitrix\Main\EventManager;

defined("CATALOG_ID", 20);


EventManager::getInstance()->addEventHandler(
	'sale',
	'OnSaleOrderSaved',
	'OnSaleOrderSavedHandler'
);


function makeAndSendOrder($orderID){
    if (empty($orderID)){
        return;
    }

    $order = Bitrix\Sale\Order::load($orderID);

    $propertyCollection = $order->getPropertyCollection();
    $personTypeId = $order->getPersonTypeId();

    $beforeJsonArray["Данные"] = array();

    //Определяем Физ или Юр лицо


    $beforeJsonArray["Данные"]["НомерЗаявки"] = $order->getId();


    if ($personTypeId == 1) {
        $beforeJsonArray["Данные"]["ЮрФизЛицо"] = "ФизЛицо";
        $beforeJsonArray["Данные"]["НаименованиеКлиента"] = $propertyCollection->getItemByOrderPropertyId(1)->getValue();
        $beforeJsonArray["Данные"]["КонтактныйТелефон"] = $propertyCollection->getItemByOrderPropertyId(3)->getValue();
        $beforeJsonArray["Данные"]["ПочтовыйЭлектронныйАдрес"] = $propertyCollection->getItemByOrderPropertyId(2)->getValue();
        $beforeJsonArray["Данные"]["ИНН"] = $propertyCollection->getItemByOrderPropertyId(20)->getValue();
        $beforeJsonArray["Данные"]["Город"] = $propertyCollection->getItemByOrderPropertyId(5)->getValue();
    }

    if ($personTypeId == 2) {
        $beforeJson .= "<ЮрФизЛицо>ЮрЛицо</>";
        $beforeJsonArray["Данные"]["ЮрФизЛицо"] = "ЮрЛицо";
        $beforeJsonArray["Данные"]["НаименованиеКлиента"] =  $propertyCollection->getItemByOrderPropertyId(12)->getValue();
        $beforeJsonArray["Данные"]["КонтактныйТелефон"] = $propertyCollection->getItemByOrderPropertyId(14)->getValue();
        $beforeJsonArray["Данные"]["ПочтовыйЭлектронныйАдрес"] = $propertyCollection->getItemByOrderPropertyId(13)->getValue();
        $beforeJsonArray["Данные"]["ИНН"] = $propertyCollection->getItemByOrderPropertyId(10)->getValue();
        $beforeJsonArray["Данные"]["Город"] = $propertyCollection->getItemByOrderPropertyId(17)->getValue();
    }

    //Определяем способ доставки
    $statOrder = CSaleOrder::GetByID($orderID);
    if ($statOrder) {

        $arDeliv = CSaleDelivery::GetByID($statOrder["DELIVERY_ID"]);


        if (empty($arDeliv["NAME"])){
            $beforeJsonArray["Данные"]["Доставка"] = "";
        } else {
            $beforeJsonArray["Данные"]["Доставка"] = $arDeliv["NAME"];
        }
    }

    $beforeJsonArray["Данные"]["Комментарий"] = $order->getField('USER_DESCRIPTION');

    $beforeJsonArray["Товары"] = array();
    $basket = $order->getBasket();
    $basketItems = $basket->getBasketItems();
    //цикл по товарам
    foreach ($basket as $basketItem) {
        $goods = array();
        //выбираем артикул
        if (CModule::IncludeModule("iblock")) {
            $db_props = CIBlockElement::GetProperty(CATALOG_ID, $basketItem->getProductId(), Array("sort" => "asc"),
                Array("CODE" => "CML2_ARTICLE"));
            if ($ar_props = $db_props->Fetch()) {
                $goods["Строка"]["Артикул"] = $ar_props["VALUE"];
            }
        }

        $goods["Строка"]["НаименованиеТовара"] = $basketItem->getField('NAME');
        $goods["Строка"]["Количество"] = $basketItem->getQuantity();

        //выбираем единицу измерения
        $db_res = CCatalogProduct::GetList(false, array("ID" => $basketItem->getProductId()), false, false,
            array('MEASURE'));
        if ($ar_res = $db_res->Fetch()) {
            if (empty($ar_res['MEASURE'])) {
                $arDefaultMeasure = CIBlockPriceTools::GetDefaultMeasure();
                $goods["Строка"]["ЕдиницаИзмерения"] = $arDefaultMeasure['SYMBOL_RUS'];

            } else {
                $rsMeasures = CCatalogMeasure::getList(false, array('ID' => $ar_res['MEASURE']), false, false, false);
                if ($arMeasure = $rsMeasures->GetNext()) {

                    $goods["Строка"]["ЕдиницаИзмерения"] = $arMeasure['SYMBOL_RUS'];
                }
            }
        }
        $beforeJsonArray["Товары"][] = $goods;
    }

    
    //POST-запрос на 1с
    $json = json_encode($beforeJsonArray, JSON_UNESCAPED_UNICODE);
    if ($curl = curl_init()) {
        curl_setopt($curl, CURLOPT_URL, 'https://office.traiv.ru:6443/trade2015/hs/SiteExchange');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
        $out = curl_exec($curl);

        $file_name = $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/data_to_1c.txt";

        $file = file_get_contents($file_name);
        $json = $file . $json;
        file_put_contents($file_name, $json . "\n" . date("Y-m-d H:i:s") . "\n=====================\n\n");

        /*
        $f = fopen($file_name, "w+");
        fwrite($f, print_r($json, true));
        fclose($f);
        */

        curl_close($curl);
    }
}

function OnSaleOrderSavedHandler(Bitrix\Main\Event $event)
{
	if (!$event->getParameter("IS_NEW")) {
		return;
	}
	$order = $event->getParameter("ENTITY");

    //если есть товары, то отсылаем
    $basket = $order->getBasket();
    $basketItems = $basket->getBasketItems();
    if (!empty($basketItems)){
        makeAndSendOrder($order->getId());
    }
}
?>